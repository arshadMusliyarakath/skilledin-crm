<?php $this->load->view('master/header');?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="d-flex">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                role="tablist">
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">-->
                                <!--        <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>-->
                                <!--    </a>-->
                                <!--</li>-->
                                <li class="nav-item">
                                    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#projects" role="tab">
                                        <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                            class="d-none d-md-inline-block">Upload Document</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                        <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                            class="d-none d-md-inline-block">View Documents</span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content pt-4 text-muted">

                            <div class="tab-pane active" id="projects" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xxl-12">
                                                <div class="card">
                                                    <!--<div class="card-header align-items-center d-flex">-->
                                                    <!--    <h4 class="card-title mb-0 flex-grow-1">Form Grid</h4>-->
                                                    <!--</div>-->

                                                    <div class="card-body">
                                                        <div class="live-preview">
                                                            <form id="myForm" name="myForm" method="POST"
                                                                enctype="multipart/form-data" action="doclistadd">
                                                                <div class="row">



                                                                    <div class='col-md-3'>
                                                                        <div class='mb-3'>
                                                                            <label for='firstNameinput'
                                                                                class='form-label'>doc name</label>
                                                                            <input type="hidden" id="edit_id"
                                                                                name="edit_id[]" class='form-control'
                                                                                value="id">
                                                                            <input type='file' id='doc_file'
                                                                                name='doc_file[]' class='form-control'
                                                                                placeholder='Enter your firstname'>
                                                                        </div>
                                                                    </div>


                                                                    <!--end col-->

                                                                    <div class="col-lg-12">
                                                                        <div class="text-end">
                                                                            <input type="submit" id="submit"
                                                                                name="submit" class="btn btn-primary"
                                                                                value="Submit">
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->

                                                                    <div class="col-lg-12">
                                                                        <p>No Data Found...</p>
                                                                    </div>



                                                                </div>
                                                                <!--end row-->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <!--end col-->

                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane fade" id="documents" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless align-middle mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th scope="col">File Name</th>
                                                                <th scope="col">Type</th>
                                                                <th scope="col">Upload Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            <tr id="editproduct">
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <a href="#" download>


                                                                            <div class="avatar-sm">
                                                                                <div
                                                                                    class="avatar-title bg-soft-secondary text-secondary rounded fs-20">
                                                                                    <i class="ri-download-2-fill"></i>
                                                                                </div>
                                                                            </div>

                                                                            <div class="avatar-sm">
                                                                                <div
                                                                                    class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                                    <i class="ri-download-fill"></i>
                                                                                </div>
                                                                            </div>

                                                                            <div class="avatar-sm">
                                                                                <div
                                                                                    class="avatar-title bg-soft-info text-info rounded fs-20">
                                                                                    <i class="ri-download-line"></i>
                                                                                </div>
                                                                            </div>

                                                                        </a>
                                                                        <div class="ms-3 flex-grow-1">
                                                                            <h6 class="fs-15 mb-0">doc name</h6>
                                                                        </div>


                                                                    </div>
                                                                </td>
                                                                <td>extension</td>
                                                                <td>date</td>

                                                            </tr>


                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <p class="card-title flex-grow-1 mb-0">No Data Found..........</p>

                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!--end tab-pane-->
                        </div>
                        <!--end tab-content-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->

    <?php $this->load->view('master/footer'); ?>