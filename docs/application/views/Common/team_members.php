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
                            <div class="card-title"> Sales Consultant List</div>
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
                                             <th>Email</th>
                                             <th>Status</th>
                                             <th width="10%">Clients</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                            <?php
                                                $i = 0;
                                                foreach ($users as $key => $user) {
                                                    $i++;
                                                    if($user->status == 1){
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
                                                                <td><a class='btn btn-link' href="<?= base_url('Common/viewConsultant/' . $user->id) ?>" ><?= $user->name ?></a></td>
                                                                <td><?= $this->Common_model->ExplodeProductName($user->product_id); ?></td>
                                                                <td><?= $user->email ?></td>
                                                                <td><i class="ri-checkbox-blank-circle-fill align-middle me-2 d-inline-block <?= $statusIcon ?>"></i> <?= $text ?></td>
                                                                <td>
                                                                    <a href="<?= base_url('Common/MyClients/' . $user->id) ?>" class="btn btn-success"><i class="fa fa-users" aria-hidden="true"></i></a>
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

       
