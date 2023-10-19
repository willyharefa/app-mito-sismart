<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Setting\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('branch')->latest()->get();
        $positions = Position::all();
        return view('pages.authentication.user.user', [
            'state_menu' => 'authentication',
            'menu_title' => 'Menu Users'
        ], compact('users', 'positions'));
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
                'name' => ['required'],
                'nickname' => ['required'],
                'gender' => ['required'],
                'employee_id' => ['required'],
                'position_id' => ['required'],
                'phone_number' => ['required', 'unique:users'],
                'email' => ['unique:users'],
                'username' => ['required', 'unique:users'],
                'password' => ['required'],
            ]);

            if($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }
            
            User::create([
                'name' => $request->name,
                'nickname' => $request->nickname,
                'gender' => $request->gender,
                'employee_id' => $request->employee_id,
                'position_id' => $request->position_id,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'username' => $request->username,
                'branch_id' => 1,
                'password' => Hash::make($request->password)
            ]);

            return redirect()->back()->with('success', 'Data has been added ✅');

        } catch (\Exception $e) {
            return view('components.errors.400', [
                'message' => 'Something went wrong, Please try again.',
                'route' => 'user.index',
                'title' => 'Bad Request'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $positions = Position::all();
        return view('pages.authentication.user.editUser', [
            'state_menu' => 'authentication',
            'menu_title' => 'User Edit'
        ], compact('user', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        try {
            if(!$request->password) {
                $user->update([
                    'name' => $request->name,
                    'nickname' => $request->nickname,
                    'gender' => $request->gender,
                    'employee_id' => $request->employee_id,
                    'position_id' => $request->position_id,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'username' => $request->username
                ]);
                return redirect()->route('user.index')->with('success', 'Data has been updated 🚀');
            }
            
            $user->update([
                'name' => $request->name,
                'nickname' => $request->nickname,
                'gender' => $request->gender,
                'employee_id' => $request->employee_id,
                'position_id' => $request->position_id,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('user.index')->with('success', 'Data has been updated 🚀');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
