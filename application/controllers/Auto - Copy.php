<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auto extends CI_Controller {
	public function index()
	{
		$token = $this->input->get('token');
		$stoken = $this->input->get('stoken');
		if($token=='OUUNYHp1lgWUxEp5nCUl') {
			$this->sessiontoken = '0AJAcQCz817nVo/jMTSkJFRiafCZfzUcF4V2EuXaS1s=';
			if(isset($stoken) && $stoken) {				
				$this->sessiontoken = $stoken;
			}
			// $this->addNextMarket();
			// $this->updateMarketResult();
			$this->autoBet();
			// echo 'Page Not Found!';
			echo date('Y-m-d H:i:s');
		} else {
			echo 'Invalid Request!';
		}
		exit;
	}
	private function addNextMarket()
	{
		$betfair = new Betfair();
		$config = array('username'=>'stevedav1','password'=>'minggold1','appKey'=>'pPhjjKrGcSuCxlGO','cert'=>'client-2048.crt','certpass'=>'1234567890');
		$betfair->init($config);
		$betfair->setSessionToken($this->sessiontoken);
		
		// $ss = $betfair->getSessionToken(TRUE);

		$countries = '"GB"';
		$this->load->model('Marketbook');
		$market = $betfair->getNextRacingMarket();
		// print_r($market);exit;
		$this->Marketbook->insert_entry($market);
	}
	private function updateMarketResult()
	{
		$betfair = new Betfair();
		$config = array('username'=>'stevedav1','password'=>'minggold1','appKey'=>'pPhjjKrGcSuCxlGO','cert'=>'client-2048.crt','certpass'=>'1234567890');
		$betfair->init($config);
		$betfair->setSessionToken($this->sessiontoken);
		
		$this->load->model('Marketbook');
		$marketIds = $this->Marketbook->getLiveMarketIds();
		foreach($marketIds as $id) {
			$data = array();
			$marketBook = $betfair->getMarketBook($id['marketid']);
			if($marketBook->status=='CLOSED'){
				$data['status'] = 1;
				$data['winnercount'] = $marketBook->numberOfWinners;
				$data['runnercount'] = $marketBook->numberOfRunners;
				foreach($marketBook->runners as $runner) {
					if($runner->status=='WINNER') {
						$data['winnerid'] = $runner->selectionId;
					}
				}
				$this->Marketbook->upateMarket($id['marketid'],$data);				
			}
		}
	}
	private function autoBet()
	{
		$this->sessiontoken = '0AJAcQCz817nVo/jMTSkJFRiafCZfzUcF4V2EuXaS1s=';
		$betfair = new Betfair();
		$config = array('username'=>'stevedav1','password'=>'minggold1','appKey'=>'pPhjjKrGcSuCxlGO','cert'=>'client-2048.crt','certpass'=>'1234567890');
		$betfair->init($config);
		$betfair->setSessionToken($this->sessiontoken);

// [uid] => 1 [quad] => 1 [status] => 1 [curleg] => 1 [stage] => 0 [horse] => 1 [dog] => 1 [uk] => 1 [ire] => 1 [sthafrica] => 1 [aust] => 1 [nz] => 0 [others] => 0 [wp1] => PLACE [default1] => 10 [wp2] => WIN [percent2] => 50 [default2] => 12 [addition2] => 2 [wp3] => PLACE [percent3] => 60 [default3] => 8 [addition3] => 2 [wp4] => PLACE [percent4] => 70 [default4] => 10 [addition4] => 2
		$this->load->model('Bettings');
		$this->load->model('Betsettings');
		$settings = $this->Betsettings->getActiveSettings();
		foreach($settings as $setting) {
			$leg = $setting['curleg'];
			if($setting['stage']==0) {
				$betamount = $setting['default'.$leg];
				if($leg>1 && $leg<=4) {
					$betamount = $betamount*$setting['percent'.$leg]/100 + $setting['addition'.$leg];
				}
				if($setting['dog']==1 && $setting['horse']==1) {
					$type="all";
				} else {
					if($setting['dog']==1){$type='dog';}
					elseif($setting['horse']==1){$type='horse';}				
				}
				$countries = array();
				if($setting['others'] == 1) {
					$countries = explode(',','"US","ES","KR","SE","BR","FR","DE","MU","AR","CL","NO","NL","CN","IT","PE","UY","HK","TH","BN","MY","JP","RU","IL","TR","RO","VN","IN","CZ","AM","KE","SK","UZ","EG","BE","HR","BA","EE","DK","FI","JO","AT","VE","CS","TT","BO","CO","PA","PH","UA","TJ","GE","SG","PT","LV","BY","SI","MK","LT","CH","PL","QA","GT","SA","IS","BG","NI","TW","GR","HU","CY","LU","EC","PY","MX","FO","MD","AE"');
				}
				if($setting['uk'] == 1) $countries[] = '"GB"';
				if($setting['ire'] == 1) $countries[] = '"IE"';
				if($setting['sthafrica'] == 1) $countries[] = '"ZA"';
				if($setting['aust'] == 1) $countries[] = '"AU"';
				if($setting['nz'] == 1) $countries[] = '"NZ"';
				$countries = implode(',', $countries);
				// $market = $betfair->getNextRacingMarket($countries, $wp='"'.$setting['wp'.$leg].'"', $type);
				$market = $this->Betsettings->getNextRacingMarket();
				// print_r($market);exit;
				//put bet
				$selectionIdx = rand(0,count($market->runners)-1);
				
				// $betresult = $betfair->placeBet($market->marketId, $market->runners[$selectionIdx]->selectionId,$betamount);
/*
stdClass Object ( [customerRef] => fsdf [status] => SUCCESS [marketId] => 1.148408560 [instructionReports] => Array ( [0] => stdClass Object ( [status] => SUCCESS [instruction] => stdClass Object ( [selectionId] => 20758013 [handicap] => 0 [limitOrder] => stdClass Object ( [size] => 5 [price] => 3 [persistenceType] => LAPSE ) [orderType] => LIMIT [side] => BACK ) [betId] => 138127893502 [placedDate] => 2018-09-21T09:32:18.000Z [averagePriceMatched] => 3.3 [sizeMatched] => 5 [orderStatus] => EXECUTION_COMPLETE ) ) )
*/
// print_r($betresult);exit;
				// if($betresult->status == 'SUCCESS') {
					$newbet = array();
					$newbet['uid'] = $setting['uid'];
					$newbet['quad'] = $setting['quad'];
					$newbet['marketid'] = $market->marketId;
					$newbet['marketname'] = $market->marketName;
					$newbet['selectionid'] = $market->runners[$selectionIdx]->selectionId;
					$newbet['selectionname'] = $market->runners[$selectionIdx]->runnerName;
					$newbet['stake'] = $betamount;
					$newbet['tm'] = date('Y-m-d H:i:s');

					$this->Bettings->putBet($newbet);

					$settingstage = array();
					$settingstage['uid'] = $setting['uid'];
					$settingstage['quad'] = $setting['quad'];
					$settingstage['stage'] = 1;
					$this->Betsettings->upateSetting($settingstage);					
				// }
			} else {
				$marketIds = $this->Bettings->loadActiveBettings();
				foreach($marketIds as $bet) {
					$data = array();
					$marketBook = $betfair->getMarketBook($bet['marketid']);
					if($marketBook->status=='CLOSED'){
						$data['wl'] = 2;
						foreach($marketBook->runners as $runner) {
							if($runner->status=='WINNER') {
								if($bet['selectionid'] == $runner->selectionId) {
									$data['wl'] = 1;
								}
							}
						}
						$data['marketid'] = $bet['marketid'];
						$this->Bettings->upateMarket($data);

						$settingstage = array();
						$settingstage['uid'] = $bet['uid'];
						$settingstage['quad'] = $bet['quad'];
						$settingstage['stage'] = 0;
						$settingstage['status'] = 0;
						if($leg==4){
							$settingstage['curleg'] = 1;
							for($lid=1;$lid<=4;$lid++) {
								$settingstage['marketid'.$lid] = '';								
								$settingstage['marketname'.$lid] = '';								
								$settingstage['selectionid'.$lid] = '';								
								$settingstage['selectionname'.$lid] = '';								
							}
						} else {
							$settingstage['curleg'] = ++$leg;
						}
						$this->Betsettings->upateSetting($settingstage);
					}
				}
			}
		}
	}
}