<?php

namespace App\Http\Controllers;

use App\Models\AvailablePosition;
use App\Models\JobApplyPositions;
use App\Models\JobApplySocieties;
use App\Models\JobCategories;
use App\Models\JobVacancies;
use App\Models\Societies;
use App\Models\Validations;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SociestiesController extends Controller
{
    public function validation(Request $request, $token)
    {
        $request->validate([
            'work_experience' => 'required',
            'job_category_id' => 'required',
            'job_position' => 'required',
            'reason_accepted' => 'required',
        ]);

        $societies = Societies::where('login_tokens', $token)->first();

        $validaitons = Validations::where('society_id', $societies->id);

        if (!$societies) {
            return response()->json([
                'message' => 'Unauthorized user',
            ], 401);
        }

        $validaitons->create([
            'society_id' => $societies->id,
            'work_experience' => $request->input('work_experience'),
            'job_category_id' => $request->input('job_category_id'),
            'job_position' => $request->input('job_position'),
            'reason_accepted' => $request->input('reason_accepted'),
        ]);

        return response()->json([
            'message' => 'Request data validation sent successful',
        ], 200);
    }

    public function getSociety($token)
    {
        $society = Societies::where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json([
                'message' => 'Unauthorized User',
            ], 401);
        }

        $validation = Validations::where('society_id', $society->id)->first();

        return response()->json([
            'validation' => $validation
        ], 200);
    }

    public function  jobVacancy()
    {
        $jobVacancies = JobVacancies::all();
        $validations = Validations::all();

        $vacancies = [];

        foreach ($jobVacancies as $jobVacancy) {
            $position = AvailablePosition::where('job_vacancy_id', $jobVacancy->id)->first();
            $validation = $validations->where('job_category_id', $jobVacancy->job_category_id)->first();

            $vacancies[] = [
                'id' => $jobVacancy->id,
                'category' => $validation->job_category,
                'company' => $jobVacancy->company,
                'address' => $jobVacancy->address,
                'description' => $jobVacancy->description,
                'available_position' => $position,
            ];
        }

        return response()->json([
            'vacancy' => $vacancies
        ]);
    }

    public function detailVacancy($id)
    {
        $jobVacancies = JobVacancies::where('id', $id)->first();
        $category = JobCategories::where('id', $jobVacancies->job_category_id)->first();
        $position = AvailablePosition::where('job_vacancy_id', $jobVacancies->id)->first();

        return response()->json([
            'validation' => [
                'id' => $jobVacancies->id,
                'category' => $category,
                'company' => $jobVacancies->company,
                'address' => $jobVacancies->address,
                'description' => $jobVacancies->description,
                'available_position' => $position
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        // dd('koneksi berhasil');
        $request->validate([
            'job_vacancy_id' => 'required',
            'position_id' => 'required',
            'notes' => 'required',
            'position_id' => 'required',
            'society_id' => 'required',
            'job_apply_societies_id' => 'required'
        ]);

        $existingApply = JobApplySocieties::where('job_vacancy_id', $request->input('job_vacancy_id'))->where('society_id', $request->input('society_id'))->first();
        $existingPosition =  JobApplyPositions::where('job_vacancy_id', $request->input('job_vacancy_id'))->where('society_id', $request->input('society_id'))->where('position_id', $request->input('position_id'))->first();

        if ($existingApply && $existingPosition) {
            return response()->json([
                'message' => "You have already applied for this job.",
            ], 401);
        }

        JobApplySocieties::create([
            'job_vacancy_id' => $request->input('job_vacancy_id'),
            'society_id' => $request->input('society_id'),
            'notes' => $request->input('notes'),
            'date' => Carbon::now(),
        ]);

        JobApplyPositions::create([
            'society_id' => $request->input('society_id'),
            'job_vacancy_id' => $request->input('job_vacancy_id'),
            'position_id' => $request->input('position_id'),
            'date' => Carbon::now(),
            'job_apply_societies_id' => $request->input('job_apply_societies_id'),
        ]);

        return response()->json([
            'message' => 'Applying for jobs success'
        ], 200);
    }

    public function getSocietyJob()
    {
        $vacancies = JobVacancies::all();

        foreach ($vacancies as $vacancy) {
            $category = JobCategories::where('id', $vacancy->job_category_id)->first();
            $ApplyPosition = JobApplyPositions::where('job_vacancy_id', $vacancy->id)->first();
            $notes = JobApplySocieties::where('id', $ApplyPosition->job_apply_societies_id)->first();
            $position = AvailablePosition::where('id', $ApplyPosition->position_id)->first();

            return response()->json([
                'vacancies' => [
                    'id' => $vacancy->id,
                    'category' => $category,
                    'company' => $vacancy->company,
                    'address' => $vacancy->address,
                    'description' => $vacancy->description,
                    'position' => [
                        'position' => $position->position,
                        'aplly_status' => $ApplyPosition->status,
                        'notes' => $notes->notes
                    ]
                ]
            ]);
        }
    }
}
