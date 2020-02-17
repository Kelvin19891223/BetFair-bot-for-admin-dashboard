<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class History extends CI_Controller {
	public function index()
	{
		$this->load->model('Bettings');
		$bettings = $this->Bettings->loadBettings(1);
		$this->load->view('bethistorypage',array('bettings'=>$bettings));
	}
}