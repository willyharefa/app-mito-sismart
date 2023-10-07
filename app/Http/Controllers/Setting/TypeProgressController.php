<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\TypeProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TypeProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeProgress = TypeProgress::all();
        return view('pages.setting.typeProgress.typeProgress', [
            'state_menu' => 'setting',
            'menu_title' => 'Type Progress Setting'
        ], compact('typeProgress'));
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
                'name_progress' => ['required', 'min:5'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            TypeProgress::create([
                'name_progress' => $request->name_progress,
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
    public function show(TypeProgress $typeProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeProgress $typeProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeProgress $typeProgress)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name_progress_edit' => ['required', 'min:5'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $typeProgress->update([
                'name_progress' => $request->name_progress_edit,
            ]);
            return redirect()->back()->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeProgress $typeProgress)
    {
        $typeProgress->delete();
        return redirect()->back()->with('success', 'Data has been deleted ✅');
    }
}
