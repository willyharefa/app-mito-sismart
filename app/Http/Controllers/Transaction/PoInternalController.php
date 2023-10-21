<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\PoInternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        dd($request->all());
        try {
            $validatorData = Validator::make($request->all(), [
                'po_internal' => ['required', 'unique:po_internals'],
                'name_customer' => ['required'],
                'date_po_in' => ['required'],
                'sales' => ['required']
            ]);

            if($validatorData->fails()) {
                return redirect()->back()->withErrors($validatorData)->withInput();
            }

            
        } catch (\Throwable $th) {
            //throw $th;
        }
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
