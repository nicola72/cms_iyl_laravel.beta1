<?php
class OrderManager
{
	protected $site;
	protected $conn;
	protected $db;
	
	protected $user_id = "NULL";
	public $order_id;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->conn = $site->conn;
		$this->db = $site->db;
		
		$this->user_id = (isset($_SESSION['id_user']) && $_SESSION['id_user']!="")? $_SESSION['id_user']: "NULL";
	}
	
	public function addOrder($sconto,$regalo)
	{
		$sql = "INSERT INTO tb_ordini 
			(idl, id_user, data, spese_spedizione, spese_contrassegno, spese_conf_regalo, modalita_pagamento, sconto, pagato, imponibile, iva, sconto_iva, importo, data_nascita, luogo_nascita, data_inserimento)
			VALUES(:lang, :id_user, :data, :spese_spedizione, :spese_contrassegno, :spese_conf_regalo, :modalita_pagamento, :sconto, :pagato, :imponibile, :iva, :sconto_iva, :importo, :data_nascita, :luogo_nascita, :data_inserimento)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':lang' => $this->site->lang,
				':id_user' => $this->user_id,
				':data' => date('Y-m-d'),
				':spese_spedizione' => $_SESSION['carrello']['ss'],
				':spese_contrassegno' => $_SESSION['carrello']['sp'],
				':spese_conf_regalo' => $regalo,
				':modalita_pagamento' => $_SESSION['carrello']['pagamento'],
				':sconto' => $sconto,
				':pagato' => 'no',
				':imponibile' => $_SESSION['carrello']['dettaglio']['imponibile'],
				':iva' => $_SESSION['carrello']['dettaglio']['iva'],
				':sconto_iva' => $_SESSION['carrello']['dettaglio']['tax_refund'],
				':importo' => $_SESSION['carrello']['dettaglio']['importo'],
				':data_nascita' => $_SESSION['carrello']['spedizione']['data_nascita'],
				':luogo_nascita' => addslashes($_SESSION['carrello']['spedizione']['citta_nascita']),
				':data_inserimento' => date('Y-m-d H:i:s'),
		));
		
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore durante inserimento nuovo ordine   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		}
		
		$this->order_id = $this->conn->lastInsertId();
		return true;
	}
	
	public function addOrderDetails($prodotto,$qta,$prezzo)
	{
		$nome_prodotto = ($this->site->lang == "ita") ? $prodotto['nome_it'] : $prodotto['nome_en'];
		
		$sql = "INSERT INTO tb_dettaglio_ordini 
			(id_ordine, id_prodotto, codice, prodotto, qta, importo_tot) 
			VALUES (:id_ordine, :id_prodotto, :codice, :prodotto, :qta, :importo_tot)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':id_ordine' => $this->order_id,
				':id_prodotto' => $prodotto['id'],
				':codice' => addslashes($prodotto['codice']),
				':prodotto' => addslashes($nome_prodotto),
				':qta' => $qta,
				':importo_tot' => $prezzo
				
		));
		
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore durante inserimento dettaglio ordine   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		}
		return true;
	}
	
	public function addSpedizioneOrdine()
	{
		$sql = "INSERT INTO tb_spedizione_ordini 
		(id_ordine, nome, cognome, email, telefono, indirizzo, cap, citta, provincia, nazione) 
		VALUES (:id_ordine, :nome, :cognome, :email, :telefono, :indirizzo, :cap, :citta, :provincia, :nazione)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':id_ordine' => $this->order_id,
				':nome' => addslashes($_SESSION['carrello']['spedizione']['nome']),
				':cognome' => addslashes($_SESSION['carrello']['spedizione']['cognome']),
				':email' => addslashes($_SESSION['carrello']['spedizione']['email']),
				':telefono' => addslashes($_SESSION['carrello']['spedizione']['tel']),
				':indirizzo' => addslashes($_SESSION['carrello']['spedizione']['indirizzo']),
				':cap' => addslashes($_SESSION['carrello']['spedizione']['cap']),
				':citta' => addslashes($_SESSION['carrello']['spedizione']['citta']),
				':provincia' => addslashes($_SESSION['carrello']['spedizione']['prov']),
				':nazione' => addslashes($_SESSION['carrello']['spedizione']['nome_nazione'])
		
		));
		
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore durante inserimento spedizione ordine   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		}
		return true;
	}
	
	public function getSpedizione($id_ordine)
	{
		$sql = "SELECT * FROM tb_spedizione_ordini WHERE id_ordine= :id_ordine";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':id_ordine' => $id_ordine		
		));
		
		
		if ($stmt->rowCount() > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
	}
	
	public function getOrdini()
	{
		$sql = "SELECT * FROM tb_ordini WHERE id_user = ".$_SESSION['id_user']." ORDER BY data DESC";
		return $this->db->select($sql);
	}
	
	public function getDettagli($id_ordine)
	{
		$sql = "SELECT * FROM tb_dettaglio_ordini WHERE id_ordine = ".$id_ordine;
		return $this->db->select($sql);
	}
	
	public function getOrdine($id_ordine)
	{
		//$this->site->log_error('errore_paypal', "entro getOrdine ".$id_ordine);
		$sql = "SELECT * FROM tb_ordini WHERE id = :id_ordine";
		
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(':id_ordine' => $id_ordine	));
		
		if ($stmt->rowCount() > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
	}
	
	public function getProdottiOrdine($id_ordine)
	{
		//$this->site->log_error('errore_paypal', "entro getProdottiOrdine ".$id_ordine);
		$sql = "SELECT * FROM tb_dettaglio_ordini WHERE id_ordine = $id_ordine";
		return $this->db->select($sql);
	}
	
	public function getDatiOrdineForPayPal($id_ordine)
	{
		$sql = "SELECT *,DATE_FORMAT(data, '%d/%m/%Y') as data_ordine FROM tb_ordini WHERE tb_ordini.id = :id_ordine";		
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(':id_ordine' => $id_ordine	));
		
		if ($stmt->rowCount() > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
	}
	
	public function setOrdinePagato($payment_status,$txn_id,$codice_ordine)
	{
		$sql = "UPDATE tb_ordini SET pagato ='si', stato_pagamento = :stato_pagamento, idtranspag = :idtranspag WHERE id = :ordine";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':stato_pagamento' => $payment_status,
				':idtranspag' => $txn_id,
				':ordine' => $codice_ordine,			
		
		));
		
		$affected_rows = $stmt->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore o durante aggiornamento stato pagamento ordine   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		}
		
		return true;
	}
}
