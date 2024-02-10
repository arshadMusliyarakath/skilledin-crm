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
                            <div class="card-title"> Products List</div>
                            <div class="btn-area">
                                <ul>
                                    <li><a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal"
              data-bs-target="#add">Add Product</a></li>
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
                                             <th>Product Name</th>
                                             <th width="20%">Status</th>
                                             <th width="10%">View</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                            <?php
                                                $i = 0;
                                                foreach ($datas as $key => $data) {
                                                    $i++;
                                                    if($data->status == 1){
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
                                                            <td><?= $data->product_name ?></td>
                                                            <td><i class="ri-checkbox-blank-circle-fill align-middle me-2 d-inline-block <?= $statusIcon ?>"></i> <?= $text ?></td>
                                                            <td>
                                   <a href="#" data-bs-toggle="modal" data-bs-target="#view_<?= $i ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                              </td>
                                                        </tr>

                                                        <div class="modal fade" id="view_<?= $i ?>" tabindex="-1"
                                                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h6 class="modal-title" id="exampleModalLabel1">Products Actions</h6>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                  aria-label="Close"></button>
                                                          </div>
                                                          <form method="POST" action="<?= base_url('Utility/updateProduct') ?>">
                                                            <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                                                <div class="modal-body">
                                                                        <input type="hidden" name="id" value="<?= $data->id ?>">
                                                                        <div class="col-xl-12">
                                                                           <label class="form-label">Product Name</label>
                                                                           <input type="text" class="form-control" name="product_name" value="<?= $data->product_name ?>" placeholder="Enter Role Name" required="">
                                                                        </div>
                                                                        <div class="col-xl-12 mt-3">
                                                                         <label class="form-label">Status :</label>
                                                                            
                                                                            <div class="form-check form-switch mb-2">
                                                                             <input class="form-check-input" type="checkbox" role="switch" id="switch-primary" name="status" <?= ($data->status == 1) ? 'checked' : '' ?>>
                                                                             <label class="form-check-label" for="switch-primary"><?= ($data->status == 1) ? 'Active' : 'Inactive' ?></label>
                                                                         </div>
                                                                      </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="#" class="btn btn-light" data-bs-dismiss="modal">Close</a>
                                                                <!--     <a href="#" class="btn btn-danger">Delete</a> -->
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
               </div>
            </div>

                </div>


            </div> 
            <!-- END MAIN-CONTENT -->

          <div class="modal fade" id="add" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h6 class="modal-title" id="exampleModalLabel1">Add New Product</h6>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                              aria-label="Close"></button>
                      </div>
                      <form method="POST" action="<?= base_url('Utility/addProduct') ?>">
                        <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                            <div class="modal-body">
                                    <div class="col-xl-12">
                                       <label class="form-label">Product Name</label>
                                       <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required="">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-light"
                                    data-bs-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                      </form>
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

       
