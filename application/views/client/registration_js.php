<script type="text/javascript">
	//$('.bhome').show();
	$(document).on('click','.displaysched',function(){

        //window.location.href = "<?php //echo base_url()?>images/AMTS20191st Sem.pdf";
        window.open("<?php echo base_url()?>nea/scheduledisp");
    });
    
    $('#modid').select2({
        placeholder: "Select a Module",
        allowClear: true
    });

    $('#code').select2({
        placeholder: "Select a Startdate",
        allowClear: true
    });


    $('.sponsor').select2({
        placeholder: "Select a sponsor",
        allowClear: true
    });

   /* $('.provid').select2({
        placeholder: "Select a Province",
        allowClear: true
    });*/

    $('.mcid').select2({
        placeholder: "Select a Municipality",
        allowClear: true
    });

    
	function validate(evt) {
	
	  var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	      key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	      var key = theEvent.keyCode || theEvent.which;
	      key = String.fromCharCode(key);
	  }

	 // console.log($('#mnumber1').val().length + 1);
	  var m1 = ($('#mnumber1').val().length + 1);
	  //console.log(m1);
	  var regex = /[0-9]|\./;
	  if( !regex.test(key)) {
	    theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	  if(m1 > 11){
	  	theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}

	function validate0(evt) {
	
	  var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	      key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	      var key = theEvent.keyCode || theEvent.which;
	      key = String.fromCharCode(key);
	  }

	 // console.log($('#mnumber1').val().length + 1);
	  var m1 = ($('#mnumber2').val().length + 1);
	  //console.log(m1);
	  var regex = /[0-9]|\./;
	  if( !regex.test(key)) {
	    theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	  if(m1 > 11){
	  	theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}

	function validate1(evt) {
	
	  var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	      key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	      var key = theEvent.keyCode || theEvent.which;
	      key = String.fromCharCode(key);
	  }

	 // console.log($('#mnumber1').val().length + 1);
	  var m1 = ($('#mob1').val().length + 1);
	  //console.log(m1);
	  var regex = /[0-9]|\./;
	  if( !regex.test(key)) {
	    theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	  if(m1 > 11){
	  	theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}

	function validate2(evt) {
	
	  var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	      key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	      var key = theEvent.keyCode || theEvent.which;
	      key = String.fromCharCode(key);
	  }

	 // console.log($('#mnumber1').val().length + 1);
	  var m1 = ($('#mob2').val().length + 1);
	  //console.log(m1);
	  var regex = /[0-9]|\./;
	  if( !regex.test(key)) {
	    theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	  if(m1 > 11){
	  	theEvent.returnValue = false;
	    if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}

    $(document).on("change", ".modid", function(event){

    	document.getElementById('code').options.length = 0; //erase dropdown

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/get_schedule_/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'modid': $('.modid').val()
		   },
		   success:function(data)
		   {
			  // console.log(data.sched.length);
			   if(data.sched.length != 0){
				   $("#code").append("<option value=''>Select a Startdate</option>");
				   for(var i = 0; i < data.sched.length; i++){
				   		$("#code").append("<option value="+data.sched[i]['code']+">("+data.sched[i]['batch']+") "+data.sched[i]['start']+"</option>");
				   		$('#sdate').val("");
					   	$('#edate').val("");
					   	$('#batch').val("");
					   	$('#venid').val("");
					   	$('#venue').val("");
					   	$('#fee').val("");
				   }
				}else{
					swal("Alert!", "Oops... No data found Please select again", "error");
				}    
		   }
		});
			
	});

	$(document).on("change", "#code", function(event){

		
		$.ajax({
		   url:"<?php echo base_url(); ?>nea/get_schedule_byid/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'code': $('#code').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.schedbyid);
			   $('#sdate').val(data.schedbyid['start']);
			   $('#edate').val(data.schedbyid['end']);
			   $('#batch').val(data.schedbyid['batch']);
			   $('#venid').val(data.schedbyid['venid']);
			   $('#venue').val(data.schedbyid['venue']);
			   $('#fee').val(data.schedbyid['fee']);
			   
		   }
		});
			
	});

	$(document).on("change", "#schlid", function(event){

		
		$.ajax({
		   url:"<?php echo base_url(); ?>nea/get_schladdress_byid/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'schlid': $('#schlid').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.schladdress);
			   $('#schladdress').val(data.schladdress['address']);
			   
		   }
		});
			
	});

	$(document).on("change", ".mcid", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/get_code_/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'idnum': $('.mcid').val()
		   },
		   success:function(data)
		   {
			   // console.log(data.pcode);
				if (data.pcode == null) {
					
				} else {
					$("#pcode").val(data.pcode['code']);
					$("#regid").val(data.pcode['region']);
					$("#provid").val(data.pcode['province']);
				}
		   }
		});
			
	});

	/*-------------------------form js -------------------------------------*/
	$(document).on("keyup", ".form-group", function(event){
		// alert("lols");
		var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        current_step = $(this).parent();
		curInputs = current_step.find("input[type='text'],input[type='radio'],input[type='date'],select,input[type='number'],input[type='email']"),
            isValid = true;

            //$(".form-group").addClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-control").addClass("has-error");
                }else{
                	$(curInputs[i]).closest(".form-control").removeClass("has-error");
                }
            }
			
	});

	$(document).on("change", ".form-group", function(event){
		var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        current_step = $(this).parent();
		curInputs = current_step.find("input[type='text'],input[type='radio'],input[type='date'],select,input[type='number'],input[type='email']"),
            isValid = true;

            //$(".form-group").addClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-control").addClass("has-error");
                }else{
                	$(curInputs[i]).closest(".form-control").removeClass("has-error");
                }
            }
			
	});

	$(document).ready(function(){

        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
		
		$("#cmd-modal-table").click(function(){
			// alert("lols");
			$('#Addcourse').modal('show');
		});
		
        $(".next").click(function(){
			// next 
            current_step = $(this).parent();
            next_step = $(this).parent().next();

            curInputs = current_step.find("input[type='text'],input[type='radio'],input[type='date'],select,input[type='number'],input[type='email']");
            isValid = true;
			// alert(curInputs.length);
            $(".form-control").removeClass("has-error");
            $(".select2-selection").removeClass("has-error");
			
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    thisAttrib = $(curInputs[i]).closest(".form-control");
					thisAttrib.addClass("has-error");
					 // alert(thisAttrib.attr('id'));
					if (thisAttrib.attr('id') == "mcid")
					{
						thisAttrib.siblings(".select2").find(".select2-selection").addClass("has-error");
					}
                }
            }
			// alert(isValid);
            if (isValid == true){ 
				// asd
                var label = $(this).attr("data-label");
                if(label == "ginsave"){
                	$('.bhome').hide();
                    ginsave();
                }

                if(label == "heasave"){
                	$('.bhome').hide();
                    heasave();
                }

                if(label == "cpcesave"){
                	$('.bhome').hide();
                    cpcesave();
                }

                if(label == "lsesave"){
                	$('.bhome').hide();
                    lsesave();                  
                }

                /*if(label == "tcesave"){
                    tcesave();
                }*/

                next_step.removeAttr('disabled').trigger('click');
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
            }
        });
        $(".previous").click(function(){
        	var label = $(this).attr("data-label");
        	console.log(label);
            if(label == "ginsave"){
            	$('.bhome').show();
            }

            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
      // Change progress bar action
        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
            .css("width",percent+"%")
            .html(percent+"%");   
        }
    });


	$(document).on("click", ".savetcesave", function(event){
		//alert('adi nah');
		if($('#modid').val() == '20130001' || $('#modid').val() == '20120398' || $('#modid').val() == '20150002' || $('#modid').val() == '20030103' || $('#modid').val() == '20030044' || $('#modid').val() == '20180020')
    	{
    		var rcross = 1;
    	}else{
    		var rcross = 0;
    	}
    	
        
		$.ajax({
		   url:"<?php echo base_url(); ?>nea/add_tcesave/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'modid': $('#modid').val(),
			   'sponsor': $('#sponsor').val(),
			   'code': $('#code').val(),
			   'edate': $('#edate').val(),
			   'sdate': $('#sdate').val(),
			   'venid': $('#venid').val(),
			   'fee': $('#fee').val(),
			   'idnum': $('#trid').val(),
			   'rd': rcross
		   },
		   success:function(data)
		   {
		   		//console.log(log);
			   if(data.rec['trainid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong. Please check input", "error");
			   }else{
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		                load_training_sched();
		            });
			   }
		   }
		});
		
			
	});

	function load_training_sched()
	{		
		$.ajax({
		   url:"<?php echo base_url(); ?>nea/get_training_sched/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'idnum':$('#trid').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
				var tr= '';
				for(var i = 0; i < data.rec.length; i++){
						tr += '<tr>';
						tr += '<td><label class="xxx">'+data.rec[i]['module']+'</label></td>';
						tr += '<td>'+data.rec[i]['start']+'</td>';
						tr += '<td>'+data.rec[i]['end']+'</td>';
						tr += '<td>'+data.rec[i]['sptypeshort']+'</td>';
						tr += '<td>'+data.rec[i]['venue']+'</td>';
						tr += '<td>'+data.rec[i]['fee']+'</td>';
						tr += '<td><a href="javascript:void(0);" style="color:red;" class="delete_module" data-trid="'+data.rec[i]['trainingid']+'"><i class="fa fa-trash"></i> remove</a></td>';
						tr += '</tr>';
				}
									
				$('.data-insert').html(tr);
		   }
		});
			
	}

	$(document).on("click", ".delete_module", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/delete_module/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'trid':$('#trid').val(),
		   		'trainingid':$(this).attr('data-trid')
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
				var tr= '';
				for(var i = 0; i < data.rec.length; i++){
						tr += '<tr>';
						tr += '<td><label class="xxx">'+data.rec[i]['module']+'</label></td>';
						tr += '<td>'+data.rec[i]['start']+'</td>';
						tr += '<td>'+data.rec[i]['end']+'</td>';
						tr += '<td>'+data.rec[i]['sptypeshort']+'</td>';
						tr += '<td>'+data.rec[i]['venue']+'</td>';
						tr += '<td>'+data.rec[i]['fee']+'</td>';
						tr += '<td><a href="javascript:void(0);" style="color:red;" class="delete_module" data-trid="'+data.rec[i]['trainingid']+'"><i class="fa fa-trash"></i> remove</a></td>';
						tr += '</tr>';
				}
									
				$('.data-insert').html(tr);
		   }
		});
			
	});

	function lsesave(){

		
			$.ajax({
			   url:"<?php echo base_url(); ?>nea/add_lsesave/",
			   method:"post",
			   dataType:"json",
			   data:{
				   'licid': $('#licid').val(),
				   'rankid': $('#rankid').val(),
				   'datedis': $('#datedis').val(),
				   'employid': $('#employid').val(),
				   'sprin': $('#sprin').val(),
				   'lnum': $('#lnum').val(),
				   'mnum': $('#mnum').val(),
				   'idnum': $('#trid').val(),
				   'seid': $('#seid').val()
			   },
			   success:function(data)
			   {
				   if(data.error == 1){

				   		swal("Error!", "Oops... There's something wrong. Please check input", "error");

				   		
				   }else{
				   		swal("Success!", "Your record has been updated.", "success");
				   }
			   }
			});
			
	}

	function cpcesave(){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/add_cpcesave/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'fullname': $('#fullname').val(),
			   'rel': $('#rel').val(),
			   'caddress': $('#caddress').val(),
			   'telnum': $('#telnum').val(),
			   'mob1': $('#mob1').val(),
			   'emailadd': $('#emailadd').val(),
			   'mob2': $('#mob2').val(),
			   'idnum': $('#trid').val(),
			   'cpid': $('#cpid').val()
		   },
		   success:function(data)
		   {
			   if(data.rec['cpid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong. Please check input", "error");
			   }else{
			   		swal("Success!", "Your record has been updated.", "success");
				   	$('#cpid').val(data.rec['cpid']);
			   }
		   }
		});
			
	}

	function heasave(){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/add_heasave/",
		   method:"post",
		   dataType:"json",
		   data:{
			   'courseid': $('#courseid').val(),
			   'school': $('#school').val(),
			   'schooladdress': $('#schooladdress').val(),
		   },
		   success:function(data)
		   {
			   if(data.rec['course'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong. Please check input", "error");
			   }else{
			   		swal("Success!", "Your record has been updated.", "success");
				   	$('#courseid').val($('#courseid').val());
				   	$('#school').val($('#school').val());
				   	$('#schooladdress').val($('#schooladdress').val());
			   }
		   }
		});
			
	}

	function ginsave() {

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/add_gin/",
		   method:"post",
		   dataType:"json",
		   data:{
		   	   'trid': $('#trid').val(),
			   'locid': $('#locid').val(),
			   'fname': $('#fname').val(),
			   'lname': $('#lname').val(),
			   'ext': $('#ext').val(),
			   'mname': $('#mname').val(),
			   'sex': $("input[name='optgender']:checked").val(),
			   'citi': $('#citi').val(),
			   'status': $('#cstatus').val(),
			   'bdate': $('#bdate').val(),
			   'bplace': $('#bplace').val(),
			   'regid': $('#regid').val(),
			   'provid': $('#provid').val(),
			   'mcid': $('#mcid').val(),
			   'address': $('#address').val(),
			   //'brgy': $('#brgy').val(),
			   'pcode': $('#pcode').val(),
			   'lnumber': $('#lnumber').val(),
			   'mobile1': $('#mnumber1').val(),
			   'mobile2': $('#mnumber2').val(),
			   'emailacc': $('#user_email').val(),
			   'fbacc': $('#fbacc').val(),
		   },
		   success:function(data)
		   {
			   console.log(data);
			   if(data.rec['trid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong. Please check input", "error");
			   }else{
			   		swal("Success!", "Your record has been updated.", "success");
				   	$('#trid').val(data.rec['trid']);
				   	$('#locid').val(data.rec['locid']);
			   }
		   }
		});

	}

	$(document).on("click", ".done", function(event){
		// var label = $('.xxx').text();
		// var certify = $("input[name='certifyme']:checked").val();

		// if((label == "" || label == null) || (certify == "undefined" || certify == undefined)){
			// if(label == "" || label == null){
				// swal("Error!", "Oops... Please add module to enroll", "error");
			// }else{
				// swal("Error!", "Oops... Please click checkbox to certify all information are correct", "error");
				// $('.checkbox').css('color','red');
			// }
			
		// }else{
			// window.location.href="<?php echo base_url()?>Done/"+$('#trid').val();
		// }
		// alert("lols");
		resid = $('#resid').val();
		token = $('#token').val();
		$.ajax({
		   url:"<?php echo base_url();?>client/update_enrollment/",
		   method:"post",
		   dataType:"json",
		   data:{ resid: resid, token: token},
		   success:function(data)
		   {
				// console.log(data);
				// swal({ 
					// title: "Success!",
					// text: "You have successfully updated your profile!",
					// type: "success" 
				// });
				swal("Success!", "You have successfully updated your profile!", "success");
					setTimeout(function() {
						window.location.href = '<?php echo base_url()?>client/dashboard';
					}, 1500);
				
		   }
		});
			
	});

	$(document).on("click", ".savecourse", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/savecourse/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'cname':$('#c_name').val()
		   },
		   success:function(data)
		   {
			   console.log(data.rec);
			   if(data.rec['courseid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong.", "error");
			   }else{
			   		$('#Addcourse').modal('hide');
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		                $('#courseid').append('<option value="'+data.rec['courseid']+'">'+data.rec['course']+'</option>');
		                $('#courseid').val(data.rec['courseid']).trigger("change");
		            });
			   }
				
		   }
		});
			
	});

	$(document).on("click", ".saveschool", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/saveschool/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'sname':$('#s_name').val(),
		   		'saddress':$('#s_address').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
			   if(data.rec['courseid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong.", "error");
			   }else{
			   	$('#Addschool').modal('hide');
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		                $('.schlid').append('<option value="'+data.rec['schoolid']+'">'+data.rec['school']+'</option>');
		                $('.schlid').val(data.rec['schoolid']).trigger("change");
		                $('#schladdress').val(data.rec['address']);
		            });
			   }
				
		   }
		});
			
	});

	$(document).on("click", ".saveLicense", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/saveLicense/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'lname':$('#lic_name').val(),
		   		'sname':$('#short_name').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
			   if(data.rec['licid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong.", "error");
			   }else{
			   	$('#AddLicense').modal('hide');
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		                $('.licid').append('<option value="'+data.rec['licid']+'">'+data.rec['license']+'</option>');
		                $('.licid').val(data.rec['licid']).trigger("change");
		            });
			   }
				
		   }
		});
			
	});

	$(document).on("click", ".saverank", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/save_rank/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'rname':$('#rank_name').val(),
		   		'rsname':$('#ranks_name').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
			   if(data.rec['rankid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong.", "error");
			   }else{
			   	$('#AddRank').modal('hide');
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		                $('.rankid').append('<option value="'+data.rec['rankid']+'">'+data.rec['rank']+'</option>');
		                $('.rankid').val(data.rec['rankid']).trigger("change");
		            });
			   }
				
		   }
		});
			
	});

	$(document).on("click", ".saveemployeer", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/save_employeer/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'empname':$('#emp_name').val(),
		   		'soname':$('#so_name').val(),
		   		'solandline':$('#so_landline').val(),
		   		'somobile':$('#so_mobile').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
			   if(data.rec['employid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong.", "error");
			   }else{
			   	$('#AddEmployeer').modal('hide');
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		            	$('.employid').append('<option value="'+data.rec['employid']+'">'+data.rec['name']+'</option>');
		                $('.employid').val(data.rec['employid']).trigger("change");
		                $('#lnum').val(data.rec['telnum']);
		                $('#mnum').val(data.rec['mnumber']);
		                $('#sprin').val(data.rec['shipowner']);
		            });
			   }
				
		   }
		});
			
	});

	$(document).on("change", ".employid", function(event){

		$.ajax({
		   url:"<?php echo base_url();?>nea/get_employeer_byid/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'employid':$('.employid').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
	            $('#lnum').val(data.rec['telnum']);
	            $('#mnum').val(data.rec['mnumber']);
	            $('#sprin').val(data.rec['shipowner']);
		   }
		});
			
	});

	$(document).on("click", ".save_sponsor", function(event){

		$.ajax({
		   url:"<?php echo base_url(); ?>nea/save_sponsor/",
		   method:"post",
		   dataType:"json",
		   data:{
		   		'sponname':$('#spon_name').val(),
		   		'sponshname':$('#spon_sh_name').val()
		   },
		   success:function(data)
		   {
			   //console.log(data.rec);
			   if(data.rec['sponid'] == 'error'){
			   		swal("Error!", "Oops... There's something wrong.", "error");
			   }else{
			   	$('#AddSponsor').modal('hide');
			   		swal({ 
		                title: "Done!",
		                text: "Data Successfully added.",
		                type: "success" 
		            }, function(){
		                $('.sponsor').append('<option value="'+data.rec['sponid']+'">'+data.rec['sptypename']+'</option>');
		                $('.sponsor').val(data.rec['sponid']).trigger("change");
		            });
			   }
				
		   }
		});
			
	});
</script>