<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>

    <!-- META DATA eta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="">
    <meta name="Author" content="">
    <meta name="keywords"
        content="">

    <!-- TITLE -->
    <title> CRM | Reset Password </title>

    <!-- FAVICON -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?= base_url('build/assets/libs/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="<?= base_url('build/assets/icon-fonts/icons.css'); ?>" rel="stylesheet">

    <!-- APP SCSS -->
    <link rel="preload" as="style" href="<?= base_url('build/assets/app-fce3f544.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('build/assets/app-fce3f544.css'); ?>" />

    <!-- MAIN JS -->
    <script src="<?= base_url('build/assets/authentication-main.js'); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




</head>

    <body>



        <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center login-logo-area">
                    <a href="<?= base_url(); ?>">
                        <img src="<?= base_url('assets/images/skilledin-logo-color.png'); ?>" alt="logo"
                            class="desktop-logo">
                        <img src="<?= base_url('assets/images/skilledin-logo.png'); ?>" alt="logo" class="desktop-dark">
                    </a>
                </div>
                    <div class="card custom-card">
                        <div class="card-body p-5">
                            <p class="h5 fw-semibold mb-2 text-center">Reset Password</p>
                            <p class="mb-4 text-muted op-7 fw-normal text-center">Hello <?= ucfirst($user->name) ?> !</p>
                            <div class="row gy-3">
                                
                                <form method="POST" id="resetPasswordForm">
                                        <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
                                        <div class="col-xl-12 mb-3">
                                            <input type="hidden" name="requestId" value="<?= $requestId ?>">
                                            <input type="hidden" name="user-id" value="<?= $user->id ?>">
                                            <label for="reset-newpassword" class="form-label text-default">New Password</label>
                                            <div class="input-group">
                                                <input type="password" name='reset-newpassword' class="form-control form-control-lg" id="reset-newpassword" placeholder="new password" required> 
                                                <button class="btn btn-light" type="button" onclick="createpassword('reset-newpassword',this)" id="button-addon21"><i class="ri-eye-off-line align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 mb-4">
                                            <label for="reset-confirmpassword" class="form-label text-default">Confirm Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control form-control-lg" name='reset-confirmpassword' id="reset-confirmpassword" placeholder="confirm password" required> 
                                                <button class="btn btn-light" type="button" onclick="createpassword('reset-confirmpassword',this)" id="button-addon22"><i class="ri-eye-off-line align-middle"></i></button>
                                            </div>
                                     
                                        </div>
                                        <div class="col-xl-12 d-grid mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary">Reset Password</button>
                                        </div>
                                </form>
                            </div>
                       
                         
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


      <script>
    $(document).ready(function () {
        $('#resetPasswordForm').submit(function (event) {
            var newPassword = $('#reset-newpassword').val();
            var confirmPassword = $('#reset-confirmpassword').val();

            // Check if passwords match
            if (newPassword !== confirmPassword) {
                // Passwords do not match, prevent form submission
                alert("Passwords do not match!");
                event.preventDefault();
            }
        });
    });
</script>  
        <!-- SCRIPTS -->

       <!-- BOOTSTRAP JS -->
    <script src="<?= base_url('build/assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>


    <!-- SHOW PASSWORD JS -->
    <script src="<?= base_url('build/assets/show-password.js'); ?>"></script>



        <!-- END SCRIPTS -->

    </body>

</html>