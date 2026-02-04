<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard EcoPoint</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS Project -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Dashboard')
    @section('keteranganheader', 'Dashboard')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">
        <div class="container-fluid">

            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Pengguna</h6>
                            <div class="card-value">25 Pengguna</div>
                        </div>
                        <div class="icon-box icon-user">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>CO₂ yang dihemat</h6>
                            <div class="card-value">100 kg CO₂</div>
                        </div>
                        <div class="icon-box icon-co2">
                            <i class="bi bi-tree-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Air yang dihemat</h6>
                            <div class="card-value">1.000 L</div>
                        </div>
                        <div class="icon-box icon-water">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-dashboard d-flex justify-content-between align-items-center">
                        <div>
                            <h6>kWh yang dihemat</h6>
                            <div class="card-value">2.5 kWh</div>
                        </div>
                        <div class="icon-box icon-energy">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 chart-row">
    <div class="col-md-8">
        <div class="card-dashboard chart-card">
            <div class="chart-title">Tren Setoran Sampah</div>
            <div class="chart-subtitle">
                Tren bulanan setoran sampah oleh penyetor (Kg).
            </div>
            <div class="chart-wrapper">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dashboard chart-card">
            <div class="chart-title">Sampah Terbanyak</div>
            <div class="chart-subtitle">
                Grafik sampah terbanyak 4 tertinggi.
            </div>
            <div class="donut-wrapper">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>

    <script>
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Setoran Sampah (Kg)',
                    data: [3000, 5500, 4200, 9000, 3500, 6000, 9800, 7500, 10500, 6200, 8800, 12000],
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39,174,96,0.15)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#27ae60'
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.parsed.y + " Kg"
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => value + " Kg"
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Sampah (Kg)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });

        /* DONUT CHART */
        const ctxDonut = document.getElementById('donutChart').getContext('2d');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Sampah Plastik', 'Kardus', 'Kaca', 'Restoran'],
                datasets: [{
                    data: [25, 27, 20, 28],
                    backgroundColor: ['#2f80ed', '#8d6e63', '#f2c94c', '#27ae60'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.label + ": " + ctx.raw + "%"
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>