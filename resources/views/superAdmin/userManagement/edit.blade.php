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
            <h3 class="card-title">Ubah User : {{ $user->name }}</h3>
        </div>
        <form action="{{ route('super-admin.user-management.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('layouts.alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-adminlte-select name="role_id" label="Role" data-placeholder="Pilih Role" required enable-old-support selected="{{ $user->role_id }}">
                                <x-adminlte-options :options="$roles->pluck('name', 'id')->toArray()" :selected="$user->role_id"/>
                            </x-adminlte-select>
                        </div>
                        <div class="form-group" id="branch_field">
                            <x-adminlte-select name="branch_id" label="Cabang" data-placeholder="Pilih Cabang" required enable-old-support>
                                <x-adminlte-options :options="$branches->pluck('name', 'id')->toArray()"/>
                            </x-adminlte-select>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Nama" name="name" value="{{ $user->name }}" required enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Email" name="email" type="email" value="{{ $user->email }}" required enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Password" name="password" type="password" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input label="Konfirmasi Password" name="password_confirmation" type="password" />
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
        $(document).ready(function(){
            if($('#role_id').val() === "1" || $('#role_id').val() === "2") {
                $('#branch_field').hide();
            } else {
                $('#branch_field').show();
            }
            $('#role_id').on('change', function() {
                if(this.value === "1" || this.value === "2") {
                    $('#branch_field').hide();
                } else {
                    $('#branch_field').show();
                }
            });
        });
    </script>
@stop