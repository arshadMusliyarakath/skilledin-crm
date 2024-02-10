<?php $this->load->view('master/footer') ?>


                    <!-- Start::row-1 -->
                    <div class="row">
                        
                    </div>
                    <!--End::row-1 -->

                </div>


            </div> 
            <!-- END MAIN-CONTENT -->

            <!-- SEARCH-MODAL -->

            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    <div class="input-group">
                        <a href="javascript:void(0);" class="input-group-text" id="Search-Grid"><i class="fe fe-search header-link-icon fs-18"></i></a>
                        <input type="search" class="form-control border-0 px-2" placeholder="Search" aria-label="Username">
                        <a href="javascript:void(0);" class="input-group-text" id="voice-search"><i class="fe fe-mic header-link-icon"></i></a>
                        <a href="javascript:void(0);" class="btn btn-light btn-icon" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fe fe-more-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <p class="font-weight-semibold text-muted mb-2">Are You Looking For...</p>
                        <span class="search-tags"><i class="fe fe-user me-2"></i>People<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                        <span class="search-tags"><i class="fe fe-file-text me-2"></i>Pages<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                        <span class="search-tags"><i class="fe fe-align-left me-2"></i>Articles<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                        <span class="search-tags"><i class="fe fe-server me-2"></i>Tags<a href="javascript:void(0);" class="tag-addon"><i class="fe fe-x"></i></a></span>
                    </div>
                    <div class="my-4">
                        <p class="font-weight-semibold text-muted mb-2">Recent Search :</p>
                        <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                        <a href="notifications"><span>Notifications</span></a>
                        <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                        </div>
                        <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                        <a href="alerts"><span>Alerts</span></a>
                        <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                        </div>
                        <div class="p-2 border br-5 d-flex align-items-center text-muted mb-0 alert">
                        <a href="mail"><span>Mail</span></a>
                        <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <div class="btn-group ms-auto">
                        <button class="btn btn-sm btn-primary-light">Search</button>
                        <button class="btn btn-sm btn-primary">Clear Recents</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- END SEARCH-MODAL -->

            <?php $this->load->view('master/footer') ?>

        </div>
        <!-- END PAGE-->

        <!-- SCRIPTS -->

        <!-- SCROLL-TO-TOP -->
        <div class="scrollToTop">
                <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
        </div>
        <div id="responsive-overlay"></div>

        <!-- POPPER JS -->
        <script src="build/assets/libs/@popperjs/core/umd/popper.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="build/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- NODE WAVES JS -->
        <script src="build/assets/libs/node-waves/waves.min.js"></script>

        <!-- SIMPLEBAR JS -->
        <script src="build/assets/libs/simplebar/simplebar.min.js"></script>
        <link rel="modulepreload" href="build/assets/simplebar-635bad04.js" /><script type="module" src="build/assets/simplebar-635bad04.js"></script>

        <!-- COLOR PICKER JS -->
        <script src="build/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
        


        <!-- STICKY JS -->
        <script src="build/assets/sticky.js"></script>

        <!-- APP JS -->
        <link rel="modulepreload" href="build/assets/app-3cade095.js" /><script type="module" src="build/assets/app-3cade095.js"></script>

        <!-- CUSTOM-SWITCHER JS -->
        <link rel="modulepreload" href="build/assets/custom-switcher-383b6a5b.js" /><script type="module" src="build/assets/custom-switcher-383b6a5b.js"></script>
        
        <!-- END SCRIPTS -->

    </body>
</html>
