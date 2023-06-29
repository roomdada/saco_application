<?php

namespace App\Http\Livewire\Lend;

use App\Models\Lend;
use Livewire\Component;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateLendForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $state = [
        'lend_type_id' => '',
        'reason' => '',
        'amount' => ''
    ];

    public $justification = '';
    public $bank_letter = '';

    public function mount() : void
    {
        $this->form->fill(array_merge($this->state, [
            'user_id' => auth()->id(),
            'justification' => $this->justification,
            'bank_letter' => $this->bank_letter,
        ]));
    }


    protected function getFormSchema(): array
    {
        return [
            Card::make()->schema([
                Grid::make(2)->schema([
                    Select::make('state.lend_type_id')
                    ->options(\App\Models\LendType::pluck('name', 'id'))
                    ->label('Type de prêt')
                    ->rules(['required', 'exists:lend_types,id'])
                    ->required(),
                TextInput::make('state.amount')
                    ->label('Montant')
                    ->rules(['required', 'numeric'])
                    ->required(),
                FileUpload::make('justification')
                    ->label('Justificatif')
                    ->acceptedFileTypes(['application/pdf'])
                    ->rules(['required'])
                    ->required(),
                FileUpload::make('bank_letter')
                    ->acceptedFileTypes(['application/pdf'])
                    ->label('Lettre de banque')
                    ->required(),
                ]),
             Textarea::make('state.reason')
                    ->label('Motif')
                    ->required(),
            ])
        ];
    }

    public function save(){
        $this->validate();
        Lend::create([
            'lend_type_id' => $this->state['lend_type_id'],
            'user_id' => auth()->id(),
            'amount' => $this->state['amount'],
            'reason' => $this->state['reason'],
            'justification'  => self::saveFile($this->justification),
            'bank_letter' => self::saveFile($this->bank_letter),
        ]);

        Notification::make()->title('Le prêt a été enregistré avec succès')->success()->send();
        return redirect()->route('lends.index');
    }

    private static function saveFile(array $file) : ?string
    {
        foreach($file as $key => $value){
            $file = $value->store('justifications');
        }
        return $file;
    }



    public function render()
    {
        return view('livewire.lend.create-lend-form');
    }
}
