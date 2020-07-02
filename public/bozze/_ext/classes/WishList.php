<?php

class WishList 
{
	protected $site;
	protected $conn;
	protected $db;
	public $prodotto;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->conn = $site->conn;
		$this->db = $site->db;
	}
	
	public function prodottoEsistenteNellaWishlist($id)
	{
		$sql = "SELECT id FROM tb_wishlist WHERE id_prodotto = ".$id." AND id_utente = ".$_SESSION['id_user'];
		if($res = $this->conn->query($sql)){ if($res->rowCount() > 0){	return true; }}
		return false;
	}
	
	public function addProdotto($id)
	{
		$sql = "INSERT INTO tb_wishlist (id_prodotto, id_utente, data_inserimento) VALUES (".$id.", ".$_SESSION['id_user'].", '".date('Y-m-d H:i:s')."')";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 0)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore inserimento articolo nella wishlist   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
				
		}
		
		return true;
	}
	
	public function getUserWhishList()
	{
		$id_user = $_SESSION['id_user'];
		
		$sql = "SELECT * FROM tb_wishlist WHERE id_utente={$id_user}";
		return $this->db->select($sql);
	}
	
	public function deleteItem($id)
	{
		$id_user = $_SESSION['id_user'];
		$sql = "DELETE FROM tb_wishlist WHERE id_prodotto = $id AND id_utente = $id_user";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		return;
	}
}

?>