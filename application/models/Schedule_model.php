<?php	
	class Schedule_model extends CI_Model
	{
		
		function get_module($curyear = "")
		{
			$this->db->select("*");
			$this->db->from("schedule a");
			$this->db->join("module b","a.modcode = b.modcode","inner");
			// if ($curyear != "All") {
				// $this->db->where("year(a.start)",$curyear);
			// }
			$this->db->order_by("b.module",'asc');
			$query = $this->db->get();
			// print_r($this->db->last_query());
			return $query;
		}
		
		function get_schedule($code = 0, $batch = "", $modcode = 0, $datestart = "", $dateend = "")
		{  	
			if (!empty($schedule)) {
				$this->db->where("code",$code);
			}
			
			if (!empty($batch)) {
				$this->db->where("batch",$batch);
			}
			
			if (!empty($modcode)) {
				$this->db->where("modcode",$modcode);
			}
			
			if (!empty($datestart)) {
				$this->db->where("start",$datestart);
			}
			
			if (!empty($dateend)) {
				$this->db->where("end",$dateend);
			}
			
			$this->db->from("schedule a");
			$query = $this->db->get();
			return $query;
		}
		
		
	}
?>