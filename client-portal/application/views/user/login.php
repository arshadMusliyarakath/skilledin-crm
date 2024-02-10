<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>

    <!-- META DATA eta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Laravel Bootstrap Responsive Admin Web Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="dashboard bootstrap, laravel template, admin panel in laravel, php admin panel, admin panel for laravel, admin template bootstrap 5, laravel admin panel, admin dashboard template, hrm dashboard, vite laravel, admin dashboard, ecommerce admin dashboard, dashboard laravel, analytics dashboard, template dashboard, admin panel template, bootstrap admin panel template">

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
                            ?>
                        <div class="row gy-3">
                            <form method="POST">
                                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                <div class="col-xl-12 mb-2">
                                    <label for="signin-username" class="form-label text-default">Email</label>
                                    <input type="text" class="form-control form-control-lg" id="signin-username"
                                        name="email" placeholder="Enter your email" autofocus="" required="">
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <label for="signin-password"
                                        class="form-label text-default d-block">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="signin-password"
                                            name="password" placeholder="Enter your password" required="">
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
                <ul class='dprt_link'>
                    <li><a href="#">Admin</a></li>
                    <li><a href="#">Sales</a></li>
                    <li><a href="#">Documentation</a></li>
                </ul>
            </div>
        </div>
    </div>

    <style type="text/css">
    .login-logo-area img {
        height: 60px !important;
    }

    ul.dprt_link {
        padding: 0;
        margin: 0 auto;
        text-align: center;

    }

    ul.dprt_link li {
        list-style: none;
        display: inline;
        text-align: center;
        margin: 0 auto;
        opacity: 0.7;
        padding-right: 15px;
        padding-left: 21px;
        background-image: url("<?=base_url('assets/icons/dot.png')?>");
        background-size: 5px;
        background-repeat: no-repeat;
        background-position: left center;
    }

    ul.dprt_link li:first-child {
        padding-left: 0;
        background-image: none;
    }

    ul.dprt_link li:last-child {
        padding-right: 0;
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