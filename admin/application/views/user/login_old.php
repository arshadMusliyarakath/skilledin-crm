<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body>


    <div class="main">
      	<div class="inner-content">
              <div class="row">
                <div class="col-md-6">
                    <div class="bg-area" id="vanta-containers">
                      <div class="icon"><img src="assets/login-images/icon.png"></div>
                      <div id="currentTime">00:00</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-area">
                        <h2>Login</h2>
                        <p class="hint"><b>Welcome back!</b> Please enter your credencials.</p>
                            <?php
                              $error_message = $this->session->flashdata('error');
                              if ($error_message) { echo '<p class="alert alert-danger">' . $error_message . '</p>'; }
                            ?>
                        <hr>
                        <form method="POST" action="">
                            <div class="mb-3">
                              <label for="" class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" placeholder="Enter your email" value="admin@admin.com" autofocus="" required="">
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Password</label>
                              <input type="password" class="form-control" name="password" placeholder="Enter your password" value="123" required="">
                            </div>
                            <button type="submit" class="btn btn-primary login-button">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                            <div class="forgot"><a href="#" data-bs-toggle="modal" data-bs-target="#forgt-password-modal">Forgot Password</a></div>
                          </form>
                    </div>
                </div>
              </div> 
        </div>
    </div>




<!-- Modal -->
<div class="modal fade" id="forgt-password-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<style type="text/css">
body{
  font-family: 'Inter', sans-serif;
}
.main {
    background-color: #727272;
    background-image: url('assets/login-images/bg-main.jpg');
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;  
}
.inner-content {
    width: 900px;
    background: white;
    margin: 0 auto;
    box-shadow: 0px 0px 33px 5px rgba(0,0,0,0.2);
    border-radius: 20px;
}
.bg-area {
    position: relative;
    height: 500px;
    background-image: url('assets/login-images/login-bg.jpg');
    background-position: center;
    background-size: cover;
    border-radius: 20px 0px 0px 20px;
}
h2 {
    color: #111c43;
}
input.form-control {
    border: 1px solid;
    border-color: rgba(0,0,0,0.3);
}
.login-area {
    width: 75%;
    margin: 0 auto;
    margin-top: 80px;
}

.login-button {
    width: 100%;
    background: #111c43;
    border-color: #111c43;
    transition: all .4s;
    margin-bottom: 9px;
}
.login-button:hover {
    background:#00071f;
    border-color: #00071f;
}
.form-control::placeholder {
  font-size: 13px; 
}
p.hint {
    font-size: 14px;
}
.icon img {
    width: 70px;
    position: absolute;
    right: 0;
    top: 61px;
}
.forgot {
    text-align: center;
}
.forgot a:link {
    text-decoration: none;
    font-size: 13px;
}
.btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
    background:#00071f;
    border-color: #00071f;
}
div#currentTime {
    position: absolute;
    color: #6299eb;
    bottom: 25px;
    left: 33px;
    opacity: 0.5;
    font-size: 16px;
}
p.alert.alert-danger {
    padding: 6px 16px;
}



.blinking-colon {
      animation: blink 1s infinite;
    }

    @keyframes blink {
      50% {
        opacity: 0;
      }
    }
</style>

<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@0.5.22/dist/vanta.net.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    VANTA.NET({
      el: "#vanta-container",
      mouseControls: true,
      touchControls: true,
      gyroControls: true,
      minHeight: 200.00,
      minWidth: 200.00,
      scale: 1.00,
      scaleMobile: 1.00,
      color: 0x3f79ff,
      backgroundColor: 0x15153c
    });
  });
</script> -->
<script>
  $(document).ready(function() {
    function getCurrentTime() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var meridiem = hours >= 12 ? 'PM' : 'AM';

      // Convert to 12-hour format
      hours = hours % 12;
      hours = hours ? hours : 12; // The hour '0' should be '12'

      // Add leading zero to hours and minutes if needed
      hours = hours < 10 ? '0' + hours : hours;
      minutes = minutes < 10 ? '0' + minutes : minutes;

      var formattedTime = hours + '<span class="blinking-colon">:</span>' + minutes + ' ' + meridiem;
      return formattedTime;
    }

    // Update the time every second
    setInterval(function() {
      $('#currentTime').html(getCurrentTime());
    }, 1000);
  });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>