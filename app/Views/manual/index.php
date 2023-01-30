<?= $this->extend('layout/layout'); ?>

<?= $this->section('header'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Manual</h1>

    <div class="row justify-content-around mb-4">
        <div class="col">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-danger text-uppercase">
                                Otomatis</div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input cb_manual" id="manual" data-manual="<?= $manual['manual']; ?>" <?= ($manual['manual'] == '0') ? "checked" : ''; ?>>
                                <label class="custom-control-label" for="manual">&nbsp;</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-around mb-4">
        <div class="col">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-warning text-uppercase">
                                Lampu</div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input cb_lampu" id="lampu_on" data-lampu_on="<?= $manual['lampu_on']; ?>" <?= ($manual['lampu_on'] == '1') ? "checked" : ''; ?>>
                                <label class="custom-control-label" for="lampu_on">&nbsp;</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-info text-uppercase">
                                Kipas</div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input cb_kipas" id="kipas_on" data-kipas_on="<?= $manual['kipas_on']; ?>" <?= ($manual['kipas_on'] == '1') ? "checked" : ''; ?>>
                                <label class="custom-control-label" for="kipas_on">&nbsp;</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-around">
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase">
                                Katup Air</div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input cb_pompa" id="valve_on" data-valve_on="<?= $manual['valve_on']; ?>" <?= ($manual['valve_on'] == '1') ? "checked" : ''; ?>>
                                <label class="custom-control-label" for="valve_on">&nbsp;</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        let manual = '<?= $manual['manual'] ?>';
        if (manual == '1') {
            $('.cb_lampu').prop('disabled', false);
            $('.cb_kipas').prop('disabled', false);
            $('.cb_pompa').prop('disabled', false);
        } else {
            $('.cb_lampu').prop('disabled', true);
            $('.cb_kipas').prop('disabled', true);
            $('.cb_pompa').prop('disabled', true);
        }

        $('.cb_manual').on('change', function() {
            let manual = $(this).data('manual');
            $.ajax({
                url: '<?= base_url('manual/updateManual'); ?>',
                type: 'POST',
                data: {
                    manual: manual
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function(data) {
                    if (data == '1' || data == '0') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil mengubah mode',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (data == '1') {
                            $('.cb_lampu').prop('disabled', false);
                            $('.cb_kipas').prop('disabled', false);
                            $('.cb_pompa').prop('disabled', false);
                        } else {
                            $('.cb_lampu').prop('disabled', true);
                            $('.cb_kipas').prop('disabled', true);
                            $('.cb_pompa').prop('disabled', true);
                        }
                        $('.cb_manual').data('manual', data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengubah mode',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        });

        $('.cb_lampu').on('change', function() {
            let lampu_on = $(this).data('lampu_on');
            $.ajax({
                url: '<?= base_url('manual/updateLampu'); ?>',
                type: 'POST',
                data: {
                    lampu_on: lampu_on
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function(data) {
                    if (data == '1' || data == '0') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil mengubah mode lampu',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.cb_lampu').data('lampu_on', data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengubah mode lampu',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        });

        $('.cb_kipas').on('change', function() {
            let kipas_on = $(this).data('kipas_on');
            $.ajax({
                url: '<?= base_url('manual/updateKipas'); ?>',
                type: 'POST',
                data: {
                    kipas_on: kipas_on
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function(data) {
                    if (data == '1' || data == '0') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil mengubah mode kipas',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.cb_kipas').data('kipas_on', data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengubah mode kipas',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        });

        $('.cb_pompa').on('change', function() {
            let valve_on = $(this).data('valve_on');
            $.ajax({
                url: '<?= base_url('manual/updatePompa'); ?>',
                type: 'POST',
                data: {
                    valve_on: valve_on
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function(data) {
                    if (data == '1' || data == '0') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil mengubah mode pompa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.cb_pompa').data('valve_on', data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengubah mode pompa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>