<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mahasiswa\Alumni\SelectTwoRequest;
use App\Http\Resources\Mahasiswa\Alumni\DetailResource;
use App\Http\Resources\Mahasiswa\Alumni\SelectTwoResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $studentId = $request->id;

            $student = Student::alumni()
                        ->where('id', $studentId)
                        ->with('biodata')
                        ->with('study_program')
                        ->first();

            abort_if(!$student, Response::HTTP_NOT_FOUND, 'Data tidak ditemukan');

            $responseData = new DetailResource($student);

            return $this->apiResponse(200, 'Success.', $responseData);

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Mahasiswa\Alumni\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $page = $request->get('page');
        $search = $request->get('search', '');

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $students = Student::alumni()
                        ->joinedSelectTwo()
                        ->searchSelectTwo($search)
                        ->orderBy('id_card_number', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $studentsCount = Student::alumni()
                        ->joinedSelectTwo()
                        ->searchSelectTwo($search)
                        ->count();

        return response()->json([
            'results' => SelectTwoResource::collection($students),
            'pagination' => [
                'more' => ($page * $limit) < $studentsCount
            ]
        ]);
    }
}
