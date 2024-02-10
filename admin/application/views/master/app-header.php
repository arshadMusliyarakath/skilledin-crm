<!-- HEADER -->

<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="<?= base_url() ?>" class="header-logo">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-logo">
                        <img src="<?= base_url('assets/images/skilledin-toggle-black-logo.png'); ?>" alt="logo"
                            class="toggle-logo">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-dark">
                        <img src="<?= base_url('assets/images/skilledin-toggle-logo.png'); ?>" alt="logo"
                            class="toggle-dark">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo"
                            class="desktop-white">
                        <img src="<?= base_url('assets/images/skilledin-toggle-logo.png'); ?>" alt="logo"
                            class="toggle-white">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start::header-element -->
            <div class="header-element header-search">
                <!-- Start::header-link -->
                <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="bx bx-search-alt-2 header-link-icon"></i>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->

            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element header-theme-mode">
                <!-- Start::header-link|layout-setting -->
                <a href="javascript:void(0);" class="header-link layout-setting">
                    <span class="light-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-moon header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                    <span class="dark-layout">
                        <!-- Start::header-link-icon -->
                        <i class="bx bx-sun header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </span>
                </a>
                <!-- End::header-link|layout-setting -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->

            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element notifications-dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                    <i class="bx bx-bell header-link-icon"></i>
                    <span class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary"
                        id="notification-icon-badge">0</span>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <!-- Start::main-header-dropdown -->
                <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                    <div class="p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fs-17 fw-semibold">Notifications</p>
                            <span class="badge bg-secondary-transparent" id="notifiation-data">0 Unread</span>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <!-- <ul class="list-unstyled mb-0" id="header-notification-scroll">
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <span class="avatar avatar-md bg-primary-transparent avatar-rounded"><i class="ti ti-gift fs-18"></i></span>
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a href="notifications">Your Order Has Been Shipped</a></p>
                                                    <span class="text-muted fw-normal fs-12 header-notification-text">Order No: 123456 Has Shipped To Your Delivery Address</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <span class="avatar avatar-md bg-secondary-transparent avatar-rounded"><i class="ti ti-discount-2 fs-18"></i></span>
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a href="notifications">Discount Available</a></p>
                                                    <span class="text-muted fw-normal fs-12 header-notification-text">Discount Available On Selected Products</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <span class="avatar avatar-md bg-pink-transparent avatar-rounded"><i class="ti ti-user-check fs-18"></i></span>
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a href="notifications">Account Has Been Verified</a></p>
                                                    <span class="text-muted fw-normal fs-12 header-notification-text">Your Account Has Been Verified Sucessfully</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <span class="avatar avatar-md bg-warning-transparent avatar-rounded"><i class="ti ti-circle-check fs-18"></i></span>
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a href="notifications">Order Placed <span class="text-warning">ID: #1116773</span></a></p>
                                                    <span class="text-muted fw-normal fs-12 header-notification-text">Order Placed Successfully</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-start">
                                            <div class="pe-2">
                                                <span class="avatar avatar-md bg-success-transparent avatar-rounded"><i class="ti ti-clock fs-18"></i></span>
                                            </div>
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-0 fw-semibold"><a href="notifications">Order Delayed <span class="text-success">ID: 7731116</span></a></p>
                                                    <span class="text-muted fw-normal fs-12 header-notification-text">Order Delayed Unfortunately</span>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul> -->
                    <div class="p-3 empty-header-item1 border-top">
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="p-5 empty-item1 d-none">
                        <div class="text-center">
                            <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                <i class="ri-notification-off-line fs-2"></i>
                            </span>
                            <h6 class="fw-semibold mt-3">No New Notifications</h6>
                        </div>
                    </div>
                </div>
                <!-- End::main-header-dropdown -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element header-shortcuts-dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" id="notificationDropdown" aria-expanded="false">
                    <i class="bx bx-grid-alt header-link-icon"></i>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <!-- Start::main-header-dropdown -->

                <!-- End::main-header-dropdown -->
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element header-fullscreen">
                <!-- Start::header-link -->
                <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                    <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                    <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->


            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-sm-2 me-0">
                            <!-- <img src="<?= base_url('/assets/images/faces/9.jpg'); ?>" alt="img" width="32" height="32" class="rounded-circle"> -->
                            <span class="avatar avatar-sm bg-<?= $iconColor ?>"><?= $shortName; ?></span>
                        </div>
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1"><?= $this->session->userdata('username') ?></p>
                            <span
                                class="op-7 fw-normal d-block fs-11"><?= $this->session->userdata('role_name') ?></span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                 <!--    <li><a class="dropdown-item d-flex" href="profile"><i
                                class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li> -->
                    <!--      <li><a class="dropdown-item d-flex" href="mail"><i class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span class="badge bg-success-transparent ms-auto">25</span></a></li>
                                <li><a class="dropdown-item d-flex border-block-end" href="todo-list"><i class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li>
                                <li><a class="dropdown-item d-flex" href="mail-settings"><i class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li>
                                <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i class="ti ti-wallet fs-18 me-2 op-7"></i>Bal: $7,12,950</a></li>
                                <li><a class="dropdown-item d-flex" href="chat"><i class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li> -->
                    <li><a class="dropdown-item d-flex" href="<?= base_url('User/logout'); ?>"><i
                                class="ti ti-logout fs-18 me-2 op-7"></i>Log Out</a></li>
                </ul>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|switcher-icon -->
                <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas"
                    data-bs-target="#switcher-canvas">
                    <i class="bx bx-cog header-link-icon"></i>
                </a>
                <!-- End::header-link|switcher-icon -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- END HEADER -->