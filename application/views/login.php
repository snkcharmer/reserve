<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>National Maritime Polytechnic - Online Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>css/ionicons.css">
  <link rel="stylesheet" href="<?php echo base_url()?>css/mediascreens.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Google Font: Source Sans Pro 
  <link rel="stylesheet" href="<?php echo base_url()?>js/ionicons.css">-->
  
  <link rel="stylesheet" href="<?php echo base_url()?>plugins/select2/css/select2.min.css">
	<!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/adminlte.min.css">
  <script src="<?php echo base_url()?>plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>plugins/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url()?>plugins/sweetalert2/sweetalert2.min.js"></script>

  <script src="<?php echo base_url()?>js/reserve.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
	
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2();
	});
</script>

<body class="hold-transition">

<?php $this->load->view("menu/navbar-login"); ?>
	
<section class="content" id="section-small-login">
	<section class="content-header">
	</section>
    <div class="container">
        <div class="row">
			<div class="col-lg-5">
				<div class="card-box">
					<div class="register-logo">
						Welcome to <b>NMP Online Registration.</b> 
					</div>
				</div>
			</div>
			
			<div class="col-lg-7 col-md-12">
				<div class="card card-primary card-outline">
					<?php echo form_open(base_url().'client/confirmlogin', 'class="container" id="nmploginform-small"'); ?>
					<div class="card-body register-card-body">
						<div class="input-group mb-3">
								  
						  <input type="email" class="form-control <?php echo (empty(form_error('emailsmall')) ? '' : 'is-invalid')?>" placeholder="Email" name="loginemail" required value="<?php echo set_value('emailsmall'); ?>">
							
						  <div class="input-group-append">
							<div class="input-group-text">
							  <span class="fas fa-envelope"></span>
							</div>
						  </div>
						</div>
						<div class="input-group mb-3">
								  
						  <input type="password" class="form-control <?php echo (empty(form_error('passwordsmall')) ? '' : 'is-invalid')?>" placeholder="Password" name="loginpassword" required value="<?php echo set_value('eadd'); ?>">
							
						  <div class="input-group-append">
							<div class="input-group-text">
							  <span class="fas fa-lock"></span>
							</div>
						  </div>
						</div>
						<div class="row">
						  <div class="col-sm-12 col-xs-12">
							
							<button type="submit" class="btn btn-danger btn-block" id="btn-login-small">Login</button>
						  </div>
						  <!-- /.col -->
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
	
 <section class="content">
	<section class="content-header">
	</section>
    <div class="container">
        <div class="row" style="margin-top:10px">
			<div class="col-lg-5">
				<div class="card-box">
					<div class="register-logo"  id="section-big-register">
						Welcome to <b>NMP Online Registration.</b> Register online anywhere and anytime. 

					</div>
				</div>
			</div>
			
			<div class="col-lg-7 col-md-12">
				<div class="card card-primary card-outline">

					  <div class="card-header">
						<h3 class="card-title">Register</h3>
					  </div>
							<div class="card-body register-card-body">
								
							  <form action="<?php echo base_url() ?>client/index" method="post" id="nmpregform">
								<?php //echo validation_errors('<div class="error">', '</div>'); ?>
								<div class="row mb-3">
									<div class="col-4">
										<?php echo form_error('lname'); ?>
										<input type="text" class="form-control <?php echo (empty(form_error('lname')) ? '' : 'is-invalid')?>" placeholder="Last Name" name="lname" value="<?php echo set_value('lname'); ?>">
									</div>
									<div class="col-4">
										<?php echo form_error('fname'); ?>
										<input type="text" class="form-control <?php echo (empty(form_error('fname')) ? '' : 'is-invalid')?>" placeholder="First Name" name="fname" required value="<?php echo set_value('fname'); ?>">
									</div>
								   <div class="col-4">
								  <input type="text" class="form-control" placeholder="Middle Name" name="mname" value="<?php echo set_value('mname'); ?>">
								  </div>
								</div>
								<div class="input-group mb-3">
								  
								  <input type="email" class="form-control <?php echo (empty(form_error('eadd')) ? '' : 'is-invalid')?>" placeholder="Email" name="eadd" required value="<?php echo set_value('eadd'); ?>">
									
								  <div class="input-group-append">
									<div class="input-group-text">
									  <span class="fas fa-envelope"></span>
									</div>
								  </div>
									<?php if (!empty(form_error('eadd'))) { ?>
									<span id="" class="error invalid-feedback">Email Address already taken</span>
									<?php } ?>
								</div>
								<div class="input-group mb-2">
									Birth Date <?php echo form_error('year','<div class="error">', '</div>'); ?>
								</div>
								  <div class="row mb-3">
									  <div class="col-3">
										<?php 
										$class = (empty(form_error('year')) ? 'class="form-control"' : 'class="form-control is-invalid"');
										$month = array(
											"" => '',
											"01" => 'January',
											"02" => 'February',
											"03" => 'March',
											"04" => 'April',
											"05" => 'May',
											"06" => 'June',
											"07" => 'July',
											"08" => 'August',
											"09" => 'September',
											"10" => 'October',
											"11" => 'November',
											"12" => 'December',
										);
										echo form_dropdown('month', $month, set_value('month'), $class); ?>
									  </div>
									  <div class="col-4">
										<?php 
										$day = array(
											"" => '',
											"01" => '1',
											"02" => '2',
											"03" => '3',
											"04" => '4',
											"05" => '5',
											"06" => '6',
											"07" => '7',
											"08" => '8',
											"09" => '9',
											"10" => '10',
											"11" => '11',
											"12" => '12',
											"13" => '13',
											"14" => '14',
											"15" => '15',
											"16" => '16',
											"17" => '17',
											"18" => '18',
											"19" => '19',
											"20" => '20',
											"21" => '21',
											"22" => '22',
											"23" => '23',
											"24" => '24',
											"25" => '25',
											"26" => '26',
											"27" => '27',
											"28" => '28',
											"29" => '29',
											"30" => '30',
											"31" => '31',
										);
										echo form_dropdown('day', $day, set_value('day'), $class); ?>
									  </div>
									  <div class="col-5">

											<?php $yearnow = date("Y"); 
												$year[""] = ""; 
												for ($i = $yearnow; $yearnow - $i < 120; $i--) 
												{
													$year[$i] = $i; 
												}
												echo form_dropdown('year', $year, set_value('year'), $class);												
											?>
									  </div>
									</div>
								<div class="input-group mb-3">
									<?php echo $this->session->flashdata("password"); ?>
									<?php echo $this->session->flashdata("mismatch"); ?>
								  <input type="password" class="form-control" placeholder="Password" name="password1" id="password1" required>
								  <div class="input-group-append">
									<div class="input-group-text">
									  <span class="fas fa-lock"></span>
									</div>
								  </div>
								</div>
								<div class="input-group mb-3">
								  <input type="password" class="form-control" placeholder="Retype password" name="password2" id="password2" required>
								  <div class="input-group-append">
									<div class="input-group-text">
									  <span class="fas fa-lock"></span>
									</div>
								  </div>
								</div>
								<div class="input-group mb-3">
								  <div class="g-recaptcha" data-sitekey="6Lcegq8ZAAAAAJ1NBRjiSPN9erll1AJ_ySXSRWvl"></div>
								</div>
								<div class="row">
								  <div class="col-8 form-group mb-0">
									<div class="custom-control custom-checkbox">
									  <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
									  <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
									</div>
								  </div>
								  <!-- /.col -->
								  <div class="col-4">
									
									<button type="submit" class="btn btn-primary btn-block" id="btn-register">Register</button>
								  </div>
								  <!-- /.col -->
								</div>
								
							  </form>

							</div>

				</div>
			</div>
		</div>
	</div>
