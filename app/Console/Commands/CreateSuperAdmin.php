<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a superadmin user for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the superadmin name?');
        $email = $this->ask('Enter the superadmin email?');
        
        // Keep asking for password until they match
        do {
            $password = $this->secret('Enter the superadmin password?');
            $confirmPassword = $this->secret('Please confirm the password');
            
            if ($password !== $confirmPassword) {
                $this->error('Passwords do not match. Please try again.');
            }
        } while ($password !== $confirmPassword);

        // Validate input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $confirmPassword,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Create superadmin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'is_active' => true,
            'department' => 'Administration',
            'position' => 'Super Administrator'
        ]);

        $this->info('Superadmin user created successfully!');
        $this->info('Email: ' . $email);
        $this->info('Role: admin');

        return 0;
    }
} 