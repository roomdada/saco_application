<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;


class UserTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery()
    {
        if(auth()->user()->isChief()){
            $department = auth()->user()->department;
            $users = $department->users->pluck('id');
            $users->push(auth()->user()->id);
            return \App\Models\User::query()->whereIn('id', $users);
        }
        return \App\Models\User::query();
    }

    protected function getTableColumns(): array
    {
        return [
          TextColumn::make('identifier')->label('Identifiant'),
          TextColumn::make('first_name')->label('Nom'),
          TextColumn::make('last_name')->label('Prénoms'),
          TextColumn::make('email')->label('Email'),
         TextColumn::make('role.name')->label('Rôle'),
        ];
    }


    public function render()
    {
        return view('livewire.user.user-table');
    }
}
