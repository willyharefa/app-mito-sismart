<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Partner\Customer;
use App\Models\Projects\Prospect;
use App\Models\Setting\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        $prospects = Prospect::with('customer', 'branch')->latest()->get();
        $sales = User::withWhereHas('position', function ($query) {
            $query->where('name', 'Sales Marketing');
        })->get();

        return view('pages.projects.prospect.prospect', [
            'state_menu' => 'projects',
            'menu_title' => 'Menu Prospects',
        ], compact('customers', 'prospects', 'sales'));
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
                'customer_id' => ['required'],
                'pic_customer' => ['required'],
                'cp_customer' => ['required'],
                'date_start' => ['required'],
                'type_service' => ['required'],
                'user_id' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $prospect = Prospect::latest()->first();

            // Get Date current
            $getDateNow = date('y');
            // Kode Prospect = PRJPKU0001
            $baseNo = "PRJPKU";

            if($prospect == null) {
                $generateNo = "0001";
            } else {
                $generateNo = substr($prospect->code_prospect, 8, 4) + 1;
                $generateNo = str_pad($generateNo, 4,"0", STR_PAD_LEFT);
            }
            
            $prospectNo = $baseNo . $getDateNow . $generateNo;

            Prospect::create([
                'code_prospect' => $prospectNo,
                'customer_id' => $request->customer_id,
                'pic_customer' => $request->pic_customer,
                'cp_customer' => $request->cp_customer,
                'date_start' => $request->date_start,
                'type_service' => $request->type_service,
                'user_id' => $request->user_id,
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
