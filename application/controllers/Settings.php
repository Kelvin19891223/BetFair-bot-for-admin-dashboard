<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller {
	public function index()
	{
		$this->sessiontoken = 'CrwZLrrjrMW8SJP3RIOzefbi1mxOtfrX7HRiPs2iT/w=';
		
		$this->load->model('Betsettings');
		$settings = $this->Betsettings->loadSettings(1);
		$markets = array();
		foreach($settings as $setting) {
			if($setting['stage']==0) {
				$betfair = new Betfair();
				$config = array('username'=>'stevedav1','password'=>'minggold1','appKey'=>'pPhjjKrGcSuCxlGO','cert'=>'client-2048.crt','certpass'=>'1234567890');
				$betfair->init($config);
				$betfair->setSessionToken($this->sessiontoken);
				$countries = '"GB"';
				$this->load->model('Marketbook');
				$market = $betfair->getNextRacingMarket();
				$markets[$setting['quad']] = $market;
			}
		}
		// print_r($markets);exit;
		$this->load->view('newbetpage',array('settings'=>$settings,'markets'=>$markets));
	}
	public function newsession()
	{
		$post = $this->input->post();
		// print_r($post);exit;
		$setting = array();
		$setting['uid'] = 1;
		$setting['quad'] = $post['quad'];
		$setting['curleg'] = $post['curleg'];
		$setting['horse'] = isset($post['horse'])?1:0;
		$setting['dog'] = isset($post['dog'])?1:0;
		$setting['uk'] = isset($post['uk'])?1:0;
		$setting['ire'] = isset($post['Ire'])?1:0;
		$setting['sthafrica'] = isset($post['Sth_Africa'])?1:0;
		$setting['aust'] = isset($post['Aust'])?1:0;
		$setting['nz'] = isset($post['NZ'])?1:0;
		$setting['others'] = isset($post['Others'])?1:0;
		$setting['wp1'] = $post['wp1'];
		$setting['default1'] = $post['default1'];
		$setting['wp2'] = $post['wp2'];
		$setting['percent2'] = $post['percent2'];
		$setting['default2'] = $post['default2'];
		$setting['addition2'] = $post['addition2'];
		$setting['wp3'] = $post['wp3'];
		$setting['percent3'] = $post['percent3'];
		$setting['default3'] = $post['default3'];
		$setting['addition3'] = $post['addition3'];
		$setting['wp4'] = $post['wp4'];
		$setting['percent4'] = $post['percent4'];
		$setting['default4'] = $post['default4'];
		$setting['addition4'] = $post['addition4'];
		
		if($post['stage']==0) {
			$setting['marketid'.$post['curleg']] = $post['marketid'.$post['curleg']];
			$setting['marketname'.$post['curleg']] = $post['marketname'.$post['curleg']];
			$setting['selectionid'.$post['curleg']] = $post['selectionid'.$post['curleg']];
			$setting['selectionname'.$post['curleg']] = $post['selectionname'.$post['curleg']];
		}
		
		$this->load->model('Betsettings');
		$this->Betsettings->saveSettings($setting);
	}
	public function runsession()
	{
		$quad = $this->input->post('sess');
		$status = $this->input->post('enabled');
		if($quad<1 || $quad>4) exit;
		
		$setting['uid'] = 1;
		$setting['quad'] = $quad;
		$setting['status'] = $status;
		$this->load->model('Betsettings');
		$this->Betsettings->runSession($setting);
	}
	private function addNextMarket()
	{
		$betfair = new Betfair();
		$config = array('username'=>'stevedav1','password'=>'minggold1','appKey'=>'pPhjjKrGcSuCxlGO','cert'=>'client-2048.crt','certpass'=>'1234567890');
		$betfair->init($config);
		$betfair->setSessionToken($this->sessiontoken);

		$this->load->model('Marketbook');
		$market = $betfair->getNextRacingMarket();
		$this->Marketbook->insert_entry($market);
	}
}