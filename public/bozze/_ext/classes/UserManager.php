<?php

class UserManager 
{
	protected $site;
	protected $db;
	protected $conn;
	
	protected $user_id = "";
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->db = $site->db;
		$this->conn = $site->conn;
		if(isset($_SESSION['id_user']))
		{
			$this->user_id = $_SESSION['id_user'];
		}
	}
	
	public function emailRegistrata($email)
	{
		$sql = sprintf("SELECT * FROM tb_users WHERE email = '%s'", $email);
		$result = $this->db->select($sql);
		if(count($result) > 0){ return true; }
		return false;
	}
	
	public function emailRegistrataPerAltroUser($email)
	{
		$sql = sprintf("SELECT * FROM tb_users WHERE email = '%s' AND id != %s", $email,$this->user_id);
		$result = $this->db->select($sql);
		if(count($result) > 0){ return true; }
		return false;
	}
	
	public function usernameRegistrata($username,$user_id)
	{
		$sql = sprintf("SELECT username FROM tb_users WHERE username= '%s' AND id != '%s'", $username, $user_id);
		$result = $this->db->select($sql);
		if(count($result) > 0){ return true; }
		return false;
	}
	
	public function addUser($nome, $cognome, $email, $username, $password, $attivo = 1, $confermato = 1, $data_registrazione = '')
	{
		$data_registrazione = ($data_registrazione == '')? date('Y-m-d H:i:s') : $data_registrazione;
		
		$sql = "INSERT INTO tb_users
				(nome, cognome, email, username, password, attivo, confermato, data_registrazione)
				VALUES (:nome,:cognome,:email,:username,:password,:attivo,:confermato,:data_registrazione)
				";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':nome' => $nome,
				':cognome' => $cognome,
				':email' => $email,
				':username' => $username,
				':password' => $password,
				':attivo' => $attivo,
				':confermato' => $confermato,
				':data_registrazione' => $data_registrazione,
		));
		
		
		$affected_rows = $stmt->rowCount();
		
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore durante inserimento registrazione nuovo utente   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		}
		
		$this->user_id = $this->conn->lastInsertId();
		return true;
	}
	
	public function insertClearPassword($user_id,$pass)
	{
		//memorizzo la password
		$sql = "INSERT INTO tb_clear_pwd
				(id_user, pwd)
				VALUES (:id_user,:pwd)
				";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':id_user' => $user_id,
				':pwd' => $pass,
		
		));
		$affected_rows = $stmt->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore durante inserimento password in tb_clear_psw per registrazione nuovo utente   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
		}
		return true;
	}
	
	public function inserimentoDettagli($nascita,$luogo_nascita)
	{
		list($gg,$mm,$aa) = explode("/" , $nascita);
		$data_nascita_db = $aa."-".$mm."-".$gg;	
	
		//$sql = sprintf("INSERT INTO tb_user_details (id_user, data_nascita, citta_nascita) VALUES (%s,'%s','%s')",$this->user_id, $data_nascita_db, $luogo_nascita);
		$sql = sprintf("INSERT INTO tb_user_details (id_user, data_nascita, citta_nascita) VALUES (:id_user,'%s',:luogo_nascita)", $data_nascita_db);
	
		$stmt = $this->conn->prepare($sql);
	
		$stmt->execute(array(
			':id_user' => $this->user_id,
			':luogo_nascita' => $luogo_nascita
		));
	
		$affected_rows = $stmt->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore durante inserimento dettagli nuovo utente   '.$error;
			$this->site->log_error('errore_db', $msg);
			exit();
		}
	
	}
	
	public function inserimentoNewsLetter($email,$lang)
	{
		$sql = "SELECT id FROM tb_newsletter WHERE email = '".$email."'";
	
		if($res = $this->conn->query($sql))
		{
			if($res->rowCount() > 0)
			{
				return -2; //già iscritto
			}
			else
			{
				$sql2 = "INSERT INTO tb_newsletter	(email, lang) VALUES (:email,:lang)";
				$stmt = $this->conn->prepare($sql2);
				$stmt->execute(array(
						':email' => $email,
						':lang' => $lang,
				));
				$affected_rows = $stmt->rowCount();
	
				if($affected_rows < 1)
				{
					$error = print_r($stmt->errorInfo(),true);
					$msg = 'errore durante inserimento email newsletter nuovo utente   '.$error;
					$this->site->log_error('errore_db', $msg);
					exit();
				}
				return 1;
			}
		}
		return -1;
	}
	
	public function verificaCredenziali($username,$password)
	{
		$sql = "SELECT id, password, attivo, confermato FROM tb_users WHERE username = '{$username}'";
		
		if($res = $this->conn->query($sql))
		{
			if ($res->rowCount() > 0)
			{
				$row = $res->fetch(PDO::FETCH_ASSOC);
		
				if($row['attivo'] != 1) //utente non attivo
				{
					return 'non attivo';
				}
				elseif($row['confermato'] != 1) //utente non confermato (qui è sempre confermato)
				{
					return 'non confermato';
				}
		
				list(,$token_salt) = explode(":",$row['password']);
				$pwd = md5($password.$token_salt).":".$token_salt;
				if($pwd != $row['password'])
				{ 
					return 'password errata';//password errata
				}
				
				$this->user_id = $row['id'];
				return 'autorizzato';	
				
			}
			return 'username errata';
		}
		return 'error';
		
	}
	
	public function updateUserLastLogin($id_user)
	{
		$sql = "UPDATE tb_users SET data_last_login = '".date('Y-m-d H:i:s')."' WHERE id = {$id_user}";
	
		try 
		{
			$stmt = $this->conn->prepare($sql);
			// execute the query
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			$this->site->log_error('errore_db', $e->getMessage());
		}
	}
	
	public function checkPassword($pwd,$id_user)
	{
		$sql = sprintf("SELECT * FROM tb_clear_pwd WHERE id_user = %s AND pwd = '%s'",  $id_user, $pwd);
		if($res = $this->conn->query($sql)){ if($res->rowCount() > 0){	return true; }}
		return false;
	}
	
	public function modifyPwd($password)
	{		 
		$token_salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
		 
		$password_chiaro = $password;
		$password = md5($password.$token_salt).":".$token_salt;
	

		//aggiorno la password criptata in tb_users
		$sql = "UPDATE tb_users SET password = :password WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':password' => $password,
				':id' => $this->user_id,
		));
		$affected_rows = $stmt->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore o password uguale durante aggiornamento password account utente   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false; 
		}
		
		//aggiorno la password in chiaro in tb_clear_pwd
		$sql2 = "UPDATE tb_clear_pwd SET pwd = :password_chiaro WHERE id_user = :id";
		$stmt2 = $this->conn->prepare($sql2);
		$stmt2->execute(array(
				':password_chiaro' => $password_chiaro,
				':id' => $this->user_id,
		));
	
		$affected_rows = $stmt2->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore o password uguale durante aggiornamento password nella tb_clear_pwd account utente   '.$error;
			$this->site->log_error('errore_db', $msg);
			return false;
	
		}
		return true;
	}
	
	public function updateUserInfo($nome,$cognome,$email)
	{
		$sql = "UPDATE tb_users SET nome = :nome, cognome = :cognome, email = :email, username = :username WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
				':nome' => $nome,
				':cognome' => $cognome,
				':email' => $email,
				':username' => $email,
				':id' => $this->user_id
		));
		$affected_rows = $stmt->rowCount();
		if($affected_rows < 1)
		{
			$error = print_r($stmt->errorInfo(),true);
			$msg = 'errore o aggiornamento non trovato durante aggiornamento account utente   '.$error;
			$this->site->log_error('errore_db', $msg);
			
		}
		return true;
	}
	
	public function getUserIdFromEmail($email)
	{
		$sql = "SELECT id FROM tb_users WHERE email='{$email}'";
		 
		if($res = $this->conn->query($sql))
		{
			if($res->rowCount() > 0)
			{
				$row = $res->fetch(PDO::FETCH_ASSOC);
				return $row['id'];
			}
		}
		return null;
	}
	
	public function getUserId()
	{
		return $this->user_id;
	}
	
	public function getUserInfo($id)
	{
		$sql = "SELECT * FROM tb_users WHERE id = {$id}";
		return $this->db->select($sql,true);
	}
	
	public function getUserDetails($id)
	{
		$sql = "SELECT * FROM tb_user_details WHERE id_user = {$id}";
		return $this->db->select($sql, true);
	}
	
	public function getUserClearPwd($id)
	{
		$sql = "SELECT * FROM tb_clear_pwd WHERE id_user = $id";
		$result = $this->db->select($sql,true);
		if(count($result) > 0)
		{
			return $result['pwd'];
		}
		return null;		
		 
	}
	
	
}

?>