<?php

namespace App\Http\Controllers;

use App\Models\Assessment\Assessment;
use App\Models\Assessment\Resource as AssessmentResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssessmentResourceController extends Controller
{
    public function index()
    {
        $assessmentResources = AssessmentResource::orderBy('assessment_resources.id')
            ->leftJoin('assessment', 'assessment_resources.assessment_id', '=', 'assessment.id')
            ->select('assessment_resources.*', 'assessment.title as assessment_title')
            ->paginate(15);

        $assessments = Assessment::orderBy('title')->get(['id', 'title']);

        return Inertia::render('AssessmentResources/Index', [
            'assessmentResources' => $assessmentResources,
            'assessments' => $assessments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'assessment_id' => ['required', 'integer', 'exists:assessment,id'],
            'resource_type' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'question_id' => ['nullable', 'integer'],
            'resource' => ['nullable', 'json'],
        ]);

        AssessmentResource::create($validated);

        return redirect()
            ->route('assessment-resources.index')
            ->with('success', 'Assessment resource created successfully.');
    }

    public function update(Request $request, AssessmentResource $assessmentResource)
    {
        $validated = $request->validate([
            'assessment_id' => ['required', 'integer', 'exists:assessment,id'],
            'resource_type' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'question_id' => ['nullable', 'integer'],
            'resource' => ['nullable', 'json'],
        ]);

        $assessmentResource->update($validated);

        return redirect()
            ->route('assessment-resources.index')
            ->with('success', 'Assessment resource updated successfully.');
    }

    public function destroy(AssessmentResource $assessmentResource)
    {
        try {
            $assessmentResource->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('assessment-resources.index')
                ->with('error', 'This assessment resource cannot be deleted because it is still in use.');
        }

        return redirect()
            ->route('assessment-resources.index')
            ->with('success', 'Assessment resource deleted.');
    }
}
