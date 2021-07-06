<?php

namespace App\Exports;

use App\Models\GradJob;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class GradJobExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    /**
     * Define properties
     *
     * @var mixed
     */
    private $year = 0;

    /**
     * Create new instance
     *
     * @param  int  $year
     * @return void
     */
    public function __construct($year)
    {
        $this->year = $year;
    }

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        return GradJob::query()->joinedDatatable()->FilterYear($this->year);
    }

    /**
     * Setting the headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Tanggal Masuk Kerja',
            'NIM',
            'Nama',
            'Tgl Lulus',
            'Nama Perusahaan',
            'Gaji'
        ];
    }

    /**
     * Mapping the data
     *
     * @return array
     */
    public function map($gradJob): array
    {
        return [
            '',
            $gradJob->date_start,
            $gradJob->student_id_number,
            $gradJob->student_name,
            date('Y-m-d', strtotime($gradJob->student_month_grad .'-'. $gradJob->student_month_grad . '-01')),
            $gradJob->company_name,
            $gradJob->sallary
        ];
    }

    /**
     * Styling the rows
     *
     * @return array
     */
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        return [
            1 => [ 'font' => [ 'bold' => true ] ]
        ];
    }
}
