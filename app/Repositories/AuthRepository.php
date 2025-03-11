<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function create(array $data){
        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password'=> Hash::make($data['password']),
        ]);
        Auth::login($user);
        return $user;
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
    public function login(array $data){
        if(!Auth ::attempt(['email' => $data['email'],'password'=>$data['password']])){
            abort(401, 'Invalid credentials');
    }
        return Auth::user();
    }
    public function logout(){
        Auth ::logout();
    }
}
