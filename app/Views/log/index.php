<?= $this->extend('layout/layout'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Log</h1>

    <div class="card">
        <div class="card-header">
            Log Pembacaan Sensor
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped" id="tanaman_table">
                <thead>
                    <tr>
                        <th>Kelembaban Udara</th>
                        <th>Suhu Udara</th>
                        <th>Suhu Air</th>
                        <th>Jarak Air</th>
                        <th>pH Air</th>
                        <th>TDS Air</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Log Foto
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped" id="foto_table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Status Tanaman</th>
                        <th>Tomat Terdeteksi?</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Log Deteksi Foto
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped" id="deteksi_foto_table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Status Tanaman</th>
                        <th>Tomat Terdeteksi?</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        let oTable = $('#tanaman_table').DataTable({
            order: [],
            "ajax": {
                "url": "<?= base_url('log/getLog'); ?>"
            },
            "columns": [{
                    "data": "kelembaban_udara"
                },
                {
                    "data": "suhu_udara"
                },
                {
                    "data": "suhu_air"
                },
                {
                    "data": "jarak_air"
                },
                {
                    "data": "ph_air"
                },
                {
                    "data": "tds_air"
                },
                {
                    "data": "created_at"
                }
            ]
        });

        setInterval(function() {
            oTable.ajax.reload();
        }, 5000);
        setInterval(function() {
            oTable.ajax.reload();
        }, 60000);

        let oTable2 = $('#foto_table').DataTable({
            order: [],
            "ajax": {
                "url": "<?= base_url('log/getPics'); ?>"
            },
            "columns": [{
                    "data": "file_name",
                    "render": function(data, type, row) {
                        return '<img src="foto/' + data + '" width="300px">';
                    }
                },
                {
                    "data": "status_tanaman"
                },
                {
                    "data": "tomat",
                    "render": function(data, type, row) {
                        if (data == '1' || row.bunga == '1') {
                            return 'Ya';
                        } else {
                            return 'Tidak';
                        }
                    }
                },
                {
                    "data": "created_at"
                }
            ]
        });

        let oTable3 = $('#deteksi_foto_table').DataTable({
            order: [],
            "ajax": {
                "url": "<?= base_url('log/getDetectedPics'); ?>"
            },
            "columns": [{
                    "data": "file_name",
                    "render": function(data, type, row) {
                        return '<img src="foto/' + data + '" width="300px">';
                    }
                },
                {
                    "data": "status_tanaman"
                },
                {
                    "data": "tomat",
                    "render": function(data, type, row) {
                        if (data == '1' || row.bunga == '1') {
                            return 'Ya';
                        } else {
                            return 'Tidak';
                        }
                    }
                },
                {
                    "data": "created_at"
                }
            ]
        });
    });
</script>
<?= $this->endSection(); ?>