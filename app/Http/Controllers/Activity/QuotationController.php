<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Jartest;
use App\Models\Activity\Quotation;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotations = Quotation::with('prospect', 'branch')->where('branch_id', 1)->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Jartest')->get();
        return view('pages.activity.Quotation.quotation', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Quotation',
        ], compact('quotations', 'prospects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'no_sp' => ['required'],
                'category' => ['required'],
                'payment' => ['required'],
                'date_quotation' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_quotation'] = 'QUO/PKU/'. $getDate.'/'.rand(1, 999);

            Quotation::create([
                'code_quotation' => $request->code_quotation,
                'prospect_id' => $request->prospect_id,
                'no_sp' => $request->no_sp,
                'category_quotation' => $request->category,
                'date_quotation' => $request->date_quotation,
                'payment' => $request->payment,
                'remark' => $request->remark,
                'branch_id' => 1,
            ]);

            Prospect::find($request->prospect_id)->update(['status_prospect' => 'Quotation']);

            Jartest::where('prospect_id', $request->prospect_id)->update(['status_jartest' => 'Done']);

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
    public function show(Quotation $quotation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Quotation')->get();
        return view('pages.activity.Quotation.editQuotation', [
            'state_menu' => 'activity',
            'menu_title' => 'Edit Quotation',
        ], compact('quotation', 'prospects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        // dd($request->all());
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'no_sp' => ['required'],
                'category' => ['required'],
                'payment' => ['required'],
                'date_quotation' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $quotation->update([
                'prospect_id' => $request->prospect_id,
                'no_sp' => $request->no_sp,
                'category_quotation' => $request->category,
                'payment' => $request->payment,
                'date_quotation' => $request->date_quotation,
                'remark' => $request->remark,
            ]);

            return redirect()->route('quotation.index')->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'quotation.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }


    public function updateStatusQuotation(Quotation $quotationId)
    {
        $quotationId->update([
            'status_quotation' => 'Progress'
        ]);
        return redirect()->route('quotation.index')->with('success', 'Submit quotation successfully 🚀');
    }
}
