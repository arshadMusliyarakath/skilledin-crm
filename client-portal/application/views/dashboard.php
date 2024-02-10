<?php $this->load->view('master/header');?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="profile-foreground position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg">
                    <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
                </div>
            </div>
            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                <div class="row g-4">
                    <div class="col">
                        <div class="p-2">
                            <h3 class="text-white mb-1"><?= $client->name ?></h3>
                            <p class="text-white-75"><?= $this->session->userdata('product_name') ?></p>
                            <div class="hstack text-white-50 gap-1">
                                <div class="me-2"><i
                                        class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i><?= $client->address ?>
                                    .
                                </div>
                                <div>
                                    <i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Skilledin
                                    Immigration
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="tab-content pt-4 text-muted">
                            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Info</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">CRM :
                                                                </th>
                                                                <td class="text-muted"><?= $client->crm_number ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Full Name :</th>
                                                                <td class="text-muted"><?= $client->name ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Mobile :</th>
                                                                <td class="text-muted"><?= $client->mobile ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">E-mail :</th>
                                                                <td class="text-muted"><?= $client->email ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Location :</th>
                                                                <td class="text-muted"><?= $client->country ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Social Media Links</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <div>
                                                        <a href="https://www.youtube.com/@skilledinimmigration/"
                                                            target="_blank" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16">
                                                                <i class="ri-youtube-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="https://www.linkedin.com/company/skilledinservices/"
                                                            target="_blank" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 ">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="https://www.instagram.com/skilledin_immigration_services/"
                                                            target="_blank" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16">
                                                                <i class="ri-instagram-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="https://www.facebook.com/skilledinimmigration/"
                                                            target="_blank" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16">
                                                                <i class="ri-facebook-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="https://twitter.com/Skilledinimmi/" target="_blank"
                                                            class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16">
                                                                <i class="ri-twitter-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="https://in.pinterest.com/skilledinservices/"
                                                            target="_blank" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16">
                                                                <i class="ri-pinterest-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Documents Details</h5>
                                                <?php
                                    $success_message = $this->session->flashdata('success');
                                    if ( $success_message) {
                                        echo '<p class="alert alert-success">' . $success_message . '</p>';
                                    }
                                    ?>
                                                <!-- Swiper -->
                                                <div class="swiper project-swiper">
                                                    <div class="swiper-wrapper">
                                                        <hr>
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Document Name</th>
                                                                    <th scope="col">Status</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                $i = 0;
                                                foreach ($documents as $key => $document) {
                                                    $i++;
                                                    $dateTime = new DateTime($document->created_at);
                                                    if($document->up_status == 1){
                                                
                                                        $statusText     =   'Uploaded';
                                                        $statusColour   =   'success';
                                                        $uploadDate     =   $dateTime->format('d M Y, h:i A');
                                                    
                                                    }else{
                                                        $statusText     = 'Pending';
                                                        $statusColour   = 'warning';
                                                        $uploadDate     =  '--';
                                                    
                                                    }
                                                    ?>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-file-pdf-o" aria-hidden="true"
                                                                            style="color: red;"></i>
                                                                        <?= $document->doc_name ?>
                                                                    </td>
                                                                   
                                                                    <td>
                                                                        <div
                                                                            class="badge badge-soft-<?= $statusColour ?> fs-10">
                                                                            <?= $statusText ?>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($document->up_status == 1){ ?>
                                                                        <a href="#"
                                                                            class='view-pdf btn btn-icon btn-sm btn-light'
                                                                            data-document-name="<?= $document->file_name ?>">
                                                                            <i class="ri-eye-line"></i>
                                                                            <!-- View -->
                                                                        </a>
                                                                        <?php }else{ ?>
                                                                        <a href="#"
                                                                            class='btn btn-sm btn-secondary'
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#doc-<?= $i ?>">
                                                                            <!-- <i class="ri-upload-2-line"></i> -->
                                                                            Upload
                                                                        </a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <div class="modal fade" id="doc-<?= $i ?>" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <form method="POST"
                                                                                action="<?= base_url('FrontEndController/uploadDocAPI') ?>"
                                                                                enctype="multipart/form-data">
                                                                                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                                                                <div class="modal-header">
                                                                                    <h6 class="modal-title"
                                                                                        id="exampleModalLabel1">
                                                                                        UPLOAD
                                                                                        <span
                                                                                            class='text-success'><?= $document->doc_name ?></span>
                                                                                    </h6>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="input-group mb-3">
                                                                                        <input type='hidden'
                                                                                            name='up-doc-id'
                                                                                            value='<?= $document->upDoc_id ?>'>
                                                                                        <input type='hidden'
                                                                                            name='doc-name'
                                                                                            value='<?= $document->doc_name ?>'>
                                                                                        <input type="file"
                                                                                            class="form-control"
                                                                                            name='doc-file'
                                                                                            accept="application/pdf"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-light"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary"
                                                                                        data-bs-dismiss="modal">Upload</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                }
                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            
                        </div>
                        <!--end tab-content-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- container-fluid -->



    </div>
    <!-- End Page-content -->
    
    
                                            





    <script>
    $(document).ready(function() {
        $(".view-pdf").click(function(e) {
            e.preventDefault();

            var clientId = "<?= $client->id?>";
            var documentName = $(this).data('document-name');

            $.ajax({
                type: "POST",
                url: "<?= base_url("FrontEndController/viewPdf") ?>",
                data: {
                    clientId: clientId,
                    documentName: documentName
                },
                xhrFields: {
                    responseType: 'blob' // Set the response type to blob
                },
                success: function(response) {
                    console.log("Success:", response);

                    var blob = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var blobUrl = URL.createObjectURL(blob);
                    window.open(blobUrl, '_blank');
                },

            });
        });
    });
    </script>
    <?php $this->load->view('master/footer'); ?>