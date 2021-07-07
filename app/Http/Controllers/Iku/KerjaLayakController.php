<?php

namespace App\Http\Controllers\Iku;

use App\Exports\GradJobExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Iku\KerjaLayak\DatatableRequest;
use App\Http\Requests\Iku\KerjaLayak\DeleteRequest;
use App\Http\Requests\Iku\KerjaLayak\StoreRequest;
use App\Http\Requests\Iku\KerjaLayak\UpdateRequest;
use App\Models\GradJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class KerjaLayakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.iku.kerja-layak.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'jobCategories' => GradJob::getAllJobCategory(),
            'employmentTypes' => GradJob::getAllEmpType(),
            'contractEmployee' => GradJob::EMP_TYPE_CONTRACT
        ];

        return view('app.iku.kerja-layak.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Iku\KerjaLayak\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $gradJob = new GradJob();
            $gradJob->student_id = $request->student_id;
            $gradJob->date_start = date('Y-m-d', strtotime($request->date_start));
            $gradJob->job_category = $request->job_category;
            $gradJob->emp_type = $request->emp_type;
            $gradJob->company_id = $request->company_id;
            $gradJob->sallary = $request->sallary;

            $uploadedEmployeeAgreement = $request->file('emp_agreement_image')->store(
                'kerja-layak/employee-agreement/', 'public'
            );

            $gradJob->emp_agreement_image = $uploadedEmployeeAgreement;

            $empContractDuration = 0;
            if ($request->emp_type == GradJob::EMP_TYPE_CONTRACT) {
                $empContractDuration = $request->emp_contract_duration;
            }

            $gradJob->emp_contract_duration = $empContractDuration;
            $gradJob->save();

            return $this->apiResponse(Response::HTTP_CREATED, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
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
        $gradJob = GradJob::where('id', $id)
                    ->with(['student' => function($student) {
                        $student->with('biodata')
                            ->with('study_program');
                    }])
                    ->with('company')
                    ->first();

        abort_if(!$gradJob, Response::HTTP_NOT_FOUND, 'Data tidak ditemukan.');

        $monthList = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $data = [
            'jobCategories' => GradJob::getAllJobCategory(),
            'employmentTypes' => GradJob::getAllEmpType(),
            'contractEmployee' => GradJob::EMP_TYPE_CONTRACT,
            'gradJob' => $gradJob,
            'gradMonthName' => $monthList[$gradJob->student->month_grad - 1] ?? 'Januari'
        ];

        return view('app.iku.kerja-layak.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Iku\KerjaLayak\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $gradJobId = $request->id;

            $gradJob = GradJob::where('id', $gradJobId)->first();
            $gradJob->student_id = $request->student_id;
            $gradJob->date_start = date('Y-m-d', strtotime($request->date_start));
            $gradJob->job_category = $request->job_category;
            $gradJob->emp_type = $request->emp_type;
            $gradJob->company_id = $request->company_id;
            $gradJob->sallary = $request->sallary;

            $uploadedEmployeeAgreement = $gradJob->emp_agreement_image;
            if ($request->hasFile('emp_agreement_image')) {
                $uploadedEmployeeAgreement = $request->file('emp_agreement_image')->store(
                    'kerja-layak/employee-agreement/', 'public'
                );
            }

            $gradJob->emp_agreement_image = $uploadedEmployeeAgreement;

            $empContractDuration = 0;
            if ($request->emp_type == GradJob::EMP_TYPE_CONTRACT) {
                $empContractDuration = $request->emp_contract_duration;
            }

            $gradJob->emp_contract_duration = $empContractDuration;
            $gradJob->save();

            return $this->apiResponse(Response::HTTP_OK, 'Data berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Iku\KerjaLayak\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request)
    {
        try {
            $gradJobId = $request->id;
            GradJob::destroy($gradJobId);

            return $this->apiResponse(Response::HTTP_OK, 'Data berhasil dihapus.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\Iku\KerjaLayak\DatatableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(DatatableRequest $request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $search = $request->get('search')['value'] ?? '';

        $year = $request->get('year', 0);

        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 0;

        $availableColumn = [
            'id', 'date_start', 'student_name', 'company_name'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $gradJobs = GradJob::joinedDatatable()
                        ->searchDatatable($search)
                        ->filterYear($year)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $gradJobsCount = GradJob::joinedDatatable()
                        ->searchDatatable($search)
                        ->filterYear($year)
                        ->count();

        return DataTables::of($gradJobs)
                ->addColumn('date_start_work', function($job) {
                    return strftime('%e %B %Y', strtotime($job->date_start));
                })
                ->addColumn('action', function($job) {
                    return '
                        <a href="'. route('iku.kerja-layak.edit', [ 'kerja_layak' => $job ]) .'" class="btn-action--green">
                            <i class="fas fa-pencil-alt relative top-[0.125rem]"></i>
                        </a>
                        <button type="button" class="btn-action--red"
                            data-id="'. $job->id .'"
                            onClick="deleteGradJob(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns([ 'no', 'date_start_work', 'action' ])
                ->skipPaging(true)
                ->setTotalRecords($gradJobsCount)
                ->addIndexColumn()
                ->make(true);
    }

    /**
     * Export excel by year of `date_start`
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function exportExcel(Request $request)
    {
        $year = $request->get('year', date('Y'));

        return (new GradJobExport($year))->download('pekerjaan_layak_' . $year . '.xlsx');
    }
}
