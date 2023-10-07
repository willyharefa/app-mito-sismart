<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\PoInternal;
use Illuminate\Http\Request;

class PoInternalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.transaction.poInternal.poInternal', [
            'state_menu' => 'transaction',
            'menu_title' => 'PO Internal'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PoInternal $poInternal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoInternal $poInternal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PoInternal $poInternal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoInternal $poInternal)
    {
        //
    }
}
