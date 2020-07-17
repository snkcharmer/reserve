<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>National Maritime Polytechnic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url()?>images/NMP.ico" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>index2.html"><b>NMP</b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php $rand = rand(0,13);
			switch ($rand) {
				case 1:
					echo "I know you're loved. Sign in!";
					break;
				case 2:
					echo "Sign in! You're doing great!";
					break;
				case 3:
					echo "Sign in and be amazed.";
					break;
				case 4:
					echo "Enter the dragon.";
					break;
				case 5:
					echo "You only fail when you stop trying.";
					break;
				case 6:
					echo "Sign in and be amazed.";
					break;
				case 7:
					echo "Never give up. Sign in now.";
					break;
				case 8:
					echo "Be the Change that you wish to see in the world.";
					break;
				case 9:
					echo "Some things take time. Sign in para di madugay.";
					break;
				case 10:
					echo "Thing will get better. Hold on and Sign in.";
					break;
				case 11:
					echo "Life is a gift. Be surprised.";
					break;
				case 12:
					echo "Speed defines the winner. Sign in fast.";
					break;
				case 13:
					echo "Break the limits.";
					break;
				default:
					echo "Sign in bebeh koh.";
					break;
				}?>
		</p>

      <form onsubmit="" id="login-form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" id="input-username" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
		  <span style="color: red" id="error-username"></span>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="input-password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		  <span style="color: red" id="error-password"></span>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url()?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>

<script>

	$(document).ready(function (e) {
		// e.preventDefault();
		let url = "<?= base_url() ?>";
		let token = localStorage.getItem("token");

		if(token){
			window.location.replace(url+"admin/dashboard");
		}

		$("#login-form").submit(function (e) {
			e.preventDefault();
			if ($("#input-username").val() === ""){
				$("#error-username").text("Username field is required");
				$("#input-username").css("border", "1px solid red");
			}

			if ($("#input-password").val() === ""){
				$("#error-password").text("Password field is required");
				$("#input-password").css("border", "1px solid red");
			}

			if ($("#input-username").val() !== "" && $("#input-password").val() !== ""){
				$.ajax({
					type: "POST",
					url: url+"admin/userlogin",
					data: {
						username: $("#input-username").val(),
						password: $("#input-password").val()
					},
					success: function (res){
						if(res === "failed"){
							alert("Ops! The username and password you've entered is not registered...");
						}else{
							localStorage.token = $("#input-username").val();
							window.location.replace(url+"admin/dashboard");
						}

					}
				});
			}
		});
	});
</script>
</body>
</html>
