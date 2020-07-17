<?php	
	class Applicant_model extends CI_Model
	{
		
		function count_applicant_all($search = "",$curyear = "All",$module = "",$code = "")
		{   	
			
			$this->db->select("*");
			$this->db->from("trainee a");
			$this->db->join("reservation b","a.idnum = b.idnum","inner");
			$this->db->join("reservation_list c","b.resid = c.resid","inner");
			$this->db->join("schedule d","c.code = d.code","inner");
			$this->db->join("module e","d.modcode = e.modcode","inner");
			$this->db->order_by("a.idnum");
			
			if ($curyear != "All") {
				$this->db->where("year(d.start)",$curyear);
			}
			
			if (!empty($search)) {
				$fullname = explode($search,",");
				$this->db->group_start();
				
					(!empty($fullname[0]) ? $this->db->like('a.lname', $fullname[0]) : "");
					(!empty($fullname[1]) ? $this->db->like('a.fname', $fullname[1]) : "");
					(!empty($fullname[2]) ? $this->db->like('a.fname', $fullname[2]) : "");
				$this->db->group_end();
				
				$result = $this->db->get();	
			} 
			
			if ($module != "All") {
				
				$this->db->where("e.module",$module);

			}
			
			if (!empty($code)) {
				
				$this->db->where("d.code",$code);

			}
			
			$result = $this->db->get();
			// print_r($this->db->last_query());
			return $result;
		}
		
		
	}
?>