<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Deal;
use App\Models\Activity\Negotiation;
use App\Models\Partner\Customer;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('branch')->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Negotiation')->get();
        return view('pages.activity.deals.deal', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Deals',
        ], compact('prospects', 'customers'));
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
                'prospect_id' => ['required'],
                'quotation_id' => ['required'],
                'date_deal' => ['required'],
                'no_po' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_deal'] = 'DEAL/PKU/'. $getDate.'/'.rand(1, 999);

            Deal::create([
                'code_deal' => $request->code_deal,
                'prospect_id' => $request->prospect_id,
                'quotation_id' => $request->quotation_id,
                'date_deal' => $request->date_deal,
                'no_po' => $request->no_po,
                'remark' => $request->remark,
                'branch_id' => 1,
            ]);

            Prospect::find($request->prospect_id)->update(['status_prospect' => 'Deals PO']);

            Negotiation::where('prospect_id', $request->prospect_id)->update(['status_negotiation' => 'Done']);

            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch(\Exception $e) {
            report($e);
            return $e;
            // return view('components.errors.400', [
            //     'message' => 'Something went wrong, Please try again.',
            //     'route' => 'deal.index',
            //     'title' => 'Bad Request'
            // ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        //
    }
}
