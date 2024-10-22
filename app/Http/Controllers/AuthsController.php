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
