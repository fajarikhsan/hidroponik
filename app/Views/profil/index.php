<?= $this->extend('layout/layout'); ?>

<?= $this->section('header'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profil</h1>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-5" src="img/undraw_profile.svg" width="15%">
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
                    <ul class="list-group list-group-flush mb-2">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Username
                            <span><?= session('username'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Password
                            <span><?= preg_replace('/[^@]/', '*', $akun['password']); ?></span>
                        </li>
                    </ul>

                    <button class="btn btn-warning btn-sm" id="btn_ubah" data-toggle="modal" data-target="#ubahModal">Ubah</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahModalLabel">Ubah Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/profil/update" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id" value="<?= $akun['id']; ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Username" value="<?= $akun['username']; ?>" value="<?= old('username'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" value="<?= $akun['password']; ?>" value="<?= old('password'); ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>

<script>
    let username_err = '<?= $validation->hasError('username'); ?>';
    let password_err = '<?= $validation->hasError('password'); ?>';
</script>

<script>
    $(document).ready(function() {
        if (Boolean(username_err) || Boolean(password_err)) {
            $('#ubahModal').modal('show');
        }
    });
</script>
<?= $this->endSection(); ?>