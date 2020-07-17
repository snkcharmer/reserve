<?php
class Login_model extends CI_Model
{
	public function admin_login(){

		$input = array('username' => $this->input->post('username'), 'password' => $this->input->post('password'));
		$this->db->select('username, password');
		$this->db->from('admin');
		$this->db->where($input);
		$query = $this->db->get();

		return $query;
	}
}
