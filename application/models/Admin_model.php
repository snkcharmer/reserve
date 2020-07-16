<?php	
	class Admin_model extends CI_Model
	{
		
		public function register_short($bdate,$passworld)
		{
			$data = array(
				"lname" => $this->input->post('lname'),
				"fname" => $this->input->post('fname'),
				"mname" => $this->input->post('mname'),
				"passworld" => $passworld,
				"eadd" => $this->input->post('mname'), 
				"bdate" => $bdate
			);
			
			$this->db->insert("trainee");
		}
		
		
		function getcitizenship()
		{
			$this->db->order_by("citid", "desc");
			$citizenship = $this->db->get('citizen');
			return $citizenship;
		}
		
		function getcivstat()
		{
			$this->db->order_by("civstatid", "asc"); 
			$civstat = $this->db->get('civstat');
			return $civstat;
		}
		
		function getreligion()
		{
			$this->db->order_by("relid", "asc"); 
			$religion = $this->db->get('religion');
			return $religion;
		}
		
		function get_school(){

			$sql = "select * from school order by school";
			$query = $this->db->query($sql);

			return $query;

		}
		
		function get_course(){

			$sql = "select * from course group by course order by course";
			$query = $this->db->query($sql);

			return $query;

		}
		
		function get_license(){

			$sql = "select * from license order by license";
			$query = $this->db->query($sql);

			return $query;

		}
		
		function get_rank(){

			$sql = "select * from rank order by rank";
			$query = $this->db->query($sql);

			return $query;

		}
		
		function get_employer(){

			$sql = "select * from employer order by name";
			$query = $this->db->query($sql);

			return $query;

		}
		
		function get_sponsor(){

			$sql = "select * from sponsor_type order by sponid";
			$query = $this->db->query($sql);

			return $query;

		}
		
		function get_municipality(){

			//$param = ['%'.$this->input->post('provid').'%'];
			$sql = "select * from zip order by municipal";
			$query = $this->db->query($sql);

			return $query;
		}
		
		function get_code_(){

			$param = [$this->input->post('idnum')];
			$sql = "select * from zip where idnum = ? ";
			$query = $this->db->query($sql,$param);

			return $query;
		}
		
		
	}
?>