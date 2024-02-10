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
                            <div class="card-title"> Clients List</div>
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
                                             <th>SL</th>
                                             <th>CRM No</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Mobile</th>
                                             <th>Product</th>
                                             <th>Status</th>
       
                                          </tr>
                                       </thead>
                                       <tbody>
                                            <?php
                                                $i = 0;
                                                foreach ($clients as $key => $client) {
                                                    $i++;
                                                    if($client->handle_deprt == 2){
                                                      $statusColur = 'success';
                                                      $statusText  = 'PUSHED';
                                                    }
                                                    else
                                                    {
                                                      $statusColur = 'warning';
                                                      $statusText  = 'PENDING';
                                                    }
                                                    ?>
                                                            <tr>
                                                                <td><?= $i ?></td>
                                                                <td><?= $client->crm_number ?></td>
                                                                <td><a class='btn btn-link' href="<?= base_url('Client/salesView/' . $client->id) ?>" ><?= $client->name ?></a></td>
                                                                <td><?= $client->email ?></td>
                                                                <td><?= $client->mobile ?></td>
                                                                <td><?= $client->product_name ?></td>
                                                                <td><span class="badge bg-<?=$statusColur?>-gradient"><?=$statusText?></span></td>
                                                         
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

       
