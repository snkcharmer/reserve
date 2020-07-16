
$(document).ready(function(){ 
	ctr = 0; 
	baseurl = $("#navbar").attr("data-baseurl");

	$('#btn-add-reserve').click(function() {
		if ($('#sel-module').val() == "") {
			$('#sel-module').siblings("span").addClass("has-error");
			// $(element).addClass('is-invalid');
			return
		} 
		
		if ($('#sel-schedule').val() == "") {
			$('#sel-schedule').siblings("span").addClass("has-error");
			// $(element).addClass('is-invalid');
			return
		} 

		if (ctr === 0) {
			$('#table-reserve-list tbody tr').remove();
		}
		ctr += 1;
		// str = '<td>' + ctr +'</td>';
		str = '<td id="' + $('#sel-module').val() + '">' + $('#sel-module').find(':selected').text() +'</td>';
		str += '<td>' + $('#sel-schedule').find(':selected').text() +'</td>';
		str += '<td><a href="#" class="nav-link remove-row"><i class="nav-icon fas fa-trash"></i><p>';
		str += '</td>';
		$('<tr id="' + $('#sel-schedule').val() + '">').html(str).appendTo('#table-reserve-list tbody');
		
		$('#sel-module option[value="' + $('#sel-module').val() +'"]').remove();
		$('#sel-schedule').empty();
	});
	
	$('#sel-module').on('select2:select', function (e) {
		modcode = $(this).val();
		
		$('#sel-schedule').empty();
		$('#sel-module').siblings("span").removeClass("has-error");
		$.ajax({
			type: "POST",
			url: baseurl + "client/get_schedule_ajax/",
			dataType: "JSON",
			data: { modcode: modcode },
			success: function(data) 
			{
				
				$.each(data,function(key,val)
				{
					var code = val.code;
					var seltext = val.start + " " + "(" + val.countReserve + ")";
					var newOption = new Option(seltext, code, false, false);
					$('#sel-schedule').append(newOption).trigger('change');
				});
			}
		});
		
		// $('#addModalParticipant').modal('show');
	});

	$('#btn-confirm-reservation').click(function() {
		
		// $(this).prop('disabled', true);
		var schedule = [];
		var module = [];
		var trNoData = "";

		$('#table-reserve-list > tbody  > tr').each(function() { 
			schedule.push( $(this).attr('id') );
			module.push( $(this).find('td:first-child').attr('id') );
			trNoData = $(this).attr('id');
		});
		
		// alert(module.length );
		if (module.length == 1 && trNoData == "trNoData") {
			Swal.fire(
				  'NMP - Online Registration',
				  'Please select Module and Schedule (Step 1 and 2)',
				  'warning'
				);
			return 
		}
		
		$( "#btn-confirm-reservation" ).prop('disabled', true);
		$( "#btn-confirm-reservation" ).text("");
		$( "#btn-confirm-reservation" ).append('<i class="fas fa-sync-alt fa-spin"></i> Please wait');
		
		$.ajax({
			type: "POST",
			url: baseurl + "client/register_schedule_ajax/",
			dataType: "JSON",
			data: { resSchedule: schedule, resModule: module, idnum: $('#hiddenid').val() },
			success: function(data) 
			{
				if (data.hasError == 0) {
					location.reload();
				} else {
					Swal.fire(
					  'NMP - Online Registration',
					  'An error has occured. Please relog your account.',
					  'warning'
					);
				}
			}
		});
		
	});
	
	$('.get-resid').click(function() {
		resid = ($(this).closest("tr").find('input').val());
		$('#btn-attachment-resid').children("a").attr("href",baseurl + "client/attachment/" + resid);
		get_payment_slip(resid)
		
		$('#paymentSlip').modal('show');
	});
	
	$('#paymentSlip').on('hidden.bs.modal', function () {
	  // do something…
		
	});
	
	$('#btn-upload-attachment').click(function() {
		resid = $('#payment-resid').val();
		// idnum = $('#payment-idnum').val();
		
		if ( resid == "") {
			Swal.fire(
				  'NMP - Online Registration',
				  'Please check your internet connection.',
				  'warning'
				);
			return
		}
		
		if( document.getElementById("uploadattachment").files.length == 0 ){
			Swal.fire(
				  'NMP - Online Registration',
				  'Please select an image to upload.',
				  'warning'
				);
			return
		}
		
		var formData = new FormData($('#form-payment-upload')[0]);
		
		$.ajax({
			type: "POST",
			url: baseurl + "client/do_upload/",
			dataType: "JSON",
			mimeType: "multipart/form-data",
			contentType: false,
            cache: false,
            processData: false,
			data: formData,
			// data: $('#form-payment-upload').serializeArray(),
			success: function(data) 
			{
				// console.log(data);
				if (data.error == 1) {
					Swal.fire(
					  'NMP - Online Registration',
					  data.details,
					  'warning'
					);
				} else {
					Swal.fire(
					  'NMP - Online Registration',
					  'Image uploaded. Please wait for your confirmation.',
					  'success'
					);
				}
			}
		});
	});
		

	
	$(document).on('click','.remove-row',function(e) {
		
		var code = $(this).closest("tr").find('td:first-child').attr('id');
		var addtextmodule = $(this).closest("tr").find('td:first-child').text();

		var newOption = new Option(addtextmodule, code, false, false);
		$('#sel-module').append(newOption).trigger('change');
		
		$(this).closest("tr").remove();
	});

});

function get_payment_slip(resid)
{
	$('#table-payment-slip tbody tr').remove();
	$('#payment-resid').val(resid);
	
	$.ajax({
		type: "POST",
		url: baseurl + "client/get_reservation_ajax/",
		dataType: "JSON",
		data: { resid: resid },
		success: function(data) 
		{
			payslip_ctr = 0;
			$.each(data,function(key,val)
			{
				++payslip_ctr;
				str = '<td id="' + val.resid + '">' + payslip_ctr +'</td>';
				str += '<td>' + val.module +'</td>';
				str += '<td>' + val.start +'</td>';
				str += '<td>' + val.amount +'</td>';
				str += '<td>' + val.dateReserve +'</td>';
				$('<tr>').html(str).appendTo('#table-payment-slip tbody');
			});
		}
	});
}

