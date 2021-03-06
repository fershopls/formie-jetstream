<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }


    public function create()
    {
        return inertia('Backend/Users/Create', [
            'title' => 'Crear un Usuario'
        ]);
    }


    public function edit(User $user)
    {

        return inertia('Backend/Form', [
            'title' => 'Editar un usuario',
            'model' => $user,
            'form' => 'users.js'
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:4',
        ]);

        return User::create($validated);
    }


    public function update(User $user, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$user->id},id",
            'password' => 'nullable|confirmed|min:4',
        ]);

        $user->update($validated);

        return $user;
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }
}
