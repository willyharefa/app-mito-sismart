<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::latest()->get();
        return view('pages.setting.position.position', [
            'state_menu' => 'setting',
            'menu_title' => 'Menu Position'
        ], compact('positions'));
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
            $validatorData = Validator::make($request->all(), [
                'name' => ['required', 'unique:positions'],
            ]);

            if($validatorData->fails()) {
                return redirect()->back()->withErrors($validatorData)->withInput();
            }

            Position::create([
                'name' => $request->name
            ]);
            return redirect()->back()->with('success', 'Data has been added ✅');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'position.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $position->update([
            'name' => $request->name_edit
        ]);
        return redirect()->back()->with('success', 'Data has been updated 🚀');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->back()->with('success', 'Data has been deleted 🚀');
    }
}
