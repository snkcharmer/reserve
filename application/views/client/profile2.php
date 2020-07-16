
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>National Maritime Polytechnic</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/ionicons.css">
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	
	<script src="<?php echo base_url()?>plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url()?>plugins/select2/js/select2.full.min.js"></script>
	<script src="<?php echo base_url()?>js/reserve.js"></script>
	<script src="<?php echo base_url()?>plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url()?>plugins/jquery-validation/additional-methods.min.js"></script>
	<script src="<?php echo base_url()?>plugins/sweetalert2/sweetalert2.min.js"></script>

</head>
<script>
	$(function () {
		$('.select2').select2();
	});
</script>

<style>
	.has-error .select2-selection {
		border-color: rgb(185, 74, 72) !important;
		border-width: medium;
	}
</style>
<body class="hold-transition">

<?php $this->load->view("client/clientmenu/navbar-client"); ?>
	
	
 <section class="content">
	<section class="content-header">
	</section>
    <div class="container">
       

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card card-danger card-outline">
					<div class="card-header">
						<h3 class="card-title">Your Enrollment Profile</h3>
					</div>
					<div class="card-body">
							<div class="row">
						 
								<div class="col-lg-3">
								  <!-- text input -->
								  <div class="form-group">
									<label>Last Name</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-3">
								  <div class="form-group">
									<label>First Name</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-3">
								  <div class="form-group">
									<label>Middle Name</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-1 col-sm-6">
								  <div class="form-group">
									<label>Suffix</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-2 col-sm-6">
								  <div class="form-group">
									<label>Sex</label>
										<?php 
										$class = (empty(form_error('sex')) ? 'class="form-control"' : 'class="form-control is-invalid"');
										$sex = array(
											"" => '',
											"M" => 'Male',
											"F" => 'Female',
										);
										echo form_dropdown('sex', $sex, set_value('sex'), $class); ?>
								  </div>
								</div>
							</div>
							<div class="row">
						 
								<div class="col-lg-3">
								  <!-- text input -->
								  <div class="form-group">
									<label>Civil Status</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-3">
								  <div class="form-group">
									<label>Birth Date</label>
									<input type="date" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-3">
								  <div class="form-group">
									<label>Birth Place<span class="font-italic" style="font-size:70%"> (Municipality)</span></label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-3">
								  <div class="form-group">
									<label>Citizenship</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								
							</div>
							<div class="row">
						 
								<div class="col-lg-3">
								  <div class="form-group">
									<label>Zipcode</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-3">
								  <div class="form-group">
									<label>Region</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								<div class="col-lg-6">
								  <div class="form-group">
									<label>Municipality</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								
								
							</div>
							<div class="row">
						 
								<div class="col-sm-12">
								  <div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								
							</div>
							
							<div class="row">
						 
								<div class="col-sm-6">
								  <div class="form-group">
									<label>Email Address</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								
							</div>
							<div class="row">
						 
								<div class="col-lg-6">
								  <div class="form-group">
									<label>Course</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								
								<div class="col-lg-6">
								  <div class="form-group">
									<label>School</label>
									<input type="text" class="form-control" placeholder="">
								  </div>
								</div>
								
							</div>
							
					</div>
					
				</div>
			</div>
			
			<div class="col-lg-12 col-md-12">
				<div class="card card-danger card-outline">
					<div class="card-header">
						<h3 class="card-title">Contact Person in Case of Emergency</h3>
					</div>
					<div class="card-body">
						<div class="row">
					 
							<div class="col-sm-6">
							  <div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" placeholder="">
							  </div>
							</div>
							
							<div class="col-sm-6">
							  <div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" placeholder="">
							  </div>
							</div>
							
							<div class="col-sm-6">
							  <div class="form-group">
								<label>Phone</label>
								<input type="text" class="form-control" placeholder="" value="<?php echo set_value('quantity', '0'); ?>">
							  </div>
							</div>
							
							<div class="col-sm-6">
							  <div class="form-group">
								<label>Relationship</label>
								<input type="text" class="form-control" placeholder="">
							  </div>
							</div>
							
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 offset-sm-6 col-lg-4 offset-lg-8 mb-3">
									
				<button type="submit" class="btn btn-block bg-gradient-success btn-lg" id="btn-register">Save</button>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function () {
		<?php
			$success = $this->session->flashdata("success");
			if  (!empty($success)) { ?>
				Swal.fire(
				  'Congratulations!',
				  'Please process your needed requirements and payment within 48 hours.',
				  'success'
				);
		<?php } ?>
	});
</script>
</body>
</html>
