<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserve extends CI_Controller {

	function __construct ()
	{
		parent:: __construct();
		$this->load->model('Reserve_model');

		// if(!$this->session->userdata('is_logged')) {
			// redirect('');
		// }

		// if($this->session->userdata('priv') !== '1') {
			// redirect('error_403');
		// }
	}
	
	public function index()
	{
		$data["modules"] = $this->Reserve_model->get_module()->result_array();
		$this->load->view('schedule',$data);
	}
	
	
	public function validate_registration_format()
	{
		
	}
	
	public function add_reservation()
	{
		
	}
}
