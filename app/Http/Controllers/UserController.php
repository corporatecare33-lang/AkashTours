<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function show($id)
    {
        // 1. Fetch user data from the database
        $user = User::findOrFail($id);
        
        // 2. Send that data to a view file
        return view('user.profile', ['user' => $user]);
    }
}

Route::get('/user/{id}', [UserController::class, 'show']);