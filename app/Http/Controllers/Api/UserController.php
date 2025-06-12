<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Create a new user account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,manager,staff,viewer',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            Log::warning('Registeration failed due to validation errors.', ['errors' => $validator->errors()]);
            $errors = $validator->errors();
            if (!empty($errors)) {
                foreach ($errors->all() as $error) {
                    return $this->result_fail(
                        'Validation Error: ' . $error,
                        412);
                }
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
            'position' => $request->position,
            'phone' => $request->phone,
            'is_active' => $request->is_active ?? true,
            'created_by' => Auth::user()->id ?? null
        ]);

        Log::info('User created successfully.', ['user_id' => $user->id]);
        return $this->result_ok(
                'User registered and OTP sent to phone numbe.',
                ['user' => $user], 
                201
            );
        // return $this->result_ok(

        //     [
        //     'user' => $user->makeHidden(['password'])
        // ], 'User created successfully');



        // return $this->result_ok([
        //     'user' => $user->makeHidden(['password'])
        // ], 'User created successfully');
    }





    /**
     * Update a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->result_fail('User not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'role' => 'sometimes|string|in:admin,manager,staff,viewer',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->result_fail('Validation Error', $validator->errors());
        }

        $user->update($request->all());
        $user->updated_by = Auth::id();
        Log::info('User updated successfully.', ['user_id' => $user->id]);
        $user->save();

        return $this->result_ok(
            'User updated successfully',
            ['user' => $user->makeHidden(['password'])],
            200
        );
    }

    /**
     * Delete a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->result_fail('User not found', 404);
        }

        $user->delete();

        return $this->result_message('User deleted successfully', 200);
    }

    /**
     * Activate a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activateUser($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->result_fail('User not found', 404);
        }

        $user->is_active = true;
        $user->updated_by = Auth::id();
        Log::info('User activated successfully.', ['user_id' => $user->id]);
        $user->save();

        return $this->result_message('User activated successfully', 200);
    }

    /**
     * Deactivate a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivateUser($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->result_fail('User not found', 404);
        }

        $user->is_active = false;
        $user->updated_by = Auth::id();
        $user->save();

        return $this->result_message('User deactivated successfully', 200);
    }
} 