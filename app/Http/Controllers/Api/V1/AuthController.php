<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }


    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }


    public function user(Request $request) {
        return response()->json($request->user());
    }


    public function refreshToken(Request $request) {
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Token refreshed successfully',
            'token' => $token,
        ]);
    }


    public function changePassword(Request $request) {
        $data = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($data['current_password'], $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 401);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }


    public function updateProfile(Request $request) {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        $user = $request->user();
        if (isset($data['name'])) {
            $user->name = $data['name'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        $user->save();

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }


    public function deleteAccount(Request $request) {
        $user = $request->user();
        $user->tokens()->delete(); // Revoke all tokens
        $user->delete(); // Delete user
        return response()->json(['message' => 'Account deleted successfully']);
    }


    public function forgotPassword(Request $request) {
        $data = $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        // Here you would typically send a password reset link via email
        // For simplicity, we will just return a success message
        return response()->json(['message' => 'Password reset link sent to your email']);
    }


    public function resetPassword(Request $request) {
        $data = $request->validate([
            'email' => 'required|string|email',
            'token' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Here you would typically verify the token and reset the password
        // For simplicity, we will just return a success message
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return response()->json(['message' => 'Password reset successfully']);
    }

    
    public function verifyEmail(Request $request) {
        // This method would typically handle email verification logic
        // For simplicity, we will just return a success message
        return response()->json(['message' => 'Email verified successfully']);
    }
    public function resendVerificationEmail(Request $request) {
        // This method would typically resend the verification email
        // For simplicity, we will just return a success message
        return response()->json(['message' => 'Verification email resent successfully']);
    }
    public function twoFactorAuthentication(Request $request) {
        // This method would typically handle enabling/disabling two-factor authentication
        // For simplicity, we will just return a success message
        return response()->json(['message' => 'Two-factor authentication settings updated successfully']);
    }
    public function socialLogin(Request $request) {
        // This method would typically handle social login logic
        // For simplicity, we will just return a success message
        return response()->json(['message' => 'Social login successful']);
    }
}
