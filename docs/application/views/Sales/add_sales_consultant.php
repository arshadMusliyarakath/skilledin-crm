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
                                 <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" pattern="[0-9]{10}" title="Please enter a 10-digit number" required="">
                              </div>
                              <div class="col-xl-6">
                                 <label class="form-label">Select Product:</label>
                                 <select class="form-select" name="product"  aria-label="Default select example" required="">
                                    <option value="">Select Product Type</option>
                                    <?php
                                       foreach ($products as $key => $product) {
                                           ?>
                                    <option value="<?= $product->id ?>"><?= $product->product_name  ?></option>
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
   function goBack() {
       window.history.back();
   }
</script>
<?php $this->load->view('master/footer') ?>
