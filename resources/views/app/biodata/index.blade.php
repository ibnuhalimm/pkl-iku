@extends('layout.app')

@section('title')
    {{ __('Biodata') }}
@endsection


@push('top_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endpush


@section('content')

    <x-card.card-default>
        <x-card.header>
            <x-card.title>
                {{ __('Biodata') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-5">
                <div class="mb-6">
                    <x-button-link href="{{ route('biodata.create') }}" color="primary">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">
                            {{ __('Tambah Data') }}
                        </span>
                    </x-button-link>
                </div>

                <x-alert-simple color="green" id="__alertSuccessTable" class="alert hidden"></x-alert-simple>

                <div class="w-full overflow-x-auto">
                    <table class="w-full" id="biodata-table">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="w-20 px-2 py-4 text-white">
                                    {{ __('ID') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Foto') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Nama') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Tempat Lahir') }}
                                </th>
                                <th class="px-2 py-4 text-white">
                                    {{ __('Tgl Lahir') }}
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


    <x-modal.modal-sm id="__modalDeleteBiodata" class="hidden">
        <x-modal.header>
            <x-modal.title>
                {{ __('Hapus Data') }}
            </x-modal.title>
        </x-modal.header>
        <x-modal.body>

            <x-alert-simple color="red" id="__alertErrorDeleteBiodata" class="alert hidden" />

            <form action="{{ route('biodata.destroy') }}" id="__formDeleteBiodata">
                @csrf
                <input type="hidden" name="id" id="__idDeleteBiodata">

                <p class="text-center mb-5">
                    Apakah Anda yakin ingin menghapus data ini?
                </p>
                <div class="text-center">
                    <x-button type="button" color="gray" id="__btnNoDeleteBiodataModal">
                        {{ __('Tidak') }}
                    </x-button>
                    <x-button type="submit" color="red" id="__btnYesDeleteBiodataModal">
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
        const datatableUrl = '{{ route('biodata.datatable') }}';
        const deleteUrl = '{{ route('biodata.destroy') }}';

        var biodataTable = $('#biodata-table').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                type: 'GET',
                url: datatableUrl
            },
            columns: [
                { data: 'id' },
                { data: 'photo_url', orderable: false },
                { data: 'name' },
                { data: 'birth_place' },
                { data: 'birth_date' },
                { data: 'action', orderable: false },
            ],
            columnDefs: [
                { targets: [0, 5], className: 'text-center' }
            ]
        });


        const deleteBiodata = (el) => {
            let id = el.getAttribute('data-id');

            $('#__idDeleteBiodata').val(id);

            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteBiodata').removeClass('hidden');
            $('body').addClass('modal-open');
        }


        $('#__btnNoDeleteBiodataModal').on('click', function() {
            $('.alert').addClass('hidden').html(null);

            $('#__modalDeleteBiodata').addClass('hidden');
            $('body').removeClass('modal-open');
        });


        $('#__formDeleteBiodata').on('submit', function(event) {
            event.preventDefault();

            let formData = new FormData($(this)[0]);

            $('#__btnNoDeleteBiodataModal').attr('disabled', true);
            $('#__btnYesDeleteBiodataModal').attr('disabled', true).html('Menghapus...');

            $('.alert').addClass('hidden').html(null);

            axios.post(deleteUrl, formData)
                .then(response => {
                    let responseData = response.data;

                    biodataTable.ajax.reload(null, false);

                    $('#__modalDeleteBiodata').addClass('hidden');
                    $('body').removeClass('modal-open');

                    $('#__alertSuccessTable').removeClass('hidden').html(responseData.message);
                    $('html, body').animate({ scrollTop: 0 }, 'slow');

                    $('#__btnNoDeleteBiodataModal').attr('disabled', false);
                    $('#__btnYesDeleteBiodataModal').attr('disabled', false).html('Ya, Hapus');
                })
                .catch(({response}) => {
                    let responseData = response.data;

                    $('#__alertErrorDeleteBiodata').removeClass('hidden').html(null);

                    if (response.status == 422) {
                        let errorFields = Object.keys(responseData.errors);

                        errorFields.map(field => {
                            $('#__alertErrorDeleteBiodata').append(
                                $('<div/>', {
                                    html: responseData.errors[field][0]
                                })
                            );
                        });

                    } else {
                        $('#__alertErrorDeleteBiodata').html(responseData.message);

                    }

                    $('#__btnNoDeleteBiodataModal').attr('disabled', false);
                    $('#__btnYesDeleteBiodataModal').attr('disabled', false).html('Ya, Hapus');
                });

            return false;
        });
    </script>
@endpush