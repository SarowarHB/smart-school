<?php

namespace App\Http\Controllers;

use App\Models\Question\Grade;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionGradeController extends Controller
{
    public function index()
    {
        $grades = Grade::orderBy('question_grade_id')->paginate(15);

        return Inertia::render('QuestionGrades/Index', [
            'grades' => $grades,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        Grade::create($validated);

        return redirect()
            ->route('question-grades.index')
            ->with('success', "Grade \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Grade $questionGrade)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $questionGrade->update($validated);

        return redirect()
            ->route('question-grades.index')
            ->with('success', "Grade \"{$validated['name']}\" updated successfully.");
    }

    public function destroy(Grade $questionGrade)
    {
        $name = $questionGrade->name;

        try {
            $questionGrade->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('question-grades.index')
                ->with('error', "Grade \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('question-grades.index')
            ->with('success', "Grade \"{$name}\" deleted.");
    }
}
