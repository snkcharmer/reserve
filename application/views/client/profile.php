
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
	<script src="<?php echo base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url()?>plugins/select2/js/select2.full.min.js"></script>

	<script src="<?php echo base_url()?>plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url()?>plugins/jquery-validation/additional-methods.min.js"></script>
	<!--- Sweet Alert New Version
	<script src="<?php echo base_url()?>plugins/sweetalert2/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	-->
	
	<!--- Sweet Alert Old Version -->
	<link rel="stylesheet" href="<?php echo base_url()?>js/nea/sweetalert/sweetalert.css">
    <script src="<?php echo base_url()?>js/nea/sweetalert-dev.js"></script>

</head>

<style>
	
	.has-error{
        border-color: red !important;
    }
	 #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<body class="hold-transition">

<?php $this->load->view("client/clientmenu/navbar-client"); ?>
	
	 <div class="row progress" style="height: 25px; display:none;">
            <div  class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
 <section class="content">
	<section class="content-header">
	</section>
        <div class="container" style=""> 
             <h1 style="text-align: center;font-weight: bold;">Registration Form</h1>
			<div class="card card-danger">
				<div class="card-header" style=""> 
					<h5 style="padding-top: 5px;"><b>Instructions: </b>Fill up all required field and check all necessary boxes. field with <span style="color: blue;">asterisk (*)</span> is a required field</h5>
				</div>
            <div class="card-body" style=""> 
				<form id="regiration_form" action=""  method="post">
					<input type="hidden" id="flag" value="<?php echo $flag;?>">
					<input type="hidden" id="locid" value="">
					<input type="hidden" id="trid" value="">
					<input type="hidden" id="csid" value="">
					<input type="hidden" id="schoolid" value="">
					<input type="hidden" id="cpid" value="">
					<input type="hidden" id="seid" value="">
					<input type="hidden" id="resid" value="<?=$resid?>">
					<input type="hidden" id="token" value="<?=$token?>">

					<fieldset>
						<h2>Step 1: General Information</h2>
						<hr>

								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<label>First Name <span style="font-size: 17px;color: red;">*</span></label>
											<input type="text" class="form-control"  name="fname" id="fname" placeholder="" value="<?php if(isset($rec['fname'])){echo $rec['fname'];}?>" required />
											
										</div>
									</div> 
									<div class="col-lg-3">   
										<div class="form-group">
											<label class="control-label">Last Name <span style="font-size: 17px;color: red;">*</span></label>
											<input type="text" class="form-control" name="lname" id="lname" placeholder="" value="<?php if(isset($rec['lname'])){ echo $rec['lname'];}?>" required  />
											
										</div>
									</div>
									<div class="col-lg-3 col-md-12">    
										<div class="form-group">
											<label class="control-label">Ext (Jr, Sr, II etc.) <span style="font-size: 12px;color: red;"></span></label>
											<input type="text" class="form-control" name="ext" id="ext" placeholder="" value="<?php if(isset($rec['suffix'])){ echo $rec['suffix'];}?>" />
											
										</div>
									</div>
									<div class="col-lg-3">    
										<div class="form-group">
											<label class="control-label">Middle Name <span style="font-size: 12px;color: red;"></span></label>
											<input type="text" class="form-control" name="mname" id="mname" placeholder="" value="<?php if(isset($rec['mname'])){ echo $rec['mname'];}?>" />
											
										</div>
									</div>
								</div> 
								<div class="row">
									<div class="col-lg-3">    
										<div class="form-group">
											<label class="control-label">Gender <span style="font-size: 17px;color: red;">*</span></label>  
											<div class ="radio">
												<label style="font-size: 1.1em;font-weight: bold;">
													<input type="radio" name="optgender" value="M" <?php if(isset($rec['sex'])){if($rec['sex'] == 'M'){echo "checked";}}?> required />
													Male 
												</label>
												<label style="font-size: 1.1em;font-weight: bold;">
													<input type="radio" name="optgender"  value="F" <?php if(isset($rec['sex'])){if($rec['sex'] == 'F'){echo "checked";}}?>>
													Female
												</label>
											</div>
											  
										</div>
									</div> 
									<div class="col-lg-3">    
										<div class="form-group">
											<label class="control-label">Citizenship <span style="font-size: 17px;color: red;">*</span></label>
											<input type="text" class="form-control" name="citi" id="citi" value="Filipino" placeholder="Citizenship" required />
											
										</div>
									</div>
									<div class="col-lg-3">    
										<div class="form-group">
											<label class="control-label">Civil Status <span style="font-size: 17px;color: red;">*</span></label>
											<select class="form-control" name="cstatus" id="cstatus" required>
											   <option value="">Select ....</option>
											   <option value="1" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '1'){echo "selected";}}?> >Single</option>
											   <option value="2" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '2'){echo "selected";}}?> >Married</option>
											   <option value="3" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '3'){echo "selected";}}?> >Widow(er)</option>
											   <option value="4" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '4'){echo "selected";}}?> >Separated </option>
											   <option value="5" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '5'){echo "selected";}}?> >Annulled</option>
											</select>
											
										</div>
									</div>
									<div class="col-lg-3">    
										<div class="form-group">
											<label class="control-label">Birthdate <span style="font-size: 17px;color: red;">*</span></label>
											<input type="date" class="form-control" name="bdate" id="bdate" value="<?php if(isset($rec['bdate'])){ echo $rec['bdate'];}?>" placeholder="Birthdate" required />
											
										</div>
									</div>
								</div> 
						<div class="row">
							<div class="col-lg-12">    
								<div class="form-group">
									<input type="text" class="form-control" name="bplace" id="bplace" value="<?php if(isset($rec['bplace'])){ echo $rec['bplace'];}?>" placeholder="" required />
									<label class="control-label">Birthplace <span style="font-size: 17px;color: red;">*</span> <small>(Municipality)</small></label>
								</div>
							</div>
						</div>
						<div class="row">
							<h5 style="font-weight: 600;padding: 10px;font-size: 18px;">Complete Mailing Address</h5>
						</div>
						<div class="row">
							<div class="col-lg-3"> 
								<div class="form-group">
									<select class="form-control mcid" name="mcid" id="mcid" required>
									   <option value="">Select ....</option>
									   <?php
										//if($flag == 1){
										foreach($mun->result_array() as $value) {?>
										<option value="<?php echo $value['idnum']?>" <?php if(isset($rec['locid'])){if($rec['locid'] == $value['idnum']){echo "selected";}}?>><?php echo $value['municipal'] . ", " . $value['province']?></option>
										<?php
									   // }
										}
										?>
									</select>
									<label class="control-label">Municipality/City <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							<div class="col-lg-3"> 
								<div class="form-group">
									<input type="text" class="form-control regid" name="regid" id="regid" value="<?php if(isset($rec['region'])){ echo $rec['region'];}?>" placeholder="Region" required readonly />
									<!-- <select class="form-control regid" name="regid" id="regid" style="width: 100%;" required>
									   <option value="">Select ....</option>
										<?php
										//foreach ($reg->result_array() as $key) {?>
											<option value="<?php //echo $key['region']?>" <?php //if(isset($rec['region'])){if($rec['region'] == $key['region']){echo "selected";}}?>><?php// echo $key['region']?></option>
										<?php
									   // }
									   ?>
									</select> -->
									<label class="control-label">Region <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>  
							<div class="col-lg-3"> 

								<div class="form-group">
									<input type="text" class="form-control provid" name="provid" id="provid" value="<?php if(isset($rec['province'])){ echo $rec['province'];}?>" placeholder="Province" required readonly />
									<!-- <select class="form-control provid" name="provid" id="provid" style="height: 50px;width: 100%;" required>
									   <option value="">Select ....</option>
										<?php
										//if($flag == 1){
									   // foreach($prov->result_array() as $value) {?>
										<option value="<?php //echo $value['province']?>" <?php //if(isset($rec['province'])){if($rec['province'] == $value['province']){echo "selected";}}?>><?php// echo $value['province']?></option>
										<?php
									   // }
									   // }
										?>
									</select>-->
									<label class="control-label">Province <span style="font-size: 17px;color: red;">*</span></label>
								</div> 
							</div> 
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" name="pcode" id="pcode" value="<?php if(isset($rec['code'])){ echo $rec['code'];}?>" placeholder="Postal Code" readonly />
									<label class="control-label">Postal Code / Zip Code  <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div> 
						</div>
						<div class="row">
							<div class="col-lg-12">    
								<div class="form-group">
									<input type="text" class="form-control" name="address" id="address" value="<?php if(isset($rec['address'])){ echo $rec['address'];}?>" placeholder="" />
									<label class="control-label">House No. / Street / Barangay  <span style="font-size: 12px;color: red;"></span></label>
								</div>
							</div>
						</div> 
						<div class="row">
							<h5 style="font-weight: 600;padding: 10px;font-size: 18px;">Contact Numbers</h5>
						</div> 
						<div class="row">
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="lnumber" id="lnumber" value="<?php if(isset($rec['landline'])){ echo $rec['landline'];}?>" placeholder="" />
									<label class="control-label">(Area Code) Landline Number </label>
								</div>
							</div> 
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" onkeypress='validate(event)' name="mnumber1" id="mnumber1" value="<?php if(isset($rec['mobile'])){ echo $rec['mobile'];}?>" placeholder="" required />
									<label class="control-label">Mobile No. 1 <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" onkeypress='validate0(event)' name="mnumber2" id="mnumber2" placeholder="" />
									<label class="control-label">Mobile No. 2 </label>
								</div>
							</div>
						</div>
						<div class="row">
							<h5 style="font-weight: 600;padding: 10px;font-size: 18px;">Social Media Account</h5>
						</div> 
						<div class="row">
							 <div class="col-lg-4">    
								<div class="form-group">
									<input style="text-transform: none;" type="email" class="form-control" name="user_email" id="user_email" value="<?php if(isset($rec['eadd'])){ echo $rec['eadd'];}?>" placeholder="Email Address" disabled />
									<label class="control-label">Email Address</label>
								</div>
							</div>
							<div class="col-lg-4">    
								<div class="form-group">
									<input style="text-transform: none;" type="text" class="form-control" name="fbacc" id="fbacc" placeholder="Facebook Account" />
									<label class="control-label">Facebook Account </label>
								</div>
							</div>
						</div>    
					   <hr>
						<button type="button" class="next btn btn-danger pull-right" data-label="ginsave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
	 
					</fieldset>
					<fieldset>
						<h2> Step 2: Highest Educational Attainment</h2>
						<hr>
						<h3 style="font-size: 15px;"></h3>
						<div class="row">
							<div class="col-lg-10">    
								<div class="form-group">
									<input style="text-transform: none;" type="text" class="form-control" name="courseid" id="courseid" value="<?php if(isset($rec['course'])){ echo $rec['course'];}?>" placeholder="" required/>
									<label class="control-label">Course Taken </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10">    
								<div class="form-group">
									<input style="text-transform: none;" type="text" class="form-control" name="school" id="school" value="<?php if(isset($rec['school'])){ echo $rec['school'];}?>" placeholder="" required/>
									<label class="control-label">School </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">    
								<div class="form-group">
									<input type="text" class="form-control" name="schooladdress" id="schooladdress" value="<?php if(isset($rec['schooladdress'])){ echo $rec['schooladdress'];}?>" placeholder="" required />
									<label class="control-label">School Address <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
						</div>
						<hr>
						<button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;" data-label="ginsave"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
						<button type="button" class="next btn btn-danger pull-right" data-label="heasave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
						<br><br>
					</fieldset>
					<fieldset>
						<h2>Step 3: Contact Person in case of Emergency</h2>
						<hr>
						<div class="row">
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" name="fullname" id="fullname" value="<?php if(isset($rec['emname'])){ echo $rec['emname'];}?>" placeholder="Fullname" required />
									<label class="control-label">Fullname <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" name="rel" id="rel" value="<?php if(isset($rec['emrelation'])){ echo $rec['emrelation'];}?>" placeholder="Relationship" required />
									<label class="control-label">Relationship <small>(Spouse, Parent, Brother, Sister, etc.)</small> <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" name="mob1" id="mob1" onkeypress='validate1(event)' value="<?php if(isset($rec['emphone'])){ echo $rec['emphone'];}?>" placeholder="" />
									<label class="control-label">Mobile No.</label>
								</div>
							</div>
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="text" class="form-control" name="telnum" id="telnum" placeholder="" value="<?php if(isset($rec['emlandline'])){ echo $rec['emlandline'];}?>"/>
									<label class="control-label">Telephone Number </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">    
								<div class="form-group">
									<input type="email" class="form-control" name="emailadd" id="emailadd" placeholder="Email Address" value="<?php if(isset($rec['ememailadd'])){ echo $rec['ememailadd'];}?>"/>
									<label class="control-label">Email Address </label>
								</div>
							</div>
							<div class="col-lg-6">    
								<div class="form-group">
									<input type="text" class="form-control" name="caddress" id="caddress" value="<?php if(isset($rec['emaddr'])){ echo $rec['emaddr'];}?>" placeholder="Address" required />
									<label class="control-label">Complete Address <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
						</div>
						<hr>
						<button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
						<button type="button" class="next btn btn-danger pull-right" data-label="cpcesave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
						<br><br>
					</fieldset>
					<fieldset>
						<h2> Step 4: Latest Shipboard Experience <span style="color: red;font-size: 13px;"></span></h2>
						<hr>
						<h3 style="font-size: 15px;">NOTE: Please type "None" if the field is not applicable</h3>
						<div class="row">
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="licid" id="licid" value="<?php if(isset($rec['license'])){ echo $rec['license'];}?>" placeholder="License" required />
									<label class="control-label">License <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="rankid" id="rankid" value="<?php if(isset($rec['rank'])){ echo $rec['rank'];}?>" placeholder="Rank" required />
									<label class="control-label">Rank <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="date" class="form-control" name="datedis" id="datedis" value="<?php if(isset($rec['dateofdesimbarkation'])){ echo $rec['dateofdesimbarkation'];}?>"/>
									<label class="control-label">Date of Disembarkation <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="employid" id="employid" value="<?php if(isset($rec['employer'])){ echo $rec['employer'];}?>" placeholder="Employer" required />
									<label class="control-label">Employer <span style="font-size: 17px;color: red;">*</span></label>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="sprin" id="sprin" placeholder="Owner of Ship "value="<?php if(isset($rec['manningagency'])){ echo $rec['manningagency'];}?>" />
									
									<label class="control-label">Manning Company <span style="font-size: 17px;color: red;"></span></label>
								</div>
							</div>
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="lnum" id="lnum" placeholder="Landline Number" value="<?php if(isset($rec['employerlandline'])){ echo $rec['employerlandline'];}?>"/>
									<label class="control-label">(Area code)Landline Number <span style="font-size: 12px;color: red;"></span></label>
								</div>
							</div>
							<div class="col-lg-4">    
								<div class="form-group">
									<input type="text" class="form-control" name="mnum" id="mnum" placeholder="Mobile No." value="<?php if(isset($rec['employermobile'])){ echo $rec['employermobile'];}?>"/>
									<label class="control-label">Mobile Number <span style="font-size: 12px;color: red;"></span></label>
								</div>
							</div>
						</div>
						<hr>
						<button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
						<button type="button" class="next btn btn-danger pull-right" data-label="lsesave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
						<br><br>
					</fieldset>
					<fieldset>
	   
						<button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
						<button type="button" class="done btn btn-danger pull-right" style="height: 50px;font-size: 18px;">Finish <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
						<br><br>
					</fieldset>
				</form> 
				</div>
			</div>
        </div>
        <p style="font-size: 19px;text-align: center;color: black;padding-bottom: 50px;"> <span>By using this system, you agree to our <!--a href="<?php //echo base_url()?>termsofservice" target="_blank"  style="color:red;">Terms of Services </a--> <a href="<?php echo base_url()?>nea/policy" target="_blank" style="color:red;">Privacy Policy</a></span></p>
    </div> 
</section>

 <?php $this->load->view("client/registration_js") ?>
 <?php $this->load->view("client/registration_modal") ?>
</body>
</html>
