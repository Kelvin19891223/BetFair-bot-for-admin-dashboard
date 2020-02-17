<?php
class Marketbook extends CI_Model {
	protected $_name = 'marketbook';
	public function getAllWallets()
	{
		$query = $this->db->query('SELECT addr FROM '.$this->_name);
		return $query->result_array();
	}
	public function getLiveMarketIds()
	{
		$query = $this->db->query('SELECT marketid FROM '.$this->_name.' WHERE status="0"');
		return $query->result_array();		
	}
	public function insert_entry($market)
	{
		$insert_query = $this->db->insert_string($this->_name, array('marketid'=>$market->marketId,'marketname'=>$market->marketName,'tm'=>date('Y-m-d H:i:s')));
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		$this->db->query($insert_query);
	}
	public function upateMarket($marketid,$data)
	{
		$this->db->where('marketid', $marketid);
		$this->db->update($this->_name, $data);
	}
}