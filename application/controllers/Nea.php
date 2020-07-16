<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nea extends CI_Controller {
	
	private $limit = 10;
	var $terms = array();
	
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('Nea_model','Admin_model'));
		$this->load->library('table');
		$this->load->helper('url');
	}

	public function index()
	{	session_start();
		//$this->load->view('home0');
		$this->load->view('nea/home0');
	}

	public function toturial()
	{	session_start();
		//$this->load->view('home0');
		$this->load->view('nea/toturial');
	}


	public function search_sched()
	{
		$search_sched = $this->input->post('search_sched');
		//print_r(expression)
		
		if (empty($search_sched))
		{
			$this->session->unset_userdata('search_sched');
		}
		else
		{
			$this->session->set_userdata(array('search_sched' => $search_sched));
		}
		
		$this->scheduledisp();
	}
	
	public function scheduledisp()
	{
		$config['base_url'] = site_url('nea/scheduledisp');
		$config['total_rows'] = $this->Nea_model->search_total_sched_template()->num_rows();
		$config['per_page'] = 6;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<a href="" class="page active">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$this->pagination->initialize($config);
		$query = $this->Nea_model->scheduledisp(6)->result_array();
		$data['records'] = $query;
		#print_r($this->session->all_userdata());
		$this->load->view('nea/scheduledisplay', $data);
	}

	public function trainingrequirements(){

		$this->load->view('nea/requirements');
	}

	public function accomodation(){

		$this->load->view('nea/accomodation');
	}

	public function search_cert()
	{
		$search_cert = $this->input->post('search_cert');
		
		if (empty($search_cert))
		{
			$this->session->unset_userdata('search_cert');
		}
		else
		{
			$this->session->set_userdata(array('search_cert' => $search_cert));
		}
		
		$this->cert_template();
	}
	
	public function cert_template()
	{
		$config['base_url'] = site_url('nea/cert_template');
		$config['total_rows'] = $this->Nea_model->search_total_cert_template()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$this->pagination->initialize($config);
		$query = $this->Nea_model->cert_template(10)->result_array();
		$data['mod'] = $this->Nea_model->get_module();
		$data['records'] = $query;
		#print_r($this->session->all_userdata());
		$this->load->view('nea/cert_template', $data);
	}

	public function save_template()
	{	
		$this->load->helper('security');
		$this->form_validation->set_rules('modid', 'Module id', 'required|xss_clean');
		$this->form_validation->set_rules('header', 'Page Header', 'required|xss_clean|trim');
		$this->form_validation->set_rules('header1', 'Page Header', 'required|xss_clea|trimn');
		$this->form_validation->set_rules('header2', 'Page Header', 'xss_clean|trim');
		$this->form_validation->set_rules('body', 'Pge Body', 'required|xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			die('error! Please check input.');
		}
		else
		{
			$this->Nea_model->save_template(); 
			
			redirect('nea/cert_template');
		}
		
	}

	public function delete_cert_temp($id = 0){

		$this->Nea_model->delete_cert_temp($id); 
			
		redirect('nea/cert_template');

	}

	public function view_certificate($mjcode){

		$data['template'] = $this->training_model->get_cert_template($mjcode)->row_array();

		$html = $this->load->view("moduletemplate/sample_certificate",$data,true);
		
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		//$pdf->setFooter('{PAGENO} / {nb}');
		$pdf->AddPage('P', // L - landscape, P - portrait
        '', '', '', '',
        	7, // margin left
	        7, // margin right
	        7, // margin top
	        7, // margin bottom
	        5, // margin header
	        7);
		$pdf->WriteHTML($html);
		ob_clean();
		$pdf->Output(); 
		exit;

	}

	public function policy()
	{	session_start();
		$this->load->view('nea/privacy');
		//$this->load->view('nea/home0');
	}

	public function announcement()
	{	
		$data['rec'] = $this->Nea_model->get_announcement()->row_array();
		//print_r($data['rec']);die();
		$this->load->view('nea/announcement',$data);
	}

	public function announcement_display()
	{	
		$data['rec'] = $this->Nea_model->get_announcement()->row_array();
		//print_r($data['rec']);die();
		$this->load->view('nea/displayannounce',$data);
	}

	public function saveannouncement()
	{	
		$this->load->helper('security');
		$this->form_validation->set_rules('announce', 'announcement', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			die('error! Please check input.');
		}
		else
		{
			$this->Nea_model->saveannouncement(); 
			$data['rec'] = $this->Nea_model->get_announcement()->row_array();
			$this->load->view('nea/announcement',$data);
		}
		
	}


	public function inquire()
	{	
		$this->load->view('nea/inquire');
	}

	public function done($trid = null)
	{
		$data['trid'] = $trid;
		$this->load->view('nea/takephoto',$data);
	}

	public function done_($trid = null)
	{
		$data['trid'] = $trid;
		$data['rec'] = $this->Nea_model->get_trainee_data($trid)->row_array();
		$this->load->view('nea/done',$data);
	}

	public function home_res()
	{
		$data['mod'] = $this->Nea_model->get_module(); 
		$data['schl'] = $this->Nea_model->get_school(); 
		$data['course'] = $this->Nea_model->get_course();  
		$data['lic'] = $this->Nea_model->get_license(); 
		$data['rank'] = $this->Nea_model->get_rank(); 
		$data['employer'] = $this->Nea_model->get_employer(); 
		$data['sponsor'] = $this->Nea_model->get_sponsor();
		//$data['reg'] = $this->Nea_model->get_region(); 
		$data['mun'] = $this->Nea_model->get_municipality_();
		$this->load->view('nea/home0',$data);
	}

	public function home()
	{
		$this->load->view('nea/home');
	}

	public function queing()
	{
		$this->load->view('nea/queing');
	}

	public function registration01($id = null)
	{
		$this->load->helper('security');
		$this->form_validation->set_rules('lname', 'Last name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('fname', 'First name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('bdate', 'Birthdate', 'required|xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			die('error! Please check input.');
		}
		else
		{
			//die('adi nah');
			$data['mod'] = $this->Nea_model->get_module(); 
			$data['schl'] = $this->Nea_model->get_school(); 
			$data['course'] = $this->Nea_model->get_course();  
			$data['lic'] = $this->Nea_model->get_license(); 
			$data['rank'] = $this->Nea_model->get_rank(); 
			$data['employer'] = $this->Nea_model->get_employer(); 
			$data['reg'] = $this->Nea_model->get_region(); 
			$data['prov'] = $this->Nea_model->get_province01();
			$data['mun'] = $this->Nea_model->get_municipality01();
			$data['sponsor'] = $this->Nea_model->get_sponsor();
			$data['rec'] = $this->Nea_model->get_old_trainee()->row_array();
			$data['flag'] = $id;
			//var_dump();die();
			if($data['rec'] == "" || $data['rec'] == null){
				//print_r($data['rec']);die();
				$this->session->set_flashdata('cerror', 'ok');
				redirect('Home');
			}else{
				$this->load->view('nea/registration',$data);
			}
			
		}
		
	}
	
	public function registration($id = null)
	{
		$data['mod'] = $this->Nea_model->get_module(); 
		$data['schl'] = $this->Nea_model->get_school(); 
		$data['course'] = $this->Nea_model->get_course();  
		$data['lic'] = $this->Nea_model->get_license(); 
		$data['rank'] = $this->Nea_model->get_rank(); 
		$data['employer'] = $this->Nea_model->get_employer(); 
		$data['sponsor'] = $this->Nea_model->get_sponsor();
		//$data['reg'] = $this->Nea_model->get_region(); 
		$data['mun'] = $this->Nea_model->get_municipality_();
		//$data['rec'] = $this->Nea_model->get_old_trainee($id)->row_array();
		$data['flag'] = $id;
		//var_dump($data['rec']);die();
		$this->load->view('nea/registration',$data);
	}

	public function get_province_()
	{
		$data['prov'] = $this->Nea_model->get_province_()->result_array(); 
		echo json_encode($data);
	}

	public function get_municipality_()
	{
		$data['muni'] = $this->Nea_model->get_municipality_()->result_array(); 
		echo json_encode($data);
	}

	public function get_code_()
	{
		$data['pcode'] = $this->Nea_model->get_code_()->row_array(); 
		echo json_encode($data);
	}

	public function get_schedule_()
	{
		$data['sched'] = $this->Nea_model->get_schedule_()->result_array(); 
		echo json_encode($data);
	}

	public function get_schedule_byid()
	{
		$data['schedbyid'] = $this->Nea_model->get_schedule_byid()->row_array(); 
		echo json_encode($data);
	}

	public function get_schladdress_byid()
	{
		$data['schladdress'] = $this->Nea_model->get_schladdress_byid()->row_array(); 
		echo json_encode($data);
	}

	public function add_gin(){

		$this->load->helper('security');
		$this->form_validation->set_rules('fname', 'First name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('lname', 'Last name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('ext', 'Suffix', 'xss_clean|trim');
		$this->form_validation->set_rules('mname', 'Middle name', 'xss_clean|trim');
		$this->form_validation->set_rules('sex', 'Gender', 'required|xss_clean|trim');
		$this->form_validation->set_rules('citi', 'Citizenship', 'required|xss_clean|trim');
		$this->form_validation->set_rules('status', 'Civil status', 'required|xss_clean|trim');
		$this->form_validation->set_rules('bdate', 'Birthdate', 'required|xss_clean|trim');
		$this->form_validation->set_rules('bplace', 'Birth Place', 'required|xss_clean|trim');
		$this->form_validation->set_rules('regid', 'Region', 'required|xss_clean|trim');
		$this->form_validation->set_rules('provid', 'Province', 'required|xss_clean|trim');
		$this->form_validation->set_rules('mcid', 'Municipality', 'required|xss_clean|trim');
		$this->form_validation->set_rules('address', 'address', 'xss_clean|trim');
		//$this->form_validation->set_rules('brgy', 'brgy', 'xss_clean|trim');
		$this->form_validation->set_rules('pcode', 'Postal code', 'xss_clean|trim');
		$this->form_validation->set_rules('lnumber', 'landline number', 'xss_clean|trim');
		$this->form_validation->set_rules('mobile1', 'mobile number', 'required|xss_clean|trim');
		$this->form_validation->set_rules('mobile2', 'mobile number', 'xss_clean|trim');
		$this->form_validation->set_rules('emailacc', 'email Address', 'xss_clean|trim');
		$this->form_validation->set_rules('fbacc', 'Facebook', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['trid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$ids = $this->Nea_model->add_gin();
			$data['rec'] = $ids;

			echo json_encode($data);
		}

	}

	public function add_heasave(){

		$this->load->helper('security');
		$this->form_validation->set_rules('courseid', 'Curse', 'required|xss_clean|trim');
		$this->form_validation->set_rules('school', 'School', 'required|xss_clean|trim');
		$this->form_validation->set_rules('schooladdress', 'School Address', 'required|xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['courseid' =>  'error'];
			// print_r(validation_errors()); die();
			echo json_encode($data);
		}
		else
		{
			$this->Nea_model->add_heasave();
			// print_r($this->db->last_query()); die();
			$data['rec'] = ['courseid' =>  'ok'];

			echo json_encode($data);
		}

	}

	public function savecourse(){

		$this->load->helper('security');
		$this->form_validation->set_rules('cname', 'coursename', 'required|xss_clean|trim|is_unique[course.course]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['courseid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->savecourse()->row_array();

			echo json_encode($data);
		}

	}

	public function saveschool(){

		$this->load->helper('security');
		$this->form_validation->set_rules('sname', 'school name', 'required|xss_clean|trim|is_unique[school.school]');
		$this->form_validation->set_rules('saddress', 'school address', 'required|xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['schoolid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->saveschool()->row_array();
			
			echo json_encode($data);
		}

	}

	public function saveLicense(){

		$this->load->helper('security');
		$this->form_validation->set_rules('lname', 'license name', 'required|xss_clean|trim|is_unique[license.license]');
		$this->form_validation->set_rules('sname', 'Short name', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['licid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->saveLicense()->row_array();
			
			echo json_encode($data);
		}

	}

	public function save_rank(){

		$this->load->helper('security');
		$this->form_validation->set_rules('rname', 'Rank name', 'required|xss_clean|trim|is_unique[rank.rank]');
		$this->form_validation->set_rules('rsname', 'Short name', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['rankid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->save_rank()->row_array();
			
			echo json_encode($data);
		}

	}

	public function save_sponsor(){

		$this->load->helper('security');
		$this->form_validation->set_rules('sponname', 'Sponsor name', 'required|xss_clean|trim|is_unique[sponsor_type.sptypename]');
		$this->form_validation->set_rules('sponshname', 'Sponsor short name', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['sponid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->save_sponsor()->row_array();
			
			echo json_encode($data);
		}

	}

	public function save_employeer(){

		$this->load->helper('security');
		$this->form_validation->set_rules('empname', 'Sponsor name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('soname', 'Sponsor short name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('solandline', 'Sponsor short name', 'xss_clean|trim');
		$this->form_validation->set_rules('somobile', 'Sponsor short name', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['employid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->save_employeer()->row_array();
			
			echo json_encode($data);
		}

	}

	public function get_employeer_byid(){

		$data['rec'] = $this->Nea_model->get_employeer_byid()->row_array();
			
		echo json_encode($data);
		
	}

	public function add_cpcesave(){

		$this->load->helper('security');
		$this->form_validation->set_rules('fullname', 'fullname', 'required|xss_clean|trim');
		$this->form_validation->set_rules('rel', 'relationship', 'required|xss_clean|trim');
		$this->form_validation->set_rules('caddress', 'complete address', 'required|xss_clean|trim');
		$this->form_validation->set_rules('telnum', 'telnum', 'xss_clean|trim');
		$this->form_validation->set_rules('mob1', 'mobile number', 'xss_clean|trim');
		$this->form_validation->set_rules('mob2', 'mobile number', 'xss_clean|trim');
		$this->form_validation->set_rules('emailadd', 'emailadd', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['cpid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->add_cpcesave();
			// $data['rec'] = $data;

			echo json_encode($data);
		}

	}

	public function add_lsesave(){

		$this->load->helper('security');
		$this->form_validation->set_rules('licid', 'License Id', 'required|xss_clean');
		$this->form_validation->set_rules('rankid', 'rankid', 'required|xss_clean');
		$this->form_validation->set_rules('datedis', 'datedis', 'xss_clean');
		$this->form_validation->set_rules('employid', 'Shipping Principal', 'xss_clean');
		$this->form_validation->set_rules('mnum', 'mobile number', 'xss_clean');
		$this->form_validation->set_rules('lnum', 'landline number', 'xss_clean');
		$this->form_validation->set_rules('sprin', 'Company name', 'xss_clean');

		/*var_dump($this->input->post('licid'));
		var_dump($this->input->post('rankid'));
		var_dump($this->input->post('datedis'));
		var_dump($this->input->post('employid'));
		var_dump($this->input->post('sprin'));
		die();*/
		if ($this->form_validation->run() == FALSE)
		{
			$data = ["error" => 1, "error_details" => validation_errors()];

			echo json_encode($data);
		}
		else
		{
			$res = $this->Nea_model->add_lsesave();
			$data = ["error" => 0];

			echo json_encode($data);
		}

	}

	public function add_tcesave(){

		$this->load->helper('security');
		$this->form_validation->set_rules('modid', 'modid', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sponsor', 'sponsor', 'required|xss_clean|trim');
		$this->form_validation->set_rules('code', 'code', 'required|xss_clean|trim');
		$this->form_validation->set_rules('edate', 'edate', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sdate', 'sdate', 'required|xss_clean|trim');
		$this->form_validation->set_rules('venid', 'venid', 'required|xss_clean|trim');
		$this->form_validation->set_rules('fee', 'fee', 'required|xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['trainid' =>  'error'];

			echo json_encode($data);
		}
		else
		{
			$data = $this->Nea_model->add_tcesave();
			$data['rec'] = ['trainid' =>  'ok'];

			echo json_encode($data);
		}

	}

	public function get_training_sched(){

		//$this->check_session();

		$data['rec'] = $this->Nea_model->get_training_sched()->result_array();

		echo json_encode($data);
	}

	public function delete_module(){

		$data['rec'] = $this->Nea_model->delete_module()->result_array();

		echo json_encode($data);
	}

	public function finish_na(){

		//$this->check_session();

		$this->Nea_model->finish_na();
		//$data['rec'] = $this->Nea_model->get_que_data()->result_array();
		$data = ['ok'=> 'ok'];
		echo json_encode($data);
	}

	public function get_que_data(){

		//$this->check_session();

		$data['rec'] = $this->Nea_model->get_que_data()->result_array();

		echo json_encode($data);
	}

	function saveid()
	{
		#header( "Content-type: image/png" );
		$trid = $this->input->post("trid");
		$rawData = $_POST['imgBase64'];
		$filteredData = explode(',', $rawData);

		$unencoded = base64_decode($filteredData[1]);
		$datime = date("Y-m-d-H.i.s", time()); # - 3600*7
		//Create the image 
		$fp = fopen('photos/'.$trid.'.jpg', 'w');
		fwrite($fp, $unencoded);
		fclose($fp);
		
	}

	public function enroll($id = null)
	{
		$data['courses'] = $this->admin_model->getcourse()->result_array();
		$data['schools'] = $this->admin_model->getschool()->result_array();
		$data['civstat'] = $this->admin_model->getcivstat()->result_array();
		$data['row'] = $this->Nea_model->get_trainee_data($id)->row_array();

		$fname = $data['row']['fname'];
		$lname = $data['row']['lname'];
		$bdate = $data['row']['bdate'];
		$data['trid'] = $data['row']['trid'];

		$olddata = $this->Nea_model->checkolddata($fname,$lname,$bdate)->row_array();
		//print_r($olddata);die();
		
		if($olddata){
			//die('dfgf');
			$s = array(
				'nid' => $id
			);
			$this->session->set_userdata($s);
			$this->enroll_($olddata['trid']);
			//redirect('Nea/enroll_/'.$olddata['trid']);
		}else{
			$s = array(
				'nid' => $id
			);
			$this->session->set_userdata($s);
			$this->load->view('nea/Generalinfo',$data);
		}
		//echo $data['row']['trid'];die();
	
	}

	public function enroll_($id = null)
	{
		$data['courses'] = $this->admin_model->getcourse()->result_array();
		$data['schools'] = $this->admin_model->getschool()->result_array();
		$data['civstat'] = $this->admin_model->getcivstat()->result_array();
		$data['row'] = $this->admin_model->searchtrid($id)->row_array();
		$data['trid'] = $data['row']['trid'];
		$xxx = array(
			'trid' => $data['row']['trid'],
		);
		$this->session->set_userdata($xxx);
		//$data['nid'] = $this->session->userdata('nid');
		//echo $this->session->userdata('nid');die();
		$this->load->view('nea/Generalinfo',$data);
		
		
	}

	function update()
	{
		$this->form_validation->set_rules('lname','Last Name', 'required|xss');
		$this->form_validation->set_rules('fname','First Name', 'required|xss');
		$this->form_validation->set_rules('mname','Middle Name', 'xss');
		$this->form_validation->set_rules('suffix','Suffix', 'xss');
		$this->form_validation->set_rules('sex','Sex', 'required|xss');
		$this->form_validation->set_rules('civilstat','Civil Stat', 'xss');
		//$this->form_validation->set_rules('religion','Religion', 'xss');
		$this->form_validation->set_rules('bdate','Birth Date', 'xss');
		$this->form_validation->set_rules('bplace','Birth Place', 'xss');
		$this->form_validation->set_rules('address','Address', 'xss');
		$this->form_validation->set_rules('zip','Zip', 'xss');
		$this->form_validation->set_rules('mobile','Emergency Phone', 'xss');
		$this->form_validation->set_rules('landline','Emergency Phone', 'xss');
		$this->form_validation->set_rules('region','Region', 'xss');
		$this->form_validation->set_rules('course','Course', 'xss');
		$this->form_validation->set_rules('school','School', 'xss');
		$this->form_validation->set_rules('citizenship','citizenship', 'xss');
		//$this->form_validation->set_rules('schaddr','School Address', 'xss');
		$this->form_validation->set_rules('town','Municipality', 'xss');
		$this->form_validation->set_rules('eadd','Email Address', 'xss');
		$this->form_validation->set_rules('emname','Emergency Name', 'xss');
		$this->form_validation->set_rules('emaddr','Emergency Address', 'xss');
		$this->form_validation->set_rules('emphone','Emergency Phone', 'xss');
		$this->form_validation->set_rules('emrel','Emergency Relation', 'xss');
		$this->form_validation->set_rules('emlandline','Emergency Landline', 'xss');
		$this->form_validation->set_rules('emadd','Emergency email address', 'xss');
		
		$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><strong>", "</strong></p></div></div>");
				
		if($this->form_validation->run()==TRUE)
		{  
			$data = $this->Nea_model->update_information();
				
			//redirect('Nea/enroll_/'.$data);
			//echo $this->session->userdata('nid');die();
			$this->enroll_($data);
		}
		else
		{
		   $this->enroll($this->input->post('idnum'));
		}
	}

	function enroll_module($id = 0)
	{
		//$this->check_session();
		//$this->session->unset_userdata("ofee");
		//print_r($this->session->all_userdata()); die();
		if($this->admin_model->searchtrid($this->session->userdata('trid'))->row_array())
		{
			$this->session->set_userdata('id',$id);
			$this->session->unset_userdata('cartitems');
			$this->session->unset_userdata('paycatid');
			$this->session->unset_userdata("ofee");
			$data['records'] = $this->admin_model->searchtrid($this->session->userdata('trid'))->row_array();
			$data['row'] = $this->Nea_model->get_trainee_nea($id)->row_array();
			$data['training'] = $this->Nea_model->searchtraining($id)->result();
			$data['ranks'] = $this->admin_model->getrank()->result_array();
			$data['licenses'] = $this->admin_model->getlicense()->result_array();
			//var_dump($data['licenses']) ;die();
			//$data['position'] = $this->admin_model->getposition()->result_array();
			$data['employer'] = $this->admin_model->getemployer()->result_array();
			$data['getlabel'] = $this->Nea_model->getlabelupdated($id)->row_array();
		}
		//var_dump($data['row']) ;die();
		$this->load->view('nea/enroll',$data);
	}

	function delete_sched_enroll($id = 0){

		$this->Nea_model->delete_sched_enroll($id);
		$this->session->set_flashdata('message_type', 'success'); 
		$this->session->set_flashdata('message', '<div style="text-align:ceneter; background: #222; color:#fff;">Data Successfully Deleted!</div>');
		redirect('Nea/enroll_module/'.$this->session->userdata('id'));
	}

	function checkcourses()
	{
		//var_dump($this->input->post('code'));die();
		$data['cnt'] = $this->Nea_model->checkcourses()->num_rows();
		$data1['rec'] = $this->Nea_model->checkcourses()->row_array();
		echo json_encode(array($data,$data1));

	}

	function confrmtraining()
	{
		//$this->check_session();
		$this->session->unset_userdata("ofee");
		$this->load->helper('security');
		$this->form_validation->set_rules('licid', 'licid', 'xss_clean|trim');
		$this->form_validation->set_rules('rankid', 'rankid', 'xss_clean|trim');
		$this->form_validation->set_rules('employer', 'employer', 'xss_clean|trim');
		$this->form_validation->set_rules('dateofme', 'date', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			die('error: Please check inputs');
		}
		else
		{
			//print_r($this->session->userdata("codeid"));die();
			$data = $this->Nea_model->proceedenroll();
			$xxx = array(
				'licid' => $this->input->post('licid'),
				'rankid' => $this->input->post('rankid'),
				'employer' => $this->input->post('employer'),
				'dateofme' => $this->input->post('dateofme'),
				'paycatid' => $this->input->post('paycatid'),
				'codeid' => $this->input->post('codeid'),
				'trainid' => $this->input->post('trainid_')
			);
			$this->session->set_userdata($xxx);
			
			$data["fees"] = $this->Nea_model->getfee();
			$data["fees2"] = $this->Nea_model->getfee_not_on_paycatid();
			
			$data['gettrainings'] = $this->Nea_model->gettrainings();
			//$data['trainid'] = $this->input->post('trainid_');

			$this->load->view('nea/training',$data);
		}
		//var_dump($this->input->post('moduleid'));die();
		

	}

	function addotherfee()
	{
		//$this->check_session();
		$fees = $this->input->post("fees");
		//print_r($fees);
		$this->session->unset_userdata("ofee");
		
		foreach($fees as $row => $key)
		{
			//print_r($row);
			if ((!empty($key)) or ($key != 0)) #---para han textbox
			{
				$sex[$row] = $key;
			} else {	
				$price = $this->Nea_model->getprice($row)->row_array();
				if ($price["amount"] != 0) 
				{
					$sex[$row] = $price["amount"];
				}			
			}

		}

		//die();
		
		$this->session->set_userdata(array("ofee" => $sex));
		$data["fees"] = $this->Nea_model->getfee();
		$data["fees2"] = $this->Nea_model->getfee_not_on_paycatid();
		
		$data['gettrainings'] = $this->Nea_model->gettrainings();

		$this->load->view('nea/training',$data);
	}

	public function confirm_enroll(){

		//$this->check_session();
		$this->load->helper('security');
		$this->form_validation->set_rules('licid', 'licid', 'xss_clean|trim');
		$this->form_validation->set_rules('rankid', 'rankid', 'xss_clean|trim');
		$this->form_validation->set_rules('employid', 'employer', 'xss_clean|trim');
		$this->form_validation->set_rules('disembark', 'dateofdisembarkation', 'xss_clean|trim');
		$this->form_validation->set_rules('paycatid', 'category id', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			die('error: Please check inputs');
		}
		else
		{
			$this->Nea_model->confirm_enroll();
			$this->enroll_module($this->session->userdata('nid'));
		}

	}

	public function confirm_finish(){

		//$this->check_session();
		$data['cfrm'] = $this->Nea_model->confirm_finish();
		echo json_encode($data);
	}

	public function savelcs(){

		//$this->check_session();
		$this->load->helper('security');
		$this->form_validation->set_rules('lcs', 'licid', 'required|xss_clean|trim');
		$this->form_validation->set_rules('lcsname', 'rankid', 'required|xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['licid' => 'error'];
			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->get_savelcs()->row_array();

			echo json_encode($data);
		}
		
	}

	public function saveemployer(){

		//$this->check_session();
		$this->load->helper('security');
		$this->form_validation->set_rules('ename', 'company name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('eadd', 'company address', 'required|xss_clean|trim');
		$this->form_validation->set_rules('etelnum', 'telephone number', 'xss_clean|trim');
		$this->form_validation->set_rules('owner', 'Ship owner', 'xss_clean|trim');
		$this->form_validation->set_rules('enumber', 'Mobile', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['employid' => 'error'];
			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->get_saveemployer()->row_array();

			echo json_encode($data);
		}
	}

	public function saverank(){

		//$this->check_session();
		$this->load->helper('security');
		$this->form_validation->set_rules('rname', 'Rank name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('rsname', 'Short name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('rtype', 'Rank type', 'xss_clean|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['rec'] = ['rankid' => 'error'];
			echo json_encode($data);
		}
		else
		{
			$data['rec'] = $this->Nea_model->get_saverank()->row_array();

			echo json_encode($data);
		}
	}


	public function error_cert($certnumber = null,$trid){

		$code = $this->session->userdata("code");
		$this->Nea_model->error_cert($certnumber,$trid);

		redirect('schedule/certificate/'.$code);
	}

	public function good_cert($certnumber = null,$trid){

		$code = $this->session->userdata("code");
		$this->Nea_model->good_cert($certnumber,$trid);

		redirect('schedule/certificate/'.$code);
	}

	public function search_na_mod()
	{
		$search_mod = $this->input->post('search');
		
		if (empty($search_mod))
		{
			$this->session->unset_userdata('search_mod');
		}
		else
		{
			$this->session->set_userdata(array('search_mod' => $search_mod));
		}
		
		$this->errorcertificate();
	}
	
	public function errorcertificate()
	{
		$config['base_url'] = site_url('nea/cert_error_list');
		$config['total_rows'] = $this->Nea_model->search_cert_error_list()->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		
		
		$this->pagination->initialize($config);
		$query = $this->Nea_model->cert_error_list(10)->result_array();
		$data['records'] = $query;
		#print_r($this->session->all_userdata());
		$this->load->view('nea/error_certificate_number', $data);
	}

}
