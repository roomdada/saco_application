<?php

namespace App\Http\Controllers;

use App\Models\Lend;
use App\State\Rejected;
use App\State\Cancelled;
use App\State\Completed;
use App\State\Validated;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;

class LendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lends.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lends.create');
    }
    /**
     * Display the specified resource.
     */
    public function show(Lend $lend)
    {
        return view('lends.show', compact('lend'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lend $lend)
    {
        return view('lends.edit', compact('lend'));
    }

    public function changeState(Lend $lend, $state)
    {
        if($state === 'cancelled') {
            $lend->state->transitionTo(Cancelled::class);
            $lend->save();
            Notification::make()->title('La demande a été annulée')->success()->send();
            return back();
        }elseif($state === 'validated') {
            $lend->state->transitionTo(Validated::class);
            $lend->save();
            Notification::make()->title('La demande a été validée')->success()->send();
            return back();
        }elseif($state === 'rejected') {
            $lend->state->transitionTo(Rejected::class);
            $lend->save();
            Notification::make()->title('La demande a été rejetée')->success()->send();
            return back();
        }

        $lend->state->transitionTo(Completed::class);
        Notification::make()->title('La demande a été acceptée par la compagnie')->success()->send();
        return back();
    }
}
