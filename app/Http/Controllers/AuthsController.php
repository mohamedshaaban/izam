<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MwListingVisitor;
use App\Models\MwListingVisitorsPasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthsController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $user = \App\Models\User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        return returnApi(['success'=>'true','status'=>1,'message'=>'Product created successfully','user'=>$user,'access_token'=>$accessToken]);

    }
    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth()->attempt($requestData)){
            return response()->json(['errors' => __('auth.invalid_login')], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
 return response(['user' => auth()->user(), 'access_token' => $accessToken], 200);

    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }



}
