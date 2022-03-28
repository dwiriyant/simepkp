@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Data Nasabah</h1> --}}
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Nasabah</h3>
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
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>001</td>
                                            <td>00104110000122</td>
                                            <td>KOPPEG BANK INDONESIA MAPALUS</td>
                                            <td>5</td>
                                            <td>30/09/2016</td>
                                            <td>1.500.000.000</td>
                                            <td>
                                                <a href="{{ route(auth()->user()->Role->code.'.customer.edit') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Memo">
                                                    Ubah <i class="fas fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>001</td>
                                            <td>00104110000122</td>
                                            <td>KOPPEG BANK INDONESIA MAPALUS</td>
                                            <td>5</td>
                                            <td>30/09/2016</td>
                                            <td>1.500.000.000</td>
                                            <td>
                                                <a href="{{ route(auth()->user()->Role->code.'.customer.edit') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Memo">
                                                    Ubah <i class="fas fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>001</td>
                                            <td>00104110000122</td>
                                            <td>KOPPEG BANK INDONESIA MAPALUS</td>
                                            <td>5</td>
                                            <td>30/09/2016</td>
                                            <td>1.500.000.000</td>
                                            <td>
                                                <a href="{{ route(auth()->user()->Role->code.'.customer.edit') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Memo">
                                                    Ubah <i class="fas fa-fw fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var t = $('#customer-table').DataTable({
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'asc' ]]
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@stop