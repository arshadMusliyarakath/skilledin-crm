<?php $this->load->view('master/header') ?>

            <?php
              $success_message = $this->session->flashdata('success');
              if ($success_message) { echo '<p class="alert alert-success">' . $success_message . '</p>'; }
            ?>
            <div class="row">
               <div class="col-xl-12">
                  <div class="card custom-card">
                     <div class="card-header justify-content-between">
                        <div class="card-title">Mail Template List</div>
                        <div class="prism-toggle">
                            <a href="<?= base_url('Mail/NewMail')?>" class="btn btn-primary">Add New</a>
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
                                             <th>Title</th>
                                             <th>Subject</th>
                                             <th>Message</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                            <?php
                                                $i = 0;
                                                foreach ($templates as $key => $mailTemp) {
                                                    $i++;
                                                   
                                                    ?>
                                                            <tr>
                                                                <td><?= $i ?></td>
                                                                <td><?= $mailTemp->title ?></td>
                                                                <td><?= $mailTemp->subject ?></td>
                                                                <td style="font-size: 11px; width: 50px;"><?= substr(strip_tags($mailTemp->message), 0, 60) ?>...</td>
                                                         
                                                                <td>
                                                                    <a href="<?= base_url('Mail/editMail/' . $mailTemp->id) ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

       
