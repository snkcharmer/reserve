<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('Schedule_model','Applicant_model', 'Login_model'));
		$this->load->library('table');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('admin/login');
	}
	
	public function userlogin()
	{
		$data['data'] = $this->Login_model->admin_login()->result_array();
		if ($data['data'] == NULL){
			echo json_encode("failed");
		}else{
			echo json_encode("success");
		}
	}
	
	public function dashboard()
	{
		$curyear = $this->input->post("curyear");
		$data["modules"] = $this->Schedule_model->get_module($curyear);
		$this->load->view('admin/dashboard',$data);
	}
	
	public function get_reservation()
	{
		// $this->load->model('Applicant_model');
		// $prnum = $this->session->userdata('priv');
		$fullname = $this->input->post('fullname');
		$curyear = $this->input->post('curyear');
		$module = $this->input->post('module');
		$code = $this->input->post('code');
		
		$this->load->library("pagination");
		  $config = array();
		  $config["base_url"] = "#";
		  $config["total_rows"] = $this->Applicant_model->count_applicant_all($fullname,$curyear,$module,$code)->num_rows();
		  $config["per_page"] = 10;
		  $config["uri_segment"] = 3;
		  $config["use_page_numbers"] = TRUE;
		  $config["full_tag_open"] = '<ul class="pagination link_me_me">';
		  $config["full_tag_close"] = '</ul>';
		  $config["first_tag_open"] = '<li>';
		  $config["first_tag_close"] = '</li>';
		  $config["last_tag_open"] = '<li>';
		  $config["last_tag_close"] = '</li>';
		  $config['next_link'] = '&gt;';
		  $config["next_tag_open"] = '<li>';
		  $config["next_tag_close"] = '</li>';
		  $config["prev_link"] = "&lt;";
		  $config["prev_tag_open"] = "<li>";
		  $config["prev_tag_close"] = "</li>";
		  $config["cur_tag_open"] = "<li class='active'><a href=''>";
		  $config["cur_tag_close"] = "</a></li>";
		  $config["num_tag_open"] = "<li>";
		  $config["num_tag_close"] = "</li>";
		  $config["num_links"] = 3;
		  $this->pagination->initialize($config);
		  $page = $this->uri->segment(3);
		  $start = ($page - 1) * $config["per_page"];

		  $output = array(
		   	'pagination_link'  => $this->pagination->create_links(),
		   	'rec'   => $this->Applicant_model->count_applicant_all($fullname,$curyear,$module,$code)->result_array(),
		   	'count'   =>	$config['total_rows'],
			/*'total_search_item'   => $this->Admin_model->get_acc_data($config["per_page"], $start)->num_rows()*/
		  );
		  echo json_encode($output);
	}
	
}
