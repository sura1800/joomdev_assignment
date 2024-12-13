<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    
    public function index(Request $request){
        $users = User::get();
        return view('dashboard',compact(['users']));
    }

    public function register(Request $request){
        $request->validate([
            'name'       => 'required|string',
            'email'      => 'required|email',
            'password'   => 'required|string',
        ]);

       $user =  User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user){
            return redirect()->back()->withSuccess('User created successfully.');
        }else{
            return redirect()->back()->withErrors('Error!! while creating user!!!');
        }
    }
}
