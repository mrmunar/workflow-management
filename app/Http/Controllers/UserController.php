<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function signup(Request $request){

        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function signin(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->all();
        $login_type = filter_var( $credentials['username'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

        try {
            if(!$token = JWTAuth::attempt([$login_type => $credentials['username'], 'password' => $credentials['password']])) {
                return response()->json([
                    'errors' => array(
                        'login' => 'Invalid Credentials!'
                    )            
                ], 401);
            }
        } catch(JWTException $e) {
            return response()->json([
                'errors' => array(
                    'login' => 'Could not create token!'
                )
            ], 500);
        }

        return response()->json([
            'token' => $token
        ]);
    }
    
    public function isLoggedIn(Request $request){
        $new_token = JWTAuth::refresh($request->query('token'));
        return response()->json([
            'token' => $new_token
        ]);
    }

    public function getUsersForDropdown(){
        $users = User::select('id', 'username')->get();
        return response()->json([
            'result' => $users
        ], 201);
    }
}