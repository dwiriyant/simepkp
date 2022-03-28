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
            <h3 class="card-title">Ubah Kata Sandi</h3>
        </div>
        <form action="{{ route('change-password.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('layouts.alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-adminlte-input label="Nama" name="name" value="{{ Auth::user()->name }}" disabled/>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Email" name="email" value="{{ Auth::user()->email }}" disabled/>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Password" name="password" type="password" required />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Konfirmasi Password" name="password_confirmation" type="password" required />
                        </div>
                        <button type="submit" class="btn btn-primary">UBAH</button>
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