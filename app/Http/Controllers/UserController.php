<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // TODO: Return a view listing users
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,manager,staff,viewer',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'department' => $validated['department'] ?? null,
            'position' => $validated['position'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'is_active' => $request->has('is_active'),
            'created_by' => auth()->id(),
        ];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $userData['profile_photo'] = $path;
        }

        $user = \App\Models\User::create($userData);

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        // TODO: Show a single user
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        // TODO: Show edit form for a user
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // TODO: Handle updating a user
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        // TODO: Handle deleting a user
    }
} 