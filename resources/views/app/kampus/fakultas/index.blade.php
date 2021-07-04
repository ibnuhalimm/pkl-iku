@extends('layout.app')

@section('title')
    {{ __('Fakultas') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                {{ __('Fakultas') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-5">
                <div class="mb-6">
                    <x-button type="button" color="primary" id="__btnCreateFaculty">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">
                            {{ __('Tambah Data') }}
                        </span>
                    </x-button>
                </div>

                <x-alert-simple color="green" id="__alertSuccessTable" class="alert hidden"></x-alert-simple>

                <div class="w-full overflow-x-auto">
                    <table class="w-full" id="faculty-table">
                        <thead>
                            <tr>
                                <th class="w-20">
                                    {{ __('ID') }}
                                </th>
                                <th>
                                    {{ __('Nama Fakultas') }}
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


    <x-modal.modal-default id="__modalCreateFaculty" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Tambah Data') }}
            </x-modal.title>
            <x-modal.close-button id="__btnCloseModalCreateFaculty" />
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalCreateFaculty" class="alert hidden"></x-alert-simple>

            <form action="{{ route('kampus.fakultas.store') }}" method="post" id="__formCreateFaculty">
                @csrf

                <x-form-group>
                    <x-form-label for="__nameCreateFaculty" isRequired="true">
                        Nama Fakultas
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameCreateFaculty" autocomplete="off" />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelCreateFaculty">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitCreateFaculty">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-default>


    <x-modal.modal-default id="__modalEditFaculty" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Edit Data') }}
            </x-modal.title>
            <x-modal.close-button id="__btnCloseModalEditFaculty" />
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalEditFaculty" class="alert hidden"></x-alert-simple>

            <form action="{{ route('kampus.fakultas.update') }}" method="post" id="__formEditFaculty">
                @csrf

                <input type="hidden" name="id" id="__idEditFaculty">

                <x-form-group>
                    <x-form-label for="__nameEditFaculty" isRequired="true">
                        Nama Fakultas
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameEditFaculty" autocomplete="off" />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelEditFaculty">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitEditFaculty">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-default>


    <x-modal.modal-sm id="__modalDeleteFaculty" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Edit Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalDeleteFaculty" class="alert hidden"></x-alert-simple>

            <form action="{{ route('kampus.fakultas.destroy') }}" method="post" id="__formDeleteFaculty">
                @csrf

                <input type="hidden" name="id" id="__idDeleteFaculty">

                <p class="mb-5 text-center">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelDeleteFaculty">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnSubmitDeleteFaculty">
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
        const datatableUrl = '{{ route('kampus.fakultas.datatable') }}';


        var facultyTable = $('#faculty-table').DataTable({
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


        $('#__btnCreateFaculty').on('click', function() {
            $('#__modalCreateFaculty').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnCloseModalCreateFaculty').on('click', function() {
            $('#__modalCreateFaculty').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelCreateFaculty').on('click', function() {
            $('#__modalCreateFaculty').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formCreateFaculty').on('submit', function(event) {
            event.preventDefault();

            const storeUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateFaculty').attr('disabled', true);
            $('#__btnSubmitCreateFaculty').attr('disabled', true).html('Menyimpan...');

            axios.post(storeUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalCreateFaculty').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelCreateFaculty').attr('disabled', false);
                    $('#__btnSubmitCreateFaculty').attr('disabled', false).html('Simpan Data');

                    facultyTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalCreateFaculty').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalCreateFaculty').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalCreateFaculty').html(responseData.message);

                    }

                    $('#__btnCancelCreateFaculty').attr('disabled', false);
                    $('#__btnSubmitCreateFaculty').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const editFaculty = (el) => {
            let id = el.getAttribute('data-id');
            let name = el.getAttribute('data-name');

            $('.alert').addClass('hidden').html(null);

            $('#__modalEditFaculty').removeClass('hidden');
            $('body').addClass('modal-open');

            $('#__idEditFaculty').val(id);
            $('#__nameEditFaculty').val(name);
        }


        $('#__btnCloseModalEditFaculty').on('click', function() {
            $('#__modalEditFaculty').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelEditFaculty').on('click', function() {
            $('#__modalEditFaculty').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formEditFaculty').on('submit', function(event) {
            event.preventDefault();

            const updateUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelEditFaculty').attr('disabled', true);
            $('#__btnSubmitEditFaculty').attr('disabled', true).html('Menyimpan...');

            axios.post(updateUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalEditFaculty').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelEditFaculty').attr('disabled', false);
                    $('#__btnSubmitEditFaculty').attr('disabled', false).html('Simpan Data');

                    facultyTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalEditFaculty').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalEditFaculty').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalEditFaculty').html(responseData.message);

                    }

                    $('#__btnCancelEditFaculty').attr('disabled', false);
                    $('#__btnSubmitEditFaculty').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const deleteFaculty = (el) => {
            let id = el.getAttribute('data-id');

            $('#__idDeleteFaculty').val(id);

            $('#__modalDeleteFaculty').removeClass('hidden');
            $('body').addClass('modal-open');
        }


        $('#__btnCancelDeleteFaculty').on('click', function() {
            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteFaculty').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formDeleteFaculty').on('submit', function(event) {
            event.preventDefault();

            const deleteUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelDeleteFaculty').attr('disabled', true);
            $('#__btnSubmitDeleteFaculty').attr('disabled', true).html('Menghapus...');

            axios.post(deleteUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalDeleteFaculty').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelDeleteFaculty').attr('disabled', false);
                    $('#__btnSubmitDeleteFaculty').attr('disabled', false).html('Ya, Hapus');

                    facultyTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalDeleteFaculty').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalDeleteFaculty').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalDeleteFaculty').html(responseData.message);

                    }

                    $('#__btnCancelDeleteFaculty').attr('disabled', false);
                    $('#__btnSubmitDeleteFaculty').attr('disabled', false).html('Ya, Hapus');

                });

            return false;
        });
    </script>
@endpush