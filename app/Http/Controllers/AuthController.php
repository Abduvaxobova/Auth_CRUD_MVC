<?php

namespace App\Http\Controllers;
use view;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=>bcrypt($request->password),
       ]);
       Auth::login($user);
       return redirect()->route("products.index");
    }
    public function registerForm()
    {
        return view("auth.register");
    }
    public function login(LoginRequest $request){
        $user = User::where("email", $request->email)->firstOrFail();
        if(!$user || !Hash::check($request->password, $user->password)) {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->back();
            }
        }
        return redirect()->route('products.index');
    }
    public function loginForm()
    {
        return view("auth.login");
    }
    public function logout()
    {

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
