@extends('layout.app')

@section('title')
    {{ __('Tambah Biodata') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.back-button href="{{ route('biodata.index') }}" />
            <x-card.title class="w-full">
                {{ __('Tambah Biodata') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>

            <div class="px-6 pb-6">

               <x-alert-simple color="green" id="__alertSuccess" class="alert hidden"></x-alert-simple>
               <x-alert-simple color="red" id="__alertError" class="alert hidden"></x-alert-simple>

                <form action="{{ route('biodata.store') }}" method="post" id="__formCreateBiodata">
                    @csrf

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Bio') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="sm:col-span-2 lg:col-span-6">
                                <div class="sm:w-1/2 lg:w-1/3 sm:pr-6">
                                    <x-form-label for="__photoCreateBiodata" isRequired="true">
                                        {{ __('Foto') }}
                                    </x-form-label>
                                    <x-form.input-file name="photo" id="__photoCreateBiodata" accept="image/*" />
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__id_card_numberCreateBiodata" isRequired="true">
                                    {{ __('NIK') }}
                                </x-form-label>
                                <x-input-text type="text" name="id_card_number" id="__id_card_numberCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__nameCreateBiodata" isRequired="true">
                                    {{ __('Nama') }}
                                </x-form-label>
                                <x-input-text type="text" name="name" id="__nameCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__birth_placeCreateBiodata" isRequired="true">
                                    {{ __('Tempat Lahir') }}
                                </x-form-label>
                                <x-input-text type="text" name="birth_place" id="__birth_placeCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__birth_dateCreateBiodata" isRequired="true">
                                    {{ __('Tanggal Lahir') }}
                                </x-form-label>
                                <x-input-text type="text" name="birth_date" id="__birth_dateCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__genderCreateBiodata" isRequired="true">
                                    {{ __('Gender') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="gender" id="__genderCreateBiodata" width="100%">
                                        <option value=""></option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__religion_idCreateBiodata" isRequired="true">
                                    {{ __('Agama') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="religion_id" id="__religion_idCreateBiodata" class="select-religion" width="100%">
                                        <option value=""></option>
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id }}">
                                                {{ $religion->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__blood_typeCreateBiodata" isRequired="false">
                                    {{ __('Golongan Darah') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="blood_type" id="__blood_typeCreateBiodata" width="100%">
                                        <option value="" selected>- Tidak Tahu -</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__marital_statusCreateBiodata" isRequired="true">
                                    {{ __('Status Menikah') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="marital_status" id="__marital_statusCreateBiodata" width="100%">
                                        <option value=""></option>
                                        <option value="0">Belum Menikah</option>
                                        <option value="1">Sudah Menikah</option>
                                    </x-form.select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Info Kontak') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="lg:col-span-2">
                                <x-form-label for="__emailCreateBiodata" isRequired="true">
                                    {{ __('Email') }}
                                </x-form-label>
                                <x-input-text type="email" name="email" id="__emailCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__phoneCreateBiodata" isRequired="true">
                                    {{ __('No HP/Telepon') }}
                                </x-form-label>
                                <x-input-text type="text" name="phone" id="__phoneCreateBiodata" />
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Info Alamat') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="sm:col-span-2 lg:col-span-2">
                                <x-form-label for="__addressCreateBiodata" isRequired="true">
                                    {{ __('Alamat') }}
                                </x-form-label>
                                <x-form.textarea name="address" id="__addressCreateBiodata" class="resize-none" rows="3"></x-form.textarea>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__province_idCreateBiodata" isRequired="true">
                                    {{ __('Provinsi') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="province_id" id="__province_idCreateBiodata" width="100%"></x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__city_idCreateBiodata" isRequired="true">
                                    {{ __('Kabupaten/Kota') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="city_id" id="__city_idCreateBiodata" width="100%"></x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__district_idCreateBiodata" isRequired="true">
                                    {{ __('Kecamatan') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="district_id" id="__district_idCreateBiodata" width="100%"></x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__village_idCreateBiodata" isRequired="true">
                                    {{ __('Desa/Kelurahan') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="village_id" id="__village_idCreateBiodata" width="100%"></x-form.select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Data Orang Tua (Ayah)') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="lg:col-span-2">
                                <x-form-label for="__father_nameCreateBiodata" isRequired="true">
                                    {{ __('Nama') }}
                                </x-form-label>
                                <x-input-text type="text" name="father_name" id="__father_nameCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__father_religion_idCreateBiodata" isRequired="true">
                                    {{ __('Agama') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="father_religion_id" id="__father_religion_idCreateBiodata" class="select-religion" width="100%">
                                        <option value=""></option>
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id }}">
                                                {{ $religion->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__father_profession_idCreateBiodata" isRequired="true">
                                    {{ __('Pekerjaan') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="father_profession_id" id="__father_profession_idCreateBiodata" class="select-profession" width="100%">
                                        <option value=""></option>
                                        @foreach ($professions as $profession)
                                            <option value="{{ $profession->id }}">
                                                {{ $profession->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__father_education_idCreateBiodata" isRequired="true">
                                    {{ __('Pendidikan Terakhir') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="father_education_id" id="__father_education_idCreateBiodata" class="select-education" width="100%">
                                        <option value=""></option>
                                        @foreach ($educations as $education)
                                            <option value="{{ $education->id }}">
                                                {{ $education->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__father_is_lifeCreateBiodata" isRequired="true">
                                    {{ __('Hidup') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="father_is_life" id="__father_is_lifeCreateBiodata" class="select-is-life" width="100%">
                                        <option value=""></option>
                                        <option value="1">Masih Hidup</option>
                                        <option value="0">Sudah Meninggal</option>
                                    </x-form.select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Data Orang Tua (Ibu)') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-dashed border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="lg:col-span-2">
                                <x-form-label for="__mother_nameCreateBiodata" isRequired="true">
                                    {{ __('Nama') }}
                                </x-form-label>
                                <x-input-text type="text" name="mother_name" id="__mother_nameCreateBiodata" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__mother_religion_idCreateBiodata" isRequired="true">
                                    {{ __('Agama') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="mother_religion_id" id="__mother_religion_idCreateBiodata" class="select-religion" width="100%">
                                        <option value=""></option>
                                        @foreach ($religions as $religion)
                                            <option value="{{ $religion->id }}">
                                                {{ $religion->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__mother_profession_idCreateBiodata" isRequired="true">
                                    {{ __('Pekerjaan') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="mother_profession_id" id="__mother_profession_idCreateBiodata" class="select-profession" width="100%">
                                        <option value=""></option>
                                        @foreach ($professions as $profession)
                                            <option value="{{ $profession->id }}">
                                                {{ $profession->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__mother_education_idCreateBiodata" isRequired="true">
                                    {{ __('Pendidikan Terakhir') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="mother_education_id" id="__mother_education_idCreateBiodata" class="select-education" width="100%">
                                        <option value=""></option>
                                        @foreach ($educations as $education)
                                            <option value="{{ $education->id }}">
                                                {{ $education->name }}
                                            </option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__mother_is_lifeCreateBiodata" isRequired="true">
                                    {{ __('Hidup') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="mother_is_life" id="__mother_is_lifeCreateBiodata" class="select-is-life" width="100%">
                                        <option value=""></option>
                                        <option value="1">Masih Hidup</option>
                                        <option value="0">Sudah Meninggal</option>
                                    </x-form.select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <x-button type="button" color="gray" id="__btnCancelCreateBiodata">
                            {{ __('Batal') }}
                        </x-button>
                        <x-button type="submit" color="primary" id="__btnSubmitCreateBiodata">
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
                <x-button-link href="{{ route('biodata.index') }}" color="red">
                    {{ __('Ya, Lanjutkan') }}
                </x-button-link>
            </div>
        </x-modal.body>
    </x-modal.modal-sm>

@endsection


@push('bottom_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        const provinceSelectTwoUrl = '{{ route('indonesia.provinsi.select') }}';
        const citySelectTwoUrl = '{{ route('indonesia.kota.select') }}';
        const districtSelectTwoUrl = '{{ route('indonesia.kecamatan.select') }}';
        const villageSelectTwoUrl = '{{ route('indonesia.desa.select') }}';
        const datatablePageUrl = '{{ route('biodata.index') }}';

        var provinceId = 0;
        var cityId = 0;
        var districtId = 0;


        $('#__genderCreateBiodata').select2({
            placeholder: '- Pilih Gender -'
        });

        $('#__marital_statusCreateBiodata').select2({
            placeholder: '- Pilih Status Menikah -'
        });

        $('.select-religion').select2({
            placeholder: '- Pilih Agama -'
        });

        $('.select-profession').select2({
            placeholder: '- Pilih Pekerjaan -'
        });

        $('.select-is-life').select2({
            placeholder: '- Pilih -'
        });

        $('.select-education').select2({
            placeholder: '- Pilih Pendidikan Terakhir -'
        });

        $('#__blood_typeCreateBiodata').select2({
            placeholder: '- Pilih Golongan Darah -',
            allowClear: true
        });

        $('#__province_idCreateBiodata').select2({
            placeholder: '- Pilih Provinsi -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: provinceSelectTwoUrl,
                data: function(params) {
                    return {
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__city_idCreateBiodata').select2({
            placeholder: '- Pilih Kabupaten/Kota -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: citySelectTwoUrl,
                data: function(params) {
                    return {
                        provinceId: provinceId,
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__district_idCreateBiodata').select2({
            placeholder: '- Pilih Kecamatan -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: districtSelectTwoUrl,
                data: function(params) {
                    return {
                        cityId: cityId,
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__village_idCreateBiodata').select2({
            placeholder: '- Pilih Desa/Kelurahan -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: villageSelectTwoUrl,
                data: function(params) {
                    return {
                        districtId: districtId,
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__province_idCreateBiodata').on('change', function() {
            provinceId = $(this).val();

            $('#__city_idCreateBiodata').val(null).trigger('change');
            $('#__district_idCreateBiodata').val(null).trigger('change');
            $('#__village_idCreateBiodata').val(null).trigger('change');
        });


        $('#__city_idCreateBiodata').on('change', function() {
            cityId = $(this).val();

            $('#__district_idCreateBiodata').val(null).trigger('change');
            $('#__village_idCreateBiodata').val(null).trigger('change');
        });


        $('#__district_idCreateBiodata').on('change', function() {
            districtId = $(this).val();

            $('#__village_idCreateBiodata').val(null).trigger('change');
        });


        $('#__btnCancelCreateBiodata').on('click', function() {
            $('#__modalCancel').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnNoCancelModal').on('click', function() {
            $('#__modalCancel').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formCreateBiodata').on('submit', function(event) {
            event.preventDefault();

            let storeUrl = $(this).attr('action');
            let formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateBiodata').attr('disabled', true);
            $('#__btnSubmitCreateBiodata').attr('disabled', true).html('Menyimpan...');

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
                    $('#__btnCancelCreateBiodata').attr('disabled', false);
                    $('#__btnSubmitCreateBiodata').attr('disabled', false).html('Simpan Data');
                });

            return false;
        });
    </script>
@endpush