<div class="toast fade" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
    <div class="toast-header text-default">
        
        <span class="me-2">
            <i class="text-info ti ti-bell fs-16"></i>
        </span>

        <strong class="me-auto" id='notify-title'></strong>
        <small id='notify-time'></small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id='notify-message'></div>
</div>

<audio id="notificationSound">
    <source src="https://documentation.beskilledin.com/assets/notification.mp3" type="audio/mp3">
</audio>


<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
  
    var userID  =   '<?= $this->session->userdata('userid') ?>';
    Pusher.logToConsole = true;

    var pusher = new Pusher('41671e855cbf4c922a1d', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {

        if(data.receiver == userID){
            document.getElementById('notify-time').innerHTML = data.time;
            document.getElementById('notify-title').innerHTML = data.title;
            document.getElementById('notify-message').innerHTML = data.message;

            var toast = new bootstrap.Toast(document.getElementById('myToast'));
            toast.show();

            var notificationSound = document.getElementById('notificationSound');
            notificationSound.play();
        }

    });
  </script>
<script>
    $(document).ready(function () {

        $('.remove-notification').on('click', function (e) {
            e.preventDefault();
            var notifyID = $(this).data('notify-id');
            
            var $this = $(this);

            $.ajax({
                type: "POST",
                url: '<?= base_url("Common/readNotification")?>',
                data: {
                    notifyID: notifyID,
                },
                success: function(response) {
                    $this.closest('li').fadeOut(300, function () {
                        $(this).remove();
                    });
                },
            });
        });


        $('.go-notify-link').on('click', function (e) {
            var notifyID = $(this).data('notify-id');
            
            var $this = $(this);

            $.ajax({
                type: "POST",
                url: '<?= base_url("Common/readNotification")?>',
                data: {
                    notifyID: notifyID,
                },
                success: function(response) {
        
                },
            });
        });
    });

</script>
   


<!-- FOOTER -->

<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container">
        <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                class="text-dark fw-semibold"> <span class="bi bi-heart-fill text-danger"></span> BE-Skilledin Services
                Pvt.Ltd </a>
        </span>
    </div>
</footer>
<!-- END FOOTER -->

</div>

<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
</div>


<div id="responsive-overlay"></div>

<!-- POPPER JS -->
<script src="<?= base_url('build/assets/libs/@popperjs/core/umd/popper.min.js'); ?>"></script>

<!-- BOOTSTRAP JS -->
<script src="<?= base_url('build/assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- NODE WAVES JS -->
<script src="<?= base_url('build/assets/libs/node-waves/waves.min.js'); ?>"></script>
<!-- SIMPLEBAR JS -->
<script src="<?= base_url('build/assets/libs/simplebar/simplebar.min.js'); ?>"></script>
<link rel="modulepreload" href="<?= base_url('build/assets/simplebar-635bad04.js'); ?>" />
<script type="module" src="<?= base_url('build/assets/simplebar-635bad04.js'); ?>"></script>
<!-- COLOR PICKER JS -->
<script src="<?= base_url('build/assets/libs/@simonwep/pickr/pickr.es5.min.js'); ?>"></script>

<!-- STICKY JS -->
<script src="<?= base_url('build/assets/sticky.js'); ?>"></script>

<!-- APP JS -->
<link rel="modulepreload" href="<?= base_url('build/assets/app-3cade095.js'); ?>" />
<script type="module" src="<?= base_url('build/assets/app-3cade095.js'); ?>"></script>

<!-- CUSTOM-SWITCHER JS -->
<link rel="modulepreload" href="<?= base_url('build/assets/custom-switcher-383b6a5b.js'); ?>" />
<script type="module" src="<?= base_url('build/assets/custom-switcher-383b6a5b.js'); ?>"></script>



</body>

</html>