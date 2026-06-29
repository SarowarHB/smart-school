<?php

namespace App\Http\Controllers;

use App\Models\Question\Cycle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionCycleController extends Controller
{
    public function index()
    {
        $cycles = Cycle::orderBy('id')->paginate(15);

        return Inertia::render('QuestionCycles/Index', [
            'cycles' => $cycles,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        Cycle::create($validated);

        return redirect()
            ->route('question-cycles.index')
            ->with('success', "Cycle \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Cycle $questionCycle)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $questionCycle->update($validated);

        return redirect()
            ->route('question-cycles.index')
            ->with('success', "Cycle \"{$validated['name']}\" updated successfully.");
    }

    public function destroy(Cycle $questionCycle)
    {
        $name = $questionCycle->name;

        try {
            $questionCycle->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('question-cycles.index')
                ->with('error', "Cycle \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('question-cycles.index')
            ->with('success', "Cycle \"{$name}\" deleted.");
    }
}
