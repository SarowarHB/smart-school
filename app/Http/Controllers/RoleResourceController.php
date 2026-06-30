<?php

namespace App\Http\Controllers;

use App\Models\Resource\Resource;
use App\Models\Role;
use App\Models\RoleResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RoleResourceController extends Controller
{
    public function index()
    {
        $roleResources = RoleResource::orderBy('role_resources.id')
            ->leftJoin('roles', 'role_resources.role_id', '=', 'roles.id')
            ->leftJoin('resources', 'role_resources.resource_id', '=', 'resources.id')
            ->select(
                'role_resources.id',
                'role_resources.role_id',
                'role_resources.resource_id',
                'roles.name as role_name',
                'resources.name as resource_name',
                'resources.description as resource_description',
            )
            ->paginate(15);

        $roles = Role::orderBy('name')->get(['id', 'name']);
        $resources = Resource::orderBy('name')->get(['id', 'name', 'description']);

        return Inertia::render('RoleResources/Index', [
            'roleResources' => $roleResources,
            'roles' => $roles,
            'resources' => $resources,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'resource_id' => [
                'required', 'integer', 'exists:resources,id',
                Rule::unique('role_resources')->where('role_id', $request->role_id),
            ],
        ]);

        RoleResource::create($validated);

        return redirect()
            ->route('role-resources.index')
            ->with('success', 'Role resource assigned successfully.');
    }

    public function destroy(RoleResource $roleResource)
    {
        try {
            $roleResource->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('role-resources.index')
                ->with('error', 'This assignment could not be deleted.');
        }

        return redirect()
            ->route('role-resources.index')
            ->with('success', 'Role resource removed.');
    }
}
