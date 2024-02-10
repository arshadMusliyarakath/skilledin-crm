<!-- DATE & TIME PICKER JS -->
<script src="<?= base_url('build/assets/libs/flatpickr/flatpickr.min.js'); ?>"></script>
<div class="card custom-card">
    <div class="card-body actions-btn">
        <ul>
            <li>
                <button class="btn btn-icon btn-primary-transparent rounded-pill btn-wave" data-bs-toggle="modal"
                    data-bs-target="#send-mail">
                    <i class="ri-mail-open-line"></i>
                </button>
                <p>Mail</p>
            </li>
            <li>
                <button class="btn btn-icon btn-warning-transparent rounded-pill btn-wave" data-bs-toggle="modal"
                    data-bs-target="#add-note">
                    <i class="ri-sticky-note-line"></i>
                </button>
                <p>Note</p>
            </li>
            <!-- <li>
                <button class="btn btn-icon btn-info-transparent rounded-pill btn-wave">
                    <i class="ri-time-line"></i>
                </button>
                <p>Remainder</p>
            </li> -->
            <li>
                <button class="btn btn-icon btn-success-transparent rounded-pill btn-wave">
                    <i class="ri-chat-1-line"></i>
                </button>
                <p>Chat</p>
            </li>
        </ul>
        <!-- Stage Notes Tab -->
        <?php $this->load->view('Client/tabs/Notes-Tab')?>
    </div>
</div>
<div class="modal fade" id="add-note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Documentation/addNote') ?>">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <div class="modal-header bg-warning">
                    <h6 class="modal-title" id="exampleModalLabel1">Create Note</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type='hidden' name='id' value='<?= $client->id?>'>
                        <div class="col-xl-12">
                            <label for="task-name" class="form-label">Note</label>
                            <input type="text" class="form-control" id="new_note" name="new_note"
                                placeholder="Enter Note" required>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <label class="form-label">Target Date</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                    <input type="text" class="form-control flatpickr-input" id="targetDate"
                                        name='targetDate' placeholder="Choose date and time" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Add Note</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal  modal-lg fade" id="send-mail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary-transparent">
                <h6 class="modal-title" id="exampleModalLabel1">Compose Mail</b>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type='hidden' name='id' value='<?= $client->id?>'>
                    <div class="row">
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">To<sup><i
                                        class="ri-star-s-fill text-danger fs-8"></i></sup></label>
                            <input type="email" class="form-control" id="to-mail" value="<?= $client->email?>"
                                placeholder="To Mail">
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">Cc<sup><i
                                        class="ri-star-s-fill text-danger fs-8"></i></sup></label>
                            <input type="email" class="form-control" id="cc-mail" 
                                placeholder="Cc Mail">
                        </div>
                        <div class="col-xl-12 mb-2">
                            <label class="form-label text-dark fw-semibold">Template</label>
                            <select id="mail-template" class="form-control">
                                <option value="">Blank Template</option>
                                <?php
                                    foreach ($mail_templates as $key => $template) {
                                        ?>
                                            <option value="<?= $template->title ?>"><?= $template->title ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-12 mb-2">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                        </div>
                        <div class="col-xl-12 mb-2">
                            <label class="col-form-label">Message</label>
                            <div id="message-editor" name='message'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" id='send-mail-btn' class="btn btn-success" data-bs-dismiss="modal">Send</button>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
flatpickr("#targetDate", {
    dateFormat: "Y-m-d",
});
$(document).ready(function() {
    var quill = new Quill('#message-editor', {
        theme: 'snow'
    });

    var clientName = '<?= $client->name ?>';
    alert(clientName);
    $('#send-mail-btn').click(function() {
        var to = $('#to-mail').val();
        var cc = $('#cc-mail').val();
        var subject = $('#subject').val();
        var message = quill.root.innerHTML;
        $.ajax({
            type: 'POST',
            url: '<?= base_url("Mail_Template/sendMail")?>',
            data: {
                clientName : clientName,
                to: to,
                cc: cc,
                subject: subject,
                message: message
            },
            success: function(response) {
  
                    alert('Mail Sent!');
                    location.reload();
                
            },
        });
    });

    $('#mail-template').change(function() {
        var tempTitle = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url("Mail_Template/fetchTemplate")?>',
            data: {
                tempTitle: tempTitle,
            },
            success: function(response) {
                var responseData = JSON.parse(response);
                $('#subject').val(responseData.subject);
                quill.clipboard.dangerouslyPasteHTML(responseData.message);
            },
        });
    });
});
</script>