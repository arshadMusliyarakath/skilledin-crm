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
                           <div class="row gy-4 mb-4">
                              <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                              <div class="col-xl-6">
                                 <label class="form-label">Full Name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter Name" required="">
                              </div>
                              <div class="col-xl-6">
                                 <label class="form-label">Email Address</label>
                                 <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required="">
                              </div>
                              <div class="col-xl-6">
                                 <label class="form-label">Mobile Number :</label>
                                 <input type="number" class="form-control" name="mobile" placeholder="Enter Mobile Number" required="">
                              </div>
                              <div class="col-xl-6">
                              <label class="form-label">Select Product:</label>
                                 <select class="mutiselect select2-hidden-accessible" name="product[]" multiple="" data-select2-id="select2-data-4-z0ss" tabindex="-1"  aria-hidden="true" required="">
                                       <?php
                                          foreach ($products as $key => $product) { 
                                                ?>
                                                      <option value="<?= $product->id ?>"><?= $product->product_name ?>
                                                      </option>
                                                <?php
                                          }
                                       ?>
                                 </select>
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
               <button class="btn btn-light m-1" onclick="goBack()">Cancel</button>
               <button class="btn btn-primary m-1">Save Manager</button>
            </div>
         </div>
      </div>
      </form>

   </div>
</div>
</div>
</div> 
<!-- END MAIN-CONTENT -->

<script>
$(document).ready(function() {
    $('.mutiselect').select2();
});
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
   function goBack() {
       window.history.back();
   }
</script>
<?php $this->load->view('master/footer') ?>
