<?php $this->load->view('master/header') ?>
<div class="row">
   <div class="col-xl-12">
    <form method="POST">
      <div class="card custom-card">
         <div class="card-body">
            <div class="table-responsive">
               <div id="hidden-columns_wrapper" class="dataTables_wrapper dt-bootstrap5">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="p-sm-3 p-0">
                          <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                           <div class="row gy-4 mb-4">
                              <input type="hidden" name="id" value="<?= $user->id?>">
                              <div class="col-xl-6">
                                 <label class="form-label">Full Name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?= $user->name?>" required="">
                              </div>
                              <div class="col-xl-6">
                                 <label class="form-label">Email Address</label>
                                 <input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="<?= $user->email?>" required="">
                              </div>
                              <div class="col-xl-6">
                                 <label class="form-label">Mobile Number :</label>
                                 <input type="number" class="form-control" name="mobile" placeholder="Enter Mobile Number" value="<?= $user->mobile?>" pattern="[0-9]{10}" title="Please enter a 10-digit number" required="">
                              </div>

                              <?php $selected = json_decode($user->product_id);?>

                              <div class="col-xl-6">
                                 <label class="form-label">Select Product:</label>
                                 <select class="mutiselect select2-hidden-accessible" name="product[]"
                                       multiple="" data-select2-id="select2-data-4-z0ss" tabindex="-1"
                                       aria-hidden="true" required="">
                                       <?php
                                          $i = 0;
                                          foreach ($products as $key => $product) {
                                                ?>
                                                      <option value="<?= $product->id ?>" <?= ($selected[$i] == $product->id) ? 'selected' : '' ?>><?= $product->product_name  ?>
                                                      </option>
                                                <?php
                                                $i++;
                                          }
                                       ?>

                                 </select>
                              </div>
                              <div class="col-xl-2">
                                 <label class="form-label">Status :</label>
                                    
                                    <div class="form-check form-switch mb-2">
                                     <input class="form-check-input" type="checkbox" role="switch" id="switch-primary" name="status" <?= ($user->status == 1) ? 'checked' : '' ?>>
                                     <label class="form-check-label" for="switch-primary"><?= ($user->status == 1) ? 'Active' : 'Inactive' ?></label>
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="float-end">
               <a  class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#delete">Delete</a>
               <button class="btn btn-primary m-1">Save Changes</button>
            </div>
         </div>
      </div>
      </form>

   </div>
</div>
</div>
</div> 
<!-- END MAIN-CONTENT -->





<div class="modal fade" id="delete" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel1">Confirm delete?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you want to delete <?= $user->name ?> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Close</button>
                <a href="<?= base_url('Sales/deleteSalesConsultant/' . $user->id) ?>" class="btn btn-danger">Yes, delete</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.mutiselect').select2();
});
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
$(document).ready(function() {
    // Attach an event listener to the checkbox change event
    $('#switch-primary').change(function() {
        // Update the label text based on the checkbox state
        var labelText = $(this).prop('checked') ? 'Active' : 'Inactive';
        $(this).next('label').text(labelText);
    });
});
</script>

<?php $this->load->view('master/footer') ?>




