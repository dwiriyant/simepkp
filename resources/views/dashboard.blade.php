@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row" style="margin-bottom: -30px">
        <div class="col-md-12 col-lg-12 col-xl-10">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xl-2">
                        <h1 class="">Dashboard</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="month" class="col-md-3 col-lg-3 col-xl-2 col-form-label">Bulan</label>
                            <div class="col-md-9 col-lg-9 col-xl-10">
                                <x-adminlte-input name="month" type="month" min="2021-01" max="{{ date('Y-m', strtotime('first day of last month')) }}" value="{{ $month }}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="month-end" class="col-md-4 col-lg-4 col-xl-3 col-form-label">Cabang</label>
                            <div class="col-md-8 col-lg-8 col-xl-9">
                                <x-adminlte-select name="branch_id" data-placeholder="Pilih kantor cabang" selected="{{ $filter_branch }}">
                                    <x-adminlte-options :options="$branches->pluck('code', 'id')->toArray()" :selected="$filter_branch"/>
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="sumbit" class="btn btn-primary">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-2">
            @can('isSuperAdmin')
            <button type="button" class=" btn btn-warning " data-toggle="modal" data-target="#uploadModal">
                <i class="fa fa-upload"></i>Upload
            </button>
            @endcan
            <button type="button" class="btn btn-success float-lg-right" onclick="window.print();">
                <i class="fa fa-print"></i> Export
            </button>
        </div>
        
    </div>
@stop

@section('content')
@include('layouts.alert')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h4 class="mb-2"><b>{{ $last ? number_format($last->outstanding_kredit, 2, ',', '.') : 0 }}</b></h4>
                    <p class="mb-0" style="font-size: 14px">Outstanding (Rp.)</p>
                    <p class="mb-0" style="font-size: 14px"><b>{{ $last ? number_format($growth['outstanding_kredit'], 2, ',', '.') : 0 }}</b></p>
                    <p class="mb-0" style="font-size: 14px">Growth (yoy)</p>
                    <p class="m-0" style="font-size: 20px;font-weight:600;">Kredit yang diberikan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-line mt-4"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4 class="mb-2"><b>{{ $last ? number_format($last->kredit_produktif, 2, ',', '.') : 0 }}</b></h4>
                    <p class="mb-0" style="font-size: 14px">Outstanding (Rp.)</p>
                    <p class="mb-0" style="font-size: 14px"><b>{{ $last ? number_format($growth['kredit_produktif'], 2, ',', '.') : 0 }}</b></p>
                    <p class="mb-0" style="font-size: 14px">Growth (yoy)</p>
                    <p class="m-0" style="font-size: 20px;font-weight:600;">Kredit Produktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-bar mt-4"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h4 class="mb-2"><b>{{ $last ? number_format($last->baki_debet_npl, 2, ',', '.') : 0 }}</b></h4>
                    <p class="mb-0" style="font-size: 14px">Outstanding (Rp.)</p>
                    <p class="mb-0" style="font-size: 14px"><b>{{ $last ? number_format($growth['baki_debet_npl'], 2, ',', '.') : 0 }}</b></p>
                    <p class="mb-0" style="font-size: 14px">Growth (yoy)</p>
                    <p class="m-0" style="font-size: 20px;font-weight:600;">Baki Debet NPL Produktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie mt-4"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4 class="mb-2"><b>{{ $last ? number_format($last->non_performing_loan, 2, ',', '.') : 0 }}</b></h4>
                    <p class="mb-0" style="font-size: 14px">Outstanding (%)</p>
                    <p class="mb-0" style="font-size: 14px"><b>{{ $last ? number_format($growth['non_performing_loan'], 2, ',', '.') : 0 }}</b></p>
                    <p class="mb-0" style="font-size: 14px">Growth (yoy)</p>
                    <p class="m-0" style="font-size: 20px;font-weight:600;">NPL Kredit Produktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-line mt-4"></i>
                </div>
                <a href="#" class="small-box-footer"></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <canvas id="kredit-diberikan" width="400" height="550"></canvas>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <canvas id="kredit-produktif" width="400" height="550"></canvas>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <canvas id="npl-baki" width="400" height="550"></canvas>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
            <canvas id="npl-kredit" width="400" height="550"></canvas>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="uploadModalLabel">Upload Data Dashboard</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('super-admin.dashboard.upload')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-select name="branch_id" label="Kantor Cabang" data-placeholder="Pilih kantor cabang">
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->code }}</option>
                                @endforeach
                            </x-adminlte-select>
                            
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

@section('footer', true)

@section('plugins.Chartjs', true)

@section('plugins.BsCustomFileInput', true)

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>

        var SI_SYMBOL = ["", "K", "M", "B", "T"];

        function abbreviateNumber(number){
            var tier = Math.log10(Math.abs(number)) / 3 | 0;
            if(tier == 0) return number;
            var suffix = SI_SYMBOL[tier];
            var scale = Math.pow(10, tier * 3);
            var scaled = number / scale;

            return scaled.toFixed(1) + suffix;
        }
        const chat1 = new Chart(document.getElementById('kredit-diberikan').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! $label !!},
                datasets: [{
                    label: 'Kredit yang diberikan 6 Bulan Terakhir',
                    data: {{ $outstanding_kredit }},
                    fill: false,
                    backgroundColor: 'chocolate',
                    borderColor: 'chocolate',
                    tension: 0.1
                }]
            },
            options: {
                legend: {
                    labels: {
                        boxWidth: 0,
                    },
                    onClick: (e) => e.stopPropagation()
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, values) {
                                return abbreviateNumber(value)
                            }
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    }
                }
            },
        });
        const chat2 = new Chart(document.getElementById('kredit-produktif').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! $label !!},
                datasets: [{
                    label: 'Kredit Produktif 6 Bulan Terakhir',
                    data: {{ $kredit_produktif }},
                    fill: false,
                    backgroundColor: 'cadetblue',
                    borderColor: 'cadetblue',
                    tension: 0.1
                }]
            },
            options: {
                legend: {
                    labels: {
                        boxWidth: 0,
                    },
                    onClick: (e) => e.stopPropagation()
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, values) {
                                return abbreviateNumber(value)
                            }
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    }
                }
            },
        });
        const chat3 = new Chart(document.getElementById('npl-baki').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! $label !!},
                datasets: [{
                    label: 'Baki Debet NPL Produktif 6 Bulan Terakhir',
                    data: {{ $baki_debet_npl }},
                    fill: false,
                    backgroundColor: 'darkred',
                    borderColor: 'darkred',
                    tension: 0.1
                }]
            },
            options: {
                legend: {
                    labels: {
                        boxWidth: 0,
                    },
                    onClick: (e) => e.stopPropagation()
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, values) {
                                return abbreviateNumber(value)
                            }
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                            });
                        }
                    }
                }
            },
        });
        const chat4 = new Chart(document.getElementById('npl-kredit').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! $label !!},
                datasets: [{
                    label: 'NPL Kredit Produktif 6 Bulan Terakhir',
                    data: {{ $non_performing_loan }},
                    fill: false,
                    backgroundColor: 'blue',
                    borderColor: 'blue',
                    tension: 0.1
                }]
            },
            options: {
                legend: {
                    labels: {
                        boxWidth: 0,
                    },
                    onClick: (e) => e.stopPropagation()
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                },
            }
        });
    </script>
@stop