<?= $this->extend('layout/layout'); ?>

<?= $this->section('header'); ?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tanaman</h1>

    <div class="card">
        <div class="card-header">
            Daftar Tanaman
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success btn-sm mb-4" data-toggle="modal" data-target="#tambahTanamanModal">Tambah Tanaman</button>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <table class="table table-hover table-striped" id="tanaman_table">
                <thead>
                    <tr>
                        <th>Nama Tanaman</th>
                        <th>Tanggal Semai</th>
                        <th>Tanggal Tanam</th>
                        <th>Tanggal Panen</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tanaman as $row) : ?>
                        <tr>
                            <td><?= $row['nama_tanaman']; ?></td>
                            <td><?= ($row['tanggal_semai'] == '0000-00-00' || $row['tanggal_semai'] == NULL) ? '-' : $row['tanggal_semai']; ?></td>
                            <td><?= ($row['tanggal_tanam'] == '0000-00-00' || $row['tanggal_tanam'] == NULL) ? '-' : $row['tanggal_tanam']; ?></td>
                            <td><?= ($row['tanggal_panen'] == '0000-00-00' || $row['tanggal_panen'] == NULL) ? '-' : $row['tanggal_panen']; ?></td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input cb_aktif" id="cb_aktif_<?= $row['id'] ?>" <?= ($row['is_active'] == '1') ? 'checked' : ''; ?> data-is_active="<?= $row['is_active']; ?>" data-id="<?= $row['id']; ?>">
                                    <label class="custom-control-label" for="cb_aktif_<?= $row['id'] ?>" id="label_cb_aktif_<?= $row['id'] ?>"><?= ($row['is_active'] == '1') ? 'Aktif' : 'Tidak Aktif'; ?></label>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary btn_edit" data-id="<?= $row['id']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger btn_delete" data-id="<?= $row['id']; ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahTanamanModal" tabindex="-1" aria-labelledby="tambahTanamanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTanamanModalLabel">Tambah Tanaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tanaman/create" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="nama_tanaman">Nama Tanaman</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_tanaman')) ? 'is-invalid' : ''; ?>" id="nama_tanaman" name="nama_tanaman" placeholder="Nama Tanaman" value="<?= old('nama_tanaman'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_tanaman'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="batas_suhu">Batas Suhu</label>
                        <input type="number" class="form-control <?= ($validation->hasError('batas_suhu')) ? 'is-invalid' : ''; ?>" id="batas_suhu" name="batas_suhu" placeholder="Batas Suhu" value="<?= old('batas_suhu'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('batas_suhu'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="lama_penyinaran">Lama Penyinaran</label>
                            <input type="number" class="form-control <?= ($validation->hasError('lama_penyinaran')) ? 'is-invalid' : ''; ?>" id="lama_penyinaran" name="lama_penyinaran" placeholder="Lama Penyinaran" value="<?= old('lama_penyinaran'); ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('lama_penyinaran'); ?>
                            </div>
                        </div>
                        <div class="form-group col-2">
                            <label for="jam">&nbsp;</label>
                            <input type="text" class="form-control-plaintext" readonly id="jam" value="Jam">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_semai">Tanggal Semai</label>
                        <input type="date" class="form-control" id="tanggal_semai" name="tanggal_semai" placeholder="Tanggal Semai" value="<?= old('tanggal_semai'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_tanam">Tanggal Tanam</label>
                        <input type="date" class="form-control" id="tanggal_tanam" name="tanggal_tanam" placeholder="Tanggal Tanam" value="<?= old('tanggal_tanam'); ?>">
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1">
                        <label class="custom-control-label" for="is_active">Aktifkan</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editTanamanModal" tabindex="-1" aria-labelledby="editTanamanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTanamanModalLabel">Ubah Tanaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tanaman/update" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="tanaman_id" id="tanaman_id">
                    <input type="hidden" name="setting_id" id="setting_id">
                    <div class="form-group">
                        <label for="nama_tanaman_edit">Nama Tanaman</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama_tanaman_edit')) ? 'is-invalid' : ''; ?>" id="nama_tanaman_edit" name="nama_tanaman_edit" placeholder="Nama Tanaman" value="<?= old('nama_tanaman_edit'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_tanaman_edit'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="batas_suhu_edit">Batas Suhu</label>
                        <input type="number" class="form-control <?= ($validation->hasError('batas_suhu_edit')) ? 'is-invalid' : ''; ?>" id="batas_suhu_edit" name="batas_suhu_edit" placeholder="Batas Suhu" value="<?= old('batas_suhu_edit'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('batas_suhu_edit'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="lama_penyinaran_edit">Lama Penyinaran</label>
                            <input type="number" class="form-control <?= ($validation->hasError('lama_penyinaran_edit')) ? 'is-invalid' : ''; ?>" id="lama_penyinaran_edit" name="lama_penyinaran_edit" placeholder="Lama Penyinaran" value="<?= old('lama_penyinaran_edit'); ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('lama_penyinaran_edit'); ?>
                            </div>
                        </div>
                        <div class="form-group col-2">
                            <label for="jam">&nbsp;</label>
                            <input type="text" class="form-control-plaintext" readonly id="jam" value="Jam">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_semai_edit">Tanggal Semai</label>
                        <input type="date" class="form-control" id="tanggal_semai_edit" name="tanggal_semai_edit" placeholder="Tanggal Semai" value="<?= old('tanggal_semai_edit'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_tanam_edit">Tanggal Tanam</label>
                        <input type="date" class="form-control" id="tanggal_tanam_edit" name="tanggal_tanam_edit" placeholder="Tanggal Tanam" value="<?= old('tanggal_tanam_edit'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_panen_edit">Tanggal Panen</label>
                        <input type="date" class="form-control" id="tanggal_panen_edit" name="tanggal_panen_edit" placeholder="Tanggal Panen" value="<?= old('tanggal_panen_edit'); ?>">
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active_edit" name="is_active_edit" value="1">
                        <label class="custom-control-label" for="is_active_edit">Aktifkan</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let nama_tanaman_err = '<?= $validation->hasError('nama_tanaman'); ?>';
    let batas_suhu_err = '<?= $validation->hasError('batas_suhu'); ?>';
    let lama_penyinaran_err = '<?= $validation->hasError('lama_penyinaran'); ?>';

    let nama_tanaman_edit_err = '<?= $validation->hasError('nama_tanaman_edit'); ?>';
    let batas_suhu_edit_err = '<?= $validation->hasError('batas_suhu_edit'); ?>';
    let lama_penyinaran_edit_err = '<?= $validation->hasError('lama_penyinaran_edit'); ?>';

    function secToHr(sec) {
        return parseInt(sec) / 3600;
    }
