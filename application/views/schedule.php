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
  <script src="<?php echo base_url()?>plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>plugins/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>js/reserve.js"></script>
</head>
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2();
	});
</script>

<body class="hold-transition">

	<nav id="navbar" class="navbar navbar-expand navbar-red navbar-light" data-baseurl="<?php echo base_url()?>">
	  <!-- Left navbar links -->
	  <ul class="navbar-nav">
		<li class="nav-item">
		  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
		  <a href="#" class="nav-link">Home</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
		  <a href="#" class="nav-link">Contact</a>
		</li>
	  </ul>

	  <!-- SEARCH FORM -->
	  <form class="form-inline ml-3">
		<div class="input-group input-group-sm">
		  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
		  <div class="input-group-append">
			<button class="btn btn-navbar" type="submit">
			  <i class="fas fa-search"></i>
			</button>
		  </div>
		</div>
	  </form>
	</nav>
	
	
 <section class="content">
	<section class="content-header">
	</section>
    <div class="container">
        <div class="row">
			<div class="col-lg-5">
				<div class="card-box">
					<div class="register-logo">
						<a href="../../index2.html"><b>NMP Registration</b></a>
					</div>
  
				  <div class="card">
					<div class="card-body">
					  <p class="login-box-msg">Step 1: Please select Module and Schedule below</p>

					  <form action="../../index.html" method="post">
						<div class="input-group mb-3">
							<label>Module Name</label>
							  <select class="form-control select2" style="width: 100%;" id="sel-module">
								<option value="" selected>Please select</option>
								<?php foreach($modules as $module) { ?>
								<option value="<?php echo $module["modcode"]; ?>">
									<?php echo $module["module"] . " - [". $module["descriptn"] . "]" . " (P" . number_format($module["fee"],2) .")"; ?>
								</option>
								<?php } ?>
							  </select>
						</div>
						<div class="input-group mb-3">
							<label>Schedule</label>
							  <select class="form-control select2" style="width: 100%;" id="sel-schedule">
							  </select>
						</div>
						<div class="row">
						  <div class="col-8">
							<div class="icheck-primary">
							  
							   
							  Step 2: Add your desired schedule on your reservation list
							</div>
						  </div>
						  <!-- /.col -->
						  <div class="col-4">
							<button type="button" class="btn btn-primary btn-block" id="btn-add-reserve">Add</button>
						  </div>
						  <!-- /.col -->
						</div>
					  </form>


					</div>
					<!-- /.form-box -->
				  </div><!-- /.card -->
				</div>
			</div>
			
			<div class="col-lg-7 col-md-12">
				<div class="card card-primary card-outline">
					<div class="card">
					  <div class="card-header">
						<h3 class="card-title">Your Reservation List</h3>
					  </div>
					  <!-- /.card-header -->
					  <div class="card-body p-0">
						<table class="table table-striped" id="table-reserve-list">
							<thead>
							<tr>
								 <!--<th style="width: 10px">#</th>-->
								<th>Module Name</th>
								<th>Schedule</th>
								<th style="width: 40px"></th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
								<td colspan="3" style="text-align:center">You have no module selected</td>
							</tr>
						  </tbody>
						</table>
					  </div>
					  
					  <!-- /.card-body -->
					</div>
				<div class="card-footer clearfix">
					<div class="row">
					  <div class="col-8">
						<div class="icheck-primary">
						  Step 3: Click this button to confirm your reservation -->
						</div>
					  </div>
					  <!-- /.col -->
					  <div class="col-4">
						<button id="btn-confirm-reservation" type="button" class="btn btn-success btn-block float-right">Proceed Reservation</button>
					  </div>
					  <!-- /.col -->
					</div>
				</div>
					
				<!-- /.card -->
				</div>
			</div>
		</div>
	</div>
</section>

</body>
</html>
