<?php

class Coupon
{
	protected $site;
	protected $conn;
	protected $db;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->conn = $site->conn;
		$this->db = $site->db;
	}
	
	public function getCoupon($code, $id_user)
	{
		$sql = "SELECT * FROM tb_coupons WHERE coupon='".$code."' AND id_user=".$id_user;
		return $this->db->select($sql,true);
	}
	
	public function isValidForAll($coupon)
	{
		$sql = "SELECT * FROM tb_coupons WHERE coupon='{$coupon}' AND id_user=0";
		
		try
		{
			$res = $this->conn->query($sql);
		}
		catch(PDOException $e)
		{
			$this->site->log_error('errore_db', 'Errore esecuzione select  '.$sql.'   '.$e->getMessage());
			return -1;
		}
		
		if ($res->rowCount() > 0)
		{
			$row = $res->fetch(PDO::FETCH_ASSOC);
			
				
			if($row['valido_fino_a'] != "")
			{
				
				
				$giorno = $row['valido_fino_a'];
				list($year,$month,$day) = explode("-", $giorno);
				
				
				$timestamp_scadenza = mktime (0, 0, 0, $month, $day+1, $year);
				
				
				$now = time();
				
				
				if($now > $timestamp_scadenza)
				{
				    return -4; //coupon è scaduto
				}
			}
			if($row['valido_il_giorno'] != "")
			{
			    
			    $giorno = $row['valido_il_giorno'];
			    list($year,$month,$day) = explode("-", $giorno);
			    
			    
			    $timestamp_inizio = mktime (0, 0, 0, $month, $day, $year);
			    $now = time();
			    
			   
			    if($now < $timestamp_inizio)
			    {
			        return -5; //coupon non valido oggi
			    }
			}
			return 1;
		}
		
		return -2;//coupon inesistente
	}
	
	public function isValidCoupon($coupon, $id_user)
	{
		
		$sql = "SELECT * FROM tb_coupons WHERE coupon='{$coupon}' AND id_user={$id_user}";
		
		try
		{
			$res = $this->conn->query($sql);
		}
		catch(PDOException $e)
		{
			$this->site->log_error('errore_db', 'Errore esecuzione select  '.$sql.'   '.$e->getMessage());
			return -1;
		}
		
		if ($res->rowCount() > 0)
		{
			$row = $res->fetch(PDO::FETCH_ASSOC);
			if($row['utilizzato'] == '1')
			{
				return -3;
			}
			
			if($row['valido_fino_a'] != "")
			{  
			    $giorno = $row['valido_fino_a'];
			    list($year,$month,$day) = explode("-", $giorno);   
			    
			    $timestamp_scadenza = mktime (0, 0, 0, $month, $day, $year);				    
			    $now = time();			    
			    
			    if($now > $timestamp_scadenza)
			    {
			        return -4; //coupon è scaduto
			    }
			}
			
			return 1;			
		}
		
		return -2;//coupon inesistente
	}
	
	public function setCouponUtilizzato($id)
	{
		if($this->isForAll($id))
		{
			return;
		}
		
		$sql = "UPDATE tb_coupons SET utilizzato = 1, data_utilizzo = '".date('Y-m-d H:i:s')."' WHERE id=".$id;
		
		$stmt = $this->conn->prepare($sql);		
		$stmt->execute();
		
		$affected_rows = $stmt->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore aggiornamento coupon   '.$error;
			$this->site->log_error('errore_db', $msg);
			exit();
		}
		return;
	}
	
	public function isForAll($id)
	{
		$sql = "SELECT * FROM tb_coupons WHERE id = $id AND id_user = 0";
		$result = $this->db->select($sql,true);
		if(count($result) > 0)
		{
			return true;
		}
		return false;
	}
	
}