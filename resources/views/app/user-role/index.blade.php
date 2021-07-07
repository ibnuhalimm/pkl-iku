@extends('layout.app')

@section('title')
    {{ __('User & Hak Akses') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                {{ __('User & Hak Akses') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-5">
                <div class="mb-6">
                    <x-button type="button" color="primary" id="__btnCreateUserRole">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">
                            {{ __('Tambah Data') }}
                        </span>
                    </x-button>
                </div>

                <x-alert-simple color="green" id="__alertSuccessTable" class="alert hidden"></x-alert-simple>

                <div class="w-full overflow-x-auto">
                    <table class="w-full" id="user-role-table">
                        <thead>
                            <tr>
                                <th class="w-20">
                                    {{ __('#') }}
                                </th>
                                <th>
                                    {{ __('Nama') }}
                                </th>
                                <th>
                                    {{ __('Username') }}
                                </th>
                                <th>
                                    {{ __('Email') }}
                                </th>
                                <th class="w-24">
                                    {{ __('###') }}
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </x-card.body>
    </x-card.card-default>


    <x-modal.modal-sm id="__modalCreateUserRole" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Tambah Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalCreateUserRole" class="alert hidden"></x-alert-simple>

            <form action="{{ route('user-role.store') }}" method="post" id="__formCreateUserRole">
                @csrf

                <x-form-group>
                    <x-form-label for="__nameCreateUserRole" isRequired="true">
                        Nama
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameCreateUserRole" autocomplete="off" />
                </x-form-group>
                <x-form-group>
                    <x-form-label for="__emailCreateUserRole" isRequired="true">
                        Email
                    </x-form-label>
                    <x-input-text type="email" name="email" id="__emailCreateUserRole" autocomplete="off" />
                </x-form-group>
                <x-form-group>
                    <x-form-label for="__usernameCreateUserRole" isRequired="true">
                        Username
                    </x-form-label>
                    <x-input-text type="text" name="username" id="__usernameCreateUserRole" autocomplete="off" />
                </x-form-group>

                <div class="text-center text-blue-500 mb-5">
                    ** Password akan dikirimkan via email
                </div>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelCreateUserRole">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitCreateUserRole">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-sm>


    <x-modal.modal-sm id="__modalResetPassword" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Reset Password') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalResetPassword" class="alert hidden"></x-alert-simple>

            <form action="{{ route('admin.reset-password') }}" method="post" id="__formResetPassword">
                @csrf

                <input type="hidden" name="id" id="__idResetPassword">

                <p class="mb-5 text-center">
                    Apakah Anda yakin <b>me-reset password</b> user ini?
                </p>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelResetPassword">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnSubmitResetPassword">
                        {{ __('Ya, Reset') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-sm>


    <x-modal.modal-sm id="__modalEditUserRole" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Edit Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalEditUserRole" class="alert hidden"></x-alert-simple>

            <form action="{{ route('user-role.update') }}" method="post" id="__formEditUserRole">
                @csrf

                <input type="hidden" name="id" id="__idEditUserRole">

                <x-form-group>
                    <x-form-label for="__nameEditUserRole" isRequired="true">
                        Nama
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameEditUserRole" autocomplete="off" />
                </x-form-group>
                <x-form-group>
                    <x-form-label for="__emailEditUserRole" isRequired="true">
                        Email
                    </x-form-label>
                    <x-input-text type="email" name="email" id="__emailEditUserRole" autocomplete="off" />
                </x-form-group>
                <x-form-group>
                    <x-form-label for="__usernameEditUserRole" isRequired="true">
                        Username
                    </x-form-label>
                    <x-input-text type="text" name="username" id="__usernameEditUserRole" class="bg-gray-200" autocomplete="off" readonly />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelEditUserRole">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitEditUserRole">
                        {{ __('Perbarui Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-sm>


    <x-modal.modal-sm id="__modalDeleteUserRole" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Hapus Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalDeleteUserRole" class="alert hidden"></x-alert-simple>

            <form action="{{ route('user-role.destroy') }}" method="post" id="__formDeleteUserRole">
                @csrf

                <input type="hidden" name="id" id="__idDeleteUserRole">

                <p class="mb-5 text-center">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelDeleteUserRole">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnSubmitDeleteUserRole">
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
        const datatableUrl = '{{ route('user-role.datatable') }}';


        var userRoleTable = $('#user-role-table').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                type: 'GET',
                url: datatableUrl
            },
            columns: [
                { data: 'DT_RowIndex', orderable: false },
                { data: 'name' },
                { data: 'username' },
                { data: 'email' },
                { data: 'action', orderable: false },
            ],
            columnDefs: [
                { targets: [0, 4], className: 'text-center' }
            ]
        });


        $('#__btnCreateUserRole').on('click', function() {
            $('#__modalCreateUserRole').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnCloseModalCreateUserRole').on('click', function() {
            $('#__modalCreateUserRole').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelCreateUserRole').on('click', function() {
            $('#__modalCreateUserRole').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formCreateUserRole').on('submit', function(event) {
            event.preventDefault();

            const storeUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateUserRole').attr('disabled', true);
            $('#__btnSubmitCreateUserRole').attr('disabled', true).html('Menyimpan...');

            axios.post(storeUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalCreateUserRole').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelCreateUserRole').attr('disabled', false);
                    $('#__btnSubmitCreateUserRole').attr('disabled', false).html('Simpan Data');

                    userRoleTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalCreateUserRole').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalCreateUserRole').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalCreateUserRole').html(responseData.message);

                    }

                    $('#__btnCancelCreateUserRole').attr('disabled', false);
                    $('#__btnSubmitCreateUserRole').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const resetPasswordUser = (el) => {
            let id = el.getAttribute('data-id');

            $('.alert').addClass('hidden').html(null);

            $('#__modalResetPassword').removeClass('hidden');
            $('body').addClass('modal-open');

            $('#__idResetPassword').val(id);
        }


        $('#__btnCancelResetPassword').on('click', function() {
            $('#__modalResetPassword').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formResetPassword').on('submit', function(event) {
            event.preventDefault();

            const resetUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelResetPassword').attr('disabled', true);
            $('#__btnSubmitResetPassword').attr('disabled', true).html('Menyimpan...');

            axios.post(resetUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalResetPassword').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelResetPassword').attr('disabled', false);
                    $('#__btnSubmitResetPassword').attr('disabled', false).html('Simpan Data');

                    userRoleTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalResetPassword').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalResetPassword').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalResetPassword').html(responseData.message);

                    }

                    $('#__btnCancelResetPassword').attr('disabled', false);
                    $('#__btnSubmitResetPassword').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const editUserRole = (el) => {
            let id = el.getAttribute('data-id');
            let name = el.getAttribute('data-name');
            let username = el.getAttribute('data-username');
            let email = el.getAttribute('data-email');

            $('.alert').addClass('hidden').html(null);

            $('#__modalEditUserRole').removeClass('hidden');
            $('body').addClass('modal-open');

            $('#__idEditUserRole').val(id);
            $('#__nameEditUserRole').val(name);
            $('#__usernameEditUserRole').val(username);
            $('#__emailEditUserRole').val(email);
        }


        $('#__btnCloseModalEditUserRole').on('click', function() {
            $('#__modalEditUserRole').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelEditUserRole').on('click', function() {
            $('#__modalEditUserRole').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formEditUserRole').on('submit', function(event) {
            event.preventDefault();

            const updateUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelEditUserRole').attr('disabled', true);
            $('#__btnSubmitEditUserRole').attr('disabled', true).html('Menyimpan...');

            axios.post(updateUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalEditUserRole').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelEditUserRole').attr('disabled', false);
                    $('#__btnSubmitEditUserRole').attr('disabled', false).html('Simpan Data');

                    userRoleTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalEditUserRole').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalEditUserRole').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalEditUserRole').html(responseData.message);

                    }

                    $('#__btnCancelEditUserRole').attr('disabled', false);
                    $('#__btnSubmitEditUserRole').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const deleteUserRole = (el) => {
            let id = el.getAttribute('data-id');

            $('#__idDeleteUserRole').val(id);

            $('#__modalDeleteUserRole').removeClass('hidden');
            $('body').addClass('modal-open');
        }


        $('#__btnCancelDeleteUserRole').on('click', function() {
            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteUserRole').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formDeleteUserRole').on('submit', function(event) {
            event.preventDefault();

            const deleteUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelDeleteUserRole').attr('disabled', true);
            $('#__btnSubmitDeleteUserRole').attr('disabled', true).html('Menghapus...');

            axios.post(deleteUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalDeleteUserRole').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelDeleteUserRole').attr('disabled', false);
                    $('#__btnSubmitDeleteUserRole').attr('disabled', false).html('Ya, Hapus');

                    userRoleTable.ajax.reload(null, false);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalDeleteUserRole').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalDeleteUserRole').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalDeleteUserRole').html(responseData.message);

                    }

                    $('#__btnCancelDeleteUserRole').attr('disabled', false);
                    $('#__btnSubmitDeleteUserRole').attr('disabled', false).html('Ya, Hapus');

                });

            return false;
        });
    </script>
@endpush