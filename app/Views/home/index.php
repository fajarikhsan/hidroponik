<?= $this->extend('layout/layout'); ?>

<?= $this->section('header'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Beranda</h1>

    <div class="row justify-content-around">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Suhu Ruangan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="suhu_udara">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thermometer-half fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kelembaban</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="kelembaban_udara">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tint fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Suhu Air</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="suhu_air">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thermometer fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                pH Air</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="ph_air">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-water fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                TDS Air</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="tds_air">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-nutritionix fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jarak Air</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="jarak_air">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ruler fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row justify-content-around">
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tinggi Tanaman 1</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18 cm</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ruler-vertical fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tinggi Tanaman 2</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18 cm</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ruler-vertical fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tinggi Tanaman 3</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18 cm</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ruler-vertical fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pertumbuhan Tanaman 1</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18 cm</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pertumbuhan Tanaman 2</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18 cm</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pertumbuhan Tanaman 3</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18 cm</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="card border-left-info shadow h-100 py-2 mb-4">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Waktu Penyinaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="waktu_penyinaran">00:00:00</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clock fa-2x text-gray-500"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-left-dark shadow h-100 py-2 mb-4">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class=" font-weight-bold text-dark text-uppercase mb-4">
                        foto & Keadaan Tanaman</div>
                    <div class="row">
                        <div class="col">
                            <img src="/foto/1673860521_627f5da2031c4d6eef6c.jpg" class="img-fluid" id="foto" alt="Responsive image">
                        </div>
                        <div class="col">
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="status_tanaman">Masa Pertumbuhan <strong>VEGETATIF</strong></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="tanggal_foto">18 Januari 2023 12:10:00</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-seedling fa-2x text-gray-500"></i>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<script src="/plugins/moment/moment.min.js"></script>
<script>
    function get_data() {
        $.ajax({
            url: '/home/get_data',
            dataType: 'json',
            success: function(data) {
                $('#suhu_udara').html(data.suhu_udara + '&#8451;');
                $('#kelembaban_udara').text(data.kelembaban_udara + '%');
                $('#suhu_air').html(data.suhu_air + '&#8451;');
                $('#ph_air').text(data.ph_air + ' pH');
                $('#tds_air').text(data.tds_air + ' ppm');
                $('#jarak_air').text(data.jarak_air + ' cm');
                $('#waktu_penyinaran').text(data.lampu);
                $('#foto').attr('src', '/foto/' + data.foto.file_name);
                $('#tanggal_foto').text(moment(data.foto.created_at).format('DD MMMM YYYY HH:mm:ss'));
                $('#status_tanaman').text(data.foto.status_tanaman);
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        get_data();
        setInterval(function() {
            get_data();
        }, 1000);
    });
</script>
<?= $this->endSection(); ?>