<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Partner\Customer;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('branch')->get();
        $prospects = Prospect::with('customer', 'branch')->get();
        return view('pages.projects.prospect.prospect', [
            'state_menu' => 'projects',
            'menu_title' => 'Menu Prospects',
        ], compact('customers', 'prospects'));
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
                'customer_id' => ['required'],
                'pic_customer' => ['required'],
                'cp_customer' => ['required'],
                'date_start' => ['required'],
                'type_service' => ['required'],
                'pic_sales' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_prospect'] = 'PRO/PKU/'. $getDate.'/'.rand(1, 999);

            Prospect::create([
                'code_prospect' => $request->code_prospect,
                'customer_id' => $request->customer_id,
                'pic_customer' => $request->pic_customer,
                'cp_customer' => $request->cp_customer,
                'date_start' => $request->date_start,
                'type_service' => $request->type_service,
                'pic_sales' => $request->pic_sales,
                'status_prospect' => 'Progress',
                'branch_id' => '1',
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
    public function show(Prospect $prospect)
    {
        return view('pages.projects.prospect.viewProspect', [
            'state_menu' => 'projects',
            'menu_title' => 'Menu Projects',
        ], compact('prospect'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prospect $prospect)
    {
        $customers = Customer::with('branch', 'prospect')->get();
        return view('pages.projects.prospect.editProspect', [
            'state_menu' => 'projects',
            'menu_title' => 'Edit Prospect',
        ], compact('prospect', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prospect $prospect)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'customer_id' => ['required'],
                'pic_customer' => ['required'],
                'cp_customer' => ['required'],
                'date_start' => ['required'],
                'type_service' => ['required'],
                'pic_sales' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $prospect->update([
                'customer_id' => $request->customer_id,
                'pic_customer' => $request->pic_customer,
                'cp_customer' => $request->cp_customer,
                'date_start' => $request->date_start,
                'type_service' => $request->type_service,
                'pic_sales' => $request->pic_sales,
            ]);
            return redirect()->route('prospect.index')->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prospect $prospect)
    {
        $prospect->delete();
        return redirect()->back()->with('success', 'Data has been deleted 🚀');
    }
}
