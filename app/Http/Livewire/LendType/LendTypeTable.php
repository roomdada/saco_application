<?php

namespace App\Http\Livewire\LendType;

use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class LendTypeTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery()
    {
        return \App\Models\LendType::query()->withCount('lends');
    }

    protected function getTableColumns(): array
    {
        return [
          TextColumn::make('name')->label('Libellé'),
            TextColumn::make('lends_count')->label('Nombre de prêts'),
        ];
    }
    public function render()
    {
        return view('livewire.lend-type.lend-type-table');
    }
}
