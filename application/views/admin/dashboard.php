<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Blank Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	<?php $this->load->view("admin/include/navmenu")?>
	<?php $this->load->view("admin/include/leftsidebar")?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reservation List</h3>
				
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 800px;">
                    <input type="text" name="table_search" class="form-control float-right code" placeholder="Code">
                    <input type="text" name="table_search" class="form-control float-right fullname" placeholder="Last Name, First Name, Middle Name">
					<?php 
						$options = array(
								'All' => 'All',
								'2018' => '2018',
								'2019' => '2019',
								'2020' => '2020',
								'2021' => '2021',
								'2022' => '2022',
								'2023' => '2023',
						);
						$attr = 'class="form-control curyear"';
						echo form_dropdown('curyear', $options, 'All', $attr); 
						
						$module['All'] = 'All';
						foreach($modules->result_array() as $mod) {
							$module[$mod["modcode"]] = $mod["module"];
						}
						$attr = 'class="form-control module"';
						echo form_dropdown('module', $module, 'All', $attr); 
					?>
                    <div class="input-group-append">
                      <button type="button" class="btn btn-default"><i class="fas fa-times"></i></button>
                      <button type="button" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Schedule</th>
                      <th>Module</th>
                      <th>Batch</th>
                      <th>Duration</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody class="data-insert-me">
                  </tbody>
				  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Schedule</th>
                      <th>Module</th>
                      <th>Batch</th>
                      <th>Duration</th>
                      <th>Option</th>
                    </tr>
                  </tfoot>
                </table>
				<div class="page-link-link"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<script src="<?=base_url()?>plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<script src="<?=base_url()?>js/moment.js"></script>
<script>
function bulls(prnumber,tblid,ctr)
{
	viewState = $('#viewState' + ctr).val();
	
	console.log(viewState);
	if (viewState == 1)
	{
		$('#viewState' + ctr).val('2');
		$('#td' + ctr).find('svg').attr("class","svg-inline--fa fa-minus fa-w-14");
		// $('#a' + ctr).attr("class","svg-inline--fa fa-minus fa-w-14");
		// alert($(this).find('i').attr("class"));
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>admin/getpr/",
			dataType: "JSON",
			data: { prnum: prnumber},
			success: function(data) 
			{
				// console.log(data);
				lolsi = data.reverse();
				$.each(lolsi,function(row,key)
				{
					// console.log(lols);
					$("<tr class='addedtr"+key.prnum+" george'><td></td><td><label class='asd'>"
					+key.prnum+"</label></td><td><label class='asd'>"+key.section+"</label></td><td><label class='asd'>"
					+key.stat_remarks+"</td><td>"+key.remarks+"</label></td><td><label class='asd'>"
					+moment(key.dateadded).format('MMM DD, YYYY (hh:mm a)')+"</label></td><td><label class='asd'>" 
					+ (!(key.dateconfirmed) ? "" : moment(key.dateconfirmed).format('MMM DD, YYYY (hh:mm a)') ) + "</label></td><td><label class='asd'>"
					+key.username+(key.userconf ? " / " + key.userconf : "")+"</label></td></tr>").insertAfter("#tr"+ ctr).hide().show('slow');
				});
			}
		});
	} else {
		$('#viewState' + ctr).val('1');
		$('#td' + ctr).find('svg').attr("class","svg-inline--fa fa-plus fa-w-14");
		// $('#a' + ctr).find('svg').attr("class","svg-inline--fa fa-plus fa-w-14");
		$('#td' + ctr).closest('tr').nextAll('.addedtr'+prnumber).remove();
	}
}
	
function checkstatid(statid){
	return (statid == 1 ? "MRM" : (statid == 2 ? "BAC" : (statid == 3 ? "AFMD" : "END")));
}
	
$(document).ready(function() {
	
	$('#cmdReport').click(function() {
		$('#reportModel').modal('show');
	});
	
});

	function load_applicant(page)
	{ 
		$.ajax({
			url:"<?php echo base_url(); ?>Admin/get_reservation/"+page,
			method:"post",
			dataType:"json",
			data:{
				"search":$('.fullname').val(),
				"curyear":$('.curyear').val(),
				"module":$('.module').val(),
				"code":$('.code').val(),
			},
			success:function(data)
			{
				console.log(data);
				var tr= '';
				for(var i = 0; i < data.rec.length; i++){
					
					tr += '<tr id="tr' + i + '">';
					tr += '<td id="td' + i + '" onclick="bulls(\''+ data.rec[i]["idnum"] + '\',' + data.rec[i]["idnum"] +',' + i + ')" id="a' + i + '"><i class="fa fa-plus"></i><input value="1" hidden id="viewState' + i + '" ></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + data.rec[i]['idnum'] + '</label></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + data.rec[i]['section'] + '</label></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + data.rec[i]['section']  + '</label></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + data.rec[i]['remarks'] + '</label></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + moment(data.rec[i]['start']).format("MMM D, YYYY (h:mm a)") + '</label></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + data.rec[i]['batch']+ '</label></td>';
					tr += '<td><label class="asd" for="code'+i+'">' + data.rec[i]['module'] + (data.rec[i]["userconf"] ? " / " + data.rec[i]["userconf"] : "")+ '</label></td>';
					tr += '</tr>';  
				}
				
				$('.cntiar').text(data.count); 
				$('.data-insert-me').html(tr);
				$('.page-link-link').html(data.pagination_link);
			}
		});
	}

	load_applicant(1);
	
	$(document).ready(function(){
		$(document).on("click", ".link_me_me li a", function(event){
			event.preventDefault();
			var page = $(this).data("ci-pagination-page");
			load_applicant(page);
		});

		$(document).on("keyup", ".fullname", function(event){
			event.preventDefault();
			load_applicant(1);
		});
		
		$(document).on("change", ".curyear", function(event){
			// alert("lols");
			event.preventDefault();
			load_applicant(1);
		});
		
		$(document).on("change", ".module", function(event){
			// alert("lols");
			event.preventDefault();
			load_applicant(1);
		});
		
		$(document).on("change", ".code", function(event){
			// alert("lols");
			event.preventDefault();
			load_applicant(1);
		});
	});

	$(document).ready(function () {
		$(document).on('show.bs.modal', '.modal', function (event) {
			var zIndex = 1040 + (10 * $('.modal:visible').length);
			$(this).css('z-index', zIndex);
			setTimeout(function() {
				$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
			}, 0);
		});
	});
</script>
</body>
</html>
