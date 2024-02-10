<?php
   $start_time = microtime(true);
   
   $this->load->view('master/header');
   
   ?>
<?php
   $baseUrl = base_url();
   
   
   
   //Profile Status
   
   $profileStatus = [
   
       'registration'      =>  25,
   
       'profilePic'        =>  ($client->profile_pic != NULL) ? 25 : 0,
   
       'mandatryDocs'      =>  ($up_docs_count >= 5) ? 25 : 0,
   
       'registrPayment'    =>  ($regPaymntStatus >= 1) ? 25 : 0,
   
   ];
   
      
   
       $success_message = $this->session->flashdata('success');
   
       if ($success_message) { echo '<p class="alert alert-success">' . $success_message . '</p>'; }
   
   
   
       $update_message = $this->session->flashdata('update');
   
       if ($update_message) { echo '<p class="alert alert-info">' . $update_message . '</p>'; }
   
   
       $DueNote = $this->session->flashdata('DueNote');
   
       if ($DueNote) { 
   
           ?>
<div class="alert alert-warning d-flex align-items-center" role="alert">
   <svg class="flex-shrink-0 me-2 svg-warning" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
      height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
      <g>
         <rect fill="none" height="24" width="24" />
      </g>
      <g>
         <g>
            <g>
               <path d="M12,5.99L19.53,19H4.47L12,5.99 M12,2L1,21h22L12,2L12,2z" />
               <polygon points="13,16 11,16 11,18 13,18" />
               <polygon points="13,10 11,10 11,15 13,15" />
            </g>
         </g>
      </g>
   </svg>
   <div>
      <?= $DueNote?>
   </div>
</div>
<?php
   }  
   
   ?>
