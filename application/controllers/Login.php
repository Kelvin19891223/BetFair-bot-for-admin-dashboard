<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('loginpage');
	}
	public function chk()
	{
		$user = array();
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		
		$user['name'] = $name;
		$user['password'] = $this->encrypt($password);
		$this->load->model('User');
		$result = $this->User->check($user);
		// var_dump($result);exit;
		if($result) {
			
			redirect('dashboard');
		} else {
			redirect('login');
		}
	}
	private function encrypt($pw)
	{
		return md5($pw.'asd');
	}
}