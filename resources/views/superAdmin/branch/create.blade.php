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
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Tambah Cabang Baru</h3>
        </div>
        <form action="{{ route('super-admin.branch.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('layouts.alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-adminlte-input label="KODE" name="code" required enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="NAMA" name="name" required enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="ALAMAT" name="address" required enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="KOTA" name="city" required enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="PROVINSI" name="province" required enable-old-support />
                        </div>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
    </script>
@stop