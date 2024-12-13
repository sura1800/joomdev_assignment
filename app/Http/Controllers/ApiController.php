<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ApiController extends Controller
{
    

    public function login(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors(),], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials.',], 401);
        }

        if($user->password_changes_status == '0'){
            $change_password_url = url('api/change-password');
            return response()->json(['message' => 'Please change your password!!.', 'url' => $change_password_url],422);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message' => 'Login successful.', 'access_token' => $token, 'token_type' => 'Bearer',]);
        
    }

    public function logout(Request $request){

            $user = auth('sanctum')->user();
            if($user){
                $user->tokens()->delete();
                return response()->json(['message' => 'Logout successful.'],200);
            }
            else{
                return response()->json(['message' => 'Token expired.',],401);
            }
    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        if ($validator->fails()) {
        return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors(),], 422);
        }

        $user = auth('sanctum')->user();

        if(!$user){
            return response()->json(['message' => 'Token expired.',],401);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect.',], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->password_changes_status = 1;
        $user->password_updated_at = date('Y-m-d');

        if($user->save()){
            return response()->json(['message' => 'Password changed successfully.',]);
        }
        else{
            return response()->json(['message' => 'Error!! while updating password.',], 401);
        }
    }



}
