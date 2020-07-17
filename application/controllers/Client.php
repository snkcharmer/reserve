<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	function __construct ()
	{
		parent:: __construct();
		$this->load->model('Client_model');
		$this->load->library('session');
		// print_r($this->session->all_userdata());
	}
	
	public function index()
	{
		// $this->form_validation->set_rules(
				// 'username', 'Username',
				// 'required|min_length[5]|max_length[12]|is_unique[users.username]',
				// array(
						// 'required'      => 'You have not provided %s.',
						// 'is_unique'     => 'This %s already exists.'
				// )
		// );
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('year', 'First Name', 'callback_check_valid_date');
		$this->form_validation->set_rules('password1', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');
		$this->form_validation->set_rules('eadd', 'Email', 'required|valid_email|is_unique[trainee.eadd]');
		$this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha Validation', 'required|callback_validate_captcha');
		
		if ($this->form_validation->run() == FALSE)
		{
				$data = array(
					'eadd',
					'id',
					'fullname',
					'nmp_logged',
				);
				
				$this->session->unset_userdata($data);
				$this->load->view('login');
				
		}
		else
		{
				
				$bdate = (int)$this->input->post('month') . "-" . (int)$this->input->post('day'). "-" . (int)$this->input->post('year');
				echo $bdate; die();
				$fullname = $this->input->post('lname') . ", " . $this->input->post('fname');
				$token = md5(date('Y-m-d H:i:s').$fullname);
				$this->Client_model->register_short($bdate,$token);
				$idnum = $this->db->insert_id();
				$eadd = $this->input->post('eadd');
				$this->session->set_flashdata("emailsent","1");
				$this->Client_model->sendEmailRegistration( $eadd, $token, $idnum );
				$this->email->send(FALSE);
				redirect('client/dashboard');
		}
	}
	
	public function resendEmail(){
		$token = $this->input->post('sesstoken');
		$eadd = $this->input->post('sesseadd');
		$idnum = $this->input->post('sessidnum');
		$this->Client_model->sendEmailRegistration( $eadd, $token, $idnum );
		$this->email->send(FALSE);
	}
	
	public function check_valid_date($str)
	{
		$isbdate = checkdate((int)$this->input->post('month'), (int)$this->input->post('day'), (int)$this->input->post('year'));
			if ($isbdate == FALSE)
			{
					$this->form_validation->set_message('check_valid_date', 'Invalid Date');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
	}
	
	function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
         $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lcegq8ZAAAAAGy3jppmJGUGMwS0a_l2BfBpAhc0&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	public function confirmlogin()
	{
		$eadd = $this->input->post("loginemail");
		$password = $this->input->post("loginpassword");
		$result = $this->Client_model->validate_login($eadd,$password);
		
		if ($result != FALSE ) 
		{
			if ($result["email_confirmed"] == 1) {
				
				$data = array(
					'eadd' => $result['eadd'],
					'id' => $result["idnum"],
					'fullname' => $result['lname'] . ", " . $result['fname'],
					'nmp_logged' => TRUE,
				);
					
				$this->session->set_userdata($data);

				redirect("client/dashboard");
			} else {
				
				$error = array(
						"error" => 1,
						"details" => "Please check your email to confirm your account.",
						"sessemail" => $result['eadd'],
						"sesstoken" => $result['conf_token'],
						"sessidnum" => $result['idnum']
						);
				$this->session->set_flashdata($error);
				redirect("client/index");
				
			}
			
		} else {
			// $this->session->set_flashdata("errorLogin","Username and password does not match.");
			$error = array(
						"error" => 2,
						"details" => "Username and password does not match."
						);
			$this->session->set_flashdata($error);
			redirect("client/index");
		}
	}
	
	public function get_schedule_ajax()
	{
		$modcode = $this->input->post("modcode");
		$res = $this->Client_model->get_schedule($modcode)->result_array();
		echo json_encode($res);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("client/index");
	}
	
	public function register_schedule_ajax()
	{
		// print_r($this->input->post("reservationList")); die();
		if ($this->session->userdata('nmp_logged') == FALSE) {
			echo json_encode(["error" => "Session Expired", "hasError" => 1]);
			
		} else {
			
			$resSchedule = $this->input->post("resSchedule");
			$resModule = $this->input->post("resModule");
			
			$idnum = $this->input->post("idnum");
			$current_session_id = $this->session->userdata('id');
			
			$ctr = 0;
			
			$this->form_validation->set_rules('resSchedule[]', 'Schedule', 'required|exact_length[8]');
			$this->form_validation->set_rules('resModule[]', 'Module', 'required|exact_length[8]');
			$this->form_validation->set_rules('idnum', 'ID number', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
					$error = validation_errors();
					echo json_encode(["error" => $error, "hasError" => 1]);
			}
			else
			{
					$this->Client_model->reserve_schedule();
					$pira = $this->db->affected_rows();
					// if ($pira > 0) {
						$this->session->set_flashdata("success","Thank you for choosing NMP. Please complete the needed requirements within 48 hours.");
						
						echo json_encode(["error" => "", "hasError" => 0]);
					// } else {
						// echo json_encode(["error" => "error database", "hasError" => 1]);
					// }
			}
		}
		// $res = $this->Client_model->get_schedule($modcode)->result_array();
		
		
	}
	
	public function confirmregistration()
	{
		$token = $this->input->get('token');
		$idnum = $this->input->get('rand');
		$res = $this->Client_model->check_token($token,$idnum);
		// print_r($this->db->last_query());
		if ($res->num_rows() > 0) {
			$this->Client_model->email_confirmed($token,$idnum);
			$this->session->set_flashdata("emailconfirmed","1");
			redirect("login");
		} else {
			redirect("404biyatch");
		}
		
	}
	
	public function dashboard()
	{
		if ($this->session->userdata('nmp_logged') == FALSE) {
			$this->index();
		} else {
			$data["idnum"] = $idnum = $this->session->userdata('id');
			$data["modules"] = $this->Client_model->get_module()->result_array();
			$data["activities"] = $this->Client_model->get_enrollment_status($idnum);
			// print_r($data); die();
			$this->load->view('client/dashboard',$data);
		}
	}
	
	public function get_reservation_ajax()
	{
		if ($this->session->userdata('nmp_logged') == FALSE) {
			echo json_encode(["sess_expired" => 1]);
		} else {
			$resid = $this->input->post("resid");
			$idnum = $this->session->userdata("id");
			$data = $this->Client_model->get_payment_slip($resid,$idnum)->result_array();
			echo json_encode($data);
		}
	}
	
	public function profile($token = "", $resid = 0)
	{
		if ($this->session->userdata('nmp_logged') == FALSE) {
			$this->index();
		} else {
			$this->load->model('Client_model');
			$data["idnum"] = $idnum = $this->session->userdata('id');
			
			// $data["religion"] = $this->Client_model->getreligion();
			// $data["citizenship"] = $this->Client_model->getcitizenship();
			// $data['civstat'] = $this->Client_model->getcivstat();
			
			// $data["modules"] = $this->Client_model->get_module()->result_array();
			// $data["activities"] = $this->Client_model->get_enrollment_status($idnum);
			
			// $data["record"] = $this->Client_model->get_client_profile($idnum);

			// $this->load->view('client/profile',$data);
			$this->load->model('Admin_model');
			// $data['sponsor'] = $this->Client_model->get_sponsor();

			$data['mun'] = $this->Admin_model->get_municipality();

			$data['flag'] = $idnum;
			$data['token'] = $token;
			$data['resid'] = $resid;
			$data["rec"] = $this->Client_model->get_client_profile($idnum)->row_array();
			$this->load->view('client/profile',$data);
			
		}
	}
	
	public function updateprofile()
	{
		$this->check_session();
		
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('bdate', 'Birth Date', 'required');
		$this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha Validation', 'required|callback_validate_captcha');
		
		if ($this->form_validation->run() == FALSE)
		{
				$this->load->model('Client_model');
				$this->profile();
		}
		else
		{
				
				redirect('client/profile');
		}
	}
	
	public function get_code_()
	{
		$this->check_session();
		$this->load->model('Admin_model');
		$data['pcode'] = $this->Admin_model->get_code_()->row_array(); 
		echo json_encode($data);
	}
	
	public function attachment(){
		$this->check_session();
		$this->load->view('client/attachment');
	}
	
	public function do_upload()
	{
		$this->check_session();
		// echo "upload";
			$resid = $this->input->post('payment-resid');
			$idnum = $this->input->post('payment-idnum');
			
			$path = "attachmentupload/";
			$config['upload_path']          = $path;
			$config['allowed_types']        = 'jpeg|jpg|png|pdf';
			$config['file_name']        = $resid . "-" . $idnum;
			$config['max_size']             = 1000;
			$config['overwrite']             = TRUE;
			$this->load->library('upload',$config);
			
			if (!$this->upload->do_upload('uploadattachment'))
			{
				$data = array('error' => 1, 'details' => $this->upload->display_errors());
				echo json_encode($data);
			}
			else
			{
				$data = array('error' => 0, 'details' => $this->upload->data());
				echo json_encode($data);
			}
	}
	
	public function update_enrollment()
	{
		$this->check_session();
		$resid = $this->input->post('resid');
		$token = $this->input->post('token');
		$this->Client_model->update_enrollment_activity_completeness($resid,$token); 
		$data = ["message" => 1];
		echo json_encode($data);
	}
	
	
	public function check_session()
	{
		if ($this->session->userdata('nmp_logged') == FALSE) {
			echo json_encode(["nmp_session_break" => 1]);
			redirect('client/dashboard');
		}
	}
	
	
}