<div class="row">
   <div class="col-xl-9">
      <div class="card custom-card crm-highlight-card mb-3" style=''>
         <div class="card-body p-0">
            <div class="row">
               <div class="col-xl-4 border-end border-inline-end-dashed">
                  <div class="d-flex flex-wrap align-items-top p-2">
                     <div class="flex-fill text-center">
                        <div class="fw-semibold fs-15  text-fixed-white">Name: <?= $client->name ?></div>
                        <span class="d-block fs-12 text-fixed-white"><span class="op-7">(UK
                        Caregiver)</span></span>
                     </div>
                  </div>
               </div>
               <?php
                  if($lastStageStatus[0]->option_name == 'DROP OUT'){
                  
                      $clr = 'danger';
                  
                      $titleText = strtoupper($lastStageStatus[0]->stage_name." : ".$lastStageStatus[0]->option_name);
                  
                  }elseif($lastStageStatus[0]->stage_name){
                  
                      $clr = 'success';
                  
                      $titleText = strtoupper($lastStageStatus[0]->stage_name." : ".$lastStageStatus[0]->option_name);
                  
                  }else{
                  
                      $clr = 'warning';
                  
                      $titleText = 'PENDING';
                  
                  }
                  
                  
                  
                  ?>
               <div class="col-xl-4 border-end border-inline-end-dashed">
                  <div class="d-flex flex-wrap align-items-top p-2">
                     <div class="flex-fill text-center">
                        <div class="fw-semibold fs-12 text-fixed-white text-center">Stage Status:</div>
                        <div class="fs-12 text-center my-badge-text text-<?=  $clr ?>">
                           <?= $titleText ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4">
                  <div class="d-flex flex-wrap align-items-top p-2 text-center">
                     <?php
                        if($client->profile_status == 0) {
                        
                        
                        
                            $prfStatus    =   'ON-HOLD';
                        
                            $prfColour    =   'warning';
                        
                        
                        
                        }elseif($client->profile_status == 1) {
                        
                        
                        
                            $prfStatus    =   'IN-PROGRESS';
                        
                            $prfColour    =   'success';
                        
                            
                        
                        }else{
                        
                        
                        
                            $prfStatus    =   'DROP OUT';
                        
                            $prfColour    =   'danger';
                        
                        
                        
                        }
                        
                        ?>
                     <div class="flex-fill">
                        <div class="fw-semibold fs-12 text-fixed-white text-center">Profile Status:</div>
                        <div class="text-center fs-12 profile-status-area badge text-<?= $prfColour ?>">
                           <div class="form-check form-switch p-0">
                              <input class="form-check-input m-0 me-1" type="checkbox" role="switch"
                                 id="profileStatus" <?=($client->profile_status == 1) ? 'checked' : '' ?>>
                              <label class="form-check-label" for="profileStatus"><?= $prfStatus ?></label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-12">
         <div class="card custom-card tab-area">
            <div class="card-body p-0">
               <ul class="nav nav-tabs tab-style-2 nav-justified mb-3 d-sm-flex d-block" id="myTab1"
                  role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link <?= ($curr_tab == 1) ? 'active' : '' ?>" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                        aria-controls="home-tab-pane" aria-selected="false" tabindex="-1"><i
                        class="ri-user-line me-1 align-middle"></i>Profile</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link <?= ($curr_tab == 2) ? 'active' : '' ?>" id="documents-tab" data-bs-toggle="tab"
                        data-bs-target="#documents-tab-pane" type="button" role="tab" aria-selected="false"
                        tabindex="-1"><i class="ri-file-line me-1 align-middle"></i>Documents</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link <?= ($curr_tab == 3) ? 'active' : '' ?>" id="documents-process-tab" data-bs-toggle="tab"
                        data-bs-target="#documents-process-tab-pane" type="button" role="tab"
                        aria-controls="profile-tab-pane" aria-selected="true"><i
                        class="ri-loader-line me-1 align-middle"></i>Documentation Process</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link <?= ($curr_tab == 4) ? 'active' : '' ?>" id="payment-milestone-tab" data-bs-toggle="tab"
                        data-bs-target="#payment-milestone-tab-pane" type="button" role="tab"
                        aria-controls="contact-tab-pane" aria-selected="false" tabindex="-1"><i
                        class='bx bx-rupee me-2 align-middle fs-16'></i>Payment Milestone</button>
                  </li>
               </ul>
               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade <?= ($curr_tab == 1) ? 'show active' : '' ?> text-muted" id="profile-tab-pane" role="tabpanel"
                     aria-labelledby="profile-tab" tabindex="0">
                     <!-- Profile Tab -->
                     <?php $this->load->view('Client/tabs/Profile-Tab'); ?>
                  </div>
                  <div class="tab-pane fade <?= ($curr_tab == 2) ? 'show active' : '' ?> text-muted" id="documents-tab-pane" role="tabpanel"
                     aria-labelledby="documents-tab" tabindex="0">
                     <!-- Documentation Tab -->
                     <?php $this->load->view('Client/tabs/Documents-Tab', array('documents' => $documents)); ?>
                  </div>
                  <div class="tab-pane fade <?= ($curr_tab == 3) ? 'show active' : '' ?> text-muted" id="documents-process-tab-pane" role="tabpanel"
                     aria-labelledby="documents-process-tab" tabindex="0">
                     <!-- Documentation Process Tab -->
                     <?php $this->load->view('Client/tabs/Documents-Process-Tab', array('deal_stages' => $deal_stages)) ?>
                  </div>
                  <div class="tab-pane fade <?= ($curr_tab == 4) ? 'show active' : '' ?> text-muted" id="payment-milestone-tab-pane" role="tabpanel"
                     aria-labelledby="payment-milestone-tab" tabindex="0">
                     <!-- Payment Mailstone Tab -->
                     <?php $this->load->view('Client/tabs/Payment-Milestone-Tab', array('deal_stages' => $deal_stages)) ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="card custom-card recent-activity-area">
            <div class="card-header justify-content-between">
               <div class="card-title">
                  Recent Activity
               </div>
            </div>
            <div class="card-body">
               <div>
                  <ul class="list-unstyled mb-0 crm-recent-activity">
                     <?php
                        foreach ($activities as $key => $activity) {
                        
                        
                        
                            $dateTime = new DateTime($activity->created_at);
                        
                            if($activity->type == 1 || $activity->type == 5){
                        
                                $color = 'success';
                        
                            }
                        
                            elseif($activity->type == 2){
                        
                                $color = 'primary';
                        
                            }
                        
                            elseif($activity->type == 3){
                        
                                $color = 'info';
                        
                            }
                        
                            elseif($activity->type == 4){
                        
                                $color = 'warning';
                        
                            }
                        
                            elseif($activity->type == 6){
                        
                                $color = 'danger';
                        
                            }
                        
                            else{
                        
                                $color = 'primary';
                        
                            }
                        
                        ?>
                     <li class="crm-recent-activity-content">
                        <div class="d-flex align-items-top">
                           <div class="me-3">
                              <span class="avatar avatar-xs bg-<?= $color ?>-transparent avatar-rounded">
                              <i class="bi bi-circle-fill fs-8"></i>
                              </span>
                           </div>
                           <div class="crm-timeline-content">
                              <span class="fw-semibold"><span
                                 class="text-<?= $color ?> fw-semibold"><?= $activity->span_1 ?>
                              </span><?= $activity->text ?></span>
                              <span class="text-<?= $color ?> fw-semibold"><?= $activity->span_2 ?> </span>
                              <span class=" fw-semibold"><?= $activity->text2 ?> </span>
                           </div>
                           <div class="flex-fill text-end">
                              <span
                                 class="d-block text-muted fs-11 op-7"><?= $dateTime->format('d M Y, h:i A') ?></span>
                           </div>
                        </div>
                     </li>
                     <?php
                        }
                        
                        ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3">
      <!-- Action Tab -->
      <?php $this->load->view('Client/tabs/Action-Tab')?>
      <!-- Stage Timeline Tab -->
      <?php $this->load->view('Client/tabs/Stage-Timeline-Tab')?>
   </div>
</div>
</div>
</div>
</div>
<!-- END MAIN-CONTENT -->
<?php
   $this->load->view('master/footer');
   
   $end_time = microtime(true);
   
   $execution_time = ($end_time - $start_time);
   
   echo "<script>console.log(' Page load : {$execution_time}')</script>"
   
   ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function() {
   
       $('#profileStatus').change(function() {
    
           Swal.fire({
   
               title: "Are you sure?",
   
               text: "Are you change this profile status?",
   
               icon: "warning",
   
               showCancelButton: true,
   
               confirmButtonColor: "#3085d6",
   
               cancelButtonColor: "#d33",
   
               confirmButtonText: "Yes, Change"
   
           }).then((result) => {
   
               if (result.isConfirmed) {
   
                   var clientId = '<?= $client->id ?>';
   
                   var prof_status = '<?= $client->profile_status ?>';
   
                   $.ajax({
   
                       type: "POST",
   
                       url: "<?= base_url("Documentation/changeProfileStatus") ?>",
   
                       data: {
   
                           clientId: clientId,
   
                           prof_status: prof_status,
   
                       },
   
                       success: function(response) {
   
                           Swal.fire({
   
                               title: "Changed!",
   
                               text: "Status Changed successfully!",
   
                               icon: "success"
   
                           });
   
                           setTimeout(function() {
   
                               location.reload();
   
                           }, 2000);
   
                       },
   
                   });
   
   
   
               }
   
           });
   
       });
   
   });
   
</script>