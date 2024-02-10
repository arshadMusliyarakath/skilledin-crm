<div class="row">
   <div class="col-xl-4">
      <div class="card custom-card client-profile-progress">
         <div class="card-body">
            <div class="d-flex align-items-top justify-content-between mb-4">
               <div>
                  <span class="d-block fs-15 fw-semibold">Profile</span>
               </div>
               <div class="dropdown">
                  <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"
                     data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fe fe-more-vertical"></i>
                  </a>
                  <ul class="dropdown-menu" style="">
                     <li><a class="dropdown-item" href="#" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">View / Edit</a></li>
                     <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#change-profile">Change Profile Pic</a></li>
                  </ul>
               </div>
            </div>
            <div class="text-center mb-4">
               <div class="mb-1">
                  <div class="client-avatar-area">
                     <div class="avatar-img"
                        style="background-image: url('<?= $client->profile_pic ?>?v=<?=time()?>')">
                     </div>
                  </div>
               </div>
               <div>
                  <h5 class="fw-semibold pb-1 mb-0  client-name"><?= $client->name ?></h5>
                  <span class="fs-13  text-muted"><i class='bx bx-envelope'></i>
                  <?= $client->email ?></span><br>
                  <p class='crm_number_area'><span class="badge bg-info-transparent">CRM :
                     <?= $client->crm_number ?> </span>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4">
      <div class="card custom-card client-profile-progress">
         <div class="card-body">
            <ul class="list-unstyled mb-0 upcoming-events-list">
               <li>
                  <div class="d-flex align-items-top justify-conent-between">
                     <div class="flex-fill">
                        <p class="mb-0 fs-14">Contact Number </p>
                        <p class="mb-0 text-muted"><?= $client->mobile ?></p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="d-flex align-items-top justify-conent-between">
                     <div class="flex-fill">
                        <p class="mb-0 fs-14">Date of Birth</p>
                        <p class="mb-0 text-muted"><?= $client->dob ?></p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="d-flex align-items-top justify-conent-between">
                     <div class="flex-fill">
                        <p class="mb-0 fs-14">Country</p>
                        <p class="mb-0 text-muted"><?= $client->country ?></p>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="d-flex align-items-top justify-conent-between">
                     <div class="flex-fill">
                        <p class="mb-0 fs-14">Qualification</p>
                        <p class="mb-0 text-muted"><?= $client->qualification ?></p>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="col-xl-4">
      <div class="card custom-card card-bg-light-gradient text-fixed-white">
         <div class="card-body p-0">
            <div class="d-flex align-items-top p-4 flex-wrap">
               <div class="me-3 lh-1">
                  <span class="avatar avatar-md avatar-rounded bg-success text-white shadow-sm">
                  <i class="bx bxs-briefcase fs-5"></i>
                  </span>
               </div>
               <div class="flex-fill" style="width:70%">
                  <p class="op-7 mb-0 fs-12">Service Detials</p>
                  <h5 class="fw-semibold fs-15 mt-1">UK, Caregiver</h5>
               </div>
            </div>
         </div>
      </div>
      <div class="card custom-card card-bg-light-gradient text-fixed-white">
         <div class="card-body p-0">
            <div class="d-flex align-items-top p-4 flex-wrap">
               <div class="me-3 lh-1 mt-1">
                  <span class="avatar avatar-md avatar-rounded bg-success text-white shadow-sm">
                  <i class="bx bxs-star fs-5"></i>
                  </span>
               </div>
               <div class="flex-fill" style="width:70%">
                  <p class="op-7 mb-0 fs-12">Requirement</p>
                  <h5 class="fw-semibold fs-15 mt-1">
                     <?= $this->Common_model->ExplodeArray($client->requirement) ?>
                  </h5>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="change-profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form method="POST" action="<?= base_url('Client/changeProfilePic') ?>" enctype="multipart/form-data">
            <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
            <div class="modal-header">
               <h6 class="modal-title" id="exampleModalLabel1">Change Profile Picture</h6>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="input-group mb-3">
                  <input type='hidden' name='id' value='<?= $client->id?>'>
                  <input type="file" class="form-control" name='profile_pic'
                     accept="image/jpeg, image/jpg, image/png" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- DATE & TIME PICKER JS -->
