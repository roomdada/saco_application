<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class DepartmentTable extends Component implements HasTable
{
      use InteractsWithTable;

    protected function getTableQuery()
    {
        return \App\Models\Department::query()->withCount('users', 'superior');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Nom'),
            TextColumn::make('users_count')->label('Nombre d\'utilisateurs'),
            TextColumn::make('superior.full_name')->label('Responsable')->searchable(),
        ];
    }
    public function render()
    {
        return view('livewire.department.department-table');
    }
}
