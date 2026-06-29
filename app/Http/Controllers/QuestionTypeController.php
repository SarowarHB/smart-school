<?php

namespace App\Http\Controllers;

use App\Models\Question\Type;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionTypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBy('id')->paginate(15);

        return Inertia::render('QuestionTypes/Index', [
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'unique:question_type,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Type::create($validated);

        return redirect()
            ->route('question-types.index')
            ->with('success', "Type \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Type $questionType)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $questionType->update($validated);

        return redirect()
            ->route('question-types.index')
            ->with('success', "Type \"{$validated['name']}\" updated successfully.");
    }

    public function destroy(Type $questionType)
    {
        $name = $questionType->name;

        try {
            $questionType->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('question-types.index')
                ->with('error', "Type \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('question-types.index')
            ->with('success', "Type \"{$name}\" deleted.");
    }
}
