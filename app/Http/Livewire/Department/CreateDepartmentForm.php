<?php

namespace App\Http\Livewire\Department;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class CreateDepartmentForm extends Component implements HasForms
{
    use \Filament\Forms\Concerns\InteractsWithForms;

    public $state = [
        'name' => '',
        'description' => '',
    ];

    public function mount()
    {
        $this->form->fill($this->state);
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()->schema([
                Grid::make(1)->schema([
                    TextInput::make('state.name')->autofocus()->required(),
                ]),
            Textarea::make('state.description'),
            ])
        ];
    }

    public function save()
    {
        $this->validate();

        $department = \App\Models\Department::create($this->state);
        Notification::make()
            ->title('Le département a été créé avec succès.')
            ->success()
            ->send();
        return redirect()->route('departments.index');
    }
    public function render()
    {
        return view('livewire.department.create-department-form');
    }
}
