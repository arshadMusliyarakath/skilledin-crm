<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Deal Stages
                </div>
            </div>
            <div class="card-body">
                <ul class='stage'>
                    <?php
                        $i = 0;
                        foreach($deal_stages as $deal_stage){
                            $i++;
                            //print_r($deal_stage);
                            $chekStatus = $this->Defualt_Model->findSelect('stage_process', array('stage'), array('client' => $client->id, 'stage' => $deal_stage->stage_id));
                            if($deal_stage->option_text == 'DROP OUT'){
                                $clr = 'danger';
                            }elseif($deal_stage->stage_id == $chekStatus[0]->stage){
                                $clr = 'success';
                            }else{
                                $clr = 'warning';
                            }
                    ?>
                    <a href='#' data-bs-toggle="modal" data-bs-target="#stage-model_<?= $i ?>">
                        <li class='border-top-card border-top-<?= $clr ?> bg-<?= $clr ?>-transparent' data-bs-toggle="tooltip" data-bs-custom-class="tooltip-<?= $clr ?>" class="me-3" aria-label="Message" data-bs-original-title="<?= $deal_stage->option_text ?>">
                            <span class="avatar avatar-md avatar-rounded bg-<?= $clr ?>-transparent ">
                                <?= ($deal_stage->stage_id == $chekStatus[0]->stage) ? "<i class='bx bx-check-circle'></i>" : "<i class='bx bx-time'></i>" ;  ?>
                            </span>
                            <p><?= $deal_stage->stage_name ?></p>
                            <!-- <span><?= $deal_stage->option_text ?></span> -->
                        </li>
                    </a>
                    <div class="modal fade" id="stage-model_<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="<?= base_url('Documentation/changeStageStatus') ?>"
                                    enctype="multipart/form-data">
                                    <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel1"><?= $deal_stage->stage_name ?>
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <input type='hidden' name='client-id' value='<?= $client->id?>'>
                                            <input type='hidden' name='stage-id' value='<?= $deal_stage->stage_id?>'>
                                            

                                            <?php 
                                                if($deal_stage->stage_id == 7){
                                                    ?>
                                                         <div class="col-xl-12">
                                                            <input type="text" class="form-control" id="travel_status" name="travel_status" placeholder="Enter <?= $deal_stage->stage_name ?>" required="">
                                                        </div>

                                                    <?php
                                                }
                                                else if($deal_stage->stage_id == 8){
                                                    ?>
                                                        <div class="col-xl-12 prfl-clsed-area">
                                                            <div class="form-check form-check-md">
                                                                <input class="form-check-input" type="radio" name="stage-option" id="Radio-md" value='Yes' checked="">
                                                                <label class="form-check-label">
                                                                    Yes, Profile Closed!
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-md">
                                                                <input class="form-check-input" type="radio" name="stage-option" id="Radio-md" value='No'>
                                                                <label class="form-check-label">
                                                                    No!
                                                                </label>
                                                            </div>
                                                        </div>

                                                    <?php
                                                }
                                                else
                                                {
                                            ?>
                                                <div class="col-xl-12">
                                                    <select class="form-select" name="stage-option"
                                                        aria-label="Default select example" required="">
                                                        <option value="">Select Status</option>
                                                        <?php
                                                        $options = $this->Defualt_Model->findAll('deal_stage_options', array('product' => 2, 'stage' => $deal_stage->stage_id));  
                                                    foreach ($options as $key => $option) {
                                                        ?>
                                                        <option value="<?= $option->option_text ?>">
                                                            <?= $option->option_text ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                           


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-bs-dismiss="modal">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>