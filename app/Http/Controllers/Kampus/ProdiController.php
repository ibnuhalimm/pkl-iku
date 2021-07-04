<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kampus\Prodi\{DatatableRequest, DeleteRequest, StoreRequest, UpdateRequest};
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.kampus.prodi.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Kampus\Prodi\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $studyProgram = new StudyProgram();
            $studyProgram->faculty_id = $request->faculty_id;
            $studyProgram->name = $request->name;
            $studyProgram->save();

            $studyProgram = StudyProgram::where('id', $studyProgram->id)->with('faculty')->first();

            return $this->apiResponse(200, 'Data tersimpan', $studyProgram);

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Get the details of the resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request->get('id');
            $studyProgram = StudyProgram::where('id', $id)->with('faculty')->first();

            abort_if(!$studyProgram, 404, 'Data tidak ditemukan.');

            return $this->apiResponse(200, 'Sukses.', $studyProgram);

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Kampus\Prodi\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $studyProgram = StudyProgram::where('id', $request->id)->first();

            $studyProgram->faculty_id = $request->faculty_id;
            $studyProgram->name = $request->name;
            $studyProgram->save();

            $studyProgram = StudyProgram::where('id', $studyProgram->id)->with('faculty')->first();

            return $this->apiResponse(200, 'Data tersimpan', $studyProgram);

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Kampus\Prodi\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request)
    {
        try {
            $studyProgram = StudyProgram::where('id', $request->id)->first();
            $studyProgram->delete();

            return $this->apiResponse(200, 'Data berhasil dihapus');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\Kampus\Prodi\DatatableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(DatatableRequest $request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $search = $request->get('search')['value'] ?? '';

        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 0;

        $facultyId = $request->get('facultyId', 0);

        $availableColumn = [
            'id', 'faculty_id', 'name'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $studyPrograms = StudyProgram::with('faculty')
                        ->facultyFilter($facultyId)
                        ->searchDatatable($search)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $studyProgramsCount = StudyProgram::facultyFilter($facultyId)->searchDatatable($search)->count();

        return DataTables::of($studyPrograms)
                ->addColumn('faculty_name', function($studyProgram) {
                    return $studyProgram->faculty->name;
                })
                ->addColumn('action', function($studyProgram) {
                    return '
                        <button type="button" class="btn-action--green"
                            data-id="'. $studyProgram->id .'"
                            onClick="editStudyProgram(this)">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn-action--red"
                            data-id="'. $studyProgram->id .'"
                            onClick="deleteStudyProgram(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['faculty_name', 'action'])
                ->skipPaging(true)
                ->setTotalRecords($studyProgramsCount)
                ->make(true);
    }
}
