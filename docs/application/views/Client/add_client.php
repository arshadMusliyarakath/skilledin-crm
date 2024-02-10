<?php $this->load->view('master/header') ?>
<!-- DATE & TIME PICKER JS -->
<script src="<?= base_url('build/assets/libs/flatpickr/flatpickr.min.js'); ?>"></script>

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
                                            <div class="col-xl-3">
                                                <label class="form-label">Full Name</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-user"></i></div>
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="Enter Full Name" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">CRM Number</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-laptop"></i></div>
                                                        <input type="number" class="form-control" name="crm_number"
                                                            placeholder="Enter CRM Number" required="">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Product</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-layer"></i></div>
                                                        <select class="form-select" name="product"
                                                            aria-label="Default select example" required="">
                                                            <option value="">Select Product</option>
                                                            <?php
                                                foreach ($products as $key => $product) {
                                                    ?>
                                                            <option value="<?= $product->id ?>">
                                                                <?= $product->product_name ?></option>
                                                            <?php
                                                }
                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Country</label>

                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-globe"></i></div>
                                                        <input type="text" class="form-control" name="country"
                                                            placeholder="Enter Country Name" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Agreement Date</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-calendar"></i></div>
                                                        <input type="text" class="form-control" id="agreement-date"
                                                            name="agreement_date" placeholder="Choose date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Closing Amount</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted">₹</div>
                                                        <input type="number" class="form-control" name="close_amt"
                                                            placeholder="Enter Closing Amount" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Mobile Number</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-mobile"></i></div>
                                                        <input type="text" class="form-control" name="mobile"
                                                            id="mobile" placeholder="Enter Mobile Number"
                                                            pattern="[0-9]{10}" title="Please enter a 10-digit number"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Email Address</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-envelope"></i></div>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            placeholder="Enter Email Address" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label">Present Address</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-buildings"></i></div>
                                                        <input type="text" class="form-control" name="address"
                                                            placeholder="Enter Present Address" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Passport Number</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-envelope"></i></div>
                                                        <input type="text" class="form-control" name="passport_no"
                                                            id="passport_no" placeholder="Enter Passport Number"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Date of Birth</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-calendar"></i></div>
                                                        <input type="text" class="form-control" id="date-of-birth"
                                                            name="dob" placeholder="Choose date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Occupation</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-briefcase-alt-2"></i></div>
                                                        <input type="text" class="form-control" name="occupation"
                                                            placeholder="Enter Occupation" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Category</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-category"></i></div>
                                                        <select class="form-select" name="category" id="category"
                                                            aria-label="Default select example" required="">
                                                            <option value="">Select Category</option>
                                                            <option value="1">Medical</option>
                                                            <option value="2">Non-Medical </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Requirement</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-list-check"></i></div>
                                                        <select class="form-select" name="requirement" id="requirement"
                                                            aria-label="Default select example" required="">
                                                            <option value="">Select Requirement</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <label class="form-label">Qualification</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-trophy"></i></div>
                                                        <select class="form-select" name="qualification"
                                                            id="qualification" aria-label="Default select example"
                                                            required="">
                                                            <option value="">Select Qualification</option>
                                                            <option value="Nurse">Nurse</option>
                                                            <option value="GNM">GNM</option>
                                                            <option value="ANM">ANM</option>
                                                            <option value="MSW">MSW</option>
                                                            <option value="+2">+2</option>
                                                            <option value="NULL">Others</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="form-label">Remarks (optional)</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"><i
                                                                class="bx bx-news"></i></div>
                                                        <textarea class="form-control" name="remarks"
                                                            placeholder="Enter Remarks"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade" id="othersModal" tabindex="-1"
                                            aria-labelledby="othersModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="othersModalLabel">Others
                                                            Qualification</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-text text-muted"><i
                                                                        class="bx bx-briefcase-alt-2"></i></div>
                                                                <input type="text" class="form-control"
                                                                    name="other-qualification"
                                                                    placeholder="Enter Qualification Detials">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Add</button>
                                                    </div>
                                                </div>
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
        <button class="btn btn-primary m-1">Save Client</button>
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
flatpickr("#agreement-date", {
    dateFormat: "Y-m-d",
});
flatpickr("#date-of-birth", {
    dateFormat: "Y-m-d",
});
</script>
<script>
$(document).ready(function() {
    $('#category').on('change', function() {
        var selectedValue = $(this).val();

        if (selectedValue !== "") {
            var url = '<?= base_url("Utility/getCategoryReq")?>';
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    category: selectedValue
                },
                success: function(data) {
                    $('#requirement').html(data);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});



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
<script>
$(document).ready(function() {
    $('#qualification').change(function() {
        if ($(this).val() === 'NULL') {
            $('#othersModal').modal('show');
        } else {
            $('#othersModal').modal('hide');
        }
    });
});
</script>

<?php $this->load->view('master/footer') ?>