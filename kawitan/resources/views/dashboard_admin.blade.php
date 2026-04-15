<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard EcoPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Dashboard Admin')
    @section('keteranganheader', 'Dashboard Admin')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">
        <div class="container-fluid">

            <div class="d-flex justify-content-end mb-2">
                <form method="GET">
                    <select name="tahun" class="form-select form-select-sm shadow-sm border-0"
                        style="width: 90px; border-radius: 10px;" onchange="this.form.submit()">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </form>
            </div>

            <div class="row g-4 mb-3">

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Pengguna</h6>
                            <div class="card-value">{{ $totalUser }}</div>
                        </div>
                        <div class="icon-box icon-user">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>CO₂ Hemat</h6>
                            <div class="card-value">{{ $co2 }} kg</div>
                        </div>
                        <div class="icon-box icon-co2">
                            <i class="bi bi-tree-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Air Hemat</h6>
                            <div class="card-value">{{ $air }} L</div>
                        </div>
                        <div class="icon-box icon-water">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Energi Hemat</h6>
                            <div class="card-value">{{ $energi }} kWh</div>
                        </div>
                        <div class="icon-box icon-energy">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row g-4">

                <div class="col-md-8">
                    <div class="card-dashboard p-3 h-100">
                        <h6>Tren Setoran Sampah</h6>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-dashboard p-3 h-100">
                        <h6>Sampah Terbanyak</h6>

                        <canvas id="donutChart" style="max-height: 250px;"></canvas>

                        <div class="mt-3 text-start">
                            @foreach ($donutLabels as $index => $label)
                                <div class="d-flex align-items-center mb-1">
                                    <div style="width: 12px; height: 12px; 
                                            background-color: 
                                            {{ ['#2f80ed', '#8d6e63', '#f2c94c', '#27ae60'][$index] }};
                                            border-radius: 3px; margin-right: 8px;">
                                    </div>
                                    <small>{{ $label }}</small>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        const lineChart = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total (kg)',
                    data: @json($lineChart),
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39,174,96,0.15)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function (value) {
                                return value + ' kg';
                            }
                        }
                    }
                }
            }
        });

        const donutChart = new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: @json($donutLabels),
                datasets: [{
                    data: @json($donutValues),
                    backgroundColor: ['#2f80ed', '#8d6e63', '#f2c94c', '#27ae60']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return label + ': ' + value + ' kg';
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>