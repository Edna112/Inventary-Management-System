<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Classes\AuthRepository;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\AuthRepositoryInterface;


class AuthController extends Controller
{
    // Define the AuthRepository property
    protected $AuthRepository;

    public function __construct(AuthRepositoryInterface $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

    public function Register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        return $this->AuthRepository->register($data);
    }
    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        return $this->AuthRepository->login($credentials);
    }
    public function Logout()
    {
        return $this->AuthRepository->logout();
    }
    public function ResetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        return $this->AuthRepository->resetPassword($data);
    }
    public function UserProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->AuthRepository->getUserProfile($user->id);
    }
    public function UserProfileById($id)
    {
        return $this->AuthRepository->getUserProfile($id);
    }
    public function UserProfileByEmail($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $this->AuthRepository->getUserProfile($user->id);
    }

}
   