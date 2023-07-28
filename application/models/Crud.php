<?php

/**
 * Crud model
 */
class crud extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	/*
    return total number of projects
  */
	public function get_count_all($table){
		return $this->db->count_all($table);
	}

	/*
			return all the projects
	*/
	public function getRows($table, $limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get($table);

		return $query->result();
	}
	public function insert($table, $data)
	{
		$result = $this->db->insert($table, $data);
		return $result;
	}

	public function update($table, $data, $id)
	{
		$result = $this->db->where('id', $id)->update($table, $data);
		return $result;
	}

	public function delete($table, $id)
	{
		$result = $this->db->delete($table, ['id' => $id]);
		return $result;
	}

	public function get_records($table)
	{
		$result = $this->db->get($table)->result();
		return $result;
	}

	public function find_record_by_id($table, $id)
	{
		$result = $this->db->get_where($table, ['id' => $id])->row();
		return $result;
	}
}
