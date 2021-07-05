<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perusahaan\Kategori\{DatatableRequest, DeleteRequest, SelectTwoRequest, StoreRequest, UpdateRequest};
use App\Http\Resources\KategoriPerusahaanSelectResource;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.perusahaan.kategori.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Perusahaan\Kategori\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $category = new CompanyCategory();
            $category->name = $request->name;
            $category->save();

            return $this->apiResponse(200, 'Data tersimpan');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Perusahaan\Kategori\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $categoryId = $request->id;

            $category = CompanyCategory::where('id', $categoryId)->first();
            $category->name = $request->name;
            $category->save();

            return $this->apiResponse(200, 'Data tersimpan');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Perusahaan\Kategori\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request)
    {
        try {
            $categoryId = $request->id;

            $category = CompanyCategory::where('id', $categoryId)->first();
            $category->delete();

            return $this->apiResponse(200, 'Data berhasil dihapus');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\Perusahaan\Kategori\DatatableRequest  $request
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

        $categories = CompanyCategory::selectRaw('id, name')
                        ->searchDatatable($search)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $categoriesCount = CompanyCategory::searchDatatable($search)->count();

        return DataTables::of($categories)
                ->addColumn('action', function($category) {
                    return '
                        <button type="button" class="btn-action--green"
                            data-id="'. $category->id .'"
                            data-name="'. $category->name .'"
                            onClick="editCategory(this)">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn-action--red"
                            data-id="'. $category->id .'"
                            onClick="deleteCategory(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->skipPaging(true)
                ->setTotalRecords($categoriesCount)
                ->make(true);
    }

    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Perusahaan\Kategori\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $page = $request->get('page');
        $search = $request->get('search', '');
        $allowAll = boolval($request->get('allowAll', false));

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $categories = CompanyCategory::selectRaw('id, name')
                        ->searchSelectTwo($search)
                        ->orderBy('name', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $categoriesCount = CompanyCategory::searchSelectTwo($search)->count();

        if ($allowAll) {
            $categoryAll = new CompanyCategory();
            $categoryAll->id = 0;
            $categoryAll->name = '- Semua Kategori -';
            $categories->prepend($categoryAll);
        }

        return response()->json([
            'results' => KategoriPerusahaanSelectResource::collection($categories),
            'pagination' => [
                'more' => ($page * $limit) < $categoriesCount
            ]
        ]);
    }
}
