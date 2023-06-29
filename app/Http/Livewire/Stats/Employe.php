<?php

namespace App\Http\Livewire\Stats;

use App\Models\Lend;
use Livewire\Component;
use App\State\Cancelled;
use App\State\Completed;
use App\State\Rejected;
use App\State\Validated;

class Employe extends Component
{

    public function render()
    {
        $myLends = Lend::whereUserId(auth()->user()->id)->count();
        $myLendCancelled = Lend::whereState('state', Cancelled::class)->whereUserId(auth()->user()->id)->count();
        $myLendCompleted = Lend::whereState('state', Completed::class)->whereUserId(auth()->user()->id)->count();
        $myLendValidated = Lend::whereState('state', Validated::class)->whereUserId(auth()->user()->id)->count();
        $myLendRejected = Lend::whereState('state', Rejected::class)->whereUserId(auth()->user()->id)->count();

        return view('livewire.stats.employe', [
            'myLendCancelled' => $myLendCancelled,
            'myLends' => $myLends,
            'myLendCompleted' => $myLendCompleted,
            'myLendValidated' => $myLendValidated,
            'myLendRejected' => $myLendRejected,
        ]);
    }
}
