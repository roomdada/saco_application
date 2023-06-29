<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateUserForm extends Component implements HasForms
{
    use  InteractsWithForms;

    public $state = [
        'identifier' => '',
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'contact' => '',
        'department_id' => '',
        'site_id' => '',
        'role_id' => '',
        'password' => '',
    ];

    public function mount() : void
    {
        $this->form->fill($this->state);
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()->schema([
                TextInput::make('state.identifier')
                    ->label('Matricule')
                    ->required(),
                TextInput::make('state.first_name')
                    ->label('Nom')
                    ->required(),
                TextInput::make('state.last_name')
                    ->label('Prénoms')
                    ->required(),
                TextInput::make('state.email')
                    ->label('Email')
                    ->required(),
                TextInput::make('state.contact')
                    ->label('Contact')
                    ->required(),
                Select::make('state.department_id')
                    ->label('Département')
                    ->placeholder('Sélectionnez un département')
                    ->options(\App\Models\Department::pluck('name', 'id'))
                    ->required(),
                Select::make('state.site_id')
                    ->label('Site')
                    ->placeholder('Sélectionnez un site')
                    ->options(\App\Models\Site::pluck('name', 'id'))
                    ->required(),
                Select::make('state.role_id')->options(Role::pluck('name', 'id')),
                TextInput::make('state.password')
                    ->label('Mot de passe')
                    ->password()
                    ->rules(['required', 'string', 'min:8'])
                    ->required(),
            ])->columns(2)
        ];
    }

    public function save()
    {
        $this->validate();


        $user = User::create($this->state);

        $department = \App\Models\Department::where('id', $user->department_id)->first();

        if($user->role_id === Role::SUPERIOR && $department->user_id === null) {
            $department->update(['superior_id' => $user->id]);
        }

        Notification::make()->success()->title('Le compte a été créé avec succès !')->send();
        return redirect()->route('users.index');
    }
    public function render()
    {
        return view('livewire.user.create-user-form');
    }
}
