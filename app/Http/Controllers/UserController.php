<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Log::info('USERS index method:', $request->all());
        $searchTerm = $request->input('search', '');

        // Using a query builder to start building the query
        $query = User::with('role');

        // Applying the search term filter
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        $users = $query->get();
        $roles = Role::all();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'roles' => $roles,
            'searchTerm' => $searchTerm,
        ]);
    }


    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', ['user' => $user]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        Log::info('Update method called with request data:', $request->all());

        $validatedData = $request->validate([
            'name' => 'required|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => 'required|exists:roles,id',
        ], [
            'name.regex' => 'Vārdā drīkst būt tikai burti un atstarpes.',
        ]);

        Log::info('Validation completed:', $validatedData);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role_id = $validatedData['role'];

        $user->save();

        return redirect()->route('users.index')->with('success', 'Lietotājs veiksmīgi atjaunināts.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        Log::info('Delete method completed');

        return redirect()->route('users.index')->with('success', 'Lietotājs veiksmīgi dzēsts.');
    }
}
