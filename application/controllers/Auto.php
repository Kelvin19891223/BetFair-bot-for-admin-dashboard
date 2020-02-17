<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auto extends CI_Controller {
	public function index()
	{
		$token = $this->input->get('token');
		$stoken = $this->input->get('stoken');
		if($token=='OUUNYHp1lgWUxEp5nCUl') {
			$this->sessiontoken = 'CrwZLrrjrMW8SJP3RIOzefbi1mxOtfrX7HRiPs2iT/w=';
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
		$market = $betfair->getMarketProfitAndLoss('1.148502653');
		// $market = $betfair->getMarketBook('1.148498720');
		print_r($market);exit;
		$market = $betfair->getNextRacingMarket();
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
		$this->sessiontoken = 'CrwZLrrjrMW8SJP3RIOzefbi1mxOtfrX7HRiPs2iT/w=';
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
				$market = $this->Betsettings->getNextRacingMarket($setting['uid'],$setting['quad']);
				// print_r($market);exit;
				//put bet
				$betresult = new stdClass();
				$betresult->status = 'SUCCESS';
				// $betresult = $betfair->placeBet($market['marketid'], $market['selectionid'],$betamount);
/*
stdClass Object ( [customerRef] => fsdf [status] => SUCCESS [marketId] => 1.148408560 [instructionReports] => Array ( [0] => stdClass Object ( [status] => SUCCESS [instruction] => stdClass Object ( [selectionId] => 20758013 [handicap] => 0 [limitOrder] => stdClass Object ( [size] => 5 [price] => 3 [persistenceType] => LAPSE ) [orderType] => LIMIT [side] => BACK ) [betId] => 138127893502 [placedDate] => 2018-09-21T09:32:18.000Z [averagePriceMatched] => 3.3 [sizeMatched] => 5 [orderStatus] => EXECUTION_COMPLETE ) ) )
Call to api-ng failed: Response: [{"jsonrpc":"2.0","error":{"code":-32099,"message":"ANGX-0002","data":{"APINGException":{"requestUUID":"prdang045-08140933-01413bdf39","errorCode":"INVALID_INPUT_DATA","errorDetails":"market id passed is invalid"},"exceptionname":"APINGException"}},"id":1}]
*/
				if(is_object($betresult) && $betresult->status == 'SUCCESS') {
					$newbet = array();
					$newbet['uid'] = $setting['uid'];
					$newbet['quad'] = $setting['quad'];
					$newbet['marketid'] = $market['marketid'];
					$newbet['marketname'] = $market['marketname'];
					$newbet['selectionid'] = $market['selectionid'];
					$newbet['selectionname'] = $market['selectionname'];
					$newbet['stake'] = $betamount;
					$newbet['tm'] = date('Y-m-d H:i:s');

					$this->Bettings->putBet($newbet);

					$settingstage = array();
					$settingstage['uid'] = $setting['uid'];
					$settingstage['quad'] = $setting['quad'];
					$settingstage['stage'] = 1;
					$this->Betsettings->upateSetting($settingstage);					
				}
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