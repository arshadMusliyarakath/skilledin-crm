<?php
if($notes){
    $today  =  date('Y-m-d');
?>
<hr>
<div class="accordion customized-accordion accordions-items-seperate" id="customizedAccordion">
    <?php
    $i = 0;
    foreach ($notes as $key => $note) {
    $i++; 
    $target =  $note->target_date;
    if (strtotime($target) <= strtotime($today)) {
        $dotClr = 'danger';
        $this->session->set_flashdata('DueNote', 'Notes: Check your due dates.');
    } else {
        $dotClr = 'warning';
    }

    
    ?>
    <div class="accordion-item custom-accordion-warning">
        <h2 class="accordion-header" id="customizedAccordion-<?= $i ?>">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#customized-Accordion-<?= $i ?>" aria-expanded="false"
                aria-controls="customized-Accordion-<?= $i ?>">
                <span class="avatar avatar-xs bg-<?= $dotClr ?>-transparent avatar-rounded me-2">
                    <i class="bi bi-circle-fill fs-8"></i>
                </span>
                <?= substr($note->note, 0, 20) ?>...
            </button>
        </h2>
        <div id="customized-Accordion-<?= $i ?>" class="accordion-collapse collapse"
            aria-labelledby="customizedAccordion-<?= $i ?>" data-bs-parent="#customizedAccordion">
            <div class="accordion-body">
                <?= $note->note ?>
                <hr>
                <span
                    class='me-2'><?= ($note->target_date != NULL) ? '<i class="ri-time-fill"></i> '.$this->Common_model->dateFormat($note->target_date) : ''?></span>
                <a href="#" class='text-danger delete-note' id='delete-note' data-note-id="<?= $note->id ?>">Delete</a>
            </div>
        </div>
    </div>

    <?php

    } ?>

</div>
<?php
}
?>

<script>
$(document).ready(function() {
    $(".delete-note").click(function(e) {
        e.preventDefault();

        var clientId = "<?= $client->id ?>";
        var noteId = $(this).data('note-id');

        $.ajax({
            type: "POST",
            url: "<?= base_url("Documentation/deleteNote") ?>",
            data: {
                clientId: clientId,
                noteId: noteId
            },
            success: function(response) {
                location.reload();
            },
        });
    });
});
</script>