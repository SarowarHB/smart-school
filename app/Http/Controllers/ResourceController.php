<?php

namespace App\Http\Controllers;

use App\Models\Resource\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::orderBy('id')->paginate(15);

        return Inertia::render('Resources/Index', [
            'resources' => $resources,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'res_url' => ['nullable', 'string', 'max:255'],
        ]);

        Resource::create($validated);

        return redirect()
            ->route('resources.index')
            ->with('success', "Resource \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'res_url' => ['nullable', 'string', 'max:255'],
        ]);

        $resource->update($validated);

        return redirect()
            ->route('resources.index')
            ->with('success', "Resource \"{$validated['name']}\" updated successfully.");
    }

    public function destroy(Resource $resource)
    {
        $name = $resource->name;

        try {
            $resource->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('resources.index')
                ->with('error', "Resource \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('resources.index')
            ->with('success', "Resource \"{$name}\" deleted.");
    }
}
