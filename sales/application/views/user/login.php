<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>

    <!-- META DATA eta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="">
    <meta name="Author" content="">
    <meta name="keywords"
        content="">

    <!-- TITLE -->
    <title> CRM | Login </title>

    <!-- FAVICON -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?= base_url('build/assets/libs/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="<?= base_url('build/assets/icon-fonts/icons.css'); ?>" rel="stylesheet">

    <!-- APP SCSS -->
    <link rel="preload" as="style" href="<?= base_url('build/assets/app-fce3f544.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('build/assets/app-fce3f544.css'); ?>" />

    <!-- MAIN JS -->
    <script src="<?= base_url('build/assets/authentication-main.js'); ?>"></script>




</head>

<body>



    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center login-logo-area">
                    <a href="<?= base_url(); ?>">
                        <img src="<?= base_url('assets/images/skilledin-logo-color.png'); ?>" alt="logo"
                            class="desktop-logo">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-dark">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <p class="h5 fw-semibold mb-2 text-center">Sign In</p>
                        <?php
                              $error_message = $this->session->flashdata('error');
                              if ($error_message) { echo '<p class="alert alert-danger">' . $error_message . '</p>'; }


                              $warning_message = $this->session->flashdata('warning');
                              if ($warning_message) { echo '<p class="alert alert-warning">' . $warning_message . '</p>'; }


                              $success_message = $this->session->flashdata('success');
                              if ($success_message) { echo '<p class="alert alert-success">' . $success_message . '</p>'; }
                            ?>

                            



                        <div class="row gy-3">
                            <form method="POST">
                                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                <div class="col-xl-12 mb-2">
                                    <label for="signin-username" class="form-label text-default">Email</label>
                                    <input type="email" class="form-control form-control-lg" id="signin-email"
                                        name="email" placeholder="Enter your email" value="" autofocus=""
                                        required="">
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <label for="signin-password" class="form-label text-default d-block">Password<a href="#" class="float-end text-danger" href="#" data-bs-toggle="modal"
                                    data-bs-target="#forgot-password">Forgot password ?</a></label>


                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="signin-password"
                                            name="password" placeholder="Enter your password" value="" required="">
                                        <button class="btn btn-light" type="button"
                                            onclick="createpassword('signin-password',this)" id="button-addon2"><i
                                                class="ri-eye-off-line align-middle"></i></button>
                                    </div>

                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary-gradient btn-wave waves-effect waves-light">Sign
                                        In <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="forgot-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?= base_url('User/ForgotPassword') ?>" enctype="multipart/form-data">
                    <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel1">Forgot password ?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type='email' class="form-control" name='email' placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style type="text/css">
    /*.login-logo-area {
    background-image: url('assets/login-images/login-bg.jpg');
    margin: 0 !important;
    padding: 3rem 0px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}*/
    .login-logo-area img {
        height: 60px !important;
    }
    </style>

    <!-- SCRIPTS -->

    <!-- BOOTSTRAP JS -->
    <script src="<?= base_url('build/assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>


    <!-- SHOW PASSWORD JS -->
    <script src="<?= base_url('build/assets/show-password.js'); ?>"></script>



    <!-- END SCRIPTS -->

</body>

</html>