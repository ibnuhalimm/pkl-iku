<?php

namespace App\Http\Requests\Iku\KerjaLayak;

use App\Models\GradJob;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => [ 'required' ],
            'date_start' => [ 'required', 'date_format:d-m-Y' ],
            'job_category' => [ 'required' ],
            'emp_type' => [ 'required' ],
            'company_id' => [ 'required' ],
            'sallary' => [ 'required', 'numeric' ],
            'emp_agreement_image' => [ 'nullable', 'image', 'mimes:jpg,jpeg,png' ],
            'emp_contract_duration' => [ 'required_if:emp_type,' . GradJob::EMP_TYPE_CONTRACT, 'integer' ]
        ];
    }

    /**
     * Get the validation attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'student_id' => 'Mahasiswa',
            'date_start' => 'Tanggal Mulai Bekerja',
            'job_category' => 'Kategori Pekerjaan',
            'emp_type' => 'Kepegawaian',
            'company_id' => 'Perusahaan/Instansi',
            'sallary' => 'Gaji Per Bulan',
            'emp_agreement_image' => 'Surat Perjanjian Kerja',
            'emp_contract_duration' => 'Lama Kontrak'
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function messages()
    {
        $allEmploymentType = GradJob::getAllEmpType();

        return [
            'emp_contract_duration.required_if' => ':Attribute wajib diisi bila :other adalah ' . $allEmploymentType[GradJob::EMP_TYPE_CONTRACT]
        ];
    }
}
