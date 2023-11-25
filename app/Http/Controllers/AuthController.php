<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthCollection;
use App\Http\Resources\ResponseCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return new AuthCollection($user,'login successful',true);
        }

        return new ResponseCollection(false,'Invalid credentials',[]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'pinyin_name'=>'required|string|max:255',
            'phone'=>'string|max:20',
            'gender'=>'required|string|max:255',
            'address'=>'string|max:255',
            'is_admin'=>'int|max:1',
            'is_ceo'=>'int|max:1',
            'status'=>'int|max:1',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return new ResponseCollection(false,'User created successfully',$user);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return new ResponseCollection(false,'Successfully logged out',[]);
    }
}
