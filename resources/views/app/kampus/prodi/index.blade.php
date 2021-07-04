@extends('layout.app')

@section('title')
    {{ __('Program Studi') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                {{ __('Program Studi') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-5">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="col-span-1 lg:col-span-1">
                        <x-button type="button" color="primary" id="__btnCreateStudyProgram">
                            <i class="fas fa-plus"></i>
                            <span class="ml-1">
                                {{ __('Tambah Data') }}
                            </span>
                        </x-button>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <div class="w-full md:w-4/5 lg:w-3/5 float-right">
                            <x-form.select id="__faculty_idFilter" class="select-faculty" style="width: 100%">
                                <option value="">
                                    - Semua Fakultas -
                                </option>
                            </x-form.select>
                        </div>
                    </div>
                </div>

                <x-alert-simple color="green" id="__alertSuccessTable" class="alert hidden"></x-alert-simple>
                <x-alert-simple color="red" id="__alertErrorTable" class="alert hidden"></x-alert-simple>

                <div class="w-full overflow-x-auto">
                    <table class="w-full" id="study-program-table">
                        <thead>
                            <tr>
                                <th class="w-20">
                                    {{ __('ID') }}
                                </th>
                                <th>
                                    {{ __('Fakultas') }}
                                </th>
                                <th>
                                    {{ __('Nama Program Studi') }}
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


    <x-modal.modal-default id="__modalCreateStudyProgram" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Tambah Data') }}
            </x-modal.title>
            <x-modal.close-button id="__btnCloseModalCreateStudyProgram" />
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalCreateStudyProgram" class="alert hidden"></x-alert-simple>

            <form action="{{ route('kampus.prodi.store') }}" method="post" id="__formCreateStudyProgram">
                @csrf

                <x-form-group>
                    <x-form-label for="__faculty_idCreateStudyProgram" isRequired="true">
                        Fakultas
                    </x-form-label>
                    <x-form.select name="faculty_id" id="__faculty_idCreateStudyProgram" class="select-faculty" style="width: 100%">
                        <option value="">
                            - Pilih Fakultas -
                        </option>
                    </x-form.select>
                </x-form-group>
                <x-form-group>
                    <x-form-label for="__nameCreateStudyProgram" isRequired="true">
                        Nama Program Studi
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameCreateStudyProgram" autocomplete="off" />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelCreateStudyProgram">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitCreateStudyProgram">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-default>


    <x-modal.modal-default id="__modalEditStudyProgram" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Edit Data') }}
            </x-modal.title>
            <x-modal.close-button id="__btnCloseModalEditStudyProgram" />
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalEditStudyProgram" class="alert hidden"></x-alert-simple>

            <form action="{{ route('kampus.prodi.update') }}" method="post" id="__formEditStudyProgram">
                @csrf

                <input type="hidden" name="id" id="__idEditStudyProgram">

                <x-form-group>
                    <x-form-label for="__faculty_idEditStudyProgram" isRequired="true">
                        Fakultas
                    </x-form-label>
                    <x-form.select name="faculty_id" id="__faculty_idEditStudyProgram" class="select-faculty" style="width: 100%">
                        <option value="">
                            - Pilih Fakultas -
                        </option>
                    </x-form.select>
                </x-form-group>
                <x-form-group>
                    <x-form-label for="__nameEditStudyProgram" isRequired="true">
                        Nama Program Studi
                    </x-form-label>
                    <x-input-text type="text" name="name" id="__nameEditStudyProgram" autocomplete="off" />
                </x-form-group>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelEditStudyProgram">
                        {{ __('Batal') }}
                    </x-button>
                    <x-button type="submit" color="primary" id="__btnSubmitEditStudyProgram">
                        {{ __('Simpan Data') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-default>


    <x-modal.modal-sm id="__modalDeleteStudyProgram" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Edit Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorModalDeleteStudyProgram" class="alert hidden"></x-alert-simple>

            <form action="{{ route('kampus.prodi.destroy') }}" method="post" id="__formDeleteStudyProgram">
                @csrf

                <input type="hidden" name="id" id="__idDeleteStudyProgram">

                <p class="mb-5 text-center">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>

                <div class="text-center">
                    <x-button type="reset" color="gray" id="__btnCancelDeleteStudyProgram">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnSubmitDeleteStudyProgram">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        const datatableUrl = '{{ route('kampus.prodi.datatable') }}';
        const facultySelectTwoUrl = '{{ route('kampus.fakultas.select') }}';
        const studyProgramShowUrl = '{{ route('kampus.prodi.show') }}';


        var facultyId = 0;


        $('.select-faculty').select2({
            width: 'resolve',
            ajax: {
                type: 'GET',
                url: facultySelectTwoUrl,
                data: function(params) {
                    return {
                        page: params.page || 1,
                        search: params.term
                    };
                },
                delay: 500
            }
        });


        $('#__faculty_idFilter').on('change', function() {
            facultyId = $(this).val();

            loadStudyProgramTable(facultyId);
        });


        const loadStudyProgramTable = (facultyId = 0) => {
            $('#study-program-table').DataTable({
                bDestroy: true,
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    type: 'GET',
                    url: datatableUrl,
                    data: {
                        facultyId: facultyId
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'faculty_name' },
                    { data: 'name' },
                    { data: 'action', orderable: false },
                ],
                columnDefs: [
                    { targets: [0, 3], className: 'text-center' }
                ]
            });
        }


        loadStudyProgramTable();


        $('#__btnCreateStudyProgram').on('click', function() {
            $('#__modalCreateStudyProgram').removeClass('hidden');
            $('body').addClass('modal-open');
        });


        $('#__btnCloseModalCreateStudyProgram').on('click', function() {
            $('#__modalCreateStudyProgram').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelCreateStudyProgram').on('click', function() {
            $('#__modalCreateStudyProgram').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formCreateStudyProgram').on('submit', function(event) {
            event.preventDefault();

            const storeUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);
            facultyId = formData.get('faculty_id');

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelCreateStudyProgram').attr('disabled', true);
            $('#__btnSubmitCreateStudyProgram').attr('disabled', true).html('Menyimpan...');

            axios.post(storeUrl, formData)
                .then(response => {
                    let responseData = response.data;
                    let facultyId = (responseData.data.faculty !== null) ? responseData.data.faculty.id : 0;
                    let facultyName = (responseData.data.faculty !== null) ? responseData.data.faculty.name : '- Pilih Fakultas -';

                    $('#__modalCreateStudyProgram').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelCreateStudyProgram').attr('disabled', false);
                    $('#__btnSubmitCreateStudyProgram').attr('disabled', false).html('Simpan Data');

                    loadStudyProgramTable(facultyId);

                    $(this)[0].reset();
                    $('#__faculty_idCreateStudyProgram').val('').trigger('change');

                    $('#__faculty_idFilter').append(
                        $('<option/>', {
                            value: facultyId,
                            html: facultyName,
                            selected: true
                        })
                    );
                    $('#__faculty_idFilter').trigger('change');

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalCreateStudyProgram').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalCreateStudyProgram').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalCreateStudyProgram').html(responseData.message);

                    }

                    $('#__btnCancelCreateStudyProgram').attr('disabled', false);
                    $('#__btnSubmitCreateStudyProgram').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const editStudyProgram = (el) => {
            let studyProgamId = el.getAttribute('data-id');

            $('.alert').addClass('hidden').html(null);

            axios.get(`${studyProgramShowUrl}?id=${studyProgamId}`)
                .then(response => {
                    let responseData = response.data;
                    let facultyId = (responseData.data.faculty !== null) ? responseData.data.faculty.id : 0;
                    let facultyName = (responseData.data.faculty !== null) ? responseData.data.faculty.name : '- Pilih Fakultas -';

                    $('#__idEditStudyProgram').val(responseData.data.id);

                    $('#__faculty_idEditStudyProgram').val('').trigger('change');
                    $('#__faculty_idEditStudyProgram').append(
                        $('<option/>', {
                            value: facultyId,
                            html: facultyName,
                            selected: true
                        })
                    );
                    $('#__faculty_idEditStudyProgram').trigger('change');

                    $('#__nameEditStudyProgram').val(responseData.data.name);

                    $('#__modalEditStudyProgram').removeClass('hidden');
                    $('body').addClass('modal-open');
                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorTable').removeClass('hidden').html(null);
                    $('#__alertErrorTable').html(responseData.message);
                });
        }


        $('#__btnCloseModalEditStudyProgram').on('click', function() {
            $('#__modalEditStudyProgram').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__btnCancelEditStudyProgram').on('click', function() {
            $('#__modalEditStudyProgram').addClass('hidden');
            $('body').removeClass('modal-open');

            $('.alert').addClass('hidden').html(null);
        });


        $('#__formEditStudyProgram').on('submit', function(event) {
            event.preventDefault();

            const updateUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);
            facultyId = formData.get('faculty_id');

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelEditStudyProgram').attr('disabled', true);
            $('#__btnSubmitEditStudyProgram').attr('disabled', true).html('Menyimpan...');

            axios.post(updateUrl, formData)
                .then(response => {
                    let responseData = response.data;
                    let facultyId = (responseData.data.faculty !== null) ? responseData.data.faculty.id : 0;
                    let facultyName = (responseData.data.faculty !== null) ? responseData.data.faculty.name : '- Pilih Fakultas -';

                    $('#__modalEditStudyProgram').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelEditStudyProgram').attr('disabled', false);
                    $('#__btnSubmitEditStudyProgram').attr('disabled', false).html('Simpan Data');

                    loadStudyProgramTable(facultyId);

                    $(this)[0].reset();
                    $('#__faculty_idEditStudyProgram').val('').trigger('change');

                    $('#__faculty_idFilter').append(
                        $('<option/>', {
                            value: facultyId,
                            html: facultyName,
                            selected: true
                        })
                    );
                    $('#__faculty_idFilter').trigger('change');

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalEditStudyProgram').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalEditStudyProgram').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalEditStudyProgram').html(responseData.message);

                    }

                    $('#__btnCancelEditStudyProgram').attr('disabled', false);
                    $('#__btnSubmitEditStudyProgram').attr('disabled', false).html('Simpan Data');

                });

            return false;
        });


        const deleteStudyProgram = (el) => {
            let id = el.getAttribute('data-id');

            $('#__idDeleteStudyProgram').val(id);

            $('#__modalDeleteStudyProgram').removeClass('hidden');
            $('body').addClass('modal-open');
        }


        $('#__btnCancelDeleteStudyProgram').on('click', function() {
            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteStudyProgram').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formDeleteStudyProgram').on('submit', function(event) {
            event.preventDefault();

            const deleteUrl = $(this).attr('action');
            const formData = new FormData($(this)[0]);

            $('.alert').addClass('hidden').html(null);

            $('#__btnCancelDeleteStudyProgram').attr('disabled', true);
            $('#__btnSubmitDeleteStudyProgram').attr('disabled', true).html('Menghapus...');

            axios.post(deleteUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    $('#__modalDeleteStudyProgram').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__btnCancelDeleteStudyProgram').attr('disabled', false);
                    $('#__btnSubmitDeleteStudyProgram').attr('disabled', false).html('Ya, Hapus');

                    loadStudyProgramTable(facultyId);

                    $(this)[0].reset();

                    $('#__alertSuccessTable').removeClass('hidden');
                    $('#__alertSuccessTable').html(responseData.message);

                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorModalDeleteStudyProgram').removeClass('hidden');

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorModalDeleteStudyProgram').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorModalDeleteStudyProgram').html(responseData.message);

                    }

                    $('#__btnCancelDeleteStudyProgram').attr('disabled', false);
                    $('#__btnSubmitDeleteStudyProgram').attr('disabled', false).html('Ya, Hapus');

                });

            return false;
        });
    </script>
@endpush