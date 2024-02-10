<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Documents</div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-light btn-sm btn-wave" data-bs-toggle="modal"
                        data-bs-target="#add-new-docs"><i class='bx bx-plus-circle'></i>
                        Add New Docs</button>

                    <button type="button" class="btn btn-primary-gradient btn-sm btn-wave waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#checklist-model"><i class="bx bx-check-circle"></i>
                        Update Check List</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Document Name</th>
                                <th scope="col">Uploaded At</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $i = 0;
                                    foreach ($documents as $key => $document) {
                                        $i++;
                                        $dateTime = new DateTime($document->created_at);
                                        if($document->up_status == 1){

                                            $statusText     =   'Uploaded';
                                            $statusColour   =   'success';
                                            $uploadDate     =   $dateTime->format('d M Y, h:i A');
                                           
                                        }else{
                                            $statusText     = 'Requested';
                                            $statusColour   = 'warning';
                                            $uploadDate     =  '--';
                                           
                                        }
                                        ?>
                            <tr>
                                <td>
                                    <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i>
                                    <?= $document->doc_name ?>
                                </td>
                                <td><?= $uploadDate ?></td>
                                <td><span class="badge bg-<?= $statusColour ?>-transparent"><?= $statusText ?></span>
                                </td>
                                <td>
                                    <?php if($document->up_status == 1){ ?>
                                    <a href="#" class='view-pdf btn btn-icon btn-sm btn-light'
                                        data-document-name="<?= $document->file_name ?>"><i class="ri-eye-line"></i></a>

                                    <?php } else {?>

                                    <a href="<?= base_url('Documentation/removeRequestedDoc') ?>"
                                        class='removeReqDoc btn btn-icon btn-sm text-danger btn-light'
                                        data-document-name="<?= $document->doc_name ?>"><i class='bx bx-x'></i></a>

                                    <?php }?>
                                </td>

                            </tr>
                            <?php
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $(".removeReqDoc").click(function(e) {
            e.preventDefault();

            var clientId = "<?= $client->id?>";
            var docName = $(this).data('document-name');
            var clickedElement = $(this);

            $.ajax({
                type: "POST",
                url: "<?= base_url("Documentation/removeRequestedDoc") ?>",
                data: {
                    clientId: clientId,
                    docName: docName
                },
                success: function(response) {
                    if (response == 1) {
                        clickedElement.closest('tr').fadeOut(500, function() {
                            $(this).remove();
                        });
                    }
                },
                error: function() {
                    console.log('Error in AJAX request');
                }
            });
        });


        $(".view-pdf").click(function(e) {
            e.preventDefault();

            var clientId = "<?= $client->id?>";
            var documentName = $(this).data('document-name');

            $.ajax({
                type: "POST",
                url: "<?= base_url("Client/viewPdf") ?>",
                data: {
                    clientId: clientId,
                    documentName: documentName
                },
                xhrFields: {
                    responseType: 'blob' // Set the response type to blob
                },
                success: function(response) {
                    console.log("Success:", response);

                    var blob = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var blobUrl = URL.createObjectURL(blob);
                    window.open(blobUrl, '_blank');
                },

            });
        });
    });
    </script>

</div>





<div class="modal fade" id="add-new-docs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog checklist">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Documentation/addNewDoc') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <input type='hidden' value='<?= $client->id ?>' name="client">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">Add New</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="add-new-doc" id=""
                                placeholder="Enter Document Name" required="">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success-gradient btn-wave  w-100" data-bs-dismiss="modal">Add
                        Document</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="checklist-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog checklist">
        <div class="modal-content">
            <form method="POST" action="<?= base_url('Documentation/submitChecklist') ?>" enctype="multipart/form-data">
                <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                <input type='hidden' value='<?= $client->id ?>' name="client">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">Check List</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <table class="table text-nowrap table-hover border table-bordered">
                            <thead>
                                <tr>
                                    <th scope="row" class="ps-4">Check</th>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $allDocs = $this->Client_model->getMandetaryDocsWithStatus($client->id);      
                                //echo $this->db->last_query();
                                foreach ($allDocs as $key => $doc) {
                                    if($doc->up_status == 1 && $client->id == $doc->client){
                                        $statusText = 'Uploaded';
                                        $statusClr = 'badge bg-success-transparent';
                                        $checkedBtn = '';
                                    }elseif($doc->up_status == 0 && $doc->added_by != NULL && $client->id == $doc->client){
                                        $statusText = 'Requested';
                                        $statusClr = 'badge bg-warning-transparent';
                                        $checkedBtn = 'checked';
                                    }else{
                                        $statusText = '';
                                        $statusClr = '';
                                        $checkedBtn = '';
                                    }      
                                    
                                ?>
                                <tr>
                                    <th scope="row" class="ps-4 text-center"><input class="form-check-input"
                                            name='doc-name[]' type="checkbox" id="checkboxNoLabel2"
                                            value="<?= $doc->id ?>" aria-label="..." <?= $checkedBtn; ?>></th>
                                    <td><?= $doc->name ?> </td>
                                    <td>
                                        <span class="<?= $statusClr ?>"><?= $statusText ?></span>
                                    </td>

                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success-gradient btn-wave btn-sm w-100"
                        data-bs-dismiss="modal">Send
                        List</button>
                </div>
            </form>
        </div>
    </div>
</div>