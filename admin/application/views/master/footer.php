<div class="toast fade" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
    <div class="toast-header text-default">
        <img class="bd-placeholder-img rounded me-2"
            src="https://laravelui.spruko.com/ynex/build/assets/images/brand-logos/favicon.ico" alt="...">
        <strong class="me-auto">Ynex</strong>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
</div>

<!-- 
<script>
    setTimeout(function() {
        var myToast = document.getElementById('myToast');
        myToast.classList.add('show');
    }, 3000);
</script> -->


<!-- FOOTER -->

<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container">
        <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                class="text-dark fw-semibold"> <span class="bi bi-heart-fill text-danger"></span> BE-Skilledin Services
                Pvt.Ltd</a>
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