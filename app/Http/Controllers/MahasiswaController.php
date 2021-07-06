<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mahasiswa\{DatatableRequest, StoreRequest, UpdateRequest};
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'studyPrograms' => StudyProgram::orderBy('name', 'asc')->get(),
            'statuses' => Student::getAllStatus()
        ];

        return view('app.mahasiswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'studyPrograms' => StudyProgram::orderBy('name', 'asc')->get(),
            'degrees' => Student::getAllDegree(),
            'statuses' => Student::getAllStatus()
        ];

        return view('app.mahasiswa.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Mahasiswa\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $student = new Student();
            $student->biodata_id = $request->biodata_id;
            $student->degree = $request->degree;
            $student->study_program_id = $request->study_program_id;
            $student->id_number = $request->id_number;
            $student->status = $request->status;
            $student->month_entry = $request->month_entry;
            $student->year_entry = $request->year_entry;
            $student->save();

            return $this->apiResponse(200, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::where('id', $id)
                    ->with('biodata')
                    ->with('study_program')
                    ->first();

        abort_if(!$student, 'Data tidak ditemukan.');

        $data = [
            'studyPrograms' => StudyProgram::orderBy('name', 'asc')->get(),
            'degrees' => Student::getAllDegree(),
            'statuses' => Student::getAllStatus(),
            'student' => $student
        ];

        return view('app.mahasiswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Mahasiswa\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $studentId = $request->id;

            $student = Student::where('id', $studentId)->first();
            $student->biodata_id = $request->biodata_id;
            $student->degree = $request->degree;
            $student->study_program_id = $request->study_program_id;
            $student->id_number = $request->id_number;
            $student->status = $request->status;
            $student->month_entry = $request->month_entry;
            $student->year_entry = $request->year_entry;

            $month_grad = $request->month_grad;
            $year_grad = $request->year_grad;
            if ($request->status != Student::STATUS_LULUS) {
                $month_grad = null;
                $year_grad = null;
            }

            $student->month_grad = $month_grad;
            $student->year_grad = $year_grad;
            $student->save();

            return $this->apiResponse(200, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\Mahasiswa\DatatableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(DatatableRequest $request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $search = $request->get('search')['value'] ?? '';

        $prodiId = $request->get('prodiId', 0);
        $status = $request->get('status', 0);

        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 0;

        $availableColumn = [
            'id', 'biodata_name', 'study_program_name', 'degree', 'status'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $students = Student::joinedDatatable()
                        ->searchDatatable($search)
                        ->filterStudyProgram($prodiId)
                        ->filterStatus($status)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $studentsCount = Student::joinedDatatable()
                        ->searchDatatable($search)
                        ->filterStudyProgram($prodiId)
                        ->filterStatus($status)
                        ->count();

        return DataTables::of($students)
                ->addColumn('action', function($student) {
                    return '
                        <a href="'. route('mahasiswa.edit', [ 'mahasiswa' => $student ]) .'" class="btn-action--green">
                            <i class="fas fa-pencil-alt relative top-[0.125rem]"></i>
                        </a>
                    ';
                })
                ->rawColumns([ 'action' ])
                ->skipPaging(true)
                ->setTotalRecords($studentsCount)
                ->make(true);
    }
}
