<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }
    public function createUser($data){
        return $this->authRepository->create($data);
    }
    public function login(array $data)
    {
        $user = $this->authRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            abort(401, 'Invalid credentials');
        }
        return $user;
    }
    public function logout()
    {
        $this->authRepository->logout(); // Repository orqali logout qilish

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
