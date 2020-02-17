<?php
class Bettings extends CI_Model {
	protected $_name = 'bettings';
	public function loadBettings($uid)
	{
		$query = $this->db->query('SELECT * FROM '.$this->_name.' WHERE uid="'.$uid.'" ORDER BY tm DESC');
		return $query->result_array();
	}
	public function loadActiveBettings()
	{
		$query = $this->db->query('SELECT uid,quad,marketid,selectionid FROM '.$this->_name.' WHERE wl="0"');
		return $query->result_array();
	}
	public function putBet($newbet)
	{
		$insert_query = $this->db->insert_string($this->_name, $newbet);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		$this->db->query($insert_query);
	}
	public function upateMarket($betting)
	{
		$this->db->where('marketid', $betting['marketid']);
		$this->db->update($this->_name, array('wl'=>$betting['wl']));
	}
}