<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Decorator extends CI_Controller {
	
	protected $view_data;

	public function get_decorated_data()
	{
		return $this->view_data;
	}
}