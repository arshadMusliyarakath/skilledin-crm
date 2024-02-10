<?php
$start_time = microtime(true);
$this->load->view('master/header');
?>
<?php

$baseUrl = base_url();

//Profile Status
$profileStatus = [
    'registration'      =>  25,
    'profilePic'        =>  ($client->profile_pic != NULL) ? 25 : 0,
    'mandatryDocs'      =>  ($up_docs_count >= 5) ? 25 : 0,
    'registrPayment'    =>  ($regPaymntStatus >= 1) ? 25 : 0,
];



$pushed = ($client->handle_deprt == 2) ? TRUE : FALSE ;

    $success_message = $this->session->flashdata('success');
    if ($success_message) { echo '<p class="alert alert-success">' . $success_message . '</p>'; }

    $update_message = $this->session->flashdata('update');
    if ($update_message) { echo '<p class="alert alert-info">' . $update_message . '</p>'; }

    echo ($pushed) ? '<div class="alert alert-solid-danger alert-dismissible fade show"> The client has been <b>Pushed to Documentation,</b> and no further changes can be made. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> </div>' : "" ;
 ?>

<div class="row">
    <div class="col-xl-3">
        <div class="card custom-card client-profile-progress">
            <div class="card-body">
                <div class="d-flex align-items-top justify-content-between mb-4">
                    <div>
                        <span class="d-block fs-15 fw-semibold">Profile</span>
                        <span class="d-block fs-12 text-muted"><?= array_sum($profileStatus); ?>% Completed</span>
                    </div>
                    <?php if(!$pushed){?>
                    <div class="dropdown">
                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#change-profile">Change Profile Pic</a></li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="text-center mb-4">
                    <div class="mb-1">
                        <div class="client-avatar-area">
                            <div class="avatar-img"
                                style="background-image: url('<?= $client->profile_pic ?>?v=<?=time()?>')">
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-semibold pb-1 mb-0  client-name"><?= $client->name ?></h5>
                        <span class="fs-13  text-muted"><i class='bx bx-envelope'></i>
                            <?= $client->email ?></span><br>
                        <span class="fs-13 text-muted"><i class='bx bxs-phone'></i>
                            <?= $client->mobile ?></span>
                        <p class='crm_number_area'><span class="badge bg-info-transparent">CRM :
                                <?= $client->crm_number ?> </span></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Mandatory Documents</div>

            </div>
            <div class="card-body pt-2">
                <div class="table-responsive">
                    <table class="table text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Document Name</th>
                                <th scope="col">Uploaded At</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $i = 0;
                                    foreach ($documents as $key => $document) {
                                        $i++;
                                        $dateTime = new DateTime($document->created_at);
                                        if($document->created_at && $document->up_status != 0){

                                            $statusText     =   'Uploaded';
                                            $statusColour   =   'success';
                                            $uploadDate     =   $dateTime->format('d M Y, h:i A');
                                            $icon           =   '<i class="ri-edit-line"></i>';
                                        }else{
                                            $statusText     = 'Pending';
                                            $statusColour   = 'warning';
                                            $uploadDate     =  '--';
                                            $icon           =  '<i class="ri-upload-2-line"></i>';
                                        }
                                        ?>
                            <tr>
                                <td><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i>
                                    <?= $document->name ?></td>
                                <td><?= $uploadDate ?></td>
                                <td><span class="badge bg-<?= $statusColour ?>-transparent"><?= $statusText ?></span>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">

                                        <a href="#" class="btn btn-icon btn-sm btn-light"
                                            <?= (($pushed) ? '' : 'data-bs-toggle="modal"')?>
                                            data-bs-target="#doc-<?= $i ?>"><?= $icon ?></a>


                                        <?php if($document->created_at){ ?>
                                        <a href="#" class='view-pdf btn btn-icon btn-sm btn-light'
                                            data-document-name="<?= $document->file_name ?>"
                                            class="btn btn-icon btn-sm btn-light">

                                            <i class="ri-eye-line"></i>

                                        </a>

                                        <?php } ?>

                                    </div>
                                </td>
                            </tr>
                            <?php
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <script>
    $(document).ready(function() {
        $(".view-pdf").click(function(e) {
            e.preventDefault();

            var clientId = "<?= $client->id?>";
            var documentName = $(this).data('document-name');

            $.ajax({
                type: "POST",
                url: "<?= base_url("Client/viewPdf") ?>",
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
    <div class="col-xl-3">
        <div class="card custom-card profile-process-status">
            <div class="card-header justify-content-between">
                <div class="card-title">Process Status</div>

            </div>
            <div class="card-body">
                <div class="progress-stacked progress-animate progress-xs mb-4">
                    <div class="progress-bar bg-<?= ($profileStatus['registration'] > 0) ? 'success' : 'warning' ?>"
                        role="progressbar" style="width: 21%" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <div class="progress-bar bg-<?= ($profileStatus['registrPayment'] > 0) ? 'success' : 'warning' ?>"
                        role="progressbar" style="width: 18%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <div class="progress-bar bg-<?= ($profileStatus['profilePic'] > 0) ? 'success' : 'warning' ?>"
                        role="progressbar" style="width: 26%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <div class="progress-bar bg-<?= ($profileStatus['mandatryDocs'] > 0) ? 'success' : 'warning' ?>"
                        role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                    </div>

                </div>

                <ul class="list-unstyled mb-0 pt-2 crm-deals-status">
                    <li class="<?= ($profileStatus['registration'] > 0) ? 'success' : 'warning' ?>">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>Registration</div>
                            <div class="fs-12 text-muted">
                                <?= ($profileStatus['registration'] > 0) ? 'Completed' : 'Pending' ?></div>
                        </div>
                    </li>
                    <li class="<?= ($profileStatus['registrPayment'] > 0) ? 'success' : 'warning' ?>">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>Registration Payments</div>
                            <div class="fs-12 text-muted">
                                <?= ($profileStatus['registrPayment'] > 0) ? 'Completed' : 'Pending' ?></div>
                        </div>
                    </li>
                    <li class="<?= ($profileStatus['profilePic'] > 0) ? 'success' : 'warning' ?>">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>Profile Photo</div>
                            <div class="fs-12 text-muted">
                                <?= ($profileStatus['profilePic'] > 0) ? 'Completed' : 'Pending' ?></div>
                        </div>
                    </li>
                    <li class="<?= ($profileStatus['mandatryDocs'] > 0) ? 'success' : 'warning' ?>">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>Mandatory Documents</div>
                            <div class="fs-12 text-muted">
                                <?= ($profileStatus['mandatryDocs'] > 0) ? 'Completed' : 'Pending' ?></div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-9">
        <div class="card custom-card recent-activity-area">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Recent Activities
                </div>
            </div>
            <div class="card-body">
                <div>
                    <ul class="list-unstyled mb-0 crm-recent-activity">

                        <?php

                        foreach ($activities as $key => $activity) {

                            $dateTime = new DateTime($activity->created_at);
                            if($activity->type == 1){
                                $color = 'success';
                            }
                            elseif($activity->type == 2){
                                $color = 'primary';
                            }
                            elseif($activity->type == 3){
                                $color = 'danger';
                            }
                            elseif($activity->type == 4){
                                $color = 'warning';
                            }
                           ?>
                        <li class="crm-recent-activity-content">
                            <div class="d-flex align-items-top">
                                <div class="me-3">
                                    <span class="avatar avatar-xs bg-<?= $color ?>-transparent avatar-rounded">
                                        <i class="bi bi-circle-fill fs-8"></i>
                                    </span>
                                </div>
                                <div class="crm-timeline-content">
                                    <span class="fw-semibold"><span
                                            class="text-<?= $color ?> fw-semibold"><?= $activity->span_1 ?>
                                        </span><?= $activity->text ?></span>
                                    <span class="text-<?= $color ?> fw-semibold"><?= $activity->span_2 ?> </span>

                                    <span class=" fw-semibold"><?= $activity->text2 ?> </span>
                                </div>
                                <div class="flex-fill text-end">
                                    <span
                                        class="d-block text-muted fs-11 op-7"><?= $dateTime->format('d M Y, h:i A') ?></span>
                                </div>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card custom-card action-area">
            <div class="card-header justify-content-between">
                <div class="card-title">Actions</div>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('Client/addRegPayment') ?>">
                    <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                    <select class="form-select mb-1" name="payment-type" aria-label="Default select example" required=""
                        <?= ($pushed) ? 'disabled' : ''?>>
                        <option value="">Select Payment Type</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Cash">Cash</option>
                    </select>
                    <div class="input-group">
                        <input type='hidden' name='client-id' value='<?= $client->id?>'>
                        <input type="number" class="form-control reg-amount"
                            <?= ($firstPayment == 0) ? "min='200000'" : ''?> name='milestone-amount'
                            placeholder="Enter Amount" required <?= ($pushed) ? 'readonly' : ''?>>
                        <button type="submit" class="btn btn-primary" type="button" id="button-addon2"
                            <?= ($pushed) ? 'disabled' : ''?>>PAY</button>
                    </div>


                </form>
                <hr>
                <div class="d-flex gap-3 mt-4 push-btn">
                    <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                    <button type="submit" id='pushBtn' class="btn btn-success-gradient shadow-success btn-wave"
                        <?= ($pushed) ? 'disabled' : ''?>><span>PUSH TO
                            DOCUMENT</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>


</div>
<!-- END MAIN-CONTENT -->


<div class="modal fade" id="change-profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Client/changeProfilePic') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">Change Profile Picture</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <input type="file" class="form-control" name='profile_pic'
                            accept="image/jpeg, image/jpg, image/png" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="doc-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Client/uploadMandateryDocs') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">UPLOAD <b>SIGNED AGREEMENT</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <input type='hidden' name='doc_id' value='1'>
                        <input type='hidden' name='doc_name' value='SIGNED AGREEMENT'>
                        <input type="file" class="form-control" name='doc_file' accept="application/pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="doc-2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Client/uploadMandateryDocs') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">UPLOAD <b>INVOICE/RECEIPT</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <input type='hidden' name='doc_id' value='2'>
                        <input type='hidden' name='doc_name' value='INVOICE RECEIPT'>
                        <input type="file" class="form-control" name='doc_file' accept="application/pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="doc-3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Client/uploadMandateryDocs') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">UPLOAD <b>CV</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <input type='hidden' name='doc_id' value='7'>
                        <input type='hidden' name='doc_name' value='CV'>
                        <input type="file" class="form-control" name='doc_file' accept="application/pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="doc-4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Client/uploadMandateryDocs') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">UPLOAD <b>PASSPORT - FRONT</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <input type='hidden' name='doc_id' value='8'>
                        <input type='hidden' name='doc_name' value='PASSPORT - FRONT'>
                        <input type="file" class="form-control" name='doc_file' accept="application/pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="doc-5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Client/uploadMandateryDocs') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">UPLOAD <b>PASSPORT - BACK</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <input type='hidden' name='doc_id' value='9'>
                        <input type='hidden' name='doc_name' value='PASSPORT - BACK'>
                        <input type="file" class="form-control" name='doc_file' accept="application/pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#pushBtn').click(function() {



        var clientId = "<?= $client->id?>";
        var handled_by = "<?= $client->handle_deprt?>";
        var profileStatus = "<?= array_sum($profileStatus) ?>";
        if (profileStatus == 100) {
            if (handled_by == 1) {

                let timerInterval;
                Swal.fire({
                    title: "Push to Documentation",
                    html: "will be done in <b></b> milliseconds.",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });


                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("Client/pushToDoc")?>',
                    data: {
                        clientId: clientId
                    },
                    success: function(response) {
                        location.reload();
                    },
                });
            } else {
                alert('Sorry! Already Pushed');
            }
        } else {
            alert('Profile not completed');
        }

    });
});
</script>

<?php
$this->load->view('master/footer');
$end_time = microtime(true);
$execution_time = ($end_time - $start_time);
echo "<script>console.log(' Page load : {$execution_time}')</script>"
?>