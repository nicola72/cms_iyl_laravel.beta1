<?php

class Db 
{
	protected $conn;
	protected $site;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->conn = $site->conn;
		
	}
	
	public function select($sql,$limit = false)
	{
		$result = array();
		
		try 
		{
			$res = $this->conn->query($sql);
		}
		catch(PDOException $e)
		{
			$this->site->log_error('errore_db', 'Errore esecuzione select  '.$sql.'   '.$e->getMessage());
			return false;
		}
		
		if (is_object($res) && $res->rowCount() > 0)
		{
			if($limit == false)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					
					$result[] = $row;
				}
				
				return $result;
			}
			else
			{
				$row = $res->fetch(PDO::FETCH_ASSOC);
				return $row;
			}
		}
		return $result;
	}
}

?>