</section>


<script src="<?php echo base_url()?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {

  $('#nmpregform').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
	  lname: {
        required: true,
      },
      password1: {
        required: true,
        minlength: 5,
      },
	  password2: {
        equalTo: "#password1",
      },
      terms: {
        required: true
      },
		day: {
        required: true
      },
		year: {
        required: true
      },
		month: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password1: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
		password2: {
        equalTo: "Password Mismatch",
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.input-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
	submitHandler: function () {
		$( "#btn-register" ).prop('disabled', true);
		$( "#btn-register" ).text("");
		$( "#btn-register" ).append('<i class="fas fa-sync-alt fa-spin"></i> Please wait');
		form.submit();
	}
  });
	
	<?php
		$email_confirmed = $this->session->flashdata("emailconfirmed");
		if  (!empty($email_confirmed)) { ?>
			  Swal.fire(
				  'Welcome to NMP Online Registration!',
				  'You have successfully verified your email! Please login to start your enrollment.',
				  'success'
				);
		<?php } ?>
	<?php
		$emailsent = $this->session->flashdata("emailsent");
		if  (!empty($emailsent)) { ?>
			  Swal.fire(
				  'Email verification sent!',
				  'Please check your email to verify registration.',
				  'success'
				);
		<?php } ?>

});
</script>
</body>
</html>
