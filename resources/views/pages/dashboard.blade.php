@extends('layouts.app')

@section('title', 'Analitik Pengunjung')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Analitik Pengunjung</li>
@endsection

@section('content')
<section id="visitor-analytics-dashboard">
    <div class="row match-height">
        @forelse($browserCards as $browser)
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card visitor-analytic-card border-0 shadow-sm">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-stretch">
                                <div class="visitor-analytic-icon bg-{{ $browser['color'] }}">
                                    <i class="fa {{ $browser['icon'] }}"></i>
                                </div>
                                <div class="visitor-analytic-copy">
                                    <span class="visitor-analytic-label">{{ strtoupper($browser['label']) }}</span>
                                    <h2 class="font-weight-bolder mb-25">{{ number_format($browser['visitors']) }}</h2>
                                    <p class="mb-0 text-muted">{{ number_format($browser['page_views']) }} page views</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light-primary mb-2">
                    Belum ada data visitor yang terekam. Dashboard ini akan mulai terisi setelah guest mengakses halaman publik.
                </div>
            </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start">
                    <h4 class="card-title mb-25">Pengunjung Bulan Ini</h4>
                    <p class="text-muted mb-0">{{ $periodLabel }} · {{ $summary['change_label'] }}</p>
                </div>
                <div class="card-content">
                    <div class="card-body pt-0">
                        <div id="visitor-trend-chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card mini-stat-card border-left-primary">
                        <div class="card-body">
                            <span class="text-uppercase text-muted small">Pengunjung Bulan Ini</span>
                            <h2 class="font-weight-bolder mb-25">{{ number_format($summary['current_visitors']) }}</h2>
                            <small class="text-muted">Unique guest visitor</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card mini-stat-card border-left-danger">
                        <div class="card-body">
                            <span class="text-uppercase text-muted small">Pengunjung Bulan Lalu</span>
                            <h2 class="font-weight-bolder mb-25">{{ number_format($summary['previous_visitors']) }}</h2>
                            <small class="text-muted">Sebagai pembanding</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card mini-stat-card border-left-success">
                        <div class="card-body">
                            <span class="text-uppercase text-muted small">Page Views Bulan Ini</span>
                            <h2 class="font-weight-bolder mb-25">{{ number_format($summary['current_page_views']) }}</h2>
                            <small class="text-muted">Total tampilan halaman publik</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card mini-stat-card border-left-warning">
                        <div class="card-body">
                            <span class="text-uppercase text-muted small">Bot Traffic Bulan Ini</span>
                            <h2 class="font-weight-bolder mb-25">{{ number_format($summary['current_bots']) }}</h2>
                            <small class="text-muted">Crawler yang ikut terekam</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Distribusi Browser</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="browser-breakdown-chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Distribusi Sistem Operasi</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="os-breakdown-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Browser</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Browser</th>
                                    <th>Visitor</th>
                                    <th>Page Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($browserBreakdown as $browser)
                                    <tr>
                                        <td>
                                            <span class="badge badge-light-{{ $browser['color'] }} mr-50">
                                                <i class="fa {{ $browser['icon'] }}"></i>
                                            </span>
                                            {{ $browser['label'] }}
                                        </td>
                                        <td>{{ number_format($browser['visitors']) }}</td>
                                        <td>{{ number_format($browser['page_views']) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-2">Belum ada data browser.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Sistem Operasi</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>OS</th>
                                    <th>Visitor</th>
                                    <th>Page Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($osBreakdown as $os)
                                    <tr>
                                        <td>
                                            <span class="badge badge-light-{{ $os['color'] }} mr-50">
                                                <i class="fa {{ $os['icon'] }}"></i>
                                            </span>
                                            {{ $os['label'] }}
                                        </td>
                                        <td>{{ number_format($os['visitors']) }}</td>
                                        <td>{{ number_format($os['page_views']) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-2">Belum ada data sistem operasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/charts/apexcharts.css') }}">
    <style>
        .visitor-analytic-card {
            overflow: hidden;
        }

        .visitor-analytic-icon {
            width: 92px;
            min-width: 92px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
        }

        .visitor-analytic-copy {
            padding: 1rem 1.25rem;
            width: 100%;
        }

        .visitor-analytic-label {
            display: inline-block;
            font-size: .75rem;
            letter-spacing: .08em;
            color: #4b4b4b;
            margin-bottom: .35rem;
        }

        .mini-stat-card {
            border-left: 4px solid transparent;
            box-shadow: 0 10px 25px rgba(34, 41, 47, .06);
        }

        .border-left-primary {
            border-left-color: #7367f0;
        }

        .border-left-danger {
            border-left-color: #ea5455;
        }

        .border-left-success {
            border-left-color: #28c76f;
        }

        .border-left-warning {
            border-left-color: #ff9f43;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const browserLabels = @json(collect($browserBreakdown)->pluck('label')->all());
            const browserSeries = @json(collect($browserBreakdown)->pluck('visitors')->all());
            const osLabels = @json(collect($osBreakdown)->pluck('label')->all());
            const osSeries = @json(collect($osBreakdown)->pluck('visitors')->all());
            const trendLabels = @json($dailyTrend['labels']);
            const trendVisitors = @json($dailyTrend['visitors']);
            const trendPageViews = @json($dailyTrend['page_views']);

            const trendChartElement = document.querySelector('#visitor-trend-chart');
            const browserChartElement = document.querySelector('#browser-breakdown-chart');
            const osChartElement = document.querySelector('#os-breakdown-chart');
            const browserTotal = browserSeries.reduce((total, value) => total + value, 0);
            const osTotal = osSeries.reduce((total, value) => total + value, 0);
            const trendTotal = trendVisitors.reduce((total, value) => total + value, 0);

            if (trendChartElement) {
                if (trendTotal === 0) {
                    trendChartElement.innerHTML = '<p class="text-center text-muted py-3 mb-0">Belum ada traffic guest bulan ini.</p>';
                } else {
                    new ApexCharts(trendChartElement, {
                        chart: {
                            type: 'area',
                            height: 320,
                            toolbar: { show: false }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        colors: ['#00cfe8', '#7367f0'],
                        series: [
                            {
                                name: 'Visitor',
                                data: trendVisitors
                            },
                            {
                                name: 'Page Views',
                                data: trendPageViews
                            }
                        ],
                        dataLabels: { enabled: false },
                        xaxis: {
                            categories: trendLabels
                        },
                        yaxis: {
                            labels: {
                                formatter: function (value) {
                                    return Math.round(value);
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        },
                        legend: {
                            position: 'top'
                        }
                    }).render();
                }
            }

            if (browserChartElement) {
                if (browserTotal === 0) {
                    browserChartElement.innerHTML = '<p class="text-center text-muted py-3 mb-0">Belum ada data browser bulan ini.</p>';
                } else {
                    new ApexCharts(browserChartElement, {
                        chart: {
                            type: 'bar',
                            height: 320,
                            toolbar: { show: false }
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                horizontal: true,
                                distributed: true
                            }
                        },
                        series: [{
                            name: 'Visitor',
                            data: browserSeries
                        }],
                        colors: ['#00cfe8', '#ea5455', '#28c76f', '#ff9f43', '#7367f0'],
                        dataLabels: {
                            enabled: true
                        },
                        xaxis: {
                            categories: browserLabels
                        },
                        legend: { show: false }
                    }).render();
                }
            }

            if (osChartElement) {
                if (osTotal === 0) {
                    osChartElement.innerHTML = '<p class="text-center text-muted py-3 mb-0">Belum ada data sistem operasi bulan ini.</p>';
                } else {
                    new ApexCharts(osChartElement, {
                        chart: {
                            type: 'donut',
                            height: 320
                        },
                        series: osSeries,
                        labels: osLabels,
                        colors: ['#7367f0', '#28c76f', '#ff9f43', '#00cfe8', '#ea5455', '#1e1e1e'],
                        legend: {
                            position: 'bottom'
                        },
                        dataLabels: {
                            formatter: function (value) {
                                return value.toFixed(0) + '%';
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (value) {
                                    return new Intl.NumberFormat('id-ID').format(value) + ' visitor';
                                }
                            }
                        }
                    }).render();
                }
            }
        });
    </script>
@endpush
