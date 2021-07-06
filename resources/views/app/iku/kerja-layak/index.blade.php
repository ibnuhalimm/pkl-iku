@extends('layout.app')

@section('title')
    {{ __('Data Mahasiswa') }}
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
                {{ __('Data Mahasiswa') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-5">
                <div class="mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                        <div class="sm:col-span-2">
                            <x-button-link href="{{ route('iku.kerja-layak.create') }}" color="primary">
                                <i class="fas fa-plus"></i>
                                <span class="ml-1">
                                    {{ __('Tambah Data') }}
                                </span>
                            </x-button-link>
                        </div>
                        <div class="sm:col-span-4">
                            <div class="grid grid-cols-5 sm:grid-cols-6 gap-4">
                                <div class="col-span-3 sm:col-span-2">
                                    <x-form.input-text type="number" id="__yearFilterTable" placeholder="Tahun Masuk Kerja" value="{{ date('Y') }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-button type="submit" color="green" id="__btnFilter" class="w-full inline-flex items-center justify-center">
                                        <span>
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <span class="ml-2">Lihat Data</span>
                                    </x-button>
                                </div>
                                <div class="col-span-5  sm:col-span-2">
                                    <x-button type="button" color="yellow" id="__btnExportExcel" class="w-full inline-flex items-center justify-center">
                                        <span>
                                            <i class="fas fa-file-excel"></i>
                                        </span>
                                        <span class="ml-2">Export Excel</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-alert-simple color="green" id="__alertSuccessTable" class="alert hidden"></x-alert-simple>

                <div class="w-full overflow-x-auto">
                    <table class="w-full" id="kerja-layak-table">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="w-20 px-2 py-4 text-white">
                                    {{ __('No') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Tgl Masuk Kerja') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Nama') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Nama Perusahaan') }}
                                </th>
                                <th class="w-20 px-2 py-4 text-white">
                                    {{ __('###') }}
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </x-card.body>
    </x-card.card-default>


    {{-- <x-modal.modal-sm id="__modalDeleteMahasiswa" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Hapus Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorDeleteMahasiswa" class="alert hidden" />

            <form action="{{ route('iku.kerja-layak.destroy') }}" id="__formDeleteMahasiswa">
                @csrf
                <input type="hidden" name="id" id="__idDeleteMahasiswa">

                <p class="text-center mb-5">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>
                <div class="text-center">
                    <x-button type="button" color="gray" id="__btnNoDeleteMahasiswaModal">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnYesDeleteMahasiswaModal">
                        {{ __('Ya, Hapus') }}
                    </x-button>
                </div>
            </form>

        </x-modal.body>
    </x-modal.modal-sm> --}}

@endsection


@push('bottom_js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('js/datatable.config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        const datatableUrl = '{{ route('iku.kerja-layak.datatable') }}';
        const exportExcelUrl = '{{ route('iku.kerja-layak.export-excel') }}';
        const deleteUrl = '{{ route('iku.kerja-layak.destroy') }}';

        var filterTahun = {{ date('Y') }};


        $(window).on('load', function() {
            $('#__yearFilterTable').val(filterTahun);
        });


        const loadKerjaLayakTable = (year = 0) => {
            $('#kerja-layak-table').DataTable({
                bDestroy: true,
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: {
                    type: 'GET',
                    url: datatableUrl,
                    data: {
                        year: year
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', orderable: false },
                    { data: 'date_start_work' },
                    { data: 'student_name' },
                    { data: 'company_name' },
                    { data: 'action', orderable: false },
                ],
                columnDefs: [
                    { targets: [0, 4], className: 'text-center' }
                ],
                orders: [
                    [ 1, 'desc' ]
                ]
            });
        }


        loadKerjaLayakTable(filterTahun);


        $('#__btnFilter').on('click', function() {
            filterTahun = $('#__yearFilterTable').val();

            loadKerjaLayakTable(filterTahun);
        });


        $('#__btnExportExcel').on('click', function() {
            window.location.href = `${exportExcelUrl}?year=${filterTahun}`;
        });


        const deleteMahasiswa = (el) => {
            let id = el.getAttribute('data-id');

            $('#__idDeleteMahasiswa').val(id);

            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteMahasiswa').removeClass('hidden');
            $('body').addClass('modal-open');
        }


        $('#__btnNoDeleteMahasiswaModal').on('click', function() {
            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteMahasiswa').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formDeleteMahasiswa').on('submit', function(event) {
            event.preventDefault();

            let formData = new FormData($(this)[0]);

            $('#__btnNoDeleteMahasiswaModal').attr('disabled', true);
            $('#__btnYesDeleteMahasiswaModal').attr('disabled', true).html('Menghapus...');

            $('.alert').addClass('hidden').html(null);

            axios.post(deleteUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    // mahasiswaTable.ajax.reload(null, false);

                    $('#__modalDeleteMahasiswa').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__alertSuccessTable').removeClass('hidden').html(responseData.message);
                    $('html, body').animate({ scrollTop: 0 }, 'slow');

                    $('#__btnNoDeleteMahasiswaModal').attr('disabled', false);
                    $('#__btnYesDeleteMahasiswaModal').attr('disabled', false).html('Ya, Hapus');
                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorDeleteMahasiswa').removeClass('hidden').html(null);

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorDeleteMahasiswa').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorDeleteMahasiswa').html(responseData.message);

                    }

                    $('#__btnNoDeleteMahasiswaModal').attr('disabled', false);
                    $('#__btnYesDeleteMahasiswaModal').attr('disabled', false).html('Ya, Hapus');
                });

            return false;
        });
    </script>
@endpush