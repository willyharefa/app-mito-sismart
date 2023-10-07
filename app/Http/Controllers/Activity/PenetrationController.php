<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Introduction;
use App\Models\Activity\Penetration;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenetrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penetrations = Penetration::with('prospect', 'branch')->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Introduction')->get();
        return view('pages.activity.penetration.penetration', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Penetration',
        ], compact('penetrations', 'prospects'));
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
                'date_penetration' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_penetration'] = 'PEN/PKU/'. $getDate.'/'.rand(1, 999);

            Penetration::create([
                'code_penetration' => $request->code_penetration,
                'prospect_id' => $request->prospect_id,
                'date_penetration' => $request->date_penetration,
                'remark' => $request->remark,
                'branch_id' => 1,
            ]);

            Prospect::find($request->prospect_id)->update(['status_prospect' => 'Penetration']);

            Introduction::where('prospect_id', $request->prospect_id)->update(['status_introduction' => 'Done']);

            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch(\Exception $e) {
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
    public function show(Penetration $penetration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penetration $penetration)
    {
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Penetration')->get();
        return view('pages.activity.penetration.editPenetration', [
            'state_menu' => 'activity',
            'menu_title' => 'Edit Penetration',
        ], compact('penetration', 'prospects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penetration $penetration)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'date_penetration' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $penetration->update([
                'prospect_id' => $request->prospect_id,
                'date_penetration' => $request->date_penetration,
                'remark' => $request->remark,
            ]);

            return redirect()->route('penetration.index')->with('success', 'Data has been updated 🚀');

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
    public function destroy(Penetration $penetration)
    {
        try {
            $penetration->delete();
            Prospect::find($penetration->prospect_id)->update([
                'status_prospect' => 'Introduction',
            ]);
            Introduction::where('prospect_id', $penetration->prospect_id)->update([
                'status_introduction' => 'Progress'
            ]);
            return redirect()->back()->with('success', 'Data has been deleted 🚀');
        } catch (\Exception $th) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'penetration.index',
                'title' => 'Bad Request'
            ]);
        }
    }
}
