<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::orderBy('id')->paginate(15);

        return Inertia::render('Actions/Index', [
            'actions' => $actions,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:actions,name'],
        ]);

        Action::create($validated);

        return redirect()
            ->route('actions.index')
            ->with('success', "Action \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Action $action)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:actions,name,{$action->id}"],
        ]);

        $action->update($validated);

        return redirect()
            ->route('actions.index')
            ->with('success', "Action updated to \"{$validated['name']}\".");
    }

    public function destroy(Action $action)
    {
        $name = $action->name;

        try {
            $action->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('actions.index')
                ->with('error', "Action \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('actions.index')
            ->with('success', "Action \"{$name}\" deleted.");
    }
}
