<?php
class User extends CI_Model {
	protected $_name = 'member';
	public function loadBettings($uid)
	{
		$query = $this->db->query('SELECT * FROM '.$this->_name.' WHERE uid="'.$uid.'" ORDER BY tm DESC');
		return $query->result_array();
	}
	public function check($user)
	{
		$query = $this->db->query('SELECT id FROM '.$this->_name.' WHERE name="'.$user['name'].'" AND password="'.$user['password'].'"');
		return count($query->row_array());
	}
	public function add($user)
	{
		$insert_query = $this->db->insert_string($this->_name, $user);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		$this->db->query($insert_query);
	}
	public function upateMarket($betting)
	{
		$this->db->where('marketid', $betting['marketid']);
		$this->db->update($this->_name, array('wl'=>$betting['wl']));
	}
}