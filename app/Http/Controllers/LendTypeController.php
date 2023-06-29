<?php

namespace App\Http\Controllers;

use App\Models\LendType;
use Illuminate\Http\Request;

class LendTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lendTypes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lendTypes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(LendType $lendType)
    {
        return view('lendTypes.show', compact('lendType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LendType $lendType)
    {
        return view('lendTypes.edit', compact('lendType'));
    }
}
