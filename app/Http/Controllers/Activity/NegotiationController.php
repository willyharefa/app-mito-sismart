<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Negotiation;
use App\Models\Activity\Quotation;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NegotiationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $negotiations = Negotiation::with('prospect', 'branch')->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Quotation')->get();
        return view('pages.activity.negotiation.negotiation', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Negotiation',
        ], compact('prospects', 'negotiations'));
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
                'prospect_id' => ['required'],
                'date_negotiation' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_negotiation'] = 'NEG/PKU/'. $getDate.'/'.rand(1, 999);

            Negotiation::create([
                'code_negotiation' => $request->code_negotiation,
                'prospect_id' => $request->prospect_id,
                'date_negotiation' => $request->date_negotiation,
                'remark' => $request->remark,
                'branch_id' => 1,
            ]);

            Prospect::find($request->prospect_id)->update(['status_prospect' => 'Negotiation']);

            Quotation::where('prospect_id', $request->prospect_id)->update(['status_quotation' => 'Done']);

            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch(\Exception $e) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'negotiation.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Negotiation $negotiation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Negotiation $negotiation)
    {
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Negotiation')->get();
        return view('pages.activity.negotiation.editNegotiation', [
            'state_menu' => 'activity',
            'menu_title' => 'Edit Negotiation',
        ], compact('prospects', 'negotiation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Negotiation $negotiation)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'date_negotiation' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $negotiation->update([
                'prospect_id' => $request->prospect_id,
                'date_negotiation' => $request->date_negotiation,
                'remark' => $request->remark,
            ]);

            return redirect()->route('negotiation.index')->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
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
    public function destroy(Negotiation $negotiation)
    {
        try {
            Prospect::find($negotiation->prospect_id)->update([
                'status_prospect' => 'Quotation',
            ]);
            Quotation::where('prospect_id', $negotiation->prospect_id)->update([
                'status_quotation' => 'Draf'
            ]);
            $negotiation->delete();
            return redirect()->back()->with('success', 'Data has been deleted 🚀');
        } catch (\Exception $th) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'quotation.index',
                'title' => 'Bad Request'
            ]);
        }
    }
}
