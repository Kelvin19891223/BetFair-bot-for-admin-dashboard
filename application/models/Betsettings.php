<?php
class Betsettings extends CI_Model {
	protected $_name = 'betsettings';
	public function loadSettings($uid)
	{
		$query = $this->db->query('SELECT * FROM '.$this->_name.' WHERE uid="'.$uid.'" ORDER BY quad');
		return $query->result_array();
	}
	public function getActiveSettings()
	{
		$query = $this->db->query('SELECT * FROM '.$this->_name.' WHERE status="1"');
		return $query->result_array();
	}
	public function isSettingExists($uid,$quad)
	{
		$query = $this->db->query('SELECT count(*) as cnt FROM '.$this->_name.' WHERE uid="'.$uid.'" AND quad="'.$quad.'"');
		$row = $query->row_array();
		return $row['cnt']>0;
	}
	public function saveSettings($setting)
	{
		if($this->isSettingExists($setting['uid'],$setting['quad'])){
			$this->upateSetting($setting);
		} else {
			$this->insertSetting($setting);
		}
	}
	public function insertSetting($setting)
	{
		$insert_query = $this->db->insert_string($this->_name, $setting);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		$this->db->query($insert_query);
	}
	public function upateSetting($setting)
	{
		$this->db->where('uid', $setting['uid']);
		$this->db->where('quad', $setting['quad']);
		$this->db->update($this->_name, $setting);
	}
	public function runSession($setting)
	{
		$this->db->where('uid', $setting['uid']);
		$this->db->where('quad', $setting['quad']);
		$this->db->update($this->_name, array('status'=>$setting['status']));
	}
	public function getNextRacingMarket($uid, $quad)
	{
		$query = $this->db->query('SELECT * FROM '.$this->_name.' WHERE uid="'.$uid.'" AND quad="'.$quad.'"');
		$row = $query->row_array();
		$market = array();
		$market['marketid'] = $row['marketid'.$row['curleg']];
		$market['marketname'] = $row['marketname'.$row['curleg']];
		$market['selectionid'] = $row['selectionid'.$row['curleg']];
		$market['selectionname'] = $row['selectionname'.$row['curleg']];
		return $market;
	}
}