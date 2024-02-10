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
                    <div class="card-title"> Managers List</div>
                    <div class="btn-area">
                        <ul>
                            <li><a href="<?= base_url('Manager/addManager') ?>" class="btn btn-primary mb-2">Add
                                    Manager</a></li>
                        </ul>
                    </div>
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
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $i = 0;
                                                foreach ($managers as $key => $manager) {
                                                    $i++;
                                                    if($manager->status == 1){
                                                        $text = 'Active';
                                                        $statusIcon = 'text-success';
                                                    }
                                                    else{
                                                        $text = 'Inactive';
                                                        $statusIcon = 'text-danger';
                                                    }
                                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><a class='btn btn-link'
                                                    href="<?= base_url('Common/TeamMembers/' . $manager->id.'/'.$manager->role) ?>"><?= $manager->name ?></a>
                                            </td>
                                            <td><?= $manager->role_name ?></td>
                                            <td><?= $manager->email ?></td>
                                            <td><i
                                                    class="ri-checkbox-blank-circle-fill align-middle me-2 d-inline-block <?= $statusIcon ?>"></i>
                                                <?= $text ?></td>
                                           
                                            <td><a class='btn btn-success'
                                                    href="<?= base_url('Manager/viewManager/' . $manager->id)  ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
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