<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Sppb;
use Illuminate\Http\Request;

class SppbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.transaction.sppb.sppb', [
            'state_menu' => 'transaction',
            'menu_title' => 'SPPB'
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
    public function show(Sppb $sppb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sppb $sppb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sppb $sppb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sppb $sppb)
    {
        //
    }
}
