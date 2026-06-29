<?php

namespace App\Http\Controllers;

use App\Models\Question\Subject;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionSubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('question_subject_id')->paginate(15);

        return Inertia::render('QuestionSubjects/Index', [
            'subjects' => $subjects,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        Subject::create($validated);

        return redirect()
            ->route('question-subjects.index')
            ->with('success', "Subject \"{$validated['name']}\" created successfully.");
    }

    public function update(Request $request, Subject $questionSubject)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $questionSubject->update($validated);

        return redirect()
            ->route('question-subjects.index')
            ->with('success', "Subject \"{$validated['name']}\" updated successfully.");
    }

    public function destroy(Subject $questionSubject)
    {
        $name = $questionSubject->name;

        try {
            $questionSubject->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('question-subjects.index')
                ->with('error', "Subject \"{$name}\" cannot be deleted because it is still in use.");
        }

        return redirect()
            ->route('question-subjects.index')
            ->with('success', "Subject \"{$name}\" deleted.");
    }
}
