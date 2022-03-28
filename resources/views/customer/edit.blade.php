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
            <h3 class="card-title">DATA NASABAH</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">CABANG</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="001">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NO REKENING</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="00105030000081">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NO AKAD</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="01/KMK-KUK/KCU/VI/2016">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NAMA NASABAH</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="MEITY FLORONTHINA WARD">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">JANGKA WAKTU</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="36">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PLAFOND AWAL</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="140.000.000,00 				">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">JATUH TEMPO</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="01/01/2021">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ANGGSURAN BUNGA</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="610.897,00">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ANGSURAN POKOK</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="3.888.889,00">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">TOTAL ANGGSURAN</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="4.499.786,00">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">KOLEKTIBILITY</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="5">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NAMA PRODUK</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="KMK KUK">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SALDO AKHIR</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="84.444.135,00">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">TOTAL ANGGUNAN</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="-">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">DATA KUNJUNGAN</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">HASIL KUNJUNGAN</label>
                            <textarea class="form-control" rows="3" placeholder="Hasil Kunjungan.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">DOKUMEN</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">REKOMENDASI</label>
                            <textarea class="form-control" rows="3" placeholder="Hasil Kunjungan.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">KESALAHAN/PERBAIKAN ATAS REKOMENDASI</label>
                            <textarea class="form-control" rows="3" placeholder="Hasil Kunjungan.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">ACTION PLAN</label>
                            <textarea class="form-control" rows="3" placeholder="Hasil Kunjungan.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">KESALAHAN/PERBAIKAN ATAS ACTION PLAN</label>
                            <textarea class="form-control" rows="3" placeholder="Hasil Kunjungan.."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">DEADLINE</label>
                            <input class="form-control" type="date" id="formFile">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">TANGGAL PENYELESAIAN</label>
                            <input class="form-control" type="date" id="formFile">
                        </div>
                        <button type="submit" class="btn btn-primary">SEND</button>
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