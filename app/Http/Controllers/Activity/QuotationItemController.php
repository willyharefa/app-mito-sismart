<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Quotation;
use App\Models\Activity\QuotationItem;
use App\Models\Inventory\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $stocks = Stock::with('branch')->where('branch_id', 1)->get();
        // $quotations = Quotation::with('prospect', 'branch')->where('branch_id', 1)->get();
        // return view('pages.activity.Quotation.quotationItem', [
        //     'state_menu' => 'activity',
        //     'menu_title' => 'Quotation Items',
        // ], compact('quotations', 'prospects', 'stocks'));
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
        // dd($request->all());
        try {
            $validatedData = Validator::make($request->all(), [
                'stock_id' => ['required'],
                'packaging' => ['required'],
                'unit' => ['required'],
                'qty' => ['required'],
                'unit_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                'total_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                // 'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            QuotationItem::create([
                'quotation_id' => $request->quotation_id,
                'stock_id' => $request->stock_id,
                'packaging' => $request->packaging,
                'unit' => $request->unit,
                'qty' => $request->qty,
                'unit_price' => $request->unit_price,
                'total_price' => $request->total_price
            ]);

            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch(\Exception $e) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'quotation.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuotationItem $quotationItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuotationItem $quotationItem)
    {
        $quotationItem->delete();
        return redirect()->back()->with('success', 'Data has been deleted 🚀');
    }

    public function showItemsQuotation($quotationId)
    {
        $quotation = Quotation::find($quotationId);
        $stocks = Stock::with('branch')->where('branch_id', 1)->get();
        $quotationItems = QuotationItem::where('quotation_id', $quotationId)->with('quotation', 'stock')->get();
        // dd($quotationItems);
        return view('pages.activity.Quotation.quotationItem', [
            'state_menu' => 'activity',
            'menu_title' => 'Quotation Items',
        ], compact('quotation', 'stocks', 'quotationItems'));
    }
}
