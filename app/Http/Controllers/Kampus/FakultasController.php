<?php

namespace App\Http\Controllers\Kampus;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kampus\Fakultas\DatatableRequest;
use App\Http\Requests\Kampus\Fakultas\StoreRequest;
use App\Http\Requests\Kampus\Fakultas\UpdateRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.kampus.fakultas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $faculty = new Faculty();
            $faculty->name = $request->name;
            $faculty->save();

            return $this->apiResponse(200, 'Data tersimpan');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Kampus\Fakultas\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $faculty = Faculty::where('id', $request->id)->first();

            $faculty->name = $request->name;
            $faculty->save();

            return $this->apiResponse(200, 'Data tersimpan');

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(DatatableRequest $request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $search = $request->get('search')['value'] ?? '';

        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 0;

        $availableColumn = [
            'id', 'name'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $faculties = Faculty::selectRaw('id, name')
                        ->searchDatatable($search)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $facultiesCount = Faculty::searchDatatable($search)->count();

        return DataTables::of($faculties)
                ->addColumn('action', function($faculty) {
                    return '
                        <button type="button" class="btn-action--green"
                            data-id="'. $faculty->id .'"
                            data-name="'. $faculty->name .'"
                            onClick="editFaculty(this)">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn-action--red"
                            data-id="'. $faculty->id .'"
                            onClick="deleteFaculty(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->skipPaging(true)
                ->setTotalRecords($facultiesCount)
                ->make(true);
    }
}
