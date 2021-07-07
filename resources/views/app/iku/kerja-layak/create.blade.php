@extends('layout.app')

@section('title')
    {{ __('Tambah Data - Pekerjaan Yang Layak') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui@1.12.1/themes/base/all.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.back-button href="{{ route('iku.kerja-layak.index') }}" />
            <x-card.title class="w-full">
                {{ __('Tambah Data - Pekerjaan Yang Layak') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>

            <div class="px-6 pb-6">

               <x-alert-simple color="green" id="__alertSuccess" class="alert hidden"></x-alert-simple>
               <x-alert-simple color="red" id="__alertError" class="alert hidden"></x-alert-simple>

                <form action="{{ route('iku.kerja-layak.store') }}" method="post" id="__formCreateGradJob">
                    @csrf

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Alumni / Mahasiswa Yang Telah Lulus') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8 mb-5">
                            <div class="sm:col-span-2 lg:col-span-3">
                                <x-form-label for="__student_idCreateGradJob" isRequired="true">
                                    {{ __('Mahasiswa') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="student_id" id="__student_idCreateGradJob" style="width: 100%">
                                        <option value=""></option>
                                    </x-form.select>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <table class="w-full">
                                <tbody>
                                    <tr>
                                        <td class="py-2 w-1/3">NIM</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__idNumberAlumni"></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">Nama</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__nameAlumni"></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">Program Studi</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__studyProgramAlumni"></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">Bulan / Tahun Lulus</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__monthGradAlumni"></strong>
                                            <strong id="__yearGradAlumni"></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Data Pekerjaan') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="lg:col-span-2">
                                <x-form-label for="__date_startCreateGradJob" isRequired="true">
                                    {{ __('Tanggal Mulai Bekerja') }}
                                </x-form-label>
                                <x-form.input-text type="text" name="date_start" id="__date_startCreateGradJob" autocomplete="false" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__job_categoryCreateGradJob" isRequired="true">
                                    {{ __('Kategori Pekerjaan') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="job_category" id="__job_categoryCreateGradJob" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($jobCategories as $value => $text)
                                            <option value="{{ $value }}">
                                                {{ $text }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__emp_typeCreateGradJob" isRequired="true">
                                    {{ __('Kepegawaian') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="emp_type" id="__emp_typeCreateGradJob" style="width: 100%">
                                        <option value=""></option>
                                        @foreach ($employmentTypes as $value => $text)
                                            <option value="{{ $value }}">
                                                {{ $text }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__company_idCreateGradJob" isRequired="true">
                                    {{ __('Nama Perusahaan / Instansi') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="company_id" id="__company_idCreateGradJob" style="width: 100%">
                                        <option value=""></option>
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__sallaryCreateGradJob" isRequired="true">
                                    {{ __('Gaji Per Bulan') }}
                                </x-form-label>
                                <x-form.input-text type="number" name="sallary" id="__sallaryCreateGradJob" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__emp_agreement_imageCreateGradJob" isRequired="false">
                                    {{ __('Surat Perjanjian Kerja') }}
                                </x-form-label>
                                <x-form.input-file name="emp_agreement_image" id="__emp_agreement_imageCreateGradJob" accept="image/*" />
                            </div>
                            <div class="lg:col-span-2" id="__emp_contract_durationWrapper" style="display: none">
                                <x-form-label for="__emp_contract_durationCreateGradJob" isRequired="true">
                                    {{ __('Lama Kontrak') }}
                                </x-form-label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-form.input-text type="text" name="emp_contract_duration" id="__emp_contract_durationCreateGradJob" />
                                    </div>
                                    <div>
                                        <x-form.input-text type="text" id="__monthStringContractDuration" class="bg-gray-200" value="Bulan" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <x-button type="button" color="gray" id="__btnCancelCreateGradJob">
                            {{ __('Batal') }}
                        </x-button>
                        <x-button type="submit" color="primary" id="__btnSubmitCreateGradJob">
                            {{ __('Simpan Data') }}
                        </x-button>
                    </div>

                </form>
            </div>
        </x-card.body>
    </x-card.card-default>


    <x-modal.modal-sm id="__modalCancel" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Batal') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>
            <p class="text-center mb-5">
                Apakah Anda yakin ingin membatalkan menyimpan data ini?
            </p>
            <div class="text-center">
                <x-button type="button" color="green" id="__btnNoCancelModal">
                    {{ __('Batal') }}
                </x-button>
                <x-button-link href="{{ route('iku.kerja-layak.index') }}" color="red">
                    {{ __('Ya, Lanjutkan') }}
                </x-button-link>
            </div>
        </x-modal.body>
    </x-modal.modal-sm>

@endsection


@push('bottom_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui@1.12.1/ui/widgets/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui@1.12.1/ui/i18n/datepicker-id.min.js"></script>

    <script>
        const alumniSelectTwoUrl = '{{ route('alumni.select') }}';
        const alumniDetailUrl = '{{ route('alumni.show') }}';
        const datatablePageUrl = '{{ route('iku.kerja-layak.index') }}';
        const perusahaanSelectTwoUrl = '{{ route('perusahaan.data.select') }}';

        const monthList = [
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

        const contactEmployee = {{ $contractEmployee }};

        $.datepicker.setDefaults( $.datepicker.regional[ "id" ] );


        $(window).on('load', function() {
            $('input[type="text"]').val(null);
            $('input[type="number"]').val(null);
            $('select').val(null).trigger('change');

            $('#__monthStringContractDuration').val('Bulan');
        });


        $('#__student_idCreateGradJob').select2({
            placeholder: '- Pilih Mahasiswa -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: alumniSelectTwoUrl,
                data: function(params) {
                    return {
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__job_categoryCreateGradJob').select2({
            placeholder: '- Pilih Kategori Pekerjaan -',
            width: 'resolve'
        });


        $('#__emp_typeCreateGradJob').select2({
            placeholder: '- Pilih Kepegawaian -',
            width: 'resolve'
        });


        $('#__emp_typeCreateGradJob').on('change', function() {
            let selectedEmploymentType = $(this).val();

            if (selectedEmploymentType == contactEmployee) {
                $('#__emp_contract_durationWrapper').show();
            } else {
                $('#__emp_contract_durationWrapper').hide();
                $('#__emp_contract_durationCreateGradJob').val('');
            }
        });


        $('#__company_idCreateGradJob').select2({
            placeholder: '- Pilih Perusahaan -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: perusahaanSelectTwoUrl,
                data: function(params) {
                    return {
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__student_idCreateGradJob').on('change', function() {
            let biodataId = $(this).val().trim();

            resetAlumniInfo();

            if (biodataId !== null && biodataId != '') {
                axios.get(`${alumniDetailUrl}?id=${biodataId}`)
                    .then(response => {
                        let responseData = response.data;

                        displayAlumniInfo(responseData.data);
                    })
                    .catch(({response}) => {
                        let responseData = response.data;

                        alert(responseData.message);
                    });
            }
        });


        const resetAlumniInfo = () => {
            $('#__idNumberAlumni').html(null);
            $('#__nameAlumni').html(null);
            $('#__studyProgramAlumni').html(null);
            $('#__monthGradAlumni').html(null);
            $('#__yearGradAlumni').html(null);
        }


        const displayAlumniInfo = (data) => {
            let { id_number, month_grad, year_grad, biodata, study_program } = data;
            let { name: student_name } = biodata;
            let { name: study_program_name } = study_program;

            $('#__idNumberAlumni').html(id_number);
            $('#__nameAlumni').html(student_name);
            $('#__studyProgramAlumni').html(study_program_name);
            $('#__monthGradAlumni').html(monthList[month_grad - 1]);
            $('#__yearGradAlumni').html(year_grad);
        }


        $('#__date_startCreateGradJob').datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '+0d',
        });


        $('#__btnCancelCreateGradJob').on('click', function() {
            $('#__modalCancel').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnNoCancelModal').on('click', function() {
            $('#__modalCancel').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formCreateGradJob').on('submit', function(event) {
            event.preventDefault();

            let storeUrl = $(this).attr('action');
            let formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateGradJob').attr('disabled', true);
            $('#__btnSubmitCreateGradJob').attr('disabled', true).html('Menyimpan...');

            axios.post(storeUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__alertSuccess').removeClass('hidden').html(responseData.message);
                    $('html, body').animate({ scrollTop: 0 }, 'slow');

                    setTimeout(() => {
                        window.location.href = datatablePageUrl;
                    }, 1500);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertError').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertError').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertError').html(responseData.message);

                    }

                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    $('#__btnCancelCreateGradJob').attr('disabled', false);
                    $('#__btnSubmitCreateGradJob').attr('disabled', false).html('Simpan Data');
                });

            return false;
        });
    </script>
@endpush