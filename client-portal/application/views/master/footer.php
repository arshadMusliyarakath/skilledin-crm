

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                &copy;
                <script>
                document.write(new Date().getFullYear())
                </script> <i class="mdi mdi-heart text-danger"></i> BE-Skilledin Services Pvt.Ltd..
            </div>

        </div>
    </div>
</footer>
</div><!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>



<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>

<!-- swiper js -->
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- profile init js -->
<script src="assets/js/pages/profile.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

<script>
function editfile_up(id) {

    $.ajax({
        type: "post",
        url: "ajax_data.php",
        data: {
            file_upload_edit: 1,
            id: id
        },
        success: function(data) {

            //alert(data);
            $("#editproduct").html(data);
        }
    });
}
</script>


<div class="chat">
    <a aria-label="anchor" href="#" class="btn btn-success btn-icon rounded-circle chat-add-icon fs-5" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="ri-chat-1-line fs-4"></i>
    </a>
</div>
    <div class="offcanvas offcanvas-end edit_profile_offcanvase" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel1">
        <div class="offcanvas-header border-bottom border-block-end-dashed">
            <h5 class="offcanvas-title" id="offcanvasRightLabel1">Chat Support
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
            <div class="p-sm-3 p-0">
                <div class="chat-body">
                    <div class="messages">
                        <?php foreach($chats as $chat){?>
                        
                            <div class="message message-<?= ($chat->type == 1) ? 'in' : 'out' ?>">
                                    <div class="chat-avatar"></div>
                                    <div class="message-body">
                                        <div class="message-content">
                                            <div class="message-text">
                                                <p class='m-0'><?= $chat->message ?></p>
                                            </div>
                                        </div>
                                        
                                    
                                        <div class="message-footer">
                                            <span class="extra-small fs-10"><?= $this->Common_model->dateTimeFormat($chat->created_at) ?></span>
                                        </div>
                                    </div>
                                <div class="clear"></div>
                            </div>

                        <?php } ?>
                    </div>

                    
                    <div class="chat-input">
                        <ul>
                            <li style="width:90%" ><input type="text" class='msg-text form-control' id="msg-text" placeholder='Type here...'></li>
                            <li><a href="#" class='msg-send' id='send-chat'><i class="ri-send-plane-2-line fs-5 text-white"></i></a></li>
                        </ul>
                    </div>            
                </div>
            </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#send-chat').click(function () {
            var messageText = $('#msg-text').val();
            var caseManager = '<?= $client->case_manager ?>';
            if(messageText != ''){
                $.ajax({
                    type: "POST",
                    url: "<?= base_url("FrontEndController/sendChat") ?>",
                    data: {
                        messageText: messageText,
                        caseManager : caseManager,
                    },
                    success: function(response) {

                    },
                });
            }
            else{
                alert('Message box is empty!!');
            }
            
        });
    });
</script>

<style>
body {
    position: relative;
}
.chat {
    position: fixed;
    z-index: 111;
    bottom: 20px;
    right: 20px;
}
.chat a {
    box-shadow: 0px 3px 6px 0px #00000057;
}
.chat-body {
    position: relative;
    height: 87vh;
}
input.msg-text.form-control {
    
}
a.msg-send i {
    background: #0ab39c;
    padding: 10px;
    border-radius: 20px;
    margin-left: 6px;
}
.chat-body .chat-input ul {
    padding: 0;
    list-style: none;
    align-items: center;
    display: flex;
}
.offcanvas-header {
    z-index: 111111111;
    background: white;
}
.chat-body .chat-input ul li {
    padding: 0;
    display: inline-block;
}
.chat-body .chat-input {
    position: absolute;
    bottom: 0;
    width: 100%;
}
.chat-avatar {
    background-image: url("<?= $this->session->userdata('userData')->profile_pic ?>");
    height: 30px;
    width: 30px;
    border-radius: 70px;
    background-size: cover;
    background-position: center;
}
.message {
    margin-bottom: 10px;
    position: relative;
}
.message-body {
    padding: 10px;
    border-radius: 7px;
    max-width: 82%;
}
.message-in .message-body {
    float: left;
}
.message-out .message-body {
    float: right;
}
.message-in .chat-avatar {
    float: left;
    margin-right: 5px;
}
.message-out .chat-avatar {
    float: right;
    margin-left: 5px;
}
 .message-in .message-body {
    background: #2787f5;
    color: white;
} 
.message-out .message-body {
    background: #b5b5b533;
    color: black;
}
.message-out  .message-footer {
    text-align: right;
    color: #00000061;
}
.message-in  .message-footer {
    text-align: left;
    color: #ffffff8a;
}  
.message hr {
    margin: 9px 0px;
    margin-bottom: 4px;
}
.messages {
    position: absolute;
    bottom: 60px;
    height: 80vh;
    overflow: scroll;
    scroll-behavior: smooth;
    padding: 10px;
}
.clear{
    clear:both;
}
</style>
</html>