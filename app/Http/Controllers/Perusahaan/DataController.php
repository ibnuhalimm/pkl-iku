<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perusahaan\Data\{DatatableRequest, DeleteRequest, SelectTwoRequest, StoreRequest, UpdateRequest};
use App\Http\Resources\Perusahaan\Data\SelectTwoResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.perusahaan.data.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.perusahaan.data.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Perusahaan\Data\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $company = new Company();
            $company->company_category_id = $request->company_category_id;
            $company->name = $request->name;
            $company->brand = $request->brand;
            $company->address = $request->address;
            $company->province_id = $request->province_id;
            $company->city_id = $request->city_id;
            $company->save();

            return $this->apiResponse(200, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
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
        $company = Company::where('id', $id)
                    ->with('company_category')
                    ->with('province')
                    ->with('city')
                    ->first();

        abort_if(!$company, 404, 'Data tidak ditemukan');

        $data = [
            'company' => $company
        ];

        return view('app.perusahaan.data.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Perusahaan\Data\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $id = $request->id;

            $company = Company::where('id', $id)->first();
            $company->company_category_id = $request->company_category_id;
            $company->name = $request->name;
            $company->brand = $request->brand;
            $company->address = $request->address;
            $company->province_id = $request->province_id;
            $company->city_id = $request->city_id;
            $company->save();

            return $this->apiResponse(200, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Perusahaan\Data\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request)
    {
        try {
            $companyId = $request->id;
            Company::where('id', $companyId)->delete();

            return $this->apiResponse(200, 'Data berhasil dihapus.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\Perusahaan\Data\DatatableRequest  $request
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
            'id', 'name', 'brand', 'city_id', 'province_id'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $companies = Company::with('province')
                        ->with('province')
                        ->searchDatatable($search)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $companiesCount = Company::searchDatatable($search)->count();

        return DataTables::of($companies)
                ->addColumn('city_name', function($company) {
                    return $company->city->name;
                })
                ->addColumn('province_name', function($company) {
                    return $company->province->name;
                })
                ->addColumn('action', function($company) {
                    return '
                        <a href="'. route('perusahaan.data.edit', [ 'data' => $company ]) .'" class="btn-action--green">
                            <i class="fas fa-pencil-alt relative top-[0.125rem]"></i>
                        </a>
                        <button type="button" class="btn-action--red"
                            data-id="'. $company->id .'"
                            onClick="deleteCompany(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['province_name', 'city_name', 'action' ])
                ->skipPaging(true)
                ->setTotalRecords($companiesCount)
                ->make(true);
    }

    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Perusahaan\data\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $page = $request->get('page');
        $search = $request->get('search', '');

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $companies = Company::searchSelectTwo($search)
                        ->orderBy('name', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $companiesCount = Company::searchSelectTwo($search)->count();

        return response()->json([
            'results' => SelectTwoResource::collection($companies),
            'pagination' => [
                'more' => ($page * $limit) < $companiesCount
            ]
        ]);
    }
}
