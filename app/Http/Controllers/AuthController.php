<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'     
        ]);

        // $isExist = User::findOrFail($email);

        $hashPassword = Hash::make($request->password);

        $newUser = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $hashPassword
        ]);
        return response()->json(['message' => 'Your account has being created'], 201);
    }

    public function Login(Request $request) {
      $user =  User::where('email', $request->email)->first();

       if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message'=>'Invalid password or email'], 401);
       }

       $token = $user->createToken('api-token')->plainTextToken;

       return response()->json([
        'message'=>'Login successful, explore the app!', 
        'token'=> $token
       ],200);

    }
}
