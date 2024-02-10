<?php $this->load->view('master/header') ?>

            <?php
              $success_message = $this->session->flashdata('success');
              if ($success_message) { echo '<p class="alert alert-success">' . $success_message . '</p>'; }
            ?>
            <div class="row">
               <div class="col-xl-12">
                  <div class="card custom-card">
                     
                     <div class="card-body">
                        

                     	<form class="row g-3 mt-0">
	                        <div class="col-md-4">
	                            <label class="form-label">Title</label>
	                            <input type="text" class="form-control" id="mail-title" placeholder="Enter Mail Title" aria-label="Mail Title" fdprocessedid="caais5"  required>
	                        </div>
                            <div class="col-md-4">
	                            <label class="form-label">From Name</label>
	                            <input type="text" class="form-control" id="from-name" placeholder="Enter From Name" aria-label="From Name" fdprocessedid="7xldul"  required>
	                        </div>
	                        <div class="col-md-4">
	                            <label class="form-label">Subject</label>
	                            <input type="text" class="form-control" id="mail-subject" placeholder="Enter Mail Subject" aria-label="Mail Subject" fdprocessedid="7xldul"  required>
	                        </div>
	                        <div class="col-md-12">
	                            <label for="inputEmail4" class="form-label">Message</label>
	                            <div id="message-editor" name='message'></div>
	                        </div>
	                       
	                        <div class="col-12">
	                            <button type="submit" class="btn btn-primary" id="send-mail-btn" fdprocessedid="jab5zw">Create</button>
	                        </div>
	                    </form>


                  </div>
               </div>
            </div>

                </div>


            </div> 
            <!-- END MAIN-CONTENT -->

            <?php $this->load->view('master/footer') ?>



<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
$(document).ready(function() {
    var quill = new Quill('#message-editor', {
        theme: 'snow'
    });
    $('#send-mail-btn').click(function() {
        var title = $('#mail-title').val();
        var subject = $('#mail-subject').val();
        var fromName = $('#from-name').val();
        var message = quill.root.innerHTML;

        var previousPageUrl = '<?= base_url("Mail/MailTemplates")?>';

        $.ajax({
            type: 'POST',
            url: '<?= base_url("Mail/addNewMail")?>',
            data: {
                title: title,
                subject: subject,
                message: message,
                fromName : fromName
            },
            success: function(response) {
                window.location.href = previousPageUrl;
               
            },
        });
    });
});
</script>



       
