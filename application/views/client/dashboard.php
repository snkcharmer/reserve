
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
	<script src="<?php echo base_url()?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

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
			<div class="col-lg-5">
				<div class="card-box">
					<div class="register-logo">
						<a href="../../index2.html"><b>NMP Online Enrollment</b></a>
					</div>
  
				  <div class="card">
					<div class="card-body">
					  <p class="login-box-msg"><span class="badge badge-warning">Step 1</span> : Please select Module and Schedule below</p>
						<input type="hidden" id="hiddenid" value="<?php echo $idnum?>" name="hiddenid" />
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
							  <span class="badge badge-warning">Step 2</span> : Add your desired schedule on your reservation list
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
							<tr id="trNoData">
								<td colspan="3" style="text-align:center">No module/schedule selected</td>
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
						  <span class="badge badge-warning">Step 3</span> : Click this button to confirm your reservation -->
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
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card card-danger card-outline">
					<div class="card-header">
						<h3 class="card-title">Your Enrollment Activity</h3>
					</div>
					<div class="card-body p-0 table-responsive">

						<table class="table table-striped" id="table-enrollment-activity" style="text-align:center">
							<thead>
								<tr>
									<th class=" align-middle"  style="width: 10px">#</th>
									<th class=" align-middle" >ID</th>
									<th class=" align-middle" >Module Name</th>
									<th class=" align-middle" >Schedule</th>
									<th class=" align-middle" >Status</th>
									<th class=" align-middle" >Remarks</th>
									<th class=" align-middle" >Date Enrolled</th>
									<th class=" align-middle" ><span class="badge badge-warning">Step 4</span> : <br> Update Profile</th>
									<th class=" align-middle" ><span class="badge badge-warning">Step 5</span> : <br> Upload Payment Image</th>
								</tr>
							</thead>
							<tbody s>
								<?php 
								$act_ctr = 0;
								if ($activities->num_rows() > 0) {
									
									foreach ($activities->result_array() as $activity) { ++$act_ctr; ?>
									<tr>
										<td>
											<?php echo $act_ctr; ?>
											<input type="hidden" value="<?=$activity["resid"]?>" name="">
										</td>
										<td style="text-align:center"><?=date("Ym-",strtotime($activity["dateReserve"])).$activity["resid"]?></td>
										<td style="text-align:center"><?=$activity["module"]?></td>
										<td style="text-align:center"><?=$activity["start"]?></td>
										<td style="text-align:center"><?php 
											if ($activity["expired"] == 0) {
												echo "Pending";
											} elseif ($activity["expired"] == 1) {
												echo "Expired";
											} elseif ($activity["expired"] == 2) {
												echo "Enrolled";
											} else { 
												echo "---" ;
											} 
											?></td>
										<td style="text-align:center"><?=$activity["remarks"]?></td>
										<td style="text-align:center"><?=$activity["dateReserve"]?></td>
										<td style="text-align:center">
											<?php if ($activity["profile"] == 0) {?>
											<a href="<?=base_url()?>client/profile/<?=$activity["conf_token"]?>/<?=$activity["resid"]?>" class="" style="color:#dc3545;"><i class="nav-icon fas fa-times "></i> Not Updated</a></td>
											<?php } else {  ?>
											<a href="<?=base_url()?>client/profile/<?=$activity["conf_token"]?>/<?=$activity["resid"]?>" class="get-resid" style="color:#28a745;"><i class="nav-icon fas fa-check "></i> Updated</a></td>
											<?php }  ?>
											
										<td style="text-align:center"><a href="#" class="get-resid"><i class="nav-icon fas fa-eye "></i> View</a></td>
									</tr>
								<?php } } else { ?>
								<tr>
									<td colspan="6" style="text-align:center">You have no pending process</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
			
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="paymentSlip">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Payment Slip</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<table class="table table-striped" id="table-payment-slip" style="text-align:center">
					<thead>
						<tr>
							<th style="width: 10px">#</th>
							<th>Module</th>
							<th>Schedule</th>
							<th>Amount</th>
							<th>Date Enrolled</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<?php echo form_open_multipart('client/do_upload','id="form-payment-upload"');?>
				<div class="form-group">
                    <label for="uploadattachment" style="color:red">Step 5: Please Upload an image of your payment.</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="uploadattachment" name="uploadattachment" required>
                        <input type="hidden" name="payment-resid" id="payment-resid" required>
                        <input type="hidden" name="payment-idnum" id="payment-idnum" value="<?=$idnum?>" required>
                        <label class="custom-file-label" for="uploadattachment">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text btn btn-success" id="btn-upload-attachment">Upload Image</span>
                      </div>
                    </div>
                  </div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				
				<button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
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
		
		bsCustomFileInput.init();
	});
</script>
</body>
</html>
