<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::all();

        return Inertia::render('Users/index', ['users' => $users]);
    }

    
    /**
     * Show the form for creating the resource.
     */
    public function create(): Response
    {
        return Inertia::render('Users/create');
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        $user->fill($request->all());
        $user->is_deletetable = true;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(User $user): Response
    {
        return Inertia::render('Users/create', ['user' => $user]);
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','string','max:255', Rule::unique('users')->ignore($id)],
            'display_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);


        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
