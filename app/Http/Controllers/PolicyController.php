<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Policy;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::orderBy('policy.id')
            ->leftJoin('roles', 'policy.role_id', '=', 'roles.id')
            ->leftJoin('actions', 'policy.action_id', '=', 'actions.id')
            ->select('policy.*', 'roles.name as role_name', 'actions.name as action_name')
            ->paginate(15);

        $roles = Role::orderBy('name')->get(['id', 'name']);
        $actions = Action::orderBy('name')->get(['id', 'name']);

        return Inertia::render('Policies/Index', [
            'policies' => $policies,
            'roles' => $roles,
            'actions' => $actions,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],
            'action_id' => ['nullable', 'integer', 'exists:actions,id'],
        ]);

        Policy::create($validated);

        return redirect()
            ->route('policies.index')
            ->with('success', "Policy \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Policy $policy)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],
            'action_id' => ['nullable', 'integer', 'exists:actions,id'],
        ]);

        $policy->update($validated);

        return redirect()
            ->route('policies.index')
            ->with('success', "Policy \"{$validated['name']}\" updated successfully.");
    }

    public function destroy(Policy $policy)
    {
        $name = $policy->name;

        try {
            $policy->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('policies.index')
                ->with('error', "Policy \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('policies.index')
            ->with('success', "Policy \"{$name}\" deleted.");
    }
}
