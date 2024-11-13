@section('title', 'Dashboard')
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a class="text-teal" href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('headscript')
    <!-- ChartJS -->
    <link rel="stylesheet" href="{{ asset('plugins/chart.js/Chart.min.css') }}" />
@endpush
@push('bodyscript')
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            var areaChartCanvas2 = $('#areaChart2').get(0).getContext('2d')

            var areaChartData1 = {
                labels: [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: 'Ekraf',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {{ $chartDataEkraf }}
                }]
            }

            var areaChartData2 = {
                labels: [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: 'Produk',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {{ $chartDataProduk }}
                }]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData1,
                options: areaChartOptions
            })

            new Chart(areaChartCanvas2, {
                type: 'line',
                data: areaChartData2,
                options: areaChartOptions
            })
        });
    </script>
@endpush
<div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-fuchsia elevation-1">
                    <i class="fas fa-layer-group">
                    </i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Data Ekraf</span>
                    <span class="info-box-number">
                        {{ $ekraf }} </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-indigo elevation-1">
                    <i class="fas fa-cube">
                    </i></span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        Data Produk </span>
                    <span class="info-box-number">
                        {{ $produk }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1">
                    <i class="fas fa-users">
                    </i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">
                        Data
                        Pengguna
                    </span>
                    <span class="info-box-number">
                        {{ $user }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-teal">
                <div class="card-header">
                    <h3 class="card-title">Data Ekraf Tahun {{ date('Y') }} </h3>
                </div>
                <div class="card-body">
                    <div wire:ignore.self class="chart">
                        <canvas id="areaChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-teal">
                <div class="card-header">
                    <h3 class="card-title">Data Produk Tahun {{ date('Y') }} </h3>
                </div>
                <div class="card-body">
                    <div wire:ignore.self class="chart">
                        <canvas id="areaChart2"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