</script>
<script>
    $(document).ready(function() {
        if (Boolean(nama_tanaman_err) || Boolean(batas_suhu_err) || Boolean(lama_penyinaran_err)) {
            $('#tambahTanamanModal').modal('show');
        }

        if (Boolean(nama_tanaman_edit_err) || Boolean(batas_suhu_edit_err) || Boolean(lama_penyinaran_edit_err)) {
            $('#editTanamanModal').modal('show');
        }

        $('#tanaman_table').DataTable();

        $('table tbody').on('click', '.btn_edit', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '/tanaman/getTanaman',
                method: 'post',
                data: {
                    tanaman_id: id
                },
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please Wait !',
                        html: 'Getting Data', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function(data) {
                    $('#tanaman_id').val(data.tanaman_id);
                    $('#setting_id').val(data.setting_id);
                    $('#nama_tanaman_edit').val(data.nama_tanaman);
                    $('#batas_suhu_edit').val(data.batas_suhu);
                    $('#lama_penyinaran_edit').val(secToHr(data.lama_penyinaran));
                    $('#tanggal_semai_edit').val(data.tanggal_semai);
                    $('#tanggal_tanam_edit').val(data.tanggal_tanam);
                    if (data.is_active == 1) {
                        $('#is_active_edit').prop('checked', true);
                    } else {
                        $('#is_active_edit').prop('checked', false);
                    }
                },
                complete: function() {
                    $('#editTanamanModal').modal('show');
                    Swal.close();
                }
            })
        });

        $('table tbody').on('click', '.cb_aktif', function() {
            let tanaman_id = $(this).data('id');
            let is_active = $(this).data('is_active');

            Swal.fire({
                icon: 'question',
                title: 'Ubah status aktif?',
                showCancelButton: true,
                confirmButtonText: 'Ubah',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tanaman/updateActive',
                        method: 'post',
                        data: {
                            tanaman_id: tanaman_id,
                            is_active: is_active
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please Wait !',
                                html: 'Updating Data', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(data) {
                            if (data == '1' || data == '0') {
                                Swal.fire('Status aktif berhasil diubah', '', 'success');
                                $('#cb_aktif_' + tanaman_id).data('is_active', data);
                                $('#label_cb_aktif_' + tanaman_id).text(data == '1' ? 'Aktif' : 'Tidak Aktif');
                            } else {
                                Swal.fire('Status aktif gagal diubah', '', 'error');
                                $('#cb_aktif_' + tanaman_id).prop('checked', Boolean(is_active));
                            }
                        }
                    })
                } else {
                    Swal.fire('Status aktif batal diubah', '', 'info');
                    $('#cb_aktif_' + tanaman_id).prop('checked', Boolean(is_active));
                }
            })
            $.ajax({

            });
        });

        $('table tbody').on('click', '.btn_delete', function() {
            let tanaman_id = $(this).data('id');

            Swal.fire({
                icon: 'question',
                title: 'Hapus tanaman?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tanaman/deleteTanaman',
                        method: 'post',
                        data: {
                            tanaman_id: tanaman_id
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please Wait !',
                                html: 'Deleting Data', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(data) {
                            if (data == '1') {
                                Swal.fire('Tanaman berhasil dihapus', '', 'success').then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Tanaman gagal dihapus', '', 'error').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                } else {
                    Swal.fire('Tanaman batal dihapus', '', 'info');
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>