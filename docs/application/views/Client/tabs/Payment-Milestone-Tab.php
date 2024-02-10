<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card payment-milestone-area">

            <div class="card-header">

                <div class="card-title">Payment Milestone</div>

                <div class="ms-auto">

                    <button type="button" class="btn btn-light btn-sm btn-wave" data-bs-toggle="modal"

                        data-bs-target="#add-new-milestone"><i class='bx bx-plus-circle'></i>

                        Add Milestone</button>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <div class="accordion customized-accordion accordions-items-seperate" id="customizedAccordion">

                        <?php

                            $i = 0;

                            foreach ($payment_milestone as $key => $payment) {

                            $i++;

                            $splitPays      = $this->Defualt_Model->findAll('split_payments', array('payment_id' => $payment->id ));

                            $totPaid        = $this->Client_model->totSplitPaid($client->id, $payment->id); 

                            $balanceAmnt    = $payment->fixed_amount - $totPaid;

                            ?>

                        <div class="accordion-item custom-accordion-primary">

                            <h2 class="accordion-header" id="heading-<?= $i ?>">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"

                                    data-bs-target="#collapse-<?= $i ?>" aria-expanded="false"

                                    aria-controls="collapse-<?= $i ?>">

                                    <span class='text-dark'><b><?= $i.". ".$payment->type ?></b></span>

                                </button>

                                <ul>

                                    <li style='width:30%'>Total Amount : ₹

                                        <?=  number_format($payment->fixed_amount, 0, ',', ','); ?>

                                    </li>

                                    <li style='width:20%'>Paid : ₹ <?=  number_format($totPaid, 0, ',', ','); ?></li>

                                    <li style='width:30%'>Balance : ₹

                                        <?=  number_format($balanceAmnt, 0, ',', ','); ?></li>

                                    <?php if($totPaid < $payment->fixed_amount){ ?>

                                    <li>

                                        <button type="button"

                                            class="btn btn-primary-ghost btn-sm btn-wave waves-effect waves-light"

                                            data-bs-toggle="modal" data-bs-target="#pay-now-<?= $i ?>"><i

                                                class='bx bx-money'></i>

                                            Pay</button>

                                    </li>

                                    <?php } ?>

                                </ul>

                            </h2>



                            <?php 
                            $newBalance = $payment->fixed_amount;
                            foreach ($splitPays as $key => $pay) {

                                $pay_date = new DateTime($pay->created_at);
                                $newBalance = $newBalance - $pay->amount;

                                ?>

                            <div id="collapse-<?= $i ?>" class="accordion-collapse collapse"

                                aria-labelledby="heading-<?= $i ?>" data-bs-parent="#accordionExample">

                                <div class="accordion-body payment-detial">

                                    <div class="row bg-white">

                                        <div class="col-xl-6">

                                            <span>Milestone</span>

                                            <p>

                                                <?= $payment->type ?>

                                            </p>

                                        </div>

                                        <div class="col-xl-6">

                                            <span>Piad date</span>

                                            <p><?= $pay_date->format('d M Y, h:i A') ?></p>

                                        </div>



                                        <div class="col-xl-6">

                                            <span>Total Amount</span>

                                            <p>₹ <?=  number_format($payment->fixed_amount, 0, ',', ','); ?></p>

                                        </div>

                                        <div class="col-xl-6">

                                            <span>Piad Amount</span>

                                            <p class='text-success'><b>₹

                                                    <?=  number_format($pay->amount, 0, ',', ','); ?></b>

                                            </p>

                                        </div>



                                        <div class="col-xl-6">

                                            <span>Balance Amount</span>

                                            <p>₹ <?=  number_format($newBalance, 0, ',', ','); ?>

                                            </p>

                                        </div>

                                        <div class="col-xl-6">

                                            <span>Payment Type</span>

                                            <p><?= ($pay->payment_type) ? $pay->payment_type : '---' ?></p>

                                        </div>



                                        <div class="col-xl-6">

                                            <span>Added By</span>

                                            <p><?= $this->user_model->username($pay->added_by) ?></p>

                                        </div>



                                        <div class="col-xl-6">

                                            <span>Approved By</span>



                                            <p>---</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <?php } ?>

                        </div>



                        <div class="modal fade" id="pay-now-<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel"

                            aria-hidden="true">

                            <div class="modal-dialog checklist">

                                <div class="modal-content">

                                    <form method="POST" action="<?= base_url('Documentation/paySplit') ?>">

                                        <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>

                                        <input type='hidden' value='<?= $client->id ?>' name="client-id">

                                        <input type='hidden' value='<?= $payment->id ?>' name="mailestone-id">

                                        <input type='hidden' value='<?= $payment->type ?>' name="mailestone-name">

                                        <div class="modal-header">

                                            <h6 class="modal-title" id="exampleModalLabel1">Add Payment</h6>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"

                                                aria-label="Close"></button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="col-xl-12 mb-2">

                                                <label class="form-label">Amount</label>

                                                <input type="number" max="<?= $balanceAmnt ?>" class="form-control"

                                                    name="pay-amount" placeholder="Enter Amount" required="">

                                            </div>



                                            <div class="col-xl-12 mb-3">

                                                <label class="form-label">Payment Type</label>

                                                <select class="form-select" name='payment-type'

                                                    aria-label="Default select example" required="">

                                                    <option value=''>Select Payment Type</option>

                                                    <option value="Cheque">Cheque</option>

                                                    <option value="Bank Transfer">Bank Transfer</option>

                                                    <option value="Cash">Cash</option>

                                                </select>

                                            </div>



                                            <button type="submit" class="btn btn-success-gradient btn-wave  w-100"

                                                data-bs-dismiss="modal">PAY NOW

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>





                        <?php

                                

                            }



                        ?>





                    </div>

                </div>

            </div>

        </div>

    </div>





    <div class="modal fade" id="add-new-milestone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog checklist">

            <div class="modal-content">

                <form method="POST" action="<?= base_url('Documentation/addMilestone') ?>">

                    <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>

                    <input type='hidden' value='<?= $client->id ?>' name="client-id">

                    <div class="modal-header">

                        <h6 class="modal-title" id="exampleModalLabel1">Add New Milestone</h6>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">

                        <div class="col-xl-12 mb-2">

                            <label class="form-label">Milestone</label>

                            <input type="text" class="form-control" name="milestone-name"

                                placeholder="Enter Milestone Name" required="">

                        </div>

                        <div class="col-xl-12 mb-2">

                            <label class="form-label">Amount</label>

                            <input type="number" class="form-control" name="fixed-amount" placeholder="Enter Amount"

                                required="">

                        </div>



                        <button type="submit" class="btn btn-success-gradient btn-wave  w-100"

                            data-bs-dismiss="modal">Add Milestone

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>







</div>