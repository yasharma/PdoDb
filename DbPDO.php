<?php
/**
* Database related class
*/
class DbPDO
{
	protected $_pdo;
	protected $_query;
	protected $_where = [];
	public function __construct($dbname, $username, $password, $driver='mysql', $host='localhost')
	{
		try {
			$this->_pdo = new PDO("$driver:host=$host;dbname=$dbname",$username,$password);	
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return $e->getMessage();	
		}
	}

	public function get($tablename, $numRows=NULL)
	{
		try {
			return empty($numRows)?$this->_pdo->query("select * from $tablename"):$this->_pdo->query("select * from $tablename LIMIT $numRows");	
		} catch (PDOException $e) {
			return $e->getMessage();
		}	
	}

	public function find($tablename)
	{
		try {
			$this->_query = "SELECT * FROM $tablename";
			$stmt = $this->_buildQuery();
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	public function save($tablename, $data)
	{
		try {
			$fields = implode(',',array_keys( $data ) );
			$values = implode(',',array_fill(0, count($data), '?'));
			$stmt = $this->_pdo->prepare("INSERT INTO $tablename( $fields ) VALUES( $values )");
			return $stmt->execute(array_values($data));
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function update($tablename, $data)
	{
		try {
			$stmt = $this->_pdo->prepare("UPDATE $tablename SET title=:title, body=:body WHERE id=:id");
			return $stmt->execute($data);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function delete($tablename, $id)
	{
		try {
			$stmt = $this->_pdo->prepare("DELETE FROM $tablename WHERE id=:id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			return $stmt->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function query($query) {
		try{
			$this->_query = filter_var($query, FILTER_SANITIZE_STRING);
			$stmt = $this->_prepareQuery();
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			return $e->getMessage();
		}
	}

	public function where($data = []) {
		if(is_array($data)){
			$this->_where = $data;	
			return $this;
		} else {
			trigger_error('Where method accepts associative array',E_USER_ERROR);
		}
	}

	protected function _buildQuery() {
		if( !empty($this->_where) ) {
			$i = 1; $this->_query .= ' WHERE ';
			foreach ($this->_where as $key => $value) {
				$this->_query .= count($this->_where) != $i ? $key .' = ?'. ' AND ':$key .' = ? ';
				$i++;
			}
			$stmt = $this->_prepareQuery();
			$stmt->execute(array_values($this->_where));
			return $stmt;
		}
	}

	protected function _prepareQuery(){
		if( !$stmt = $this->_pdo->prepare($this->_query) ) {
			trigger_error('Problem preparing query', E_USER_ERROR);
		}
		return $stmt;
	}
} 