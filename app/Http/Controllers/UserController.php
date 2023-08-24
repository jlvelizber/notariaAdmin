<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
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
        $roles = Role::all();
        return Inertia::render('Users/create', ['roles' => $roles]);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'midle_name' => 'string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>['required','integer',Rule::exists('roles','id')],
        ]);

        $user = User::create([
            'name' => $request->name,
            'midle_name' => $request->midle_name,
            'first_last_name' => $request->first_last_name,
            'second_last_name' => $request->second_last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->sync([$request->role]);

        event(new Registered($user));

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
        $roles = Role::all();

        $user->role = $user->getMainRole();
       
        return Inertia::render('Users/create', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'midle_name' => 'string|max:255',
            'first_last_name' => 'required|string|max:255',
            'second_last_name' => 'required|string|max:255',
            'password' => ['required_if:password,null','confirmed', Rules\Password::defaults()],
            'role'=>['required','integer',Rule::exists('roles','id')],
        ]);

       

            $user = User::find($id);
            $user->fill($request->all());
            $user->save();
    
            $user->roles()->sync([$request->role]);
    
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
