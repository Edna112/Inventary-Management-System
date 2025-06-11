<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function login(array $credentials);
    public function register(array $data);
    public function logout();
    public function resetPassword(array $data);
    public function getUserProfile($userId);
}