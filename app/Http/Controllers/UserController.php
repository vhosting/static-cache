<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return inertia('users/Index', [
            'items' => User::query()
                ->orderBy('name')
                ->paginate(25)
                ->toResourceCollection(),
        ]);
    }

    public function create()
    {
        return inertia('users/Create');
    }

    public function store(CreateUserRequest $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        toast('success', 'Utente creato con successo!');

        return to_route('users.index');
    }

    public function edit(User $user)
    {
        return inertia('users/Edit', [
            'item' => $user->toResource(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        toast('success', 'Utente aggiornato con successo!');

        return to_route('users.index');
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        $user->update([
            'password' => $request->input('password'),
        ]);

        toast('success', 'Password aggiornata con successo!');

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        toast('success', 'Utente eliminato con successo!');

        return back();
    }
}
