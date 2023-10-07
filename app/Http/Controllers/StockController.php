<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Stock;
use App\Models\Setting\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        $stocks = Stock::with('branch')->latest()->get();
        // dd($branches);
        return view('pages.inventory.StockMaster', [
            'state_menu' => 'inventory',
            'menu_title' => 'Stock Master'
        ], compact('branches', 'stocks'));
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
        try {
            $validatedData = Validator::make($request->all(), [ 
                'code_stock' => ['required', 'min:3',
                                    Rule::unique('stocks')->where(function ($query) use ($request) {
                                        return $query->where('branch_id', $request->branch_id);
                                    }),
                                ],
                'name_stock' => ['required', 'min:3'],
                'unit' => ['required', 'min:2'],
                'packaging' => ['required'],
                'branch_id' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            Stock::create($request->all());
            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch (\Throwable $e) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'penetration.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $branches = Branch::all();
        return view('pages.inventory.editStock', [
            'state_menu' => 'inventory',
            'menu_title' => 'Edit Stock',
        ], compact('stock', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        try {
            $validatedData = Validator::make($request->all(), [ 
                'code_stock' => ['required', 'min:3'],
                'name_stock' => ['required', 'min:3'],
                'unit' => ['required', 'min:2'],
                'packaging' => ['required'],
                'branch_id' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $stock->update($request->all());
            return redirect()->route('stocks.index')->with('success', 'Data has been updated ✅');

        } catch (\Throwable $e) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'penetration.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
