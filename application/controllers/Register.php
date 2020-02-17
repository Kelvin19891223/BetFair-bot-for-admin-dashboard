<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
	public function index()
	{
		$this->load->view('registerpage');
	}
	public function newuser()
	{
		$newuser = array();
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');
		
		$newuser['name'] = $name;
		$newuser['email'] = $email;
		if($password == $password2) {
			$newuser['password'] = $this->encrypt($password);
		}
		$newuser['regdate'] = date('Y-m-d H:i:s');
		
		$this->load->model('User');
		$this->User->add($newuser);
		redirect('login');
	}
	private function encrypt($pw)
	{
		return md5($pw.'asd');
	}
}