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
@include('layouts.alert')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">DATA NASABAH</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input label="CABANG" name="branch_id" readonly value="{{ $customer->Branch->code }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="NO REKENING" name="no_rek" readonly value="{{ $customer->no_rek }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="NO AKAD" name="no_akd" readonly value="{{ $customer->no_akd }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="NAMA SINGKAT" name="nama_singkat" readonly value="{{ $customer->nama_singkat }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="JANGKA WAKTU" name="jnk_wkt_bl" readonly value="{{ $customer->jnk_wkt_bl }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="PLAFOND AWAL" name="plafond_awal" readonly value="{{ number_format($customer->plafond_awal,2,',','.') }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="JATUH TEMPO" name="tgl_jt" readonly value="{{ $customer->tgl_jt }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input label="ANGGSURAN BUNGA" name="bunga" readonly value="{{ number_format($customer->bunga,2,',','.') }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="ANGGSURAN POKOK" name="pokok" readonly value="{{ number_format($customer->pokok,2,',','.') }}" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">TOTAL ANGGSURAN</label>
                        <input type="text" readonly class="form-control" id="exampleInputEmail1" value="{{ number_format($customer->bunga + $customer->pokok,2,',','.') }}">
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="KOLEKTIBILITY" name="kolektibility" readonly value="{{ $customer->kolektibility }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="NAMA PRODUK" name="prd_name" readonly value="{{ $customer->prd_name }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="SALDO AKHIR" name="saldo_akhir" readonly value="{{ number_format($customer->saldo_akhir,2,',','.') }}" />
                    </div>
                    <div class="form-group">
                        <x-adminlte-input label="TOTAL ANGGUNAN" name="totagunan_ydp" readonly value="{{ number_format($customer->totagunan_ydp,2,',','.') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">DATA KUNJUNGAN</h3>
        </div>
        @if ($create)
        <form action="{{ route(Auth::user()->Role->code.'.customer.store-visit', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @else
        <form action="{{ route(Auth::user()->Role->code.'.customer.update-visit', $visit->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @endif
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($create)
                            <div class="form-group">
                                <x-adminlte-textarea label="DETAIL" rows="4" name="result" enable-old-support required />
                            </div>
                            <div class="form-group">
                                <x-adminlte-input-file name="document" label="DOKUMEN" placeholder="Choose a file...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-file>
                            </div>
                            <br>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang" >
                                <i class="fas fa-fw fa-save"></i> KIRIM
                            </button>

                            <!-- Modal Delete Confirmation -->
                            <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 id="send_dialog">Pastikan data yang Anda masukkan sudah benar.</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @can('isHeadOfficeAdmin')
                                <div class="form-group">
                                    <x-adminlte-textarea label="HASIL KUNJUNGAN" rows="4" name="result" enable-old-support  readonly >
                                        {{ isset($visit) ? $visit->result : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">DOKUMEN</label>
                                    <br>
                                    <a target="_blank" href="{{asset('storage/'.$visit->document)}}">Lihat Dokumen</a>
                                </div>
                                @if ($visit->status == "new" || $visit->status == "recommendation_revision")
                                    <div class="form-group">
                                        <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support readonly>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                        </x-adminlte-textarea>
                                    </div>

                                @endif
                                
                                @if ($visit->status == "recommendation_revision" || $visit->status == "recommendation_approve")
                                <div class="form-group">
                                    <x-adminlte-select name="recommendation_status" label="APPROVAL REKOMENDASI" required enable-old-support disabled>
                                        <x-adminlte-options :options="['recommendation_approve' => 'Setujui', 'recommendation_revision' => 'Perbaiki']" :selected="$visit->status"/>
                                    </x-adminlte-select>
                                </div>
                                @endif
                                @if ($visit->status == "recommendation_revision")
                                    <div class="form-group" id="recommendation_revision" style="display: none;">
                                        <x-adminlte-textarea label="KESALAHAN/PERBAIKAN ATAS REKOMENDASI" rows="4" name="recommendation_correction" enable-old-support readonly>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation_correction : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                @endif
                                @if ($visit->status == "action_approve")
                                    <div class="form-group">
                                        <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support readonly>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                    <div class="form-group" id="recommendation_revision" style="display: none;">
                                        <x-adminlte-textarea label="KESALAHAN/PERBAIKAN ATAS REKOMENDASI" rows="4" name="recommendation_correction" enable-old-support readonly>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation_correction : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                    <x-adminlte-textarea label="ACTION PLAN" rows="4" name="action" enable-old-support readonly>
                                        {{ isset($visit->action_plan) ? $visit->action_plan->action : '' }}
                                    </x-adminlte-textarea>
                                    <div class="form-group">
                                        <x-adminlte-input label="DEADLINE" type="date" name="deadline" value="{{ isset($visit->action_plan) ? $visit->action_plan->deadline : '' }}" />
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang">
                                        <i class="fas fa-fw fa-save"></i> KIRIM
                                    </button>

                                    <!-- Modal Delete Confirmation -->
                                    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 id="send_dialog">Apakah Anda yakin akan mengirim Deadline tersebut?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($visit->status == 'new' || $visit->status == 'recommendation_revision')
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang">
                                        <i class="fas fa-fw fa-save"></i> KIRIM
                                    </button>

                                    <!-- Modal Delete Confirmation -->
                                    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 id="send_dialog">Apakah Anda yakin akan mengirim Rekomendasi tersebut?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endcan
                            @can('isSupervisor')
                                <div class="form-group">
                                    <x-adminlte-textarea label="HASIL KUNJUNGAN" rows="4" name="result" enable-old-support  readonly >
                                        {{ isset($visit) ? $visit->result : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">DOKUMEN</label>
                                    <br>
                                    <a target="_blank" href="{{asset('storage/'.$visit->document)}}">Lihat Dokumen</a>
                                </div>
                                <div class="form-group">
                                    <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support readonly>
                                        {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                @if ($visit->status == 'recommendation_validation')
                                    <div class="form-group">
                                        <x-adminlte-select name="recommendation_status" label="APPROVAL REKOMENDASI" required enable-old-support>
                                            <x-adminlte-options :options="['recommendation_approve' => 'Setujui', 'recommendation_revision' => 'Perbaiki']" :selected="$visit->status"/>
                                        </x-adminlte-select>
                                    </div>
                                    <div class="form-group" id="recommendation_revision" style="display: none;">
                                        <x-adminlte-textarea label="KESALAHAN/PERBAIKAN ATAS REKOMENDASI" rows="4" name="recommendation_correction" enable-old-support>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation_correction : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                @endif
                                
                                @if ($visit->status == 'recommendation_validation')
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang">
                                        <i class="fas fa-fw fa-save"></i> KIRIM
                                    </button>

                                    <!-- Modal Delete Confirmation -->
                                    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 id="send_dialog"></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endcan
                            @can('isCreditCollection')
                                <div class="form-group">
                                    <x-adminlte-textarea label="HASIL KUNJUNGAN" rows="4" name="result" enable-old-support  readonly >
                                        {{ isset($visit) ? $visit->result : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">DOKUMEN</label>
                                    <br>
                                    <a target="_blank" href="{{asset('storage/'.$visit->document)}}">Lihat Dokumen</a>
                                </div>
                                <div class="form-group">
                                    <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support readonly>
                                        {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                @if ($visit->status == 'recommendation_approve' || $visit->status == 'action_revision')
                                <div class="form-group">
                                    <x-adminlte-textarea label="ACTION PLAN" rows="4" name="action" enable-old-support>
                                        {{ isset($visit->action_plan) ? $visit->action_plan->action : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                @else
                                <div class="form-group">
                                    <x-adminlte-textarea label="ACTION PLAN" rows="4" name="action" enable-old-support readonly>
                                        {{ isset($visit->action_plan) ? $visit->action_plan->action : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                @endif
                                @if ($visit->status == 'action_revision')
                                    @if (isset($visit->action_plan) && $visit->action_plan->action_correction)
                                        <div class="form-group" >
                                            <x-adminlte-textarea label="KESALAHAN/PERBAIKAN ATAS ACTION PLAN" rows="4" name="action_correction" enable-old-support readonly>
                                                {{ $visit->action_plan->action_correction }}
                                            </x-adminlte-textarea>
                                        </div>
                                    @endif
                                @endif
                                @if ($visit->status == 'recommendation_approve' || $visit->status == 'action_revision')
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang">
                                        <i class="fas fa-fw fa-save"></i> KIRIM
                                    </button>

                                    <!-- Modal Delete Confirmation -->
                                    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 id="send_dialog">Apakah Anda yakin akan mengirim Action Plan tersebut?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($visit->status == 'input_deadline')
                                    <div class="form-group">
                                        <x-adminlte-input label="DEADLINE" type="date" name="deadline" value="{{ isset($visit->action_plan) ? $visit->action_plan->deadline : '' }}" readonly />
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang">
                                        <i class="fas fa-fw fa-save"></i> ACTION PLAN SUDAH DILAKUKAN
                                    </button>

                                    <!-- Modal Delete Confirmation -->
                                    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 id="send_dialog">Apakah Anda yakin Action Plan sudah dilakukan?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                    <button type="submit" name="action" value="action_realized" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endcan
                            @can('isCreditManager')
                                <div class="form-group">
                                    <x-adminlte-textarea label="HASIL KUNJUNGAN" rows="4" name="result" enable-old-support  readonly >
                                        {{ isset($visit) ? $visit->result : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">DOKUMEN</label>
                                    <br>
                                    <a target="_blank" href="{{asset('storage/'.$visit->document)}}">Lihat Dokumen</a>
                                </div>
                                <div class="form-group">
                                    <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support readonly>
                                        {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                <div class="form-group">
                                    <x-adminlte-textarea label="ACTION PLAN" rows="4" name="action" enable-old-support readonly>
                                        {{ isset($visit->action_plan) ? $visit->action_plan->action : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                @if ($visit->status == 'action_validation')
                                    <div class="form-group">
                                        <x-adminlte-select name="action_status" label="APPROVAL ACTION PLAN" required enable-old-support>
                                            <x-adminlte-options :options="['action_approve' => 'Setujui', 'action_revision' => 'Perbaiki']" :selected="$visit->status"/>
                                        </x-adminlte-select>
                                    </div>
                                    <div class="form-group" id="action_revision" style="display: none;">
                                        <x-adminlte-textarea label="KESALAHAN/PERBAIKAN ATAS ACTION PLAN" rows="4" name="action_correction" enable-old-support required>
                                            {{ isset($visit->action_plan) ? $visit->action_plan->action_correction : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendModal" title="Hapus Data Cabang">
                                        <i class="fas fa-fw fa-save"></i> KIRIM
                                    </button>

                                    <!-- Modal Delete Confirmation -->
                                    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 id="send_dialog"></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">KIRIM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($visit->status != 'action_realized')
                                    <div class="form-group">
                                        <x-adminlte-select name="action_status" label="APPROVAL ACTION PLAN" disabled enable-old-support>
                                            <x-adminlte-options :options="['action_approve' => 'Setujui', 'action_revision' => 'Perbaiki']" :selected="$visit->status"/>
                                        </x-adminlte-select>
                                    </div>
                                    <div class="form-group" id="action_revision" style="display: none;">
                                        <x-adminlte-textarea label="KESALAHAN/PERBAIKAN ATAS ACTION PLAN" rows="4" name="action_correction" enable-old-support disabled>
                                            {{ isset($visit->action_plan) ? $visit->action_plan->action_correction : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                @endif
                            @endcan
                            @canany(['isSuperAdmin', 'isBranchManager', 'isBranchOfficeAdmin'])
                                <div class="form-group">
                                    <x-adminlte-textarea label="HASIL KUNJUNGAN" rows="4" name="result" enable-old-support  readonly >
                                        {{ isset($visit) ? $visit->result : '' }}
                                    </x-adminlte-textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">DOKUMEN</label>
                                    <br>
                                    <a target="_blank" href="{{asset('storage/'.$visit->document)}}">Lihat Dokumen</a>
                                </div>
                                @if ($visit->recommendation)
                                    <div class="form-group">
                                        <x-adminlte-textarea label="REKOMENDASI" rows="4" name="recommendation" enable-old-support readonly>
                                            {{ isset($visit->recommendation) ? $visit->recommendation->recommendation : '' }}
                                        </x-adminlte-textarea>
                                    </div>
                                @endif
                                @if ($visit->action_plan)
                                    <div class="form-group">
                                        <x-adminlte-input label="DEADLINE" type="date" name="deadline" value="{{ isset($visit->action_plan) ? $visit->action_plan->deadline : '' }}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <x-adminlte-input label="TANGGAL PENYELESAIAN" type="date" name="completion_date" value="{{ isset($visit->action_plan) ? $visit->action_plan->completion_date : '' }}" readonly />
                                    </div>
                                @endif
                            @endcanany
                            @canany(['isCreditCollection', 'isHeadOfficeAdmin', 'isSupervisor', 'isCreditManager'])
                                @if ($visit->status == 'action_realized')
                                    <div class="form-group">
                                        <x-adminlte-input label="DEADLINE" type="date" name="deadline" value="{{ isset($visit->action_plan) ? $visit->action_plan->deadline : '' }}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <x-adminlte-input label="TANGGAL PENYELESAIAN" type="date" name="completion_date" value="{{ isset($visit->action_plan) ? $visit->action_plan->completion_date : '' }}" readonly />
                                    </div>
                                @endif
                            @endcanany
                        @endif
                        
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
        if ($('#recommendation_status').length) {
            if($('#recommendation_status').val() === "recommendation_approve" ) {
                $('#recommendation_revision').hide();
                $('#send_dialog').text('Apakah Anda yakin akan menyetujui Rekomendasi tersebut?');
                $('#recommendation_correction').prop('required',false);
            } else {
                $('#recommendation_revision').show();
                $('#send_dialog').text('Apakah Anda yakin akan merevisi Rekomendasi tersebut?');
                $('#recommendation_correction').prop('required',true);
            }
            $('#recommendation_status').on('change', function() {
                if(this.value == "recommendation_approve") {
                    $('#recommendation_revision').hide();
                    $('#send_dialog').text('Apakah Anda yakin akan menyetujui Rekomendasi tersebut?');
                    $('#recommendation_correction').prop('required',false);
                } else {
                    $('#recommendation_revision').show();
                    $('#send_dialog').text('Apakah Anda yakin akan merevisi Rekomendasi tersebut?');
                $('#recommendation_correction').prop('required',true);
                }
            });
        }
        if ($('#action_status').length) {
            if($('#action_status').val() === "action_approve" ) {
                $('#action_revision').hide();
                $('#send_dialog').text('Apakah Anda yakin akan menyetujui Action Plan tersebut?');
                $('#action_correction').prop('required',false);
            } else {
                $('#action_revision').show();
                $('#send_dialog').text('Apakah Anda yakin akan merevisi Action Plan tersebut?');
                $('#action_correction').prop('required',true);
            }
            $('#action_status').on('change', function() {
                if(this.value == "action_approve") {
                    $('#action_revision').hide();
                    $('#send_dialog').text('Apakah Anda yakin akan menyetujui Action Plan tersebut?');
                    $('#action_correction').prop('required',false);
                } else {
                    $('#action_revision').show();
                    $('#send_dialog').text('Apakah Anda yakin akan merevisi Action Plan tersebut?');
                    $('#action_correction').prop('required',true);
                }
            });
        }
        
    </script>
@stop