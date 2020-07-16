<?php	
	class Client_model extends CI_Model
	{
		
		public function check_registered_email($eadd)
		{
			$sql = "select * from where eadd = ?";
			$query = $this->db->query($sql,[$eadd]);
			
			return $query;
		}
		
		public function register_short($bdate,$token)
		{
			$passworld = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			
			$data = array(
				"lname" => strtoupper($this->input->post('lname')),
				"fname" => strtoupper($this->input->post('fname')),
				"mname" => strtoupper($this->input->post('mname')),
				"passworld" => $passworld,
				"eadd" => $this->input->post('eadd'), 
				"bdate" => $bdate,
				"conf_token" => $token
			);
			
			$this->db->insert("trainee",$data);
		}
		
		public function validate_login($eadd, $passworld){
			
			$this->db->where("eadd",$eadd);
			$this->db->where("eadd",$eadd);
			$query = $this->db->get("trainee");
			// print_r($this->db->last_query()); die();
			
			if ($query->num_rows() > 0) {
				$rec = $query->row_array();
				
				if (password_verify($passworld,$rec['passworld'])) {
					// print_r($rec); die();
					return $rec;
				} else {
					// print_r($rec);
					// print_r($rec); die();
					return FALSE;
				}
			} else {
				return FALSE;
			}
			
		}
		
		public function get_module()
		{
			$yanaNaFriday = date("Y-m-d",strtotime('Friday this week'));
			
			$sql = "select b.module, b.modcode, b.descriptn,b.fee
					from schedule a
					inner join module b on a.modcode = b.modcode
					where start >= ?
					group by a.modcode
					order by b.module";
					
			$result = $this->db->query($sql,array($yanaNaFriday));
			// print_r($this->db->last_query()); die();
			return $result;
		}
		
		public function get_schedule($modcode = 0)
		{
			$yanaNaFriday = date("Y-m-d",strtotime('Friday this week')); 
			
			$sql = "select a.code,if(isnull(b.piraNa),0,b.piraNa) as countReserve,date_format(a.start, '%M %e, %Y') as start
					from schedule a
					left join (
						select a.code,count(b.resid) as piraNa 
						from schedule a
						inner join reservation_list b on a.code = b.code
						inner join reservation c on b.resid = c.resid
						where start >= ? and modcode = ? and c.expired = 0 group by a.code 
							) b on a.code = b.code
					where start >= ? and modcode = ?
					having countReserve < 12
					order by a.start";
			$result = $this->db->query($sql,array($yanaNaFriday,$modcode,$yanaNaFriday,$modcode));
			// print_r($this->db->last_query()); die();
			return $result;
		}
		
		public function get_module_info($code) {
			$sql = "select * 
					from schedule a 
					inner join module b on a.modcode = b.modcode 
					left join cash_payment_type c on c.typename = b.modcode and isTraining = 1
					where code = ?";
			$query = $this->db->query($sql,[$code]);
			return $query;
		}
		
		public function check_duplicate_registered_module()
		{
			$sql = "select * 
					from reservation a
					inner join reservation_list b on a.resid = b.resid
					where a.idnum = ? and b.code = ?";
			$query = $this->db->get();
		}
		
		public function reserve_schedule() {
			
			
			$this->db->trans_start();
			
				$codes = $this->input->post("resSchedule");
				$reservation = array(
						"idnum" =>  $this->input->post("idnum"),
						"expired" => 0,
						"enrolled" => 0,
						"dateReserve" => date("Y-m-d H:i:s"),
						"dateApproved" => "0000-00-00 00:00:00",
						"userid" => 0
					);
				$this->db->insert("reservation",$reservation);
				$resid = $this->db->insert_id();
				
				foreach ($codes as $code => $val) {
					$rec = $this->get_module_info($val)->row_array();
					$datas[] = array(
						"resid" =>  $resid,
						"amount" =>  $rec["amount"],
						"paytypeid" => $rec["paytypeid"],
						"code" => $val,
					);
				}
				$this->db->insert_batch("reservation_list",$datas);
			
			$this->db->trans_complete();
		}
		
		public function get_reservation($resid)
		{
			$sql = "select *
					from";
			
		}
		
		function emailConfig()
		{
			$mail_config['smtp_host'] = 'smtp.gmail.com';
			$mail_config['smtp_port'] = '587';
			$mail_config['smtp_user'] = 'nationalmaritimepolytechnic@gmail.com';
			$mail_config['_smtp_auth'] = TRUE;
			$mail_config['smtp_pass'] = 'ejixtotyswzwpqfh';
			$mail_config['smtp_crypto'] = 'tls';
			$mail_config['protocol'] = 'smtp';
			$mail_config['mailtype'] = 'html';
			$mail_config['send_multipart'] = FALSE;
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = TRUE;
			$mail_config['smtp_conn_options'] = array(
						'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
						)
				);
			return $mail_config;
		}
		
		function sendEmailReservation($to_email)
		{
				$this->load->library('email');
				$mail_config = $this->emailConfig();
				
				$this->email->initialize($mail_config);
			
				$this->email->set_newline("\r\n");
				$confirm_code = md5(date('Y-m-d H:i:s'));
				// $this->email->from('registration@nmp.gov.ph', 'National Maritime Polytechnic');
				$this->email->from('nationalmaritimepolytechnic@gmail.com', 'National Maritime Polytechnic');
				$this->email->to($to_email);
				// $this->email->cc('registration@nmp.gov.ph');
				$this->email->subject("NMP Email confirmation");
				$this->email->message("Your new account for <b> NMP Online Registration </b>
				<b>From: datestart </b>
				<b>To: dateend </b> has been submitted.
				<br>
				If you have some question or clarification just visit our office <b>at Barangay Cabalawan Tacloban City</b> or you can just contact us through
    			<b>Mobile Number (+63) 936 786 2196</b><br>
    			or Like Us on <b>Facebook @nmptraningcenter</b> to see some updates.
    			You can also check our website <b>http://nmp.gov.ph/</b>
				Please wait for a confirmation from the management<br><br>
				Best regards,<br><br>
				National Maritime Polytechnic
				");
				
				if ($this->email->send()) {
					$data['record'] = ['response' => 'success'];
					// echo json_encode($data);
					echo $data;
				}else{
					echo $this->email->print_debugger();
				}
				
				die();
		}
		
		function sendEmailRegistration($to_email, $token, $resid)
		{
				$this->load->library('email');
				$mail_config = $this->emailConfig();
				$this->email->initialize($mail_config);
				$this->email->set_newline("\r\n");
				
				// $this->email->from('registration@nmp.gov.ph', 'National Maritime Polytechnic');
				$this->email->from('nationalmaritimepolytechnic@gmail.com', 'National Maritime Polytechnic');
				$this->email->to($to_email);
				// $this->email->cc('registration@nmp.gov.ph');
				$this->email->subject("NMP Email confirmation");
				$this->email->message("Welcome to <b> NMP Online Registration </b>
				
				Thank you for registering in our website. To login and proceed to enrollment, please confirm your email by clicking this link: <b><a href='http://reserve.nmp.gov.ph/confirm/registration?token=" . $token . "&rand=" . $resid ."'>Confirm your Account</a></b>.
				
				<br><br>
				If you have some question or clarification, just visit our office at<b> Barangay Cabalawan Tacloban City</b> or you can contact us through
    			<b>Mobile Number (+63) 936 786 2196</b><br>.
    			Like us on <b>Facebook @nmptraningcenter</b> to see more updates.
    			You can also check our website <b>http://nmp.gov.ph/</b>
				<br><br>
				Best regards,<br><br>
				National Maritime Polytechnic
				");
				if ($this->email->send()) {
					$data['record'] = ['response' => 'success'];
					// echo json_encode($data);
					// echo $data;
				}else{
					echo $this->email->print_debugger();
				}	
		}
		
		function forgot_password($email, $token, $resid)
		{
				$this->load->library('email');
				$mail_config = $this->emailConfig();
				$this->email->initialize($mail_config);
				$this->email->set_newline("\r\n");
				
				// $this->email->from('registration@nmp.gov.ph', 'National Maritime Polytechnic');
				$this->email->from('nationalmaritimepolytechnic@gmail.com', 'National Maritime Polytechnic');
				$this->email->to($email);
				// $this->email->cc('registration@nmp.gov.ph');
				$this->email->subject("NMP Email confirmation");
				$this->email->message("Welcome to <b> NMP Online Registration </b>
				
				Please confirm your email by clicking this link: <b><a href='http://reserve.nmp.gov.ph/confirm/registration?token=" . $token . "&rand=" . $resid ."'>Confirm your Account</a></b>
				
				<br><br>
				If you have some question or clarification, just visit our office at<b> Barangay Cabalawan Tacloban City</b> or you can contact us through
    			<b>Mobile Number (+63) 936 786 2196</b><br>
    			or Like Us on <b>Facebook @nmptraningcenter</b> to see some updates.
    			You can also check our website <b>http://nmp.gov.ph/</b>
				Please wait for a confirmation from the management<br><br>
				Best regards,<br><br>
				National Maritime Polytechnic
				");
				if ($this->email->send()) {
					$data['record'] = ['response' => 'success'];
					// echo json_encode($data);
					// echo $data;
				}else{
					echo $this->email->print_debugger();
				}	
		}
		
		function check_token($token, $idnum)
		{
			$sql = "select idnum from trainee where conf_token = ? and idnum = ?";
			$query = $this->db->query($sql,[$token,$idnum]);
			return $query;
		}
		
		function email_confirmed($token, $idnum)
		{
			$sql = "update trainee set email_confirmed = 1 where idnum = ? and conf_token = ?";
			$this->db->query($sql,[$idnum, $token]);
		}
		
		
		function get_enrollment_status($idnum)
		{
			$sql = "select b.resid, f.module, e.start, b.expired, b.remarks, b.dateReserve, a.conf_token, 	
					b.profile
					from trainee a
					inner join reservation b on a.idnum = b.idnum
					inner join reservation_list c on b.resid = c.resid
					inner join cash_payment_type d on c.paytypeid = d.paytypeid and isTraining = 1
					inner join schedule e on c.code = e.code
					inner join module f on e.modcode = f.modcode
					where a.idnum = ?";
			$query = $this->db->query($sql,[$idnum]);
			// print_r($this->db->last_query());
			return $query;
		}
		
		function get_payment_slip($resid = 0,$idnum = 0)
		{
			$sql = "select a.*,b.*,d.module,c.start
					from reservation a
					inner join reservation_list b on a.resid = b.resid
					inner join schedule c on c.code = b.code
					inner join module d on d.modcode = c.modcode
					inner join cash_payment_type e on b.paytypeid = e.paytypeid
					where a.resid = ? and a.idnum = ?";
			$query = $this->db->query($sql,[$resid, $idnum]);
			return $query;		
			
		}
		
		function get_client_profile($idnum = 0)
		{
			$sql = "select * from trainee a
					left join zip b on a.locid = b.idnum 
					where a.idnum = ?";
			$query = $this->db->query($sql,[$idnum]);
			return $query;	
		}
		
		function update_enrollment_activity_completeness($resid,$token)
		{
			$sql = "update 
					reservation b
					inner join trainee c on b.idnum = c.idnum 
					set profile = 1 
					where b.resid = ? and c.conf_token = ?";
			$query = $this->db->query($sql,[$resid,$token]);
		}
	}
?>