<?php

namespace App\Http\Controllers;

use App\Http\Requests\Biodata\DatatableRequest;
use App\Http\Requests\Biodata\DeleteRequest;
use App\Http\Requests\Biodata\SelectTwoRequest;
use App\Http\Requests\Biodata\StoreRequest;
use App\Http\Requests\Biodata\UpdateRequest;
use App\Http\Resources\Biodata\SelectTwoResource;
use App\Models\Biodata;
use App\Models\BiodataParent;
use App\Models\Education;
use App\Models\Profession;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.biodata.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'religions' => Religion::all(),
            'professions' => Profession::all(),
            'educations' => Education::all()
        ];

        return view('app.biodata.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Biodata\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $biodata = new Biodata();
            $biodateParent = new BiodataParent();

            $uploadedPhotoPath = $request->file('photo')->store(
                'biodata/', 'public'
            );

            $biodata->id_card_number = $request->id_card_number;
            $biodata->name = $request->name;
            $biodata->photo = $uploadedPhotoPath;
            $biodata->birth_place = $request->birth_place;
            $biodata->birth_date = date('Y-m-d', strtotime($request->birth_date));
            $biodata->gender = $request->gender;
            $biodata->blood_type = $request->blood_type;
            $biodata->religion_id = $request->religion_id;
            $biodata->marital_status = $request->marital_status;
            $biodata->address = $request->address;
            $biodata->province_id = $request->province_id;
            $biodata->city_id = $request->city_id;
            $biodata->district_id = $request->district_id;
            $biodata->village_id = $request->village_id;
            $biodata->phone = $request->phone;
            $biodata->email = $request->email;
            $biodata->save();

            $biodataId = $biodata->id;

            $biodateParent->biodata_id = $biodataId;
            $biodateParent->father_name = $request->father_name;
            $biodateParent->father_religion_id = $request->father_religion_id;
            $biodateParent->father_profession_id = $request->father_profession_id;
            $biodateParent->father_education_id = $request->father_education_id;
            $biodateParent->father_is_life = $request->father_is_life;

            $biodateParent->mother_name = $request->mother_name;
            $biodateParent->mother_religion_id = $request->mother_religion_id;
            $biodateParent->mother_profession_id = $request->mother_profession_id;
            $biodateParent->mother_education_id = $request->mother_education_id;
            $biodateParent->mother_is_life = $request->mother_is_life;
            $biodateParent->save();

            return $this->apiResponse(200, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Show the details of data
     * Catch by id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $biodataId = $request->get('id', 0);

            $biodata = Biodata::where('id', $biodataId)
                    ->with(['parent' => function($parent) {
                        $parent->with('father_religion')
                            ->with('father_profession')
                            ->with('father_education')
                            ->with('mother_religion')
                            ->with('mother_profession')
                            ->with('mother_education');
                    }])
                    ->with('religion')
                    ->with('province')
                    ->with('city')
                    ->with('district')
                    ->with('village')
                    ->first();

            if (!$biodata) {
                return $this->apiResponse(404, 'Data tidak ditemukan');
            }

            return $this->apiResponse(200, 'Sukses.', $biodata);

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
        $biodata = Biodata::where('id', $id)
                    ->with(['parent' => function($parent) {
                        $parent->with('father_religion')
                            ->with('father_profession')
                            ->with('father_education')
                            ->with('mother_religion')
                            ->with('mother_profession')
                            ->with('mother_education');
                    }])
                    ->with('religion')
                    ->with('province')
                    ->with('city')
                    ->with('district')
                    ->with('village')
                    ->first();

        abort_if(!$biodata, 404, 'Data tidak ditemukan.');

        $data = [
            'religions' => Religion::all(),
            'professions' => Profession::all(),
            'educations' => Education::all(),
            'biodata' => $biodata
        ];

        return view('app.biodata.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Biodata\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $biodata = Biodata::where('id', $request->id)->first();
            $biodateParent = BiodataParent::where('biodata_id', $biodata->id)->first();

            $uploadedPhotoPath = $biodata->photo;
            if ($request->hasFile('photo')) {
                $uploadedPhotoPath = $request->file('photo')->store(
                    'biodata/', 'public'
                );
            }


            $biodata->id_card_number = $request->id_card_number;
            $biodata->name = $request->name;
            $biodata->photo = $uploadedPhotoPath;
            $biodata->birth_place = $request->birth_place;
            $biodata->birth_date = date('Y-m-d', strtotime($request->birth_date));
            $biodata->gender = $request->gender;
            $biodata->blood_type = $request->blood_type;
            $biodata->religion_id = $request->religion_id;
            $biodata->marital_status = $request->marital_status;
            $biodata->address = $request->address;
            $biodata->province_id = $request->province_id;
            $biodata->city_id = $request->city_id;
            $biodata->district_id = $request->district_id;
            $biodata->village_id = $request->village_id;
            $biodata->phone = $request->phone;
            $biodata->email = $request->email;
            $biodata->save();

            // $biodateParent->biodata_id = $biodataId;
            $biodateParent->father_name = $request->father_name;
            $biodateParent->father_religion_id = $request->father_religion_id;
            $biodateParent->father_profession_id = $request->father_profession_id;
            $biodateParent->father_education_id = $request->father_education_id;
            $biodateParent->father_is_life = $request->father_is_life;

            $biodateParent->mother_name = $request->mother_name;
            $biodateParent->mother_religion_id = $request->mother_religion_id;
            $biodateParent->mother_profession_id = $request->mother_profession_id;
            $biodateParent->mother_education_id = $request->mother_education_id;
            $biodateParent->mother_is_life = $request->mother_is_life;
            $biodateParent->save();

            return $this->apiResponse(200, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Biodata\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request)
    {
        try {
            Biodata::destroy($request->id);

            return $this->apiResponse(200, 'Data berhasil dihapus.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(500, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\Biodata\DatatableRequest  $request
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
            'id', 'photo', 'name', 'birth_place', 'birth_date'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $biodatas = Biodata::searchDatatable($search)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $biodatasCount = Biodata::searchDatatable($search)->count();

        return DataTables::of($biodatas)
                ->addColumn('photo_url', function($biodata) {
                    return '
                        <img src="'. $biodata->photo_url .'" class="w-10 h-auto" />
                    ';
                })
                ->addColumn('birth_date', function($biodata) {
                    return strftime('%e %B %Y', strtotime($biodata->birth_date));
                })
                ->addColumn('action', function($biodata) {
                    return '
                        <a href="'. route('biodata.edit', [ 'biodata' => $biodata ]) .'" class="btn-action--green">
                            <i class="fas fa-pencil-alt relative top-[0.125rem]"></i>
                        </a>
                        <button type="button" class="btn-action--red"
                            data-id="'. $biodata->id .'"
                            onClick="deleteBiodata(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['photo_url', 'birth_date', 'action' ])
                ->skipPaging(true)
                ->setTotalRecords($biodatasCount)
                ->make(true);
    }

    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Biodata\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $page = $request->get('page');
        $search = $request->get('search', '');

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $biodatas = Biodata::searchSelectTwo($search)
                        ->orderBy('id_card_number', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $biodatasCount = Biodata::searchSelectTwo($search)->count();

        return response()->json([
            'results' => SelectTwoResource::collection($biodatas),
            'pagination' => [
                'more' => ($page * $limit) < $biodatasCount
            ]
        ]);
    }
}
