<?php

namespace App\Http\Controllers;

use App\Models\Resource\Resource;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('resources')->orderBy('id')->paginate(15);
        $resources = Resource::orderBy('name')->get(['id', 'name', 'description']);

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'resources' => $resources,
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

    public function syncResources(Request $request, Role $role)
    {
        $validated = $request->validate([
            'resource_ids' => ['present', 'array'],
            'resource_ids.*' => ['integer', 'exists:resources,id'],
        ]);

        $role->resources()->sync($validated['resource_ids']);

        return redirect()
            ->route('roles.index')
            ->with('success', "Resources for \"{$role->name}\" updated.");
    }
}
