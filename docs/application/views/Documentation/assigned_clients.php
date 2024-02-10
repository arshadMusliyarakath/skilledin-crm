<?php $this->load->view('master/header') ?>



<?php

              $success_message = $this->session->flashdata('success');

              if ($success_message) { echo '<p class="alert alert-success">' . $success_message . '</p>'; }

            ?>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="head-bar">

                    <div class="card-title"> Assigned Client List</div>

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

                                            <th>Product Type</th>

                                            <th>Assigned date</th>

                                            <th>Profile Status</th>

                                            <th>Service Status</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        

                                            $value = '';

                                            $i = 0;

                                            foreach ($assignedClients as $key => $client) {

                                                $date = new DateTime($client->assigned_at);



                                                $lastStageStatus = $this->Client_model->lastStageStatus($client->id);

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

                                                

                                                

                                                if($client->profile_status == 0) {



                                                    $prfStatus    =   'ON-HOLD';

                                                    $prfColour    =   'warning';



                                                }elseif($client->profile_status == 1) {



                                                    $prfStatus    =   'IN-PROGRESS';

                                                    $prfColour    =   'success';

                                                    

                                                }else{



                                                    $prfStatus    =   'REFUND';

                                                    $prfColour    =   'danger';



                                                }

                                                    

                                                $i++;

                                                

                                                ?>

                                        <tr>

                                            <td><?= $i ?></td>

                                            <td><a class='btn btn-link'

                                                    href="<?= base_url('Client/docsView/' . $client->id) ?>"><?= $client->name ?></a>

                                            </td>

                                            <td><?= $client->product_name ?></td>

                                            <td><?= $date->format('d M Y, h:i A') ?></td>

                                            <td><span

                                                    class="badge bg-<?= $prfColour ?>-transparent"><?= $prfStatus ?></span>

                                            </td>

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

</div>



</div>





</div>

<!-- END MAIN-CONTENT -->



<?php $this->load->view('master/footer') ?>











<script>

$(document).ready(function() {

    $('#hidden-columns').DataTable();

});

</script>







<!-- DATATABLES CDN JS -->



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>