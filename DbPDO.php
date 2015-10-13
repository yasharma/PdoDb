<?php
/**
* Database related class
*/
class DbPDO
{
	protected $_pdo;
	public function __construct($dbname, $username, $password, $driver='mysql', $host='localhost')
	{
		try {
			$this->_pdo = new PDO("$driver:host=$host;dbname=$dbname",$username,$password);	
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage();	
		}
	}

	public function get($tablename, $numRows=NULL)
	{
		try {
			return empty($numRows)?$this->_pdo->query("select * from $tablename"):$this->_pdo->query("select * from $tablename LIMIT $numRows");	
		} catch (PDOException $e) {
			echo $e->getMessage();
		}	
	}

	public function find($tablename, $id)
	{
		try {
			$stmt = $this->_pdo->prepare("SELECT * FROM $tablename WHERE id = :id");
			$stmt->execute(array(
				'id' => $id
			));
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e->getMessage();
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

	public function query($query)
	{
		try{
			$stmt = $this->_pdo->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return $e->getMessage();
		}
	}
}