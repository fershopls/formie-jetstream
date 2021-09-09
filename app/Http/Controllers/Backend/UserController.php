<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function create()
    {
        return inertia('Backend/Users/Create');
    }


    public function edit(User $user)
    {
        return inertia('Backend/Users/Create', [
            'model' => $user
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        return User::create($validated);
    }
}
