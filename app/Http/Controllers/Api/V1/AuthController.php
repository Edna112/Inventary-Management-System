<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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


    public function login(Request $request)
    {
        try {
            // Convert email to lowercase if it exists in the request
            if ($request->has('email')) {
                $request->merge(['email' => strtolower($request->input('email'))]);
            }

            // Log the incoming registration request.
            Log::info('Login request received', ['user' => 'Anonymous']);

            // Define custom error messages
            $messages = [
                'password.required' => 'Password is required.',
                'email.string' => 'Email must be a string.',
                'email.email' => 'Email must be a valid email address.',
                'email.max' => 'Email must not exceed 255 characters.',
            ];

            // Validate the request
            $validator = Validator::make($request->all(), [
                'email' => 'string|email|max:255',
                'password' => 'required|string',
            ], $messages);

            // Check if validation fails
            if ($validator->fails()) {
                Log::warning('Login failed due to validation errors.', ['errors' => $validator->errors()]);
                $errors = $validator->errors();
                if (!empty($errors)) {
                    foreach ($errors->all() as $error) {
                        return $this->result_fail(
                            'Validation Error: ' . $error,
                            412);
                    }
                }
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                Log::warning('Invalid login attempt', ['email' => $request->email]);
                return $this->result_fail(
                    'Invalid login details.',
                    401);
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Update last login time
            $user->last_login_at = Carbon::now();
            $user->save();

            Log::info('User logged in successfully', ['user' => $user]);
            
            // Generate token
            $tokenResult = $user->createToken('Login');
            $token = $tokenResult->accessToken;

            // Return success response
            return $this->result_ok(
                'Login successful.',
                [
                    'token' => $token,
                    'expires_at' => $tokenResult->token->expires_at,
                    'user' => $user
                ],
                200);
        } catch (\Exception $e) {
            // Log the error and return response
            Log::error("Error during login: " . $e->getMessage());
            return $this->result_fail(
                'An unexpected error occurred during login.',
                500
            );
        }
    }

    
    /**
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout user",
     *     description="Revoke the user's access token and log them out",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated"),
     *             @OA\Property(property="status", type="integer", example=401)
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            
            if ($user) {

                $token = $request->user()->token();
                // $accessTokenId = $request->user()->token()->id;
    
                // Revoke the token to log the user out
                $token->revoke();

                // Revoke the token that was used to authenticate the current request
                // $user->currentAccessToken()->delete();
                
                Log::info('User logged out successfully', [
                    'user_id' => $user->id,
                    'email' => $user->email
                ]);
                
                return $this->result_ok(
                    'Successfully logged out',
                    null,
                    200
                );
            }

        } catch (\Exception $e) {
            Log::error('Logout failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return $this->result_fail(
                'Logout failed',
                $e->getMessage(),
                500
            );
        }
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
