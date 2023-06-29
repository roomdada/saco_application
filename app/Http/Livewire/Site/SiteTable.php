<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class SiteTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery()
    {
        return \App\Models\Site::query()->withCount('users');
    }

    protected function getTableColumns(): array
    {
        return [
          TextColumn::make('name')->label('Libellé'),
          TextColumn::make('users_count')->label('Nombre employés'),
        ];
    }
    public function render()
    {
        return view('livewire.site.site-table');
    }
}
