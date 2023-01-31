<?= $this->extend('layout/layout'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="plugins/chart.js/Chart.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Log</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Suhu Udara
                </div>
                <div class="card-body">
                    <canvas id="suhu_udara"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Kelembaban Udara
                </div>
                <div class="card-body">
                    <canvas id="kelembaban_udara"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Suhu Air
                </div>
                <div class="card-body">
                    <canvas id="suhu_air"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Tinggi Air
                </div>
                <div class="card-body">
                    <canvas id="tinggi_air"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    pH Air
                </div>
                <div class="card-body">
                    <canvas id="ph_air"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    TDS Air
                </div>
                <div class="card-body">
                    <canvas id="tds_air"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
    let suhu_udara, kelembaban_udara, suhu_air, tinggi_air, ph_air, tds_air;

    function log() {
        $.ajax({
            url: '/chart/getlog',
            dataType: 'json',
            success: function(data) {
                if (suhu_udara) {
                    suhu_udara.destroy();
                    kelembaban_udara.destroy();
                    suhu_air.destroy();
                    tinggi_air.destroy();
                    ph_air.destroy();
                    tds_air.destroy();
                }
                suhu_udara = new Chart($('#suhu_udara'), {
                    type: 'line',
                    data: {
                        labels: data.suhu_udara.label,
                        datasets: [{
                            label: 'Suhu Udara',
                            data: data.suhu_udara.value,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0)',
                        }],
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                kelembaban_udara = new Chart($('#kelembaban_udara'), {
                    type: 'line',
                    data: {
                        labels: data.kelembaban_udara.label,
                        datasets: [{
                            label: 'Kelembaban Udara',
                            data: data.kelembaban_udara.value,
                            borderColor: '#4ddee3',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                suhu_air = new Chart($('#suhu_air'), {
                    type: 'line',
                    data: {
                        labels: data.suhu_air.label,
                        datasets: [{
                            label: 'Suhu Air',
                            data: data.suhu_air.value,
                            borderColor: '#2c6be8',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                tinggi_air = new Chart($('#tinggi_air'), {
                    type: 'line',
                    data: {
                        labels: data.jarak_air.label,
                        datasets: [{
                            label: 'Tinggi Air',
                            data: data.jarak_air.value,
                            borderColor: '#5fff14',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                ph_air = new Chart($('#ph_air'), {
                    type: 'line',
                    data: {
                        labels: data.ph_air.label,
                        datasets: [{
                            label: 'pH Air',
                            data: data.ph_air.value,
                            borderColor: '#fff957',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                tds_air = new Chart($('#tds_air'), {
                    type: 'line',
                    data: {
                        labels: data.tds_air.label,
                        datasets: [{
                            label: 'TDS Air',
                            data: data.tds_air.value,
                            borderColor: '#9c9b84',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        })
    }

    function updateLog() {
        $.ajax({
            url: '/chart/getlog',
            dataType: 'json',
            success: function(data) {
                suhu_udara.data.labels = data.suhu_udara.label;
                suhu_udara.data.datasets[0].data = data.suhu_udara.value;
                suhu_udara.update();

                kelembaban_udara.data.labels = data.kelembaban_udara.label;
                kelembaban_udara.data.datasets[0].data = data.kelembaban_udara.value;
                kelembaban_udara.update();

                suhu_air.data.labels = data.suhu_air.label;
                suhu_air.data.datasets[0].data = data.suhu_air.value;
                suhu_air.update();

                tinggi_air.data.labels = data.jarak_air.label;
                tinggi_air.data.datasets[0].data = data.jarak_air.value;
                tinggi_air.update();

                ph_air.data.labels = data.ph_air.label;
                ph_air.data.datasets[0].data = data.ph_air.value;
                ph_air.update();

                tds_air.data.labels = data.tds_air.label;
                tds_air.data.datasets[0].data = data.tds_air.value;
                tds_air.update();
            }
        })
    }
</script>
<script>
    $(document).ready(function() {
        log();
        setInterval(updateLog, 5000);
    });
</script>
<?= $this->endSection(); ?>