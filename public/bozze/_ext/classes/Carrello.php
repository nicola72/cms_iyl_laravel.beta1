<?php

class Carrello 
{
	protected $site;
	protected $conn;
	protected $db;
	public $prodotto;
	public $importo_totale;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->conn = $site->conn;
		$this->db = $site->db;
	}
	
	public function getNrProdottiNelCarrello()
	{
		$id_user = (isset($_SESSION['id_user'])) ? $_SESSION['id_user'] : "";
		$ret = 0;
		 
		$carrello = array();
		$sessionId = session_id();
		 
		if($id_user != "")
		{			
			$sql = "SELECT * FROM tb_carrello WHERE session_id = '$sessionId' OR id_utente = $id_user ORDER BY is_accessorio ASC, data_inserimento ASC";
		} 
		else 
		{
			$sql = "SELECT * FROM tb_carrello WHERE session_id = '$sessionId' ORDER BY is_accessorio ASC, data_inserimento ASC";
		}
		
		if($res = $this->conn->query($sql))
		{
			if($res->rowCount() > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					
					if($row['varianti'] != "" && $row['varianti'] != null)
					{
						$varianti = json_decode($row['varianti']);
						$row['varianti'] = $varianti;
					}
					$carrello[] = $row;
				}
			}
		}
		if(count($carrello) == 0)
		{
			return $ret;
		}
		
		 
		foreach($carrello as $id => $record)
		{
			if($record['varianti'] == "")
			{
				$ret += $record['qta'];
			}
			else
			{
				foreach ($record['varianti'] as $var)
				{
					$ret += $var->qta;
				}
			}
		}
		return $ret;
	}
	
	public function getProdottiCarrello()
	{
		$id_user = $this->site->userManager->getUserId();
		
		if($id_user != '')
		{
			$sql = "SELECT * FROM tb_carrello WHERE session_id='".session_id()."' OR id_utente={$id_user} ORDER BY is_accessorio ASC, data_inserimento ASC";
		}
		else
		{
			$sql = "SELECT * FROM tb_carrello WHERE session_id='".session_id()."' ORDER BY is_accessorio ASC, data_inserimento ASC";
		}
		
		$carrello = array();
		
		$res = $this->conn->query($sql);
		if ($res->rowCount() > 0)
		{
			while($row = $res->fetch(PDO::FETCH_ASSOC))
			{
				if($row['varianti']!=""){
					$varianti = json_decode($row['varianti']);
					$row['varianti'] = $varianti;
				}
				$carrello[] = $row;
			}		
		}
		return $carrello;
	}
	
	public function prodottoEsistenteNelCarrello($id)
	{
		$sql = "SELECT id, qta FROM tb_carrello WHERE id_prodotto = ".$id." AND session_id='".session_id()."'";
		if($res = $this->conn->query($sql)){ if($res->rowCount() > 0){	return $res->fetch(PDO::FETCH_ASSOC); }}
		return false;
	}
	
	public function addProdotto($id_prodotto, $qta=1, $is_accessorio=false, $is_accessorio_of=false, $has_varianti=false, $qta_varianti=array(), $id_user='')
	{			
		$prezzo = ($this->prodotto['prezzo_scontato']!="" && $this->prodotto['prezzo_scontato']!="0.00") ? $this->prodotto['prezzo_scontato'] : $this->prodotto['prezzo'];
		$prezzo = $prezzo * $qta;
		$id_user = ($id_user=="") ? 'NULL' : $id_user;
	
		if(!$is_accessorio)
		{	//prodotto "normale"
			if(!$has_varianti)
			{	//se non ha varianti
				$sql = "INSERT INTO tb_carrello (id_prodotto, id_utente, session_id, qta, prezzo, data_inserimento) VALUES ({$id_prodotto}, {$id_user}, '".session_id()."', {$qta}, {$prezzo}, '".date('Y-m-d H:i:s')."')";
			} else 
			{	//se ha varianti
				$qta_varianti = json_encode($qta_varianti);
				$sql = "INSERT INTO tb_carrello (id_prodotto, varianti, id_utente, session_id, qta, prezzo, data_inserimento) VALUES ({$id_prodotto}, '{$qta_varianti}', {$id_user}, '".session_id()."', {$qta}, {$prezzo}, '".date('Y-m-d H:i:s')."')";
			}
		} 
		else 
		{	//prodotto "accessorio"
			if(!$has_varianti)
			{	//se non ha varianti
				$sql = "INSERT INTO tb_carrello (id_prodotto, id_utente, session_id, qta, prezzo, is_accessorio, is_accessorio_of, data_inserimento) VALUES ({$id_prodotto}, {$id_user}, '".session_id()."', {$qta}, {$prezzo}, 1, {$is_accessorio_of}, '".date('Y-m-d H:i:s')."')";
			} else 
			{	//se ha varianti
				$qta_varianti = json_encode($qta_varianti);
				$sql = "INSERT INTO tb_carrello (id_prodotto, varianti, id_utente, session_id, qta, prezzo, is_accessorio, is_accessorio_of, data_inserimento) VALUES ({$id_prodotto}, '{$qta_varianti}', {$id_user}, '".session_id()."', {$qta}, {$prezzo}, 1, {$is_accessorio_of}, '".date('Y-m-d H:i:s')."')";
			}
		}
	
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 0)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore inserimento articolo nel carrello   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
			
		}
		return true;		
	}
	
	public function modifyQtaProdotto($id_record, $qta)
	{
		$prezzo = ($this->prodotto['prezzo_scontato']!="" && $this->prodotto['prezzo_scontato']!="0.00") ? $this->prodotto['prezzo_scontato'] : $this->prodotto['prezzo'];
		$prezzo = $prezzo * $qta;
		
		$sql = "UPDATE tb_carrello SET qta = {$qta}, prezzo = {$prezzo} WHERE id={$id_record}";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 0)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore aggiornamento articolo nel carrello   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
				
		}
		return true;
	}
	
	public function updateQta($qta, $id_carrello, $prodotto)
	{
		$prezzo = ($prodotto['prezzo_scontato']!="" && $prodotto['prezzo_scontato']!="0.00") ? $prodotto['prezzo_scontato'] : $prodotto['prezzo'];
		$prezzo = $prezzo * $qta;
		
		$sql = "UPDATE tb_carrello SET qta = {$qta}, prezzo = {$prezzo} WHERE id={$id_carrello}";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 0)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore aggiornamento articolo nel carrello   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		
		}
		return true;
	}
	
	public function removeRecord($id_carrello)
	{
		$sql = "DELETE FROM tb_carrello WHERE id = $id_carrello";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 0)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore aggiornamento articolo nel carrello   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		
		}
		return true;
	}
	
	public function getPesoCarrello($prodotti)
	{
		$id_user = $this->site->userManager->getUserId();
		$peso = 0;
		
		foreach($prodotti as $item)
		{
			$prodotto = $this->site->productManager->getInfoProduct($item['id_prodotto']);
			if($prodotto['peso'] != '')
			{
				$peso += $prodotto['peso'] * $item['qta'];
			}
		}
		
		return $peso;
	}
	
	public function setImportoTotale($importo)
	{
		$this->importo_totale = $importo;
		return;
	}
	
	public function setCartEmpty()
	{
		$id_user = $this->site->userManager->getUserId();
		$sessionId = session_id();
		
		if($id_user != '')
		{
			$sql = "DELETE FROM tb_carrello WHERE id_utente = {$id_user} OR session_id = '$sessionId'";
		}
		else
		{
			
			$sql = "DELETE FROM tb_carrello WHERE session_id = '$sessionId'";
		}
		
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return;
	}
}

?>