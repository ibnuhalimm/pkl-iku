@extends('layout.app')

@section('title')
    {{ __('Kategori Perusahaan') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                {{ __('Kategori Perusahaan') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-5">
                <div class="mb-6">
                    <x-button type="button" color="primary" id="__btnCreateCategory">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">
                            {{ __('Tambah Data') }}
                        </span>
                    </x-button>
                </div>

                <x-alert-simple color="green" id="__alertSuccessTable" class="alert hidden"></x-alert-simple>

                <div class="w-full overflow-x-auto">
                    <table class="w-full" id="category-table">
                        <thead>
                            <tr>
                                <th class="w-20">
                                    {{ __('ID') }}
                                </th>
                                <th>
                                    {{ __('Kategori') }}
                                </th>
                                <th class="w-20">
                                    {{ __('###') }}
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </x-card.body>
    </x-card.card-default>


    <x-modal.modal-default id="__modalCreateCategory" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Tambah Data') }}
            </x-modal.title>
            <x-modal.close-button id="__btnCloseModalCreateCategory" />
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalCreateCategory" class="alert hidden"></x-alert-simple>

            <form action="{{ route('perusahaan.kategori.store') }}" method="post" id="__formCreateCategory">
                @csrf

                <x-form-group>
                    <x-form-label for="__nameCreateCategory" isRequired="true">
                        Kategori Perusahaan
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameCreateCategory" autocomplete="off" />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelCreateCategory">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitCreateCategory">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-default>


    <x-modal.modal-default id="__modalEditCategory" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Edit Data') }}
            </x-modal.title>
            <x-modal.close-button id="__btnCloseModalEditCategory" />
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalEditCategory" class="alert hidden"></x-alert-simple>

            <form action="{{ route('perusahaan.kategori.update') }}" method="post" id="__formEditCategory">
                @csrf

                <input type="hidden" name="id" id="__idEditCategory">

                <x-form-group>
                    <x-form-label for="__nameEditCategory" isRequired="true">
                        Kategori Perusahaan
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameEditCategory" autocomplete="off" />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelEditCategory">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitEditCategory">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-default>


    <x-modal.modal-sm id="__modalDeleteCategory" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Hapus Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalDeleteCategory" class="alert hidden"></x-alert-simple>

            <form action="{{ route('perusahaan.kategori.destroy') }}" method="post" id="__formDeleteCategory">
                @csrf

                <input type="hidden" name="id" id="__idDeleteCategory">

                <p class="mb-5 text-center">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelDeleteCategory">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnSubmitDeleteCategory">
                        {{ __('Ya, Hapus') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-sm>

@endsection


@push('bottom_js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('js/datatable.config.js') }}"></script>

    <script>
        const datatableUrl = '{{ route('perusahaan.kategori.datatable') }}';


        var categoryTable = $('#category-table').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                type: 'GET',
                url: datatableUrl
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'action', orderable: false },
            ],
            columnDefs: [
                { targets: [0, 2], className: 'text-center' }
            ]
        });


        $('#__btnCreateCategory').on('click', function() {
            $('#__modalCreateCategory').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnCloseModalCreateCategory').on('click', function() {
            $('#__modalCreateCategory').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelCreateCategory').on('click', function() {
            $('#__modalCreateCategory').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formCreateCategory').on('submit', function(event) {
            event.preventDefault();

            const storeUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateCategory').attr('disabled', true);
            $('#__btnSubmitCreateCategory').attr('disabled', true).html('Menyimpan...');

            axios.post(storeUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalCreateCategory').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelCreateCategory').attr('disabled', false);
                    $('#__btnSubmitCreateCategory').attr('disabled', false).html('Simpan Data');

                    categoryTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalCreateCategory').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalCreateCategory').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalCreateCategory').html(responseData.message);

                    }

                    $('#__btnCancelCreateCategory').attr('disabled', false);
                    $('#__btnSubmitCreateCategory').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const editCategory = (el) => {
            let id = el.getAttribute('data-id');
            let name = el.getAttribute('data-name');

            $('.alert').addClass('hidden').html(null);

            $('#__modalEditCategory').removeClass('hidden');
            $('body').addClass('modal-open');

            $('#__idEditCategory').val(id);
            $('#__nameEditCategory').val(name);
        }


        $('#__btnCloseModalEditCategory').on('click', function() {
            $('#__modalEditCategory').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelEditCategory').on('click', function() {
            $('#__modalEditCategory').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formEditCategory').on('submit', function(event) {
            event.preventDefault();

            const updateUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelEditCategory').attr('disabled', true);
            $('#__btnSubmitEditCategory').attr('disabled', true).html('Menyimpan...');

            axios.post(updateUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalEditCategory').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelEditCategory').attr('disabled', false);
                    $('#__btnSubmitEditCategory').attr('disabled', false).html('Simpan Data');

                    categoryTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalEditCategory').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalEditCategory').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalEditCategory').html(responseData.message);

                    }

                    $('#__btnCancelEditCategory').attr('disabled', false);
                    $('#__btnSubmitEditCategory').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const deleteCategory = (el) => {
            let id = el.getAttribute('data-id');

            $('#__idDeleteCategory').val(id);

            $('#__modalDeleteCategory').removeClass('hidden');
            $('body').addClass('modal-open');
        }


        $('#__btnCancelDeleteCategory').on('click', function() {
            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteCategory').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formDeleteCategory').on('submit', function(event) {
            event.preventDefault();

            const deleteUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelDeleteCategory').attr('disabled', true);
            $('#__btnSubmitDeleteCategory').attr('disabled', true).html('Menghapus...');

            axios.post(deleteUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalDeleteCategory').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelDeleteCategory').attr('disabled', false);
                    $('#__btnSubmitDeleteCategory').attr('disabled', false).html('Ya, Hapus');

                    categoryTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalDeleteCategory').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalDeleteCategory').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalDeleteCategory').html(responseData.message);

                    }

                    $('#__btnCancelDeleteCategory').attr('disabled', false);
                    $('#__btnSubmitDeleteCategory').attr('disabled', false).html('Ya, Hapus');

                });

            return false;
        });
    </script>
@endpush