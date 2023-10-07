<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('pages.setting.branch.branch', [
            'state_menu' => 'setting',
            'menu_title' => 'Branches Setting'
        ], compact('branches'));
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
                'code_branch' => ['required', 'unique:branches', 'min:3'],
                'name_branch' => ['required', 'min:4'],
                'npwp_branch' => ['required', 'max:16'],
                'contact_branch' => ['required'],
                'address_branch' => ['required'],
                'pic_branch' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            Branch::create([
                'code_branch' => $request->code_branch,
                'name_branch' => $request->name_branch,
                'npwp_branch' => $request->npwp_branch,
                'contact_branch' => $request->contact_branch,
                'address_branch' => $request->address_branch,
                'pic_branch' => $request->pic_branch
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
    public function show(Branch $branch)
    {
        return view('pages.setting.branch.viewBranch', [
            'state_menu' => 'setting',
            'menu_title' => 'Detail Branch'
        ], compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('pages.setting.branch.editBranch', [
            'state_menu' => 'setting',
            'menu_title' => 'Edit Branch'
        ], compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'code_branch' => ['required', 'min:3'],
                'name_branch' => ['required', 'min:4'],
                'npwp_branch' => ['required', 'max:16'],
                'contact_branch' => ['required'],
                'address_branch' => ['required'],
                'pic_branch' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $branch->update([
                'code_branch' => $request->code_branch,
                'name_branch' => $request->name_branch,
                'npwp_branch' => $request->npwp_branch,
                'contact_branch' => $request->contact_branch,
                'address_branch' => $request->address_branch,
                'pic_branch' => $request->pic_branch
            ]);
            return redirect()->route('branch.index')->with('success', 'Data has been updated ✅');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->back()->with('success', "Data has been deleted 🚀");
    }
}
