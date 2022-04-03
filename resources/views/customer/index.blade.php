@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<br>
@include('layouts.alert')
    @can('isCreditCollection')
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>Dimohon untuk langsung mengisi data kunjungan per Nasabah, setelah melakukan kunjungan.</strong>
    </div>
    @endcan
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left"><b>Data Nasabah</b> </h4>
                    @can('isSuperAdmin')
                    <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#uploadModal">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                    @endcan
                </div>
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="customer-table" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>CABANG</th>
                                            <th>NO REK</th>
                                            <th>NAMA NASABAH</th>
                                            <th>KOLEKTIBILITY</th>
                                            <th>JATUH TEMPO</th>
                                            <th>BAKI DEBET</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            @php
                                                $last_visit = $customer->visit->sortByDesc('visit_at')->first();
                                                $warn = '';
                                                if($last_visit && $last_visit->status == 'new' && Gate::check('isHeadOfficeAdmin')) {
                                                    $warn = 'table-warning';
                                                }
                                                if($last_visit && $last_visit->status == 'action_approve' && Gate::check('isHeadOfficeAdmin')) {
                                                    $warn = 'table-warning';
                                                }
                                                if($last_visit && $last_visit->status == 'recommendation_validation' && Gate::check('isSupervisor')) {
                                                    $warn = 'table-warning';
                                                }
                                                if($last_visit && $last_visit->status == 'recommendation_approve' && Gate::check('isCreditCollection')) {
                                                    $warn = 'table-warning';
                                                }
                                                if($last_visit && $last_visit->status == 'input_deadline' && Gate::check('isCreditCollection')) {
                                                    $warn = 'table-warning';
                                                }
                                                if($last_visit && $last_visit->status == 'action_validation' && Gate::check('isCreditManager')) {
                                                    $warn = 'table-warning';
                                                }
                                                if($last_visit && $last_visit->status == 'action_realized' && Gate::check('isCreditManager')) {
                                                    $warn = 'table-success';
                                                }
                                                if($last_visit && $last_visit->status == 'action_realized' && Gate::check('isHeadOfficeAdmin')) {
                                                    $warn = 'table-success';
                                                }
                                                if($last_visit && $last_visit->status == 'recommendation_revision' && Gate::check('isHeadOfficeAdmin')) {
                                                    $warn = 'table-danger';
                                                }
                                                if($last_visit && $last_visit->status == 'action_revision' && Gate::check('isCreditCollection')) {
                                                    $warn = 'table-danger';
                                                }
                                            @endphp
                                            <tr class="{{$warn}}">
                                                <td></td>
                                                <td>{{ $customer->branch->code }}</td>
                                                <td>{{ $customer->no_rek }}</td>
                                                <td>{{ $customer->nama_singkat }}</td>
                                                <td>{{ $customer->kolektibility }}</td>
                                                <td>per tanggal {{ date('d', strtotime($customer->tgl_jt)) }}</td>
                                                <td>{{ number_format($customer->saldo_akhir,2,',','.') }}</td>
                                                <td>
                                                    @if ($last_visit && $last_visit->status == 'new')
                                                        Butuh Rekomendasi
                                                    @elseif($last_visit && $last_visit->status == 'recommendation_validation')
                                                        Review Rekomendasi
                                                    @elseif($last_visit && $last_visit->status == 'recommendation_revision')
                                                        Revisi Rekomendasi
                                                    @elseif($last_visit && $last_visit->status == 'recommendation_approve')
                                                        Rekomendasi Disetujui
                                                    @elseif($last_visit && $last_visit->status == 'action_validation')
                                                        Review Action Plan
                                                    @elseif($last_visit && $last_visit->status == 'action_revision')
                                                        Revisi Action Plan
                                                    @elseif($last_visit && $last_visit->status == 'action_approve')
                                                        Action Plan Disetujui
                                                    @elseif($last_visit && $last_visit->status == 'input_deadline')
                                                        Deadline Sudah Ada
                                                    @elseif($last_visit && $last_visit->status == 'action_realized')
                                                        Action Plan Sudah Dilakukan
                                                    @else
                                                        -                                                        
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route(Auth::user()->Role->code.'.customer.detail', $customer->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Nasabah">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="uploadModalLabel">Upload Data Nasabah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('super-admin.customer.upload')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">                            
                            <x-adminlte-input-file name="file" label="File Excel" placeholder="Choose a file..." accept=".xls,.xlsx,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" label="Close" theme="secondary" icon="fas fa-lg fa-times" data-dismiss="modal"/>
                    <x-adminlte-button class="btn-flat" type="submit" label="Upload" theme="success" icon="fas fa-lg fa-upload"/>
                </div>
            </form>
        </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('plugins.BsCustomFileInput', true)

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var t = $('#customer-table').DataTable({
                "scrollY":        "400px",
                "scrollCollapse": true,
                "paging":         false,
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 7, 'desc' ]]
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@stop