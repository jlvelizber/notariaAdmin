<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return Inertia::render('Roles/index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255| unique:' . Role::class,
            'display_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);


        $role = new Role();
        $role->fill($request->all());
        $role->is_deletetable = true;
        $role->save();

        return redirect()->route('roles.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return Inertia::render('Roles/create', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','string','max:255', Rule::unique('roles')->ignore($id)],
            'display_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);


        $role = Role::find($id);
        $role->fill($request->all());
        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
