<?php defined('BASEPATH') or exit('No direct script access allowed');

class MongoDirectories extends CI_model {
	private $database = 'codeigniter_test';
	private $collection = 'directories_backup';
	private $conn;

	function __construct(){
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function count(){
		try {
			$query = new MongoDB\Driver\Command(["count" => $this->collection]);
			$result = $this->conn->executeCommand($this->database, $query);
			return $result->toArray()[0]->n;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function getDirectories($skip, $limit){
		try {
			$filter = [];
			$options = [
				'skip' => $skip,
				'limit' => $limit,
			];
			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);
			return $result;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function getById($_id)
	{
		try {
			$filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);

			foreach ($result as $user) {
				return $user;
			}

			return NULL;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching user: ' . $ex->getMessage(), 500);
		}
	}

	function insert($data){
		try {
			if (!in_array($this->collection, $this->listCollections())) {
				$this->createCollection();
			} else {
				$this->deleteCollection();
			}
			$query = new MongoDB\Driver\BulkWrite();
			foreach ($data as $d) {
				$query->insert($d);
			}

			$result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

			if ($result == 1) {
				return TRUE;
			}
			return FALSE;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving data: ' . $ex->getMessage(), 500);
		}
	}

	function createCollection(){
		try {
			$query = new MongoDB\Driver\Command(["create" => $this->collection]);
			$result = $this->conn->executeCommand($this->database, $query);
			return $result->toArray()[0]->ok;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving data: ' . $ex->getMessage(), 500);
		}
	}

	function deleteCollection(){
		try {
			$query = new MongoDB\Driver\Command(["drop" => $this->collection]);
			$result = $this->conn->executeCommand($this->database, $query);
			return $result->toArray()[0]->ok;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving data: ' . $ex->getMessage(), 500);
		}
	}

	function listCollections(){
		try {
			$query = new MongoDB\Driver\Command(["listCollections" => 1]);
			$result = $this->conn->executeCommand($this->database, $query);
			$collections = [];
			foreach($result->toArray() as $collection){
				array_push($collections, $collection->name);
			}

			return $collections;
		} catch (MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving data: ' . $ex->getMessage(), 500);
		}
	}
}
