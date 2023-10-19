<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Mapping;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mappings = Mapping::with(['prospect', 'branch'])->latest()->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Progress')->latest()->get();
        return view('pages.activity.mapping.mapping', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Mapping',
        ], compact('mappings', 'prospects'));
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
                'date_mapping' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            Mapping::create([
                'prospect_id' => $request->prospect_id,
                'date_mapping' => $request->date_mapping,
                'remark' => $request->remark,
                'branch_id' => '1',
            ]);

            Prospect::find($request->prospect_id)->update([
                'status_prospect' => 'Mapping',
            ]);
            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapping $mapping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapping $mapping)
    {
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Mapping')->get();
        return view('pages.activity.mapping.editMapping', [
            'state_menu' => 'activity',
            'menu_title' => 'Edit Mapping',
        ], compact('mapping', 'prospects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapping $mapping)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'date_mapping' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $mapping->update([
                'prospect_id' => $request->prospect_id,
                'date_mapping' => $request->date_mapping,
                'remark' => $request->remark,
            ]);
            return redirect()->route('mapping.index')->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapping $mapping)
    {
        //
    }
}
