<?php

namespace App\Http\Livewire\Stats;

use App\Models\Lend;
use App\Models\User;
use Livewire\Component;
use App\State\Cancelled;
use App\Models\Department;
use App\State\Completed;
use App\State\Validated;

class Superior extends Component
{
    public function render()
    {
        $department = auth()->user()->department;
        $users = $department->users->pluck('id');
        $lends = Lend::whereIn('user_id', $users)->count();
        $myLends = Lend::whereUserId(auth()->user()->id)->count();
        $myLendCancelled = Lend::whereState('state', Cancelled::class)->whereUserId(auth()->user()->id)->count();
        $myLendCompleted = Lend::whereState('state', Completed::class)->whereUserId(auth()->user()->id)->count();
        $myLendValidated = Lend::whereState('state', Validated::class)->whereUserId(auth()->user()->id)->count();
        $myLendRejected = Lend::whereState('state', Rejected::class)->whereUserId(auth()->user()->id)->count();



        return view('livewire.stats.superior',[
            'users' => count($users),
            'lends' => $lends,
            'myLendCancelled' => $myLendCancelled,
            'myLends' => $myLends,
            'myLendCompleted' => $myLendCompleted,
            'myLendValidated' => $myLendValidated,
            'myLendRejected' => $myLendRejected,
        ]);
    }
}
