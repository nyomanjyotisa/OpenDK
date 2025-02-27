@extends('layouts.dashboard_template')

@section('content')
    <section class="content-header">
        <h1>
            {{ $page_title ?? 'Page Title' }}
            <small>{{ $page_description ?? '' }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">{!! $page_title !!}</li>
        </ol>
    </section>

    <section class="content container-fluid">

        @include('partials.flash_message')

        <div class="box box-primary">
            <div class="box-header with-border">
                @include('forms.btn-social', ['create_url' => route('informasi.form-dokumen.create')])
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dokumen-table">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap" style="max-width: 160px;">Aksi</th>
                                <th>Nama Dokumen</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('partials.asset_datatables')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var data = $('#dokumen-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('informasi.form-dokumen.getdata') !!}",
                columns: [{
                        data: 'aksi',
                        name: 'aksi',
                        class: 'text-center text-nowrap',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama_dokumen',
                        name: 'nama_dokumen'
                    },
                ],
                order: [
                    [1, 'desc']
                ]
            });
        });
    </script>
    @include('forms.datatable-vertical')
    @include('forms.delete-modal')
@endpush
