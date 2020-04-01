<?php


namespace App\Http\Controllers;


use App\Models\User;

class WelcomeController
{
    public function index()
    {
        $user = User::all();
        return $user;
        return 'welcome';
    }
}