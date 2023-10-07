<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Jartest;
use App\Models\Activity\Penetration;
use App\Models\Inventory\Stock;
use App\Models\Projects\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JartestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::with('branch')->where('branch_id', 1)->get();
        $jartests = Jartest::with('prospect', 'branch')->where('branch_id', 1)->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Penetration')->get();
        return view('pages.activity.jartest.jartest', [
            'state_menu' => 'activity',
            'menu_title' => 'Menu Jartest',
        ], compact('jartests', 'prospects', 'stocks'));
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
                'prospect_id' => ['required'],
                'stock_id' => ['required'],
                'date_jartest' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $getDate = Carbon::now()->format('Y/m');
            $request['code_jartest'] = 'JAR/PKU/'. $getDate.'/'.rand(1, 999);

            Jartest::create([
                'code_jartest' => $request->code_jartest,
                'prospect_id' => $request->prospect_id,
                'stock_id' => $request->stock_id,
                'date_jartest' => $request->date_jartest,
                'remark' => $request->remark,
                'branch_id' => 1,
            ]);

            Prospect::find($request->prospect_id)->update(['status_prospect' => 'Jartest']);

            Penetration::where('prospect_id', $request->prospect_id)->update(['status_penetration' => 'Done']);

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
    public function show(Jartest $jartest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jartest $jartest)
    {
        $stocks = Stock::with('branch')->where('branch_id', 1)->get();
        $prospects = Prospect::with('customer', 'branch')->where('status_prospect', 'Jartest')->get();
        return view('pages.activity.jartest.editJartest', [
            'state_menu' => 'activity',
            'menu_title' => 'Edit Jartest',
        ], compact('prospects', 'jartest', 'stocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jartest $jartest)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'prospect_id' => ['required'],
                'stock_id' => ['required'],
                'date_jartest' => ['required'],
                'remark' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $jartest->update([
                'prospect_id' => $request->prospect_id,
                'stock_id' => $request->stock_id,
                'date_jartest' => $request->date_jartest,
                'remark' => $request->remark,
            ]);

            return redirect()->route('jartest.index')->with('success', 'Data has been updated 🚀');

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
    public function destroy(Jartest $jartest)
    {
        try {
            $jartest->delete();
            Prospect::find($jartest->prospect_id)->update([
                'status_prospect' => 'Penetration',
            ]);
            Penetration::where('prospect_id', $jartest->prospect_id)->update([
                'status_penetration' => 'Progress'
            ]);
            return redirect()->back()->with('success', 'Data has been deleted 🚀');
        } catch (\Exception $th) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'jartest.index',
                'title' => 'Bad Request'
            ]);
        }
    }
}
