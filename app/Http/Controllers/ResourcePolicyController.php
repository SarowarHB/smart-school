<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Resource\Policy as ResourcePolicy;
use App\Models\Resource\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResourcePolicyController extends Controller
{
    public function index()
    {
        $resourcePolicies = ResourcePolicy::orderBy('resources_policy.id')
            ->leftJoin('resources', 'resources_policy.resource_id', '=', 'resources.id')
            ->leftJoin('policy', 'resources_policy.policy_id', '=', 'policy.id')
            ->select('resources_policy.*', 'resources.name as resource_name', 'policy.name as policy_name')
            ->paginate(15);

        $resources = Resource::orderBy('name')->get(['id', 'name']);
        $policies = Policy::orderBy('name')->get(['id', 'name']);

        return Inertia::render('ResourcePolicies/Index', [
            'resourcePolicies' => $resourcePolicies,
            'resources' => $resources,
            'policies' => $policies,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'resource_id' => ['required', 'integer', 'exists:resources,id'],
            'policy_id' => ['required', 'integer', 'exists:policy,id'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        ResourcePolicy::create($validated);

        return redirect()
            ->route('resource-policies.index')
            ->with('success', 'Resource policy created successfully.');
    }

    public function update(Request $request, ResourcePolicy $resourcePolicy)
    {
        $validated = $request->validate([
            'resource_id' => ['required', 'integer', 'exists:resources,id'],
            'policy_id' => ['required', 'integer', 'exists:policy,id'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $resourcePolicy->update($validated);

        return redirect()
            ->route('resource-policies.index')
            ->with('success', 'Resource policy updated successfully.');
    }

    public function destroy(ResourcePolicy $resourcePolicy)
    {
        try {
            $resourcePolicy->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('resource-policies.index')
                ->with('error', 'This resource policy cannot be deleted because it is still in use.');
        }

        return redirect()
            ->route('resource-policies.index')
            ->with('success', 'Resource policy deleted.');
    }
}
