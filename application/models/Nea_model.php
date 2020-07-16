<?php	
class Nea_model extends CI_Model
{
		var $data = array();
		function __construct()
		{
			parent::__construct();	
			$this->load->library('typography');
		}

		function search_total_sched_template()
		{
			$search_sched = $this->session->userdata('search_sched');
		
			$sql = "SELECT * FROM module 
					where active = 'Y' and (module like ? OR descriptn like ?) group by module order by module ";
			$query = $this->db->query($sql, array('%'.$search_sched.'%','%'.$search_sched.'%'));
			
			//print_r($this->db->last_query());
			return $query;
		}
		
		function scheduledisp($count)
		{
			
			$search_sched = $this->session->userdata('search_sched');
			
			$sql = "SELECT * FROM module 
					where active = 'Y' and (module like ? OR descriptn like ?) group by module order by module limit ?,?";
			$query = $this->db->query($sql, array('%'.$search_sched.'%','%'.$search_sched.'%',intval($this->uri->segment(3)), $count));
			#echo "<br>";
			#print_r($this->db->last_query());
			//print_r($this->db->last_query()); die();
			return $query;
		}

		function search_total_cert_template()
		{
			$module = $this->session->userdata('search_cert');
		
			$sql = "SELECT * 
					FROM certificate_temp as a
					left join module as b on b.modcode = a.modcode
					where (b.module like ? OR b.descriptn like ?) order by b.module";
			$query = $this->db->query($sql, array('%'.$module.'%','%'.$module.'%'));
			
			#print_r($this->db->last_query());
			return $query;
		}
		
		function cert_template($count)
		{
			
			$module = $this->session->userdata('search_cert');
			
			$sql = "SELECT *
					FROM certificate_temp as a
					left join module as b on b.modcode = a.modcode
					where (b.module like ? OR b.descriptn like ?) order by b.module limit ?,?";
			$query = $this->db->query($sql, array('%'.$module.'%','%'.$module.'%',intval($this->uri->segment(3)), $count));
			#echo "<br>";
			#print_r($this->db->last_query());
			#print_r($this->db->last_query()); die();
			return $query;
		}

		function save_template(){

			$data = [
				'modcode'=> $this->input->post('modid'),
				'header'=> $this->input->post('header'),
				'hmargintop'=> $this->input->post('hmargint'),
				'hmarginbottom'=> $this->input->post('hmarginb'),
				'header1'=> $this->input->post('header1'),
				'h1margintop'=> $this->input->post('h1margint'),
				'h1marginbottom'=> $this->input->post('h1marginb'),
				'header2'=> $this->input->post('header2'),
				'h2margintop'=> $this->input->post('h2margint'),
				'h2marginbottom'=> $this->input->post('h2marginb'),
				'body'=> $this->input->post('body'),
				'bmargintop'=> $this->input->post('bmargint'),
				'bmarginbottom'=> $this->input->post('bmarginb'),
				'fmargintop'=> $this->input->post('fmargint'),
				'fmarginbottom'=> $this->input->post('fmarginb'),
				'dateadded'=> date('Y-m-d'),
			];
			
			if($this->input->post('cert_id') == ""){
				$this->db->insert('certificate_temp',$data);
			}else{
				$this->db->where('id',$this->input->post('cert_id'));
				$this->db->update('certificate_temp',$data);
			}	
			
			
		}

		function delete_cert_temp($id){

			$param = [$id];
			$sql = "DELETE from certificate_temp where id = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_sponsor(){

			$sql = "select * from sponsor_type order by sponid";
			$query = $this->db->query($sql);

			return $query;

		}


		function get_announcement(){

			$sql = "SELECT * FROM `announcement` WHERE 1";
			$query = $this->db->query($sql);

			return $query;

		}	

		function saveannouncement(){

			$data = [
				'announcement'=> $this->input->post('announce'),
				'dateadded'=> date('Y-m-d'),
				'userid'=>$this->session->userdata("userid"),
			];
			if($this->input->post('anid') == ""){
				$this->db->insert('announcement',$data);
			}else{
				$this->db->where('id',$this->input->post('anid'));
				$this->db->update('announcement',$data);
			}

		}

		function save_sponsor(){

			$data = [
				'sptypename' => strtoupper($this->input->post('sponname')),
				'sptypeshort' => strtoupper($this->input->post('sponshname'))
			];
			$this->db->insert('sponsor_type',$data);
			$id = $this->db->insert_id();

			$sql = "select * from sponsor_type where sponid = ?";
			$query = $this->db->query($sql,[$id]);

			return $query;

		}	

