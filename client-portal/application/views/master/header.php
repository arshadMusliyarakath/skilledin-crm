<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Profile | Skilledin - Client Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- swiper css -->
    <link rel="stylesheet" href="assets/libs/swiper/swiper-bundle.min.css">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="<?= base_url() ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/logo/skilledin-logo-clr.jpg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/logo/skilledin-logo-clr.jpg" alt="" height="40">
                                </span>
                            </a>

                            <a href="<?= base_url() ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/logo/skilledin-logo-clr.jpg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/logo/skilledin-logo-clr.jpg" alt="" height="40">
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item horizontal-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="<?= $this->session->userdata('userData')->profile_pic ?>"
                                        alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span
                                            class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= $client->name ?></span>
                                        <span
                                            class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?= $this->session->userdata('product_name') ?></span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome <?= $client->name ?>!</h6>
                                <a class="dropdown-item" href="<?= base_url('logout')?>"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-horizontal-sm-hover"
                    id="horizontal-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <!-- <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=base_url('') ?>">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li> -->

            <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=base_url('documents') ?>">
                                <i class="ri-pages-line"></i> <span data-key="t-dashboards">Documents</span>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=base_url('') ?>">
                                <i class="ri-file-list-3-line" style="color:red ;"></i><span data-key="t-dashboards"
                                    style="color:red ;">
                                    <blink>New Files &#x2605;</blink>
                                </span>
                            </a>
                        </li>



                    </ul>
                </div> -->
            <!-- Sidebar -->
            <!-- </div> -->




            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="horizontal-overlay"></div>