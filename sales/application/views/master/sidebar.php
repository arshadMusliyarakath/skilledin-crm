<!-- SIDEBAR -->

            <aside class="app-sidebar sticky" id="sidebar">

                <!-- Start::main-sidebar-header -->
                <div class="main-sidebar-header">
                    <a href="<?= base_url(); ?>" class="header-logo">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-logo">
                        <img src="<?= base_url('assets/images/skilledin-toggle-logo.png'); ?>" alt="logo" class="toggle-logo">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-dark">
                        <img src="<?= base_url('assets/images/skilledin-toggle-logo.png'); ?>" alt="logo" class="toggle-dark">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-white">
                        <img src="<?= base_url('assets/images/skilledin-toggle-logo.png'); ?>" alt="logo" class="toggle-white">
                    </a>
                </div>
                <!-- End::main-sidebar-header -->

                <!-- Start::main-sidebar -->
                <div class="main-sidebar" id="sidebar-scroll">

                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                        </div>
                        <ul class="main-menu">
                        

                            <!-- Start::slide__category -->

                            <li class="slide__category"><span class="category-name">Main</span></li>
                            <!-- End::slide__category -->
                            <li class="slide">
                                <a  href="<?= base_url(); ?>" class="side-menu__item">
                                    <i class="bx bx-home side-menu__icon"></i>
                                    <span class="side-menu__label">Dashboards</span>
                                </a>
                            </li>

                            <li class="slide__category"><span class="category-name">Pages</span></li>

                            
                            <?php if($this->session->userdata('role') == 2){?>

                            <li class="slide">
                                <a href="<?= base_url('Sales'); ?>" class="side-menu__item">
                                    <i class="bx bx-briefcase side-menu__icon"></i>
                                    <span class="side-menu__label">Sales Consultants</span>
                                </a>
                            </li>

                            <li class="slide">
                                <a href="<?= base_url('Client'); ?>" class="side-menu__item">
                                    <i class="bx bx-user-circle side-menu__icon"></i>
                                    <span class="side-menu__label">Clients</span>
                                </a>
                            </li>

                            <?php } ?>
                            <?php if($this->session->userdata('role') == 4){?>

                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-user-circle side-menu__icon"></i>
                                    <span class="side-menu__label">Clients</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Clients</a>
                                    </li>
                                  
                                        
                                    <li class="slide">
                                        <a href="<?= base_url('Client/addClient'); ?>" class="side-menu__item">Add New Client</a>
                                    </li>
                                    <li class="slide">
                                        <a href="<?= base_url('Client'); ?>" class="side-menu__item">Registered Clients</a>
                                    </li>
                                    
                                </ul>
                            </li>



                            <?php } ?>

<!--  

                            <li class="slide">
                                <a href="<?= base_url('Sales'); ?>" class="side-menu__item">
                                    <i class="bx bx-user-circle side-menu__icon"></i>
                                    <span class="side-menu__label">Sales Consultants</span>
                                </a>
                            </li> -->
<!-- 
                            <li class="slide">
                                <a href="<?= base_url('Documentation'); ?>" class="side-menu__item">
                                    <i class="bx bx-user-circle side-menu__icon"></i>
                                    <span class="side-menu__label">Case Managers</span>
                                </a>
                            </li> -->


                            
                            

                            
                            <!-- <li class="slide__category"><span class="category-name">Extras</span></li> -->

             

<!-- 
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-duplicate side-menu__icon"></i>
                                    <span class="side-menu__label">Utilities</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Utilities</a>
                                    </li>
                                  
                                        
                                    <li class="slide">
                                        <a href="<?= base_url('Utility/roles'); ?>" class="side-menu__item">Roles / Designations</a>
                                    </li>
                                    <li class="slide">
                                        <a href="<?= base_url('Utility/products'); ?>" class="side-menu__item">Products</a>
                                    </li>
                                    
                                </ul>
                            </li>
 -->

                            <!-- Start::slide -->
                            <!-- <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="bx bx-cog side-menu__icon"></i>
                                    <span class="side-menu__label">Settings</span>
                                    <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    <li class="slide side-menu__label1">
                                        <a href="javascript:void(0);">Settings</a>
                                    </li>
                                  
                                        
                                    <li class="slide">
                                        <a href="#" class="side-menu__item">Pages</a>
                                    </li>
                                    <li class="slide">
                                        <a href="#" class="side-menu__item">Mails</a>
                                    </li>
                                    
                                </ul>
                            </li> -->
                            <!-- End::slide -->

                           


                            <!-- <li class="slide">
                                <a href="#" class="side-menu__item">
                                    <i class="bx bx-store-alt side-menu__icon"></i>
                                    <span class="side-menu__label">Empty</span>
                                </a>
                            </li> -->
                            
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>


                    </nav>
                    <!-- End::nav -->

                </div>
                <!-- End::main-sidebar -->

            </aside>
            <!-- END SIDEBAR -->