		function save_employeer(){

			$data = [
				'name' => strtoupper($this->input->post('empname')),
				'shipowner' => strtoupper($this->input->post('soname')),
				'telnum' => $this->input->post('solandline'),
				'mnumber' => $this->input->post('somobile')
			];
			$this->db->insert('employer',$data);
			$id = $this->db->insert_id();

			$sql = "select * from employer where employid = ?";
			$query = $this->db->query($sql,[$id]);

			return $query;

		}
		
		
		function get_module(){

			$sql = "select * from module where active = 'Y' order by descriptn";
			$query = $this->db->query($sql);

			return $query;

		}

		function get_schedule_(){

			$param = [$this->input->post('modid'),date('Y-m')];
			$sql = "select a.start,b.venid,b.venue,a.batch,a.code 
					from schedule as a 
					inner join venue as b on a.venid = b.venid
					where a.modcode = ? and date_format(a.start,'%Y-%m') >= ? and a.max != a.size order by a.start";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_schedule_byid(){

			$param = [$this->input->post('code')];
			$sql = "select a.start,a.end,b.venid,b.venue,a.batch,a.code,a.fee 
					from schedule as a 
					inner join venue as b on a.venid = b.venid
					where a.code = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_school(){

			$sql = "select * from school order by school";
			$query = $this->db->query($sql);

			return $query;

		}

		function savecourse(){

			$data = [
				'course' => strtoupper($this->input->post('cname'))
			];
			$this->db->insert('course',$data);
			$id = $this->db->insert_id();

			$sql = "select * from course where courseid = ?";
			$query = $this->db->query($sql,[$id]);

			return $query;

		}

		function saveschool(){

			$data = [
				'school' => strtoupper($this->input->post('sname')),
				'address' => strtoupper($this->input->post('saddress'))
			];
			$this->db->insert('school',$data);
			$id = $this->db->insert_id();

			$sql = "select * from school where schoolid = ?";
			$query = $this->db->query($sql,[$id]);

			return $query;

		}

		function get_course(){

			$sql = "select * from course group by course order by course";
			$query = $this->db->query($sql);

			return $query;

		}

		function get_schladdress_byid(){

			$param = [$this->input->post('schlid')];
			$sql = "select * from school where schoolid = ?";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_license(){

			$sql = "select * from license order by license";
			$query = $this->db->query($sql);

			return $query;

		}

		function saveLicense(){

			$data = [
				'license' => strtoupper($this->input->post('lname')),
				'licname' => strtoupper($this->input->post('sname'))
			];
			$this->db->insert('license',$data);
			$id = $this->db->insert_id();

			$sql = "select * from license where licid = ? ";
			$query = $this->db->query($sql,[$id]);

			return $query;

		}

		function get_rank(){

			$sql = "select * from rank order by rank";
			$query = $this->db->query($sql);

			return $query;

		}

		function save_rank(){

			$data = [
				'rank' => strtoupper($this->input->post('rname')),
				'rankshort' => strtoupper($this->input->post('rsname'))
			];
			$this->db->insert('rank',$data);
			$id = $this->db->insert_id();

			$sql = "select * from rank where rankid = ? ";
			$query = $this->db->query($sql,[$id]);

			return $query;

		}

		function get_employer(){

			$sql = "select * from employer order by name";
			$query = $this->db->query($sql);

			return $query;

		}

		function get_employeer_byid(){

			$param = [$this->input->post('employid')];
			$sql = "select * from employer where employid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_region(){
			$sql = "select region from zip group by region";
			$query = $this->db->query($sql);

			return $query;
		}

		function get_province_(){

			$param = [$this->input->post('regid')];
			$sql = "select province from zip where region = ? group by province";
			$query = $this->db->query($sql,$param);
			//var_dump($this->db->last_query());die();
			return $query;
		}

		function get_province01(){

			//$param = [$this->input->post('regid')];
			$sql = "select province from zip group by province";
			$query = $this->db->query($sql);
			//var_dump($this->db->last_query());die();
			return $query;
		}

		function get_municipality_(){

			//$param = ['%'.$this->input->post('provid').'%'];
			$sql = "select * from zip order by municipal";
			$query = $this->db->query($sql);

			return $query;
		}

		function get_municipality01(){

			//$param = ['%'.$this->input->post('provid').'%'];
			$sql = "select * from zip ";
			$query = $this->db->query($sql);

			return $query;
		}

		function get_code_(){

			$param = [$this->input->post('idnum')];
			$sql = "select * from zip where idnum = ? ";
			$query = $this->db->query($sql,$param);

			return $query;
		}

		function add_gin(){

			$locationid = $this->input->post('mcid');
			// $locationid = $this->add_location($this->input->post('locid'));
			if($this->input->post('mobile2') != ""){
				$mobile = $this->input->post('mobile1').' / '.$this->input->post('mobile2');
			}else{
				$mobile = $this->input->post('mobile1');
			}
			$data = [
				'fname' => strtoupper($this->input->post('fname')),
				'lname' => strtoupper($this->input->post('lname')),
				'mname' => strtoupper($this->input->post('mname')),
				'suffix' => $this->input->post('ext'),
				'bdate' => date('Y-m-d',strtotime($this->input->post('bdate'))),
				'bplace' => $this->input->post('bplace'),
				'sex' => $this->input->post('sex'),
				'civstatid' => $this->input->post('status'),
				'citid' => 1,
				'locid' => $locationid,
				'landline' => $this->input->post('lnumber'),
				'mobile' => $mobile,
				// 'fbaccount' => $this->input->post('fbacc'),
				'regid' => $this->input->post('regid'),
				'address' => $this->input->post('address'),
				'entrydate' => date('Y-m-d')
			];
			

			$this->db->where('idnum',$this->session->userdata('id'));
			$this->db->update('trainee',$data);
			$trid = $this->input->post('trid');

			$ids = ['trid' => $trid,'locid' => $locationid];

			return $ids;
		}


		function add_heasave(){

			$data = [
				'course' => $this->input->post('courseid'),
				'school' => $this->input->post('school'),
				'schooladdress' => $this->input->post('schooladdress'),
			];
			$this->db->where('idnum',$this->session->userdata('id'));
			$this->db->update('trainee',$data);

		}

		function add_cpcesave(){
			$idnum = $this->session->userdata('id');
			
			$mobile = $this->input->post('mob1');


			$data = [
				'emname' => $this->input->post('fullname'),
				'emrelation' => $this->input->post('rel'),
				'emaddr' => $this->input->post('caddress'),
				'emlandline' => $this->input->post('telnum'),
				'emphone' => $mobile,
				'ememailadd' => $this->input->post('emailadd')
			];
			
			$this->db->where('idnum',$idnum);
			$this->db->update('trainee',$data);

			return $idnum;
			
		}

		function add_lsesave(){

			$data = [
					'license' => $this->input->post('licid'),
					'rank' => $this->input->post('rankid'),
					'dateofdesimbark' => $this->input->post('datedis'),
					'employer' => $this->input->post('employid'),
					'manningagency' => $this->input->post('sprin'),
					'employerlandline' => $this->input->post('lnum'),
					'employermobile' => $this->input->post('mnum')
				];

			
			$this->db->where('idnum',$this->session->userdata('id'));
			$this->db->update('trainee',$data);
			
			print_r($this->db->last_query());
		}

		function get_training_sched(){

			$param = [$this->input->post('idnum')];
			$sql = "select a.start,a.end,a.trainingid,b.module,
					c.venue,a.fee,d.sptypename,d.sptypeshort 
					from training_ as a
					inner join module as b on a.modcode = b.modcode
					inner join venue as c on a.venueid = c.venid
					inner join sponsor_type as d on a.sponsor = d.sponid
					where a.trid = ? order by a.trainingid";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function delete_module(){

			$sql = "delete from training_ where trainingid = ?";
			$query = $this->db->query($sql,[$this->input->post('trainingid')]);

			$param = [$this->input->post('trid')];
			$sql = "select a.start,a.end,a.trainingid,b.module,
					c.venue,a.fee,d.sptypename,d.sptypeshort 
					from training_ as a
					inner join module as b on a.modcode = b.modcode
					inner join venue as c on a.venueid = c.venid
					inner join sponsor_type as d on a.sponsor = d.sponid
					where a.trid = ? order by a.trainingid";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function add_tcesave(){

			if($this->input->post('rd') == 1){
				$data = ['redcross'=> 1];

				$this->db->where('idnum',$this->input->post('idnum'));
				$this->db->update('trainee_',$data);
			}
			
			$data = [
				'trid' => $this->input->post('idnum'),
				'modcode' => $this->input->post('modid'),
				'code' => $this->input->post('code'),
				'end' => $this->input->post('edate'),
				'start' => $this->input->post('sdate'),
				'sponsor' => $this->input->post('sponsor'),
				'venueid' => $this->input->post('venid'),
				'fee' => $this->input->post('fee'),
				'date_added' => date('Y-m-d')
			];
			$this->db->insert('training_',$data);
			
		}

		function get_old_trainee(){

			/*if($id == 0){
				$param = ['','',''];
				$sql = "select *,b.code as pcode,a.address as comadd
						from trainee as a 
						left join zip as b on a.locid = b.idnum
						LEFT join school as c on a.schoolid = c.schoolid
						left join course as d on a.courseid = d.courseid
						where a.lname = ? and a.fname = ? and a.bdate = ? ";
				$query = $this->db->query($sql,$param);		
				//echo $this->db->last_query();die();
				return $query;
			}else{*/
			$param = [$this->input->post('lname'),$this->input->post('fname'),$this->input->post('bdate')];
			$sql = "select *,b.code as pcode,a.address as comadd
					from trainee as a 
					left join zip as b on a.locid = b.idnum
					LEFT join school as c on a.schoolid = c.schoolid
					left join course as d on a.courseid = d.courseid
					where a.lname = ? and a.fname = ? and a.bdate = ? ";
			$query = $this->db->query($sql,$param);		
			//var_dump( $this->db->last_query());die();
			return $query;
			//}	
		}

		function finish_na(){

			$data = [
				'done_' => 1,
				'certify' => 1
			];

			
			$this->db->where('idnum',$this->input->post('trid'));
			$this->db->update('trainee_',$data);
		}

		function get_que_data(){

			$sql = "select concat(fname,' ',LEFT(mname,1),'. ',lname,' ',suffix) as name,window,idnum,redcross
					from trainee_ where done_ = 1 order by idnum";
			$query = $this->db->query($sql);

			return $query;

		}

		function search_total_list_()
		{
			$sql = "select fname,mname,lname,suffix,window,idnum,redcross
					from trainee_ where done_ = 1 order by idnum";
			$query = $this->db->query($sql);

			return $query;
		}
		
		function list_($count)
		{
			//$lname = $this->session->userdata('lname');
			//$fname = $this->session->userdata('fname');
			
			$sql = "select fname,mname,lname,suffix,window,idnum,redcross
					from trainee_ where done_ = 1 order by idnum limit ?,?";
			$query = $this->db->query($sql, array(intval($this->uri->segment(3)), $count));
			
			#print_r($this->db->last_query()); die();
			return $query;
		}

		function get_trainee_data($id){

			$param = [$id];
			$sql = "select *,b.code as pcode,a.idnum as id_
					from trainee_ as a 
					LEFT join school as c on a.schoolid = c.schoolid
					left join course as d on a.courseid = d.courseid
					left join location_ as e on a.locid = e.locid
					left join zip as b on e.mcid = b.idnum
					left join emergency_con_person_ as f on a.cpid = f.cpid
					where a.idnum = ? ";
			$query = $this->db->query($sql,$param);		
			//echo $this->db->last_query();die();

			return $query;
				
		}

		public function update_information()
		{
			if($this->input->post("trid") == ""){
				$data = array(
					'nid' => $this->input->post('idnum'),
				);
				$this->session->set_userdata($data);
			}
			

			$selyear = $this->getselyear();
			$rec = $this->getmaxtrid($selyear)->row_array();
			$maxtrid = $rec["maxtrid"] + 1;

			if($this->input->post("trid") != "0"){
				//die($this->input->post("sex"));
				$data = array(
					"trid" => $this->input->post("trid"),
					"lname" => strtoupper($this->input->post("lname")),
					"fname" => strtoupper($this->input->post("fname")),
					"mname" => strtoupper($this->input->post("mname")),
					"suffix" => strtoupper($this->input->post("suffix")),
					"sex" => $this->input->post("sex"),
					"civstatid" => $this->input->post("civilstat"),
					"citid" => $this->input->post("citizenship"),
					"landline" => $this->input->post("landline"),
					"mobile" => $this->input->post("mobile"),
					"relid" => $this->input->post("religion"),
					"bdate" => $this->input->post("bdate"),
					"bplace" => strtoupper($this->input->post("bplace")),
					"address" => strtoupper($this->input->post("address")),
					"zip" => $this->input->post("zip"),
					"regid" => $this->input->post("region"),
					"locid" => $this->input->post("town"),
					"courseid" => $this->input->post("course"),
					"schoolid" => $this->input->post("school"),
					"eadd" => $this->input->post("eadd"),
					"emname" => strtoupper($this->input->post("emname")),
					"emaddr" => strtoupper($this->input->post("emaddr")),
					"emphone" => $this->input->post("emphone"),
					"emrelation" => $this->input->post("emrel"),
					"emlandline" => $this->input->post("emlandline"),
					"ememailadd" => $this->input->post("emeadd"),
					"user" => $this->session->userdata("userid"),
				);
				$this->db->where('trid',$this->input->post("trid"));
				$this->db->update('trainee',$data);



				$oldfile = $this->input->post('idnum').'.jpg';
				$newfile = $this->input->post('trid').'.jpg';
				$Dir = FCPATH.'photos/';
				
				//echo $Dir.$oldfile.'   '.$Dir.$newfile;die();
				//rename($Dir.$oldfile, $Dir.$newfile);
				if(file_exists($Dir.$oldfile)){
					unlink($Dir.$newfile);
					if(rename($Dir.$oldfile,$Dir.$newfile)){
					 	//echo sprintf("%s was renamed to %s",$oldfile,$newfile);die();
					}else{
					 	echo 'An error occurred during renaming the file';
					}
				}
				return $this->input->post("trid");
			}else{
				//print_r($this->checkfirstrecord());die();

				if ($this->checkfirstrecord())
				{
					//die('dsadas');
					$data = array(
						"trid" => $maxtrid,
						"lname" => strtoupper($this->input->post("lname")),
						"fname" => strtoupper($this->input->post("fname")),
						"mname" => strtoupper($this->input->post("mname")),
						"suffix" => strtoupper($this->input->post("suffix")),
						"sex" => $this->input->post("sex"),
						"civstatid" => $this->input->post("civilstat"),
						"citid" => $this->input->post("citizenship"),
						"landline" => $this->input->post("landline"),
						"mobile" => $this->input->post("mobile"),
						"relid" => $this->input->post("religion"),
						"bdate" => $this->input->post("bdate"),
						"bplace" => strtoupper($this->input->post("bplace")),
						"address" => strtoupper($this->input->post("address")),
						"zip" => $this->input->post("zip"),
						"regid" => $this->input->post("region"),
						"locid" => $this->input->post("town"),
						"courseid" => $this->input->post("course"),
						"schoolid" => $this->input->post("school"),
						"eadd" => $this->input->post("eadd"),
						"emname" => strtoupper($this->input->post("emname")),
						"emaddr" => strtoupper($this->input->post("emaddr")),
						"emphone" => $this->input->post("emphone"),
						"emrelation" => $this->input->post("emrel"),
						"emlandline" => $this->input->post("emlandline"),
						"ememailadd" => $this->input->post("emeadd"),
						"user" => $this->session->userdata("userid"),
						"entrydate" => date('Y-m-d'),
					);
					
					#print_r($data); die();
					#echo $this->input->post("course"); die();
					$this->db->insert("trainee", $data);

					$oldfile = $this->input->post('idnum').'.jpg';
					$newfile = $maxtrid.'.jpg';
					$Dir = FCPATH.'photos/';
					
					//echo $Dir.$oldfile.'   '.$Dir.$newfile;die();
					//rename($Dir.$oldfile, $Dir.$newfile);
					if(file_exists($Dir.$oldfile)){
						if(rename($Dir.$oldfile,$Dir.$newfile)){
						 	//echo sprintf("%s was renamed to %s",$oldfile,$newfile);die();
						}else{
						 	echo 'An error occurred during renaming the file';
						}
					}	
					return $maxtrid;
				}
				else
				{
					//die('dsadas');
					$data = array(
						"trid" => $selyear.'00001',
						"lname" => strtoupper($this->input->post("lname")),
						"fname" => strtoupper($this->input->post("fname")),
						"mname" => strtoupper($this->input->post("mname")),
						"suffix" => strtoupper($this->input->post("suffix")),
						"sex" => $this->input->post("sex"),
						"civstatid" => $this->input->post("civilstat"),
						"citid" => $this->input->post("citizenship"),
						"landline" => $this->input->post("landline"),
						"mobile" => $this->input->post("mobile"),
						"relid" => $this->input->post("religion"),
						"bdate" => $this->input->post("bdate"),
						"bplace" => strtoupper($this->input->post("bplace")),
						"address" => strtoupper($this->input->post("address")),
						"zip" => $this->input->post("zip"),
						"regid" => $this->input->post("region"),
						"locid" => $this->input->post("town"),
						"courseid" => $this->input->post("course"),
						"schoolid" => $this->input->post("school"),
						"eadd" => $this->input->post("eadd"),
						"emname" => strtoupper($this->input->post("emname")),
						"emaddr" => strtoupper($this->input->post("emaddr")),
						"emphone" => $this->input->post("emphone"),
						"emrelation" => $this->input->post("emrel"),
						"emlandline" => $this->input->post("emlandline"),
						"ememailadd" => $this->input->post("emeadd"),
						"user" => $this->session->userdata("userid"),
						"entrydate" => date('Y-m-d')
					);
					
					#print_r($data); die();
					#echo $this->input->post("course"); die();
					$this->db->insert("trainee", $data);
					$oldfile = $this->input->post('idnum').'.jpg';
					$newfile = $selyear.'00001.jpg';
					$Dir = FCPATH.'photos/';
					
					//echo $Dir.$oldfile.'   '.$Dir.$newfile;die();
					//rename($Dir.$oldfile, $Dir.$newfile);
					if(file_exists($Dir.$oldfile)){
						if(rename($Dir.$oldfile,$Dir.$newfile)){
						 	//echo sprintf("%s was renamed to %s",$oldfile,$newfile);die();
						}else{
						 	echo 'An error occurred during renaming the file';
						}
					}	
					return $selyear.'00001';
					
				}
			}	
		}

		function checkolddata($fname,$lname,$bdate){

			$param = [$fname,$lname,$bdate];
			$sql = "select * from trainee where fname = ? and lname = ? and bdate = ? ";
			$query = $this->db->query($sql,$param);

			return $query;
		}

		function getselyear()
		{
			$query = $this->db->get('settings');
			if ($query->num_rows() > 0)
			{
			   $row = $query->row(); 
			   return $row->year;
			}
		}
		
		function checkfirstrecord()
		{
			$selyear = $this->getselyear().'00001';
			$query = $this->db->get_where('trainee', array('trid' => $selyear));
			if ($query->num_rows() > 0)
			{
			   return true;
			}
		}

		public function getmaxtrid($selyear)
		{
			$sql = "select max(trid) as maxtrid from trainee where left(trid,4) = ?";
			$query = $this->db->query($sql,array($selyear));
			return $query;
		}

		public function searchtraining($id){
			//echo $id; die();
			$param = [$id];
			$sql = "select *,b.module as dnamodule,c.code as scode 
					from training_ as a
					inner join module as b on a.modcode = b.modcode
					inner join schedule as c on a.code = c.code
					inner join sponsor_type as d on a.sponsor = d.sponid 
					left join venue as e on a.venueid = e.venid
					where a.trid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;
		}

		public function getlabelupdated($id){
			//echo $id; die();
			$param = [$id];
			$sql = "select min(a.label) as min_
					from training_ as a 
					where a.trid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;
		}

		public function get_trainee_nea($id){

			$param = [$id];
			$sql = "select *
					from trainee_ as a 
					left join shipboard_experience as b on a.seid = b.seid
					where a.idnum = ? ";
			$query = $this->db->query($sql,$param);		
			//echo $this->db->last_query();die();
			return $query;
				
		}

		public function checkcourses(){

			//$param = [$this->input->post('code')];
			$newcode = $this->input->post("code");
			$sql = "select paycatid
					from cash_payment_type 
					where typename IN($newcode) and isActive = 1 group by paycatid";
			$query = $this->db->query($sql);		
			//echo $this->db->last_query();die();
			return $query;
				
		}

		function getfee()
		{
			$newcode = $this->session->userdata("codeid");
			//print_r($newcode);die();
			$param = [$newcode];
			$sql = "select paycatid from cash_payment_type where typename IN ($newcode) group by paycatid";
			$query = $this->db->query($sql)->row_array();
			//print_r($this->db->last_query());die();
			$paycatid = $query['paycatid'];
			if (!empty($paycatid))
			{
				$this->db->where("paycatid",$paycatid);
			}
			
			
				$this->db->where("isActive",1);
			
			
			$this->db->where("isTraining",0);
			$query = $this->db->get('cash_payment_type');
			//print_r($this->db->last_query());die();
			return $query;
		}

		function proceedenroll(){

			if($this->input->post('licid') != ""){
				$withlic = 'Y';
			}else{
				$withlic = 'N';
			}
			$data = [
				'withlic' => $withlic,
				'licid' => $this->input->post('licid'),
				'rankid' => $this->input->post('rankid'),
				'employid' => $this->input->post('employer'),
				'dateofdisembarkation' => $this->input->post('dateofme'),
			];
			//print_r($data);print_r($this->session->userdata('trid'));die();
			$this->db->where('trid',$this->session->userdata('trid'));
			$this->db->update('trainee',$data);

		}

		public function gettrainings(){
			//echo $this->session->userdata('nid');die();
			$newcode = $this->session->userdata("codeid");
			$param = [$this->session->userdata('nid')];
			
			$sql = "select *,b.module as dnamodule,c.code as scode 
					from training_ as a
					inner join module as b on a.modcode = b.modcode
					inner join schedule as c on a.code = c.code 
					where a.trid = ? and a.modcode IN ($newcode) ";
			$query = $this->db->query($sql,$param);
			//print_r($this->db->last_query());die();
			return $query;
		}

		function getfee_not_on_paycatid()
		{
			$paycatid = $this->session->userdata('paycatid');
			//print_r($paycatid);die();
			if (!empty($paycatid))
			{
				$this->db->where("paycatid <>",$paycatid);
			}
			
			$this->db->where("isTraining",0);
			$query = $this->db->get('cash_payment_type');

			//print_r($this->db->last_query());die();
			return $query;
		}

		function getprice($paytypeid = 0)
		{
			$this->db->select("amount");
			$this->db->where("paytypeid",$paytypeid);
			$query = $this->db->get("cash_payment_type");
			return $query;
		}

		public function confirm_enroll(){


			//if($this->session->userdata('lastid1') == ""){
			$payments = array(
				"trid" => $this->session->userdata('trid'),
				"paydate" => date("Y-m-d"),
				"paycatid" => $this->input->post("paycatid"),
				"venid" => $this->session->userdata("venid"),
				"user" => $this->session->userdata("userid"),
			);
			$this->db->insert("cash_payment",$payments);

			$lastid1 = $this->db->insert_id();
			/*	$xxx = array(
					'lastid1' => $lastid1,
				);
				$this->session->set_userdata($xxx);
			}else{
				$lastid1 = $this->session->userdata('lastid1');
			}*/

			#insert other fees / payid2--------------------start
			$ofee = $this->session->userdata("ofee");
			$ofee2 = $ofee;
			$lastid2 = 0;
			#print_r(is_array($ofee)); die();
			if (is_array($ofee))
			{
				#echo count($ofee); die();
				reset($ofee2); #---------get first key to determine the paycatid of other fee
				$first_key = key($ofee2); 
				$sql = "select * from cash_payment_type where paytypeid = ?";
				$qweqwe = $this->db->query($sql,array($first_key))->row_array();
		
				#print_r($qweqwe); die();
				$payments = array(
					"trid" => $this->session->userdata('trid'),
					"paydate" => date("Y-m-d"),
					"paycatid" => $qweqwe["paycatid"],
					"venid" => $this->session->userdata("venid"),
					"user" => $this->session->userdata("userid"),
				);
				
				$this->db->insert("cash_payment",$payments);
				
				$lastid2 = $this->db->insert_id();
				
				foreach($ofee as $row5 => $key5)
				{
					$sql = "insert into cash_paymentlist (payid,amount,paytypeid) values (?,?,?)";
					$this->db->query($sql,array($lastid2,$key5,$row5));
				}
			}
			#insert other fees / payid2--------------------end
				
			
			$sql_trainee = "select * from trainee_ where idnum = ?";
			$result_trainee = $this->db->query($sql_trainee,[$this->session->userdata("nid")])->row_array(); 

			$licid = $this->input->post("licid");
			$rankid = $this->input->post("rankid");
			$employer = $this->input->post("employid");
			$dateofme = $this->input->post("disembark");
			$code = $this->input->post("code");
			$modcode = $this->input->post("modcode");
			$venid = $this->input->post("venueid");
			$spid = $this->input->post("spid");
			$codelenght = count($code);
			//print_r($codelenght);die();
			for($i = 0; $i <= $codelenght - 1; $i++){
				//print_r('code: '.$code[$i].' Modecode: '.$modcode[$i].'<br>');
				$data[] = array(
				'trid' => $this->session->userdata('trid'),
				'code' => $code[$i],
				'licid' => $licid,
				'rankid' => $rankid,
				'employid' => $employer,
				'civstatid' => $result_trainee['civstatid'],
				'sponid' => $spid[$i],
				'enrolled' => date('Y-m-d'),
				'dateofdisembarkation' => date('Y-m-d',strtotime($dateofme)),
				'user' => $this->session->userdata("userid"),
				'payid' => $lastid1,
				'payid2' => $lastid2 
				);
				
				$sql = "update schedule set size = size + 1 where code = ?";
				$this->db->query($sql,array($code[$i]));
				
				#check if it has submodule--------start
				$sql = "select a.code,b.modcode,b.module
					from schedule a 
					join module b on a.modcode = b.modcode
					join submodule c on b.modcode = c.modcode 
					where a.code = ?
					group by a.code";
				$result = $this->db->query($sql,array($code[$i]));
				//$this->db->select("code");
				//$result = $this->db->get_where("schedule_with_submod",array("code" => $row["code"]));
				
				if ($result->num_rows() > 0)
				{
					$result = $result->row_array();
					$subcode = $result["code"];
				}
				#check if it has submodule--------end
			}
			//die();
			$this->db->insert_batch('training',$data);

			for($ii = 0; $ii <= $codelenght - 1; $ii++)
			{
				#insert to cash_paymentlist an mga modules--
				#get amount of fee------
				$sql = "select a.paytypeid,a.amount,c.trainingid from cash_payment_type a 
				inner join schedule b on a.typename = b.modcode 
				inner join training c on c.code = b.code 
				inner join trainee d on d.trid = c.trid 
				where b.code = ? and d.trid = ?";
				$trainfee = $this->db->query($sql,array($code[$ii],$this->session->userdata('trid')))->row();
				
				#get amount of fee------
				$sql = "Insert into cash_paymentlist(payid,amount,paytypeid,trainingid) values (?,?,?,?)";
				$this->db->query($sql,array($lastid1,$trainfee->amount,$trainfee->paytypeid,$trainfee->trainingid));
			}
			
			#---insert to subtraining-----------start
			if (!empty($subcode)) 	
			{
				$sql = "Insert into subtraining(trainingid,submodid,user) select a.trainingid,c.submodid,? from training a inner join schedule b on a.code = b.code inner join submodule c on b.modcode = c.modcode where a.code = ? and a.trid = ?";
				
				$this->db->query($sql,array($this->session->userdata("userid"), $subcode,$this->session->userdata('trid')));
			}
			#insert to subtraining-----------end 
			
			#---insert other fees to cash_payments----------start
			$fees = $this->input->post("fees");
			//print_r($fees);die();
			foreach($fees as $row => $key)
			{
				
				if ((!empty($key)) or ($key != 0))
				{
					
					//print_r($key);die();
					$sql = "insert into cash_paymentlist (payid,amount,paytypeid) values (?,?,?)";
					$this->db->query($sql,array($lastid1,$key,$row));		
				}
				else
				{
					//print_r($row);die();
					//$this->db->select("amount");
					$sql = "INSERT INTO cash_paymentlist
							(payid,amount,paytypeid)
							SELECT ?,amount,?
							FROM cash_payment_type where paytypeid = ? and amount != 0";
					$this->db->query($sql,array($lastid1,$row,$row));
					//print_r($this->db->last_query());die();
				}
			}

			$trainid = explode(",",$this->input->post("trainid"));
			$trainidcnt = count($trainid);
			//print_r($codelenght);die();
			for($i = 0; $i <= $trainidcnt - 1; $i++){
				$data = ['label'=> 1];
				$this->db->where('trainingid',$trainid[$i]);
				$this->db->update('training_',$data);
			}
				

		}
		
		function confirm_finish(){

			$param = [$this->session->userdata('nid')];
			$sql = "delete from training_ where trid = ?";
			$query = $this->db->query($sql,$param);

			$sql = "delete a.*,b.*,c.*,d.* from trainee_ as a 
					left join emergency_con_person_ as b on a.cpid = b.cpid
					left join location_ as c on a.locid = c.locid
					left join shipboard_experience as d on a.seid = d.seid  
					where a.idnum = ?";
			$query = $this->db->query($sql,$param);

			return true;
		}

		function get_savelcs(){

			$data = [
				'license' => $this->input->post('lcs'),
				'licname' => $this->input->post('lcsname')
			];
			$this->db->insert('license',$data);
			$param = [$this->db->insert_id()];

			$sql = "select * from license where licid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_saveemployer(){

			$data = [
				'name' => $this->input->post('ename'),
				'address1' => $this->input->post('eadd'),
				'telnum' => $this->input->post('etelnum'),
				'shipowner' => $this->input->post('owner'),
				'mnumber' => $this->input->post('enumber')
			];
			$this->db->insert('employer',$data);
			$param = [$this->db->insert_id()];

			$sql = "select * from employer where employid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function get_saverank(){

			$data = [
				'rank' => $this->input->post('rname'),
				'rankshort' => $this->input->post('rsname'),
				'ranktype' => $this->input->post('rtype')
			];
			$this->db->insert('rank',$data);
			$param = [$this->db->insert_id()];

			$sql = "select * from rank where rankid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}

		function delete_sched_enroll($id){

			$param = [$id];
			$sql = "DELETE from training_ where trainingid = ? ";
			$query = $this->db->query($sql,$param);

			return $query;

		}	

		function error_cert($certnum,$trid){

			$data = [
				'remarks' => 'error certificate number',
				'error_data' => 1
			];
			$this->db->where('certnum',$certnum);
			$this->db->update('certnumber',$data);

			$dataa = [
				'error_certnum' => 1
			];
			$this->db->where('trainingid',$trid);
			$this->db->update('training',$dataa);

		}

		function good_cert($certnum,$trid){

			$data = [
				'remarks' => '',
				'error_data' => 0
			];
			$this->db->where('certnum',$certnum);
			$this->db->update('certnumber',$data);

			$dataa = [
				'error_certnum' => 0
			];
			$this->db->where('trainingid',$trid);
			$this->db->update('training',$dataa);

		}

	function search_cert_error_list()
		{
			$module = $this->session->userdata('search_mod');
		
			$sql = "SELECT concat(c.descriptn,'(',c.module,')') as module, a.certnum,a.certdate,a.dateadded
					FROM certnumber as a
					left join schedule as b on a.code = b.code
					left join module as c on b.modcode = c.modcode
					where a.error_data = 1 and (c.module like ? OR c.descriptn like ?) order by c.module";
			$query = $this->db->query($sql, array('%'.$module.'%','%'.$module.'%'));
			
			#print_r($this->db->last_query());
			return $query;
		}
		
	function cert_error_list($count)
	{
		
		$module = $this->session->userdata('search_mod');
		
		$sql = "SELECT concat(c.descriptn,'(',c.module,')') as module, a.certnum,a.certdate,a.dateadded
				FROM certnumber as a
				left join schedule as b on a.code = b.code
				left join module as c on b.modcode = c.modcode
				where a.error_data = 1 and (c.module like ? OR c.descriptn like ?) order by b.module limit ?,?";
		$query = $this->db->query($sql, array('%'.$module.'%','%'.$module.'%',intval($this->uri->segment(3)), $count));
		#echo "<br>";
		#print_r($this->db->last_query());
		#print_r($this->db->last_query()); die();
		return $query;
	}	
	
}
?>