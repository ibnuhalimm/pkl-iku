<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'facultiesCount' => Faculty::count(),
            'studyProgramsCount' => StudyProgram::count(),
            'studentsCount' => Student::count(),
            'companiesCount' => Company::count()
        ];

        return view('app.dashboard', $data);
    }
}
