<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hidroponik Indoor - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height: 100vh;">

            <div class="col-xl-5 col-lg-5 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-success">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center text-gray-200 mb-4">
                                <h1 class="h4 mb-4">Hidroponik Indoor</h1>
                                <h6>Tomat Ceri</h6>
                            </div>
                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <form class="user" method="post" action="/auth/login">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-warning btn-user btn-block text-gray-900">
                                    Masuk
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>