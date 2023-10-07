<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Setting\Branch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $branches = Branch::all();
        return view('pages.partner.customer.customer', [
            'state_menu' => 'partner',
            'menu_title' => 'Customers',
        ], compact('customers', 'branches'));
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
    public function store(StoreCustomerRequest $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name_customer' => ['required', 'min:3'],
                'type_bussiness' => ['required', 'min:4'],
                'npwp' => ['required', 'max:16'],
                'contact' => ['required'],
                'pic_customer' => ['required'],
                'pic_status' => ['required'],
                'email' => ['required', 'email'],
                'branch' => ['required'],
                'pic_sales' => ['required'],
                'city' => ['required'],
                'address' => ['required'],
                'about_customer' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            Customer::create([
                'name_customer' => $request->name_customer,
                'type_bussiness' => $request->type_bussiness,
                'npwp' => $request->npwp,
                'contact' => $request->contact,
                'pic_customer' => $request->pic_customer,
                'pic_status' => $request->pic_status,
                'email' => $request->email,
                'branch_id' => $request->branch,
                'pic_sales' => $request->pic_sales,
                'city' => $request->city,
                'address' => $request->address,
                'about_customer' => $request->about_customer
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
    public function show(Customer $customer)
    {
        return view('pages.partner.customer.viewCustomer', [
            'state_menu' => 'partner',
            'menu_title' => 'Detail Customer',
        ], compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $branches = Branch::all();
        return view('pages.partner.customer.editCustomer', [
            'state_menu' => 'partner',
            'menu_title' => 'Edit Customer',
        ], compact('customer', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name_customer' => ['required', 'min:3'],
                'type_bussiness' => ['required', 'min:4'],
                'npwp' => ['required', 'max:16'],
                'contact' => ['required'],
                'pic_customer' => ['required'],
                'pic_status' => ['required'],
                'email' => ['required', 'email'],
                'branch' => ['required'],
                'pic_sales' => ['required'],
                'city' => ['required'],
                'address' => ['required'],
                'about_customer' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $customer->update([
                'name_customer' => $request->name_customer,
                'type_bussiness' => $request->type_bussiness,
                'npwp' => $request->npwp,
                'contact' => $request->contact,
                'pic_customer' => $request->pic_customer,
                'pic_status' => $request->pic_status,
                'email' => $request->email,
                'branch_id' => $request->branch,
                'pic_sales' => $request->pic_sales,
                'city' => $request->city,
                'address' => $request->address,
                'about_customer' => $request->about_customer
            ]);
            return redirect()->route('customer.index')->with('success', 'Data has been updated 🚀');

        } catch (\Exception $e) {
            Log::error('Error while inserting data: ' . $e->getMessage());
            return response()->withErrors('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('success', 'Data has been deleted 🚀');
    }
}
