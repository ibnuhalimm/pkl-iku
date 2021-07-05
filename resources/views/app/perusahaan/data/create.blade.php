@extends('layout.app')

@section('title')
    {{ __('Tambah Data Perusahaan') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.back-button href="{{ route('perusahaan.data.index') }}" />
            <x-card.title class="w-full">
                {{ __('Tambah Data Perusahaan') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>

            <div class="px-6 pb-6">

               <x-alert-simple color="green" id="__alertSuccess" class="alert hidden"></x-alert-simple>
               <x-alert-simple color="red" id="__alertError" class="alert hidden"></x-alert-simple>

                <form action="{{ route('perusahaan.data.store') }}" method="post" id="__formCreateCompany">
                    @csrf

                    <div class="mb-10">
                        <div class="flex flex-row items-center justify-between mb-3">
                            <h2 class="block whitespace-nowrap text-gray-600 text-base font-bold">
                                {{ __('Data Perusahaan') }}
                            </h2>
                            <hr class="w-full ml-3 relative border border-r-0 border-b-0 border-l-0 border-gray-300">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-x-8">
                            <div class="sm:col-span-2 lg:col-span-2">
                                <x-form-label for="__company_category_idCreateCompany" isRequired="true">
                                    {{ __('Kategori') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="company_category_id" id="__company_category_idCreateCompany" width="100%"></x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__nameCreateCompany" isRequired="true">
                                    {{ __('Nama Perusahaan') }}
                                </x-form-label>
                                <x-input-text type="text" name="name" id="__nameCreateCompany" />
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__brandCreateCompany" isRequired="false">
                                    {{ __('Brand') }}
                                </x-form-label>
                                <x-input-text type="text" name="brand" id="__brandCreateCompany" />
                            </div>
                            <div class="sm:col-span-2 lg:col-span-2">
                                <x-form-label for="__addressCreateCompany" isRequired="false">
                                    {{ __('Alamat') }}
                                </x-form-label>
                                <x-form.textarea name="address" id="__addressCreateCompany" class="resize-none" rows="3"></x-form.textarea>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__province_idCreateCompany" isRequired="true">
                                    {{ __('Provinsi') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="province_id" id="__province_idCreateCompany" width="100%"></x-form.select>
                                </div>
                            </div>
                            <div class="lg:col-span-2">
                                <x-form-label for="__city_idCreateCompany" isRequired="true">
                                    {{ __('Kabupaten/Kota') }}
                                </x-form-label>
                                <div>
                                    <x-form.select name="city_id" id="__city_idCreateCompany" width="100%"></x-form.select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <x-button type="button" color="gray" id="__btnCancelCreateCompany">
                            {{ __('Batal') }}
                        </x-button>
                        <x-button type="submit" color="primary" id="__btnSubmitCreateCompany">
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
                <x-button-link href="{{ route('perusahaan.data.index') }}" color="red">
                    {{ __('Ya, Lanjutkan') }}
                </x-button-link>
            </div>
        </x-modal.body>
    </x-modal.modal-sm>

@endsection


@push('bottom_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        const categorySelectTwoUrl = '{{ route('perusahaan.kategori.select') }}';
        const provinceSelectTwoUrl = '{{ route('indonesia.provinsi.select') }}';
        const citySelectTwoUrl = '{{ route('indonesia.kota.select') }}';
        const datatablePageUrl = '{{ route('perusahaan.data.index') }}';

        var provinceId = 0;


        $('#__company_category_idCreateCompany').select2({
            placeholder: '- Pilih Kategori -',
            width: 'resolve',
            allowClear: true,
            ajax: {
                type: 'GET',
                url: categorySelectTwoUrl,
                data: function(params) {
                    return {
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__province_idCreateCompany').select2({
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


        $('#__city_idCreateCompany').select2({
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


        $('#__province_idCreateCompany').on('change', function() {
            provinceId = $(this).val();

            $('#__city_idCreateCompany').val(null).trigger('change');
        });


        $('#__btnCancelCreateCompany').on('click', function() {
            $('#__modalCancel').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnNoCancelModal').on('click', function() {
            $('#__modalCancel').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formCreateCompany').on('submit', function(event) {
            event.preventDefault();

            let storeUrl = $(this).attr('action');
            let formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateCompany').attr('disabled', true);
            $('#__btnSubmitCreateCompany').attr('disabled', true).html('Menyimpan...');

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
                    $('#__btnCancelCreateCompany').attr('disabled', false);
                    $('#__btnSubmitCreateCompany').attr('disabled', false).html('Simpan Data');
                });

            return false;
        });
    </script>
@endpush