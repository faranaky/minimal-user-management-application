<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if(Admin::where('email', $request->get('email'))->exists()){
            $user = Admin::where('email', $request->get('email'))->first();
            $auth = Hash::check($request->get('password'), $user->password);
            if($user && $auth){

                $user->rollApiKey(); //Model Function

                return response(array(
                    'token' => $user->api_token,
                    'message' => 'Authorization Successful!',
                ));
            }
        }

        return response(array(
            'message' => 'Unauthorized, check your credentials.',
        ), 401);
     }

     public function guest()
     {
         return response()->json(['error' => 'Unauthorized'], 401);
     }

     public function invalidLogin()
     {
         return response()->json(['error' => 'Invalid Credentials'], 400);
     }
}
