<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        return view('livewire.stats', [
            'departments' => \App\Models\Department::count(),
            'users' => \App\Models\User::count(),
            'lends' => \App\Models\Lend::count(),
            'sites' => \App\Models\Site::count(),
        ]);
    }
}
