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
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">List Data Cabang</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{route('super-admin.branch.create')}}" class="btn btn-primary">
                                <i class="fas fa-fw fa-plus"></i> Tambah Cabang
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.alert')
                    <div id="" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="customer-table" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>ALAMAT</th>
                                            <th>KOTA</th>
                                            <th>PROVINSI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branchs as $branch)
                                            <tr>
                                                <td></td>
                                                <td>{{ $branch->code }}</td>
                                                <td>{{ $branch->name }}</td>
                                                <td>{{ $branch->address }}</td>
                                                <td>{{ $branch->city }}</td>
                                                <td>{{ $branch->province }}</td>
                                                <td>
                                                    <a href="{{ route('super-admin.branch.edit', $branch->id) }}" class="btn btn-warning" title="Ubah Data Cabang">
                                                        <i class="fas fa-fw fa-edit"></i> Ubah
                                                    </a>
                                                    <form action="{{route('super-admin.branch.destroy', $branch->id)}}" method="post" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$branch->id}}" title="Hapus Data Cabang">
                                                            <i class="fas fa-fw fa-trash"></i> Hapus
                                                        </button>

                                                        <!-- Modal Delete Confirmation -->
                                                        <div class="modal fade" id="deleteModal{{$branch->id}}" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h4>Apakah anda yakin akan menghapus Cabang ini?</h4>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-danger waves-effect waves-light">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->
                                                    </form>
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