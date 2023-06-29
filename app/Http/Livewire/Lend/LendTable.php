<?php

namespace App\Http\Livewire\Lend;

use App\Models\Lend;
use Livewire\Component;
use App\State\Cancelled;
use App\State\Confirmed;
use App\State\Validated;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class LendTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery()
    {
        if(auth()->user()->isEmployee()) {
            return \App\Models\Lend::query()->where('user_id', auth()->user()->id)->with('lendType', 'user')->latest();
        }

        // if is chief get all lends from his department and his lends
        if(auth()->user()->isChief()) {
            $department = auth()->user()->department;
            $users = $department->users->pluck('id');
            $users->push(auth()->user()->id);
            return \App\Models\Lend::query()->whereIn('user_id', $users)->with('lendType', 'user')->latest();
        }
        return \App\Models\Lend::query()->with('lendType', 'user', 'user')->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('created_at')->label('Date')->dateTime('d F Y'),
            TextColumn::make('lendType.name')->label('Type de prêt'),
            TextColumn::make('amount')->label('Montant')->searchable(),
            TextColumn::make('user.full_name')->label('Emprunteur')->searchable(),
            BadgeColumn::make('state')->label('Statut')
                        ->color(function(Lend $record) {
                            if($record->state instanceof Confirmed) {
                                return 'warning';
                            }elseif($record->state instanceof \App\State\Rejected || $record->state instanceof \App\State\Cancelled) {
                                return 'danger';
                            }elseif($record->state instanceof \App\State\Validated) {
                                return 'primary';
                            }
                            return 'success';
                        })
                        ->formatStateUsing(fn(Lend $record) => $record->state->description()),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')->label('Annuler')->hidden(fn(Lend $record) => ! $record->canBeCancelled())->color('danger')->icon('heroicon-o-x-circle')->requiresConfirmation()->url(function (Lend $record) {
                return route('change-state', [$record, 'state' => 'cancelled']);
            }),
            Action::make('validated')->label('Approuver')->hidden(fn(Lend $record) => ! $record->canBeValidated())->icon('heroicon-o-check-circle')->requiresConfirmation()->color('warning')->url(function (Lend $record) {
                return route('change-state', [$record, 'state' =>'validated']);
            }),
            Action::make('rejected')->label('Rejeter')->hidden(fn(Lend $record) =>! $record->canBeRejected())->icon('heroicon-o-ban')->requiresConfirmation()->color('danger')->url(function (Lend $record) {
                return route('change-state', [$record, 'state' =>'rejected']);
            }),
            Action::make('completed')->label('Accepeter')->hidden(fn(Lend $record) =>! $record->canBeCompleted())->icon('heroicon-o-check-circle')->requiresConfirmation()->color('success')->url(function (Lend $record) {
                return route('change-state', [$record, 'state' =>'completed']);
            }),
        ];
    }


    public function render()
    {
        return view('livewire.lend.lend-table');
    }
}
