<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Introduction;
use App\Models\Activity\Mapping;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IntroductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $introductions = Introduction::with('prospect', 'branch')->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Mapping')->get();
        return view('pages.activity.introduction.introduction', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Introduction',
        ], compact('prospects', 'introductions'));
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
                'date_introduction' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_introduction'] = 'INT/PKU/'. $getDate.'/'.rand(1, 999);

            Introduction::create([
                'code_introduction' => $request->code_introduction,
                'prospect_id' => $request->prospect_id,
                'date_introduction' => $request->date_introduction,
                'remark' => $request->remark,
                'branch_id' => 1,
            ]);

            Prospect::find($request->prospect_id)->update(['status_prospect' => 'Introduction']);

            Mapping::where('prospect_id', $request->prospect_id)->update(['status_mapping' => 'Done']);

            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Introduction $introduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Introduction $introduction)
    {
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Introduction')->get();
        return view('pages.activity.introduction.editIntroduction', [
            'state_menu' => 'activity',
            'menu_title' => 'Edit Introduction',
        ], compact('introduction', 'prospects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Introduction $introduction)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'date_introduction' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $introduction->update([
                'prospect_id' => $request->prospect_id,
                'date_introduction' => $request->date_introduction,
                'remark' => $request->remark,
            ]);

            return redirect()->route('introduction.index')->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Introduction $introduction)
    {
        //
    }
}
