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
                                <input type="hidden" id='mail-id'  value='<?= $mail->id?>'>
	                            <label class="form-label">Title</label>
	                            <input type="text" class="form-control" id="mail-title" placeholder="Enter Mail Title" aria-label="Mail Title" value="<?= $mail->title ?>" fdprocessedid="caais5" required>
	                        </div>
                            <div class="col-md-4">
	                            <label class="form-label">From Name</label>
	                            <input type="text" class="form-control" id="from-name" placeholder="Enter From Name" aria-label="From Name" value="<?= $mail->from_name ?>" fdprocessedid="7xldul" required>
	                        </div>
	                        <div class="col-md-4">
	                            <label class="form-label">Subject</label>
	                            <input type="text" class="form-control" id="mail-subject" placeholder="Enter Mail Subject" aria-label="Mail Subject" value="<?= $mail->subject ?>" fdprocessedid="7xldul"  required>
	                        </div>
	                        <div class="col-md-12">
	                            <label for="inputEmail4" class="form-label">Message</label>
	                            <div id="message-editor" name='message'><?= $mail->message ?></div>
	                        </div>
	                       
	                        <div class="col-12">
	                            <button type="submit" class="btn btn-info" id="update-mail-btn" fdprocessedid="jab5zw">Update</button>
                                <a href="<?= base_url('Mail/deleteMail/').$mail->id ?>" class='btn btn-danger ms-2'>Delete</a>
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
    $('#update-mail-btn').click(function() {
        var title = $('#mail-title').val();
        var subject = $('#mail-subject').val();
        var mailId = $('#mail-id').val();
        var fromName = $('#from-name').val();
        var message = quill.root.innerHTML;
        var previousPageUrl = '<?= base_url("Mail/MailTemplates")?>';

        $.ajax({
            type: 'POST',
            url: '<?= base_url("Mail/editMail")?>',
            data: {
                title: title,
                subject: subject,
                message: message,
                mailId : mailId,
                fromName : fromName
            },
            success: function(response) {
                window.location.href = previousPageUrl;
            },
        });
    });
});
</script>



       
