<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect('user/dashboard');
        }
        return redirect()->back()->withErrors('Opps! You have entered invalid credentials!!!');
    }

    public function dashboard(Request $request){
        $user = User::where('id',Auth::guard('web')->id())->first(['name']);
        return view('user.dashboard',compact(['user']));
    }

    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function changePassword(Request $request){
        return view('user.change-password');
    }

    public function changePasswordAction(Request $request){
        $request->validate([
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password',
        ]);
        if(User::where('id',Auth::guard('web')->id())->update(['password' => Hash::make($request->password), 'password_changes_status' => 1, 'password_updated_at' => date('Y-m-d')])){
            return redirect()->route('user.dashboard')->withSuccess('Password changes successfully.');
        }else{
            return redirect()->back()->withErrors('Error!! while updating password!!!');
        }
    }

    public function profile(Request $request){
        $user = User::where('id',Auth::guard('web')->id())->first(['name','email']);
        return view('user.profile',compact(['user']));
    }
    
}
