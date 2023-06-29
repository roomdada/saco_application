<?php

namespace App\Models;

use App\State\Rejected;
use App\State\Cancelled;
use App\State\Completed;
use App\State\LendState;
use App\State\Validated;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lend extends Model
{
    use HasFactory, HasStates;

    protected $casts = [
        'state' => LendState::class,
    ];

    protected $guarded = [];

    public function lendType()
    {
        return $this->belongsTo(LendType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canBeCancelled() : bool
    {
        return $this->state->canTransitionTo(Cancelled::class) && $this->user_id === auth()->user()->id;
    }

    public function canBeValidated() : bool
    {
        return  $this->state->canTransitionTo(Validated::class) && auth()->user()->isChief();
    }

    public function canBeRejected() : bool
    {
        return $this->state->canTransitionTo(Rejected::class) && auth()->user()->isAdmin();
    }

    public function canBeCompleted() : bool
    {
        return $this->state->canTransitionTo(Completed::class) && auth()->user()->isAdmin();
    }

}
