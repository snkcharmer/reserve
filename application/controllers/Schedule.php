<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."controllers/Admin.php");

class Schedule extends Admin {

	public function index()
	{
		$this->load->view('schedule');
	}
	
}
