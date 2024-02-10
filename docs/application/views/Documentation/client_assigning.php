<?php $this->load->view('master/header') ?>

<?php
$success_message = $this->session->flashdata('success');
if ($success_message) {
    echo '<p class="alert alert-success">' . $success_message . '</p>';
}
?>
<div class="row">
    <div class="col-xl-9">
        <div class="card custom-card">
            <div class="card-header">
                <div class="head-bar">
                    <div class="card-title"> Waiting List</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hidden-columns_wrapper" class="dataTables_wrapper dt-bootstrap5">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="hidden-columns" class="table table-bordered text-nowrap w-100 dataTable">
                                    <thead>
                                        <tr>
                                            <th width="10%">SL</th>
                                            <th>Name</th>
                                            <th>Sales Consultent</th>
                                            <th>Product Type</th>
                                            <th width="10%">Assign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $value = '';
                                        $i = 0;
                                        foreach ($waitingClients as $key => $client) {
                                            $i++;

                                            ?>
                                        <tr>
                                            <td>
                                                <?= $i ?>
                                            </td>
                                            <td>
                                                <b><?= $client->name ?></b>
                                            </td>
                                            <td>
                                                <?= $client->consultant_name ?>
                                            </td>
                                            <td>
                                                <?= $client->product_name ?>
                                            </td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#assign_<?= $i ?>">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-primary"
                                                        enable-background="new 0 0 24 24" height="24px"
                                                        viewBox="0 0 24 24" width="24px" fill="#000000">
                                                        <g>
                                                            <rect fill="none" height="24" width="24" />
                                                        </g>
                                                        <g>
                                                            <path
                                                                d="M20,9V6h-2v3h-3v2h3v3h2v-3h3V9H20z M9,12c2.21,0,4-1.79,4-4c0-2.21-1.79-4-4-4S5,5.79,5,8C5,10.21,6.79,12,9,12z M9,6 c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2S7,9.1,7,8C7,6.9,7.9,6,9,6z M15.39,14.56C13.71,13.7,11.53,13,9,13c-2.53,0-4.71,0.7-6.39,1.56 C1.61,15.07,1,16.1,1,17.22V20h16v-2.78C17,16.1,16.39,15.07,15.39,14.56z M15,18H3v-0.78c0-0.38,0.2-0.72,0.52-0.88 C4.71,15.73,6.63,15,9,15c2.37,0,4.29,0.73,5.48,1.34C14.8,16.5,15,16.84,15,17.22V18z" />
                                                        </g>
                                                    </svg>






                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="assign_<?= $i ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="exampleModalLabel1">Client Assigning
                                                            to Case Manager</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST"
                                                        action="<?= base_url('Documentation/AssignToDoc/') ?>">
                                                        <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                                        <div class="modal-body">
                                                            <div class="input-group mb-3">
                                                                <div class="col-xl-12">
                                                                    <input type='hidden' name='client'
                                                                        value="<?= $client->id ?>">
                                                                    <input type='hidden' name='client-email'
                                                                        value="<?= $client->email ?>">
                                                                    <label class="form-label">Select Case Manager
                                                                        :</label>
                                                                    <select class="form-select" name="case-manager"
                                                                        aria-label="Default select example" required="">
                                                                        <option value="">Select</option>
                                                                        <?php foreach ($todayLogins as $key => $loginUser) { ?>
                                                                        <option value="<?= $loginUser->id ?>">
                                                                            <?= $loginUser->name ?>
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-success">Assign</button>
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
                </div>
            </div>


        </div>

        <div class="card custom-card">
            <div class="card-header">
                <div class="head-bar">
                    <div class="card-title"> Assigned Clients (
                        <?= date('M-Y') ?> )
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hidden-columns_wrapper" class="dataTables_wrapper dt-bootstrap5">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="hidden-columns2" class="table table-bordered text-nowrap w-100 dataTable">

                                    <thead>
                                        <tr>
                                            <th width="10%">SL</th>
                                            <th>Name</th>
                                            <th>Case Manager</th>
                                            <th>Product Type</th>
                                            <th>Service Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $i = 0;
                                                foreach ($assignedClients as $key => $assignedClient) {
                                                    $i++;

                                                    $lastStageStatus = $this->Client_model->lastStageStatus($assignedClient->id);
                                                    if($lastStageStatus[0]->option_name == 'DROP OUT') {
                                                        $serviceStatus      =   strtoupper($lastStageStatus[0]->stage_name." : ".$lastStageStatus[0]->option_name);
                                                        $serviceClr         =   'danger';
                                                    }elseif($lastStageStatus[0]->stage_name != NULL) {
                                                        $serviceStatus      =   strtoupper($lastStageStatus[0]->stage_name." : ".$lastStageStatus[0]->option_name);
                                                        $serviceClr         =   'success';
                                                    }else{
                                                        $serviceStatus      =   'PENDING';
                                                        $serviceClr         =   'warning';
                                                    }
                                                   
                                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><a class='btn btn-link'
                                                    href="<?= base_url('Client/docsView/').$assignedClient->id ?>"><?= $assignedClient->name ?></a>
                                            </td>
                                            <td><?= $assignedClient->case_manager ?></td>
                                            <td><?= $assignedClient->product_name ?></td>
                                            <td><span
                                                    class="badge bg-<?= $serviceClr ?>-transparent"><?= $serviceStatus ?></span>
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
            </div>

        </div>
    </div>

    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-header">
                <div class="head-bar">
                    <div class="card-title"> Today Login's</div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group mb-0">
                    <?php
                    $i = 1;
                    foreach ($todayLogins as $key => $loginUser) {
                        $dateTime = DateTime::createFromFormat('H:i:s', $loginUser->in_time);
                        ?>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-sm bg-light text-default fw-semibold">
                                    <?= $i;
                                        $i++ ?>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <p class="mb-0 fw-semibold">
                                    <?= $loginUser->name ?>
                                </p>
                            </div>
                            <div>
                                <span class="text-success">
                                    <?= $dateTime->format('h:i A') ?>
                                </span>
                            </div>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-header">
                <div class="head-bar">
                    <div class="card-title"> No. of Cases ( <?= date('M-Y') ?> )</div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group mb-0">
                    <?php
                    $i = 1;
                    foreach ($getCaseCount as $key => $caseCount) {
                    
                        ?>
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-sm bg-light text-default fw-semibold">
                                    <?= $i;
                                        $i++ ?>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <p class="mb-0 fw-semibold">
                                    <?= $caseCount->name ?>
                                </p>
                            </div>
                            <div>
                                <span class="avatar avatar-sm bg-orange-gradient">
                                    <?= $caseCount->client_count ?>
                                </span>
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







</div>


</div>
<!-- END MAIN-CONTENT -->





<?php $this->load->view('master/footer') ?>





<script>
$(document).ready(function() {
    $('#hidden-columns').DataTable();
    $('#hidden-columns2').DataTable();
});
</script>



<!-- DATATABLES CDN JS -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>