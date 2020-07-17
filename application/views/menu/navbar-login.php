<nav id="navbar" class="navbar navbar-expand navbar-blue navbar-light" data-baseurl="<?php echo base_url()?>"
	style="height: 100px">
	
	<div class="container">
		<div class="row">
		
			<div class="col-lg-12 col-xs-12">
				<img src="<?php echo base_url()?>images/nmp2.png" alt="AdminLTE Logo" class="img-fluid" style="height: auto; max-height: 100px;">
			</div>
		</div>
			<div class="col-lg-6 col-xs-12" id="section-login">
				<div class="row">
					<?php echo form_open(base_url().'client/confirmlogin', 'class="container" id="nmploginform"'); ?>
					
						<div class="col-lg-5 col-sm-12">
							<div class="input-group input-group-sm">
								<input type="email" class="form-control form-control-navbar" placeholder="Email" name="loginemail" id="loginemail" required >
							</div>
						</div>
						<div class="col-lg-5 col-sm-12">
							<div class="input-group input-group-sm">
								<input type="password" class="form-control form-control-navbar" placeholder="Password" id="loginpassword" name="loginpassword" required >
							</div>
						</div>
						<div class="col-md-2">
							<div class="input-group input-group-sm">
								<button id="btn-confirm-login" type="submit" class="btn btn-success btn-sm btn-block float-right ">Login</button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
				<div class="row" style="padding-left: 15px">
					<span class="text-danger" style="font-size: 80%">
						<?php 
							$err = $this->session->flashdata("details");
							echo  (empty($err) ? "" : $err . "&nbsp;&nbsp;") ?> 
					</span>
					<a href=""  style="font-size:13px; color:#fff"> Forgot Password? </a>	
				</div>

			</div>
		
    </div>
	
</nav>