<?php
if($stageTimeLine){
    // echo "<pre>";
    // var_dump($stageTimeLine);
?>
<div class="card custom-card">
    <div class="card-header justify-content-between">
        <div class="card-title">
            Stages Timeline
        </div>
    </div>
    <div class="card-body">
        <ul class="list-unstyled timeline-widget mb-0 my-3">
            <?php foreach($stageTimeLine as $timeline){
                        $date = new DateTime($timeline->created_at);
                    ?>
            <li class="timeline-widget-list">
                <div class="d-flex align-items-top">
                    <div class="me-5 text-center">
                        <span class="d-block fs-12 text-muted">Stage</span>
                        <span class="d-block fs-20 fw-semibold">0<?= $timeline->stage_id ?> </span>
                    </div>
                    <div class="d-flex flex-wrap flex-fill align-items-center justify-content-between">
                        <div>
                            <p class="mb-1 text-truncate timeline-widget-content text-wrap">
                                <?= $timeline->stage ?></p>
                            <p class="mb-0 fs-12 lh-1 text-muted"><?= $date->format('d M Y, h:i A') ?>
                            </p>
                            <span
                                class="my-badge-text and-style bg-<?= ($timeline->option_text == 'DROP OUT') ? 'danger' : 'primary' ?>-transparent mt-2"><?= $timeline->option_text ?></span>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<?php
}
?>