@extends('layout.app')

@section('title')
    {{ __('Edit Mahasiswa') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.back-button href="{{ route('mahasiswa.index') }}" />
            <x-card.title class="w-full">
                {{ __('Edit Mahasiswa') . __(' - ') . $student->id_number }}
            </x-card.title>
        </x-card.header>
        <x-card.body>

            <div class="px-6 pb-6">

               <x-alert-simple color="green" id="__alertSuccess" class="alert hidden"></x-alert-simple>
               <x-alert-simple color="red" id="__alertError" class="alert hidden"></x-alert-simple>

                <form action="{{ route('mahasiswa.update') }}" method="post" id="__formEditStudent">
                    @csrf

                    <input type="hidden" name="id" value="{{ $student->id }}">

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Bio') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8 mb-5">
                            <div class="sm:col-span-2 lg:col-span-3">
                                <x-form-label for="__biodata_idEditStudent" isRequired="true">
                                    {{ __('Biodata') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="biodata_id" id="__biodata_idEditStudent" style="width: 100%">
                                        <option value="{{ $student->biodata_id }}" selected>
                                            {{ $student->biodata->id_card_number . ' - ' . $student->biodata->name }}
                                        </option>
                                    </x-form.select>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <table class="w-full">
                                <tbody>
                                    <tr>
                                        <td class="py-2 w-1/3">NIK</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__nikBiodata">
                                                {{ $student->biodata->id_card_number }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">Nama</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__nameBiodata">
                                                {{ $student->biodata->name }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">TTL</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__ttlBiodata">
                                                {{ $student->biodata->birth_place . ', ' . $student->biodata->birth_date }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">Gender</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__genderBiodata">
                                                {{ $student->biodata->gender }}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">Alamat</td>
                                        <td class="py-2">:</td>
                                        <td class="py-2">
                                            <strong id="__addressBiodata">
                                                {{ $student->biodata->address }}
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Data Kemahasiswaan') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="lg:col-span-2">
                                <x-form-label for="__degreeEditStudent" isRequired="true">
                                    {{ __('Jenjang') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="degree" id="__degreeEditStudent" style="width: 100%">
                                        {{-- <option value=""></option> --}}
                                        @foreach ($degrees as $value => $text)
                                            <option value="{{ $value }}" @if ($student->degree == $value) selected @endif>
                                                {{ $text }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__study_program_idEditStudent" isRequired="true">
                                    {{ __('Program Studi') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="study_program_id" id="__study_program_idEditStudent" style="width: 100%">
                                        {{-- <option value=""></option> --}}
                                        @foreach ($studyPrograms as $studyProgram)
                                            <option value="{{ $studyProgram->id }}" @if ($student->study_program_id == $studyProgram->id) selected @endif>
                                                {{ $studyProgram->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__id_numberEditStudent" isRequired="true">
                                    {{ __('NIM') }}
                                </x-form-label>
                                <x-input-text type="text" name="id_number" id="__id_numberEditStudent" value="{{ $student->id_number }}" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__statusEditStudent" isRequired="true">
                                    {{ __('Status') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="status" id="__statusEditStudent" style="width: 100%">
                                        {{-- <option value=""></option> --}}
                                        @foreach ($statuses as $value => $text)
                                            <option value="{{ $value }}" @if ($student->status == $value) selected @endif>
                                                {{ $text }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__month_entryEditStudent" isRequired="true">
                                    {{ __('Bulan/Tahun Masuk') }}
                                </x-form-label>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <div>
                                        <x-form.select name="month_entry" id="__month_entryEditStudent" style="width: 100%">
                                            {{-- <option value=""></option> --}}
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" @if ($student->month_entry == $i) selected @endif>
                                                    {{ strftime('%B', strtotime('2021-' . $i . '-01')) }}
                                                </option>
                                            @endfor
                                        </x-form.select>
                                    </div>
                                    <div>
                                        <x-input-text type="number" name="year_entry" id="__year_entryEditStudent" value="{{ $student->year_entry }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Data Kelulusan') }}
                            </h2>
                            <small class="block whitespace-nowrap ml-2">
                                Wajib diisi jika status lulus
                            </small>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="lg:col-span-2">
                                <x-form-label for="__month_gradEditStudent" isRequired="false">
                                    {{ __('Bulan/Tahun Lulus') }}
                                </x-form-label>
                                <div class="grid grid-cols-2 gap-x-4">
                                    <div>
                                        <x-form.select name="month_grad" id="__month_gradEditStudent" style="width: 100%">
                                            @if (empty($student_month_grad))
                                                <option value="" selected></option>
                                            @endif

                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" @if ($student->month_grad == $i) selected @endif>
                                                    {{ strftime('%B', strtotime('2021-' . $i . '-01')) }}
                                                </option>
                                            @endfor
                                        </x-form.select>
                                    </div>
                                    <div>
                                        <x-input-text type="number" name="year_grad" id="__year_gradEditStudent" value="{{ $student->year_grad }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <x-button type="button" color="gray" id="__btnCancelEditStudent">
                            {{ __('Batal') }}
                        </x-button>
                        <x-button type="submit" color="primary" id="__btnSubmitEditStudent">
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
                <x-button-link href="{{ route('mahasiswa.index') }}" color="red">
                    {{ __('Ya, Lanjutkan') }}
                </x-button-link>
            </div>
        </x-modal.body>
    </x-modal.modal-sm>

@endsection


@push('bottom_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        const biodataSelectTwoUrl = '{{ route('biodata.select') }}';
        const biodataDetailUrl = '{{ route('biodata.show') }}';
        const datatablePageUrl = '{{ route('mahasiswa.index') }}';


        $('#__biodata_idEditStudent').select2({
            placeholder: '- Pilih Biodata -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: biodataSelectTwoUrl,
                data: function(params) {
                    return {
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__study_program_idEditStudent').select2({
            placeholder: '- Pilih Program Studi -',
            width: 'resolve'
        });


        $('#__degreeEditStudent').select2({
            placeholder: '- Pilih Jenjang -',
            width: 'resolve'
        });


        $('#__statusEditStudent').select2({
            placeholder: '- Pilih Status -',
            width: 'resolve'
        });


        $('#__month_entryEditStudent').select2({
            placeholder: '- Pilih Bulan -',
            width: 'resolve'
        });


        $('#__month_gradEditStudent').select2({
            placeholder: '- Pilih Bulan -',
            width: 'resolve'
        });


        $('#__biodata_idEditStudent').on('change', function() {
            let biodataId = $(this).val();

            resetBiodataInfo();

            if (biodataId !== null) {
                axios.get(`${biodataDetailUrl}?id=${biodataId}`)
                    .then(response => {
                        let responseData = response.data;

                        displayBiodataInfo(responseData.data);
                    })
                    .catch(({response}) => {
                        let responseData = response.data;

                        alert(responseData.message);
                    });
            }
        });


        const resetBiodataInfo = () => {
            $('#__nikBiodata').html(null);
            $('#__nameBiodata').html(null);
            $('#__ttlBiodata').html(null);
            $('#__genderBiodata').html(null);
            $('#__addressBiodata').html(null);
        }


        const displayBiodataInfo = (data) => {
            let { id_card_number, name, birth_place, birth_date, gender, address } = data;

            $('#__nikBiodata').html(id_card_number);
            $('#__nameBiodata').html(name);
            $('#__ttlBiodata').html(`${birth_place}, ${birth_date}`);
            $('#__genderBiodata').html(gender);
            $('#__addressBiodata').html(address);
        }


        $('#__btnCancelEditStudent').on('click', function() {
            $('#__modalCancel').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnNoCancelModal').on('click', function() {
            $('#__modalCancel').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formEditStudent').on('submit', function(event) {
            event.preventDefault();

            let storeUrl = $(this).attr('action');
            let formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelEditStudent').attr('disabled', true);
            $('#__btnSubmitEditStudent').attr('disabled', true).html('Menyimpan...');

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
                    $('#__btnCancelEditStudent').attr('disabled', false);
                    $('#__btnSubmitEditStudent').attr('disabled', false).html('Simpan Data');
                });

            return false;
        });
    </script>
@endpush