<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class le9ko extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->helper('url');
		$this->load->view('koass');
	}

	function trackme()
	{
		$this->load->helper('url');
		$this->load->view('trackme');
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
