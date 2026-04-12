<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id')->paginate(15);

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);

        Role::create($validated);

        return redirect()
            ->route('roles.index')
            ->with('success', "Role \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:roles,name,{$role->id}"],
        ]);

        $role->update($validated);

        return redirect()
            ->route('roles.index')
            ->with('success', "Role updated to \"{$validated['name']}\".");
    }

    public function destroy(Role $role)
    {
        $name = $role->name;
        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', "Role \"{$name}\" deleted.");
    }
}