<script src="<?= base_url('build/assets/libs/flatpickr/flatpickr.min.js'); ?>"></script>
<!-- Edit / View Profile -->
<div class="offcanvas offcanvas-end edit_profile_offcanvase" tabindex="-1" id="offcanvasRight"
   aria-labelledby="offcanvasRightLabel1">
   <div class="offcanvas-header border-bottom border-block-end-dashed">
      <h5 class="offcanvas-title" id="offcanvasRightLabel1">Edit / View Profile
      </h5>
      <a type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></a>
   </div>
   <div class="offcanvas-body p-0">
      <div class="p-sm-3 p-0">
         <form action="<?= base_url('Client/updateClient')?>" method="post">
            <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
            <input type="hidden" value='<?= $client->id ?>' name='id'>
            <label class="form-label">Full Name</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-user"></i></div>
                  <input type="text" class="form-control" name="name" value='<?= $client->name ?>'
                     placeholder="Enter Full Name" required="">
               </div>
            </div>
            <label class="form-label">CRM Number</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-laptop"></i></div>
                  <input type="number" class="form-control" name="crm_number" value='<?= $client->crm_number ?>'
                     placeholder="Enter CRM Number" required="">
               </div>
            </div>
            <label class="form-label">Product</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-layer"></i></div>
                  <select class="form-select" name="product" aria-label="Default select example" required="">
                     <option value="">Select Product</option>
                     <?php
                        foreach ($products as $key => $product) {
                        
                        ?>
                     <option value="<?= $product->id ?>"
                        <?= ($product->id == $client->product) ? 'selected' : ''?>>
                        <?= $product->product_name ?>
                     </option>
                     <?php
                        }
                        
                        ?>
                  </select>
               </div>
            </div>
            <label class="form-label">Country</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-globe"></i></div>
                  <input type="text" class="form-control" name="country" placeholder="Enter Country Name"
                     value='<?= $client->country ?>' required="">
               </div>
            </div>
            <label class="form-label">Agreement Date</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-calendar"></i></div>
                  <input type="text" class="form-control" id="agreement-date"
                     value='<?= $client->agreement_date ?>' name="agreement_date" placeholder="Choose date">
               </div>
            </div>
            <label class="form-label">Closing Amount</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted">₹</div>
                  <input type="number" class="form-control" name="close_amt" value='<?= $client->close_amt ?>'
                     placeholder="Enter Closing Amount" required="">
               </div>
            </div>
            <label class="form-label">Mobile Number</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-mobile"></i></div>
                  <input type="text" class="form-control" name="mobile" id="mobile"
                     placeholder="Enter Mobile Number" pattern="[0-9]{10}" title="Please enter a 10-digit number"
                     value='<?= $client->mobile ?>' required="">
               </div>
            </div>
            <label class="form-label">Email Address</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-envelope"></i></div>
                  <input type="email" class="form-control" name="email" id="email" value='<?= $client->email ?>'
                     placeholder="Enter Email Address" required="">
               </div>
            </div>
            <label class="form-label">Present Address</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-buildings"></i></div>
                  <input type="text" class="form-control" name="address" value='<?= $client->address ?>'
                     placeholder="Enter Present Address" required="">
               </div>
            </div>
            <label class="form-label">Passport Number</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-envelope"></i></div>
                  <input type="text" class="form-control" name="passport_no" id="passport_no"
                     placeholder="Enter Passport Number" value='<?= $client->passport_no ?>' required="">
               </div>
            </div>
            <label class="form-label">Date of Birth</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-calendar"></i></div>
                  <input type="text" class="form-control" id="date-of-birth" value='<?= $client->dob ?>'
                     name="dob" placeholder="Choose date">
               </div>
            </div>
            <label class="form-label">Occupation</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-briefcase-alt-2"></i></div>
                  <input type="text" class="form-control" name="occupation" value='<?= $client->occupation ?>'
                     placeholder="Enter Occupation" required="">
               </div>
            </div>
            <label class="form-label">Qualification</label>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-text text-muted"><i class="bx bx-trophy"></i></div>
                  <input type="text" class="form-control" name="qualification"
                     value='<?= $client->qualification ?>' placeholder="Enter Qualification" required="">
               </div>
            </div>
            <div class="col-xl-12">
               <label class="form-label">Remarks (optional)</label>
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-text text-muted"><i class="bx bx-news"></i></div>
                     <textarea class="form-control" name="remarks"
                        placeholder="Enter Remarks"><?= $client->remarks ?></textarea>
                  </div>
               </div>
            </div>
            <button type="submit"
               class="btn btn-primary-gradient btn-lg w-100 btn-wave waves-effect waves-light mt-3">
            Update Profile</button>
         </form>
      </div>
   </div>
</div>
<script>
   flatpickr("#agreement-date", {
   
       dateFormat: "Y-m-d",
   
   });
   
   flatpickr("#date-of-birth", {
   
       dateFormat: "Y-m-d",
   
   });
   
</script>
<script>
   $(document).ready(function() {
   
       $('#mobile').on('blur', function() {
   
           var mobileNumber = $(this).val();
   
           var url = '<?= base_url("Client/CheckMobileExist")?>';
   
           $.ajax({
   
               url: url,
   
               method: 'POST',
   
               data: {
   
                   mobile: mobileNumber
   
               },
   
               success: function(data) {
   
                   if (data == 1) {
   
                       alert('Mobile Number already exists!');
   
                       $('#mobile').val('');
   
                   }
   
               },
   
           });
   
       });
   
   
   
   
   
       $('#email').on('blur', function() {
   
           var email = $(this).val();
   
           var url = '<?= base_url("Client/CheckEmailExist")?>';
   
           $.ajax({
   
               url: url,
   
               method: 'POST',
   
               data: {
   
                   email: email
   
               },
   
               success: function(data) {
   
                   if (data == 1) {
   
                       alert('Email address already exists!');
   
                       $('#mobile').val('');
   
                   }
   
               },
   
           });
   
       });
   
   
   
   
   
       $('#passport_no').on('blur', function() {
   
           var passport_no = $(this).val();
   
           var url = '<?= base_url("Client/CheckPassportExist")?>';
   
           $.ajax({
   
               url: url,
   
               method: 'POST',
   
               data: {
   
                   passport_no: passport_no
   
               },
   
               success: function(data) {
   
                   if (data == 1) {
   
                       alert('Passport number already exists!');
   
                       $('#passport_no').val('');
   
                   }
   
               },
   
           });
   
       });
   
   });
   
</script>