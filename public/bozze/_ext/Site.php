<?php
require_once('mail_form/phpmailer/PHPMailerAutoload.php');
require_once('classes/Db.php');
require_once('classes/ProductManager.php');
require_once('classes/UserManager.php');
require_once('classes/MailManager.php');
require_once('classes/SessionManager.php');
require_once('classes/Carrello.php');
require_once('classes/WishList.php');
require_once('classes/Coupon.php');
require_once('classes/OrderManager.php');
require_once('classes/Utils.php');
class Site 
{	
	const _ROOT = '/';
	const _GOOGLE_ANALYTICS = 'UA-32581493-43';
	
	public $p = 0;
	public $lang;
	public $langDir;
	public $conn;
	public $seo;
	public $html;	
	public $action = null;
	public $nr_prod_per_page = 24;
	public $nr_totale_pagine = 0;
	
	public $db;
	public $productManager;
	public $userManager;
	public $mailManager;
	public $sessionManager;
	public $couponManager;
	public $carrello;
	public $wishlist;
	public $orderManager;
	
	public $noIndex = false;
	
	
	
	public $prodotto = null;
	public $categoria = null;
	public $macroCategoria = null;
	public $is_abbinamento = false;
	
	public $default_email = 'info@chess-store.it';
	public $order_email = 'info@chess-store.it';
	/*public $default_email = 'nicola.tamburini@fjstudio.com';
	public $order_email = 'nicola.tamburini@fjstudio.com';*/
	
	public $url_paypall = 'https://www.paypal.com/cgi-bin/webscr';
	//public $url_paypall = 'https://sandbox.paypal.com/cgi-bin/webscr';
	
	public $email_paypal = 'info@chess-store.it';
	//public $email_paypal = 'paypal@inyourlife.info';
	
	
	public function __construct($page, $lang, $action = null)
	{
	    $this->action = $action;
		$this->page = $page;
		$this->lang = $lang;	
		$this->langDir = substr($lang, 0,2);	
		$this->conn = $this->setConnection();	
		
		$this->db = new Db($this);
		$this->productManager = new ProductManager($this);
		$this->userManager = new UserManager($this);
		$this->mailManager = new MailManager($this);
		$this->sessionManager = new SessionManager($this);
		$this->carrello = new Carrello($this);
		$this->wishlist = new WishList($this);
		$this->couponManager = new Coupon($this);
		$this->orderManager = new OrderManager($this);

		include __DIR__ . '/traduction/'.$lang.'.php';
	}
	
	public function init()
	{
		if(isset($_GET['p']))
		{			
			$this->p = $_GET['p'];
		}
	    if($this->action != null)
	    {
	       if(method_exists($this, $this->action))
            {
            	$action = $this->action;
                return $this->$action();
            }
	    }
	
		$this->seo = $this->getSeo();
		if($this->page != 'submit_ordine')
		{
			$this->html = $this->getHtmlPage();
		}
		else{
			$site = $this;
			include __DIR__ . '/page/'.$this->lang.'/'.$this->page.'.php';
		}
		
		
	}
	
	public function setCategoria($macroId,$categoriaId)
	{
	    $this->categoria      = $categoriaId ? $this->productManager->getCategoria($categoriaId)  : NULL;
	    $this->macroCategoria = $macroId     ? $this->productManager->getMacroCategoria($macroId) : NULL;
	}
	
	public function setProdotto($id)
	{
		if($this->is_abbinamento == true)
		{
			$this->prodotto = $this->productManager->getAbbinamento($id);
		}
		else
		{
			$this->prodotto = $this->productManager->getInfoProduct($id);
		}
		return $this->prodotto;
	}
	
	public function log_error($nome_file,$errore)
	{
		$fp = fopen($_SERVER['DOCUMENT_ROOT']."/_ext/log/".$nome_file, "a+");
		fwrite($fp, $errore);
		fclose($fp);
	}
	
	public function getHtml()
	{
		return $this->html;
	}
	
	public function getSeo()
	{
	    return include __DIR__ . '/seo.php';
	}
	
	protected function setConnection()
	{
	
    	$user = 'us_chessto1';
    	$password = 'V3dqk3%5';
    	$database = 'db_chessto1_';
    	$host = '91.186.19.50';
    	
		/* !!!! ATTENZIONE RICORDARSI DI AGGIUNGERE CAMPO SPESE_CONF_REGALO NELLA TABELLA TB_ORDINI !!!!!! */
		
    	/*$user = 'us_test_ches1';
    	$password = 'V3dqk3%5';
    	$database = 'db_test_ut_chessto1';
    	$host = '213.229.100.154';*/

        $col = 'mysql:host='.$host.';dbname='.$database.'';
        try 
        {
        	$conn = new PDO($col , $user, $password); //tra le virgolette un eventuale password
        }
        catch(PDOException $e) 
        {
        	$this->log_error("errore_connessione_db.txt", date("d-m-Y H:i",time())." -> ".$e->getMessage());
        	echo 'Stiamo effettuando un intervento di manutenzione. Ci scusiamo per il disagio!';
        	exit();
        }
		
		return $conn;
	}
	
	public function estensioneFile($nomefile)
	{
		$array=array();
		$nomeimmagine=substr($nomefile,0,strpos($nomefile,"."));
		$estensionefile=substr($nomefile,strpos($nomefile,"."));
		array_push($array,$nomeimmagine);
		array_push($array,$estensionefile);
	
		return $array;
	}
	
	public function decode($valore)
	{
		$valore=stripslashes($valore);
		$valore=str_replace("\"","&quot;",$valore);
		$valore=str_replace(" & "," &amp; ",$valore);
		return $valore;
	}
	
	public function getHead()
	{
		return include __DIR__ . '/head.php';
	}
	
	public function getScript()
	{
		return include __DIR__ . '/script.php';
	}
	
	public function getFormContatti()
	{
		return include __DIR__ . '/form_contatti.php';
	}
	
	public function getFormContattiBig()
	{
		return include __DIR__ . '/form_contatti_big.php';
	}
	
	public function getHtmlPage()
	{
		$site = $this;
		return include __DIR__ . '/layout.php';
	}
	
	public function getCookiesText()
	{
		return include __DIR__ . '/cookie_text.php';
	}
	
	public function getFbScript()
	{
		return include __DIR__ . '/fb_script.php';
	}
	
	public function getPolicy()
	{
		return include __DIR__ . '/policy/'.$this->lang.'.php';
	}
	
	public function getUrl($page, $lang = null)
	{
		if($lang == null)
		{
			echo $this->seo[$page][$this->lang]['url'];
		}
		else
		{
			echo $this->seo[$page][$lang]['url'];
		}
	}
	
	public function getPage($lang=false)
	{
		$site = $this;
		if($lang == false)
		{
			return include __DIR__ . '/page/'.$this->page.'.php';
				
		}
		else{
			return include __DIR__ . '/page/'.$this->lang.'/'.$this->page.'.php';
		}
	
	}
	
	public function getFile($nomefile,$lang=false)
	{
		$site = $this;
		if($lang == false)
		{
			return include __DIR__ . '/common/'.$nomefile.'.php';
			
		}
		else{
			return include __DIR__ . '/common/'.$this->lang.'/'.$nomefile.'.php';
		}
	
	}
	
	public function getH1()
	{
		return include __DIR__ . '/h1.php';
	}
	
	public function getH2()
	{
		return include __DIR__ . '/h2.php';
	}
	
	public function getAlt()
	{
	    if($this->page == 'categoria')
	    {
	        if($this->lang == 'ita')
	        {
	            echo $this->categoria['nome_it'].' online';
	        }
	        else{
	            echo $this->categoria['nome_en'].' online';
	        }
	    }
	    elseif($this->page == 'scheda_prodotto')
	    {
	    	if($this->is_abbinamento == true)
	    	{
	    		if($this->lang == 'ita')
	    		{
	    				
	    			echo utf8_encode($this->prodotto['titolo'].' online');
	    		}
	    		else{
	    			echo utf8_encode($this->prodotto['titolo_en'].' online');
	    		}
	    	}
	    	else{
	    		if($this->lang == 'ita')
	    		{
	    				
	    			echo $this->prodotto['nome_it'].' online';
	    		}
	    		else{
	    			echo $this->prodotto['nome_en'].' online';
	    		}
	    	}
	    }
	    else
	    {
	        echo $this->seo[$this->page][$this->lang]['alt'];
	    }
		
	}
	
	public function getLogo()
	{
		if($this->page == 'policy')
		{
			echo self::_ROOT .'_ext/img/logo/'.$this->seo['home'][$this->lang]['logo'];
		}
		else{
			echo self::_ROOT .'_ext/img/logo/'.$this->seo[$this->page][$this->lang]['logo'];
		}
	}
	
	public function getFormRegistrazione()
	{
		return include __DIR__ . '/form_registrazione.php';
	}
	
	public function getFormLogin()
	{
		return include __DIR__ . '/form_login.php';
	}
	
	public function getFormModificaAccount()
	{
		
		return include __DIR__ . '/form_modifica_account.php';
	}
	
	public function getFormRecuperaPwd()
	{
	
	    return include __DIR__ . '/form_recupera_password.php';
	}
	
	public function getFormOrdinamento()
	{
	    return include __DIR__ . '/form_ordinamento.php';
	}
	
	public function getFormFiltro()
	{
	    return include __DIR__ . '/form_filtro.php';
	}
	
	public function getFormCarrello()
	{
		return include __DIR__ . '/form_carrello.php';
	}
	
	public function getLabel($page,$lang = null)
	{
		if($lang == null)
		{
			echo $this->seo[$page][$this->lang]['label'];
		}
		else{
			echo $this->seo[$page][$lang]['label'];
		}
	}
	
	public function getSliderImages()
	{
		$images = array();
		$sql = "SELECT * FROM tb_file WHERE tb='tb_slider' ORDER BY posizione ASC";
		
		$res = $this->db->select($sql);
		
		if(is_array($res) && count($res) > 0)
		{
			$images = $res;
		}
		return $images;
		
	}
		
	public function login_access()
	{
		$username = $_POST['username'];
		$password = $_POST['pass'];		
		
		$accesso = $this->userManager->verificaCredenziali($username, $password);
		
		if($accesso == 'non attivo'){ return $this->sendAjaxMsg(_WARN_7);}
		if($accesso == 'non confermato'){ return $this->sendAjaxMsg(_WARN_7);}
		if($accesso == 'password errata'){ return $this->sendAjaxMsg(_WARN_8);}
		if($accesso == 'username errata'){ return $this->sendAjaxMsg(_WARN_6);}
		if($accesso == 'error'){ return $this->sendAjaxMsg(_WARN_3);}	

		//AUTORIZZATO
		if($accesso == 'autorizzato')
		{
			$user_id = $this->userManager->getUserId();
			$this->sessionManager->login($user_id);
			$this->userManager->updateUserLastLogin($user_id);
			
			return $this->sendAjaxMsg('auth');
		}
		
	}
	
	public function sendAjaxMsg($message)
	{
		$ret = new stdClass();
		$ret->msg = $message;
		echo json_encode($ret);
		exit();
	}
	
	public function logout()
	{
		$this->sessionManager->destroySession();
		$url = $this->getUrl('home');
		if($this->lang == 'ita')
		{
			header("Location: https://www.chess-store.it");
		}
		else{
			header("Location: https://www.chess-store.org");
		}
		die();
	}
	
	public function isLogged()
	{
		return (isset($_SESSION['auth']) && $_SESSION['auth']=="1") ? true : false;
	}
	
	public function getCartCount()
	{		
		return $this->carrello->getNrProdottiNelCarrello();
	}
	
	
	public function addToWishList()
	{
		//se non è loggato lo butto fuori
		if(!$this->isLogged()){	return $this->sendAjaxMsg(_WARN_14);}
		
		$idp = $_GET['id_prodotto'];		
		
		if(!$this->wishlist->prodottoEsistenteNellaWishlist($idp))
		{
			$prodotto = $this->productManager->getInfoProduct($idp);
			if(!$this->wishlist->addProdotto($idp)){ return $this->sendAjaxMsg(_WARN_3);}
		}
		
		return $this->sendAjaxMsg(_ADDWISHLIST);
	    
	}
	
	public function addAbbinamentoToWishList()
	{
		//se non è loggato lo butto fuori
		if(!$this->isLogged()){	return $this->sendAjaxMsg(_WARN_14);}
		
		$abbinamento = $this->productManager->getAbbinamento($_GET['id_abbinamento']);
		
		$id_prodotto[] = $abbinamento['id_prodotto1'];
		$id_prodotto[] = $abbinamento['id_prodotto2'];
		
		foreach($id_prodotto as $idp)
		{
			//se non è già presente nella wishlist ce lo inserisco
			if(!$this->wishlist->prodottoEsistenteNellaWishlist($idp))
			{
				if(!$this->wishlist->addProdotto($idp)){ return $this->sendAjaxMsg(_WARN_3);}
			}
		}
		
		return $this->sendAjaxMsg(_ADDWISHLIST);
		 
	}
	
	public function deleteFromWishList()
	{
		$idp = $_GET['id_prodotto'];
		
		$this->wishlist->deleteItem($idp);
		return $this->sendAjaxMsg('Success');
	}
	
	public function addToCart()
	{	
		$idp = $_GET['id_prodotto'];
		$is_accessorio = false;
		$is_accessorio_of = false;
		
		$id_user = $this->userManager->getUserId();
		
		if(!$res = $this->carrello->prodottoEsistenteNelCarrello($idp))
		{
			//informazioni prodotto
			$prodotto = $this->productManager->getInfoProduct($idp);
		
			//se il prodotto non esiste
			if(count($prodotto) == 0){ return $this->sendAjaxMsg(_WARN_3); }
		
			$qta = 1;
			//se non è presente in magazzino esco
			if($prodotto['qta_stock'] < $qta){ return $this->sendAjaxMsg(_WARN_13); }
		
			//aggiungo il prodotto al carrello
			$this->carrello->prodotto = $prodotto;
			if(!$this->carrello->addProdotto($idp, $qta, $is_accessorio, $is_accessorio_of, false, array(), $id_user))
			{
				return $this->sendAjaxMsg(_WARN_3);
			}
		}
		else
		{
			$qta = $res['qta'];
			$qta = $qta +1 ;
		
			//id del carrello da aggiornare
			$id_record = $res['id'];
		
			//informazioni prodotto
			$prodotto = $this->productManager->getInfoProduct($idp);
		
			//se non è presente in magazzino esco
			if($prodotto['qta_stock'] < $qta){ return $this->sendAjaxMsg(_WARN_13); }
		
			//modifico il prodotto al carrello
			$this->carrello->prodotto = $prodotto;
			if(!$this->carrello->modifyQtaProdotto($id_record, $qta))
			{
				return $this->sendAjaxMsg(_WARN_3);
			}
		
		} 
		
		$ret = new stdClass();
		$ret->msg = _ADDCARRELLO;
		$ret->tot = $this->getCartCount();
		echo json_encode($ret);
		exit();
	}
	
	public function cartUpdateQta()
	{
		$qta = $_GET['qta'];
		$id_carrello = $_GET['id_carrello'];
		$id_prodotto = $_GET['id_prodotto'];
		
		$prodotto = $this->productManager->getInfoProduct($id_prodotto);
		if($prodotto['qta_stock'] < $qta)
		{
			return $this->sendAjaxMsg(_WARN_13);
		}
		
		if(!$this->carrello->updateQta($qta, $id_carrello, $prodotto))
		{
			return $this->sendAjaxMsg(_WARN_3);
		}
		return $this->sendAjaxMsg('success');
	}
	
	public function deleteItemFromCart()
	{
		$id_carrello = $_GET['id_carrello'];
		
		if(!$this->carrello->removeRecord($id_carrello))
		{
			return $this->sendAjaxMsg(_WARN_3);
		}
		return $this->sendAjaxMsg('success');
	}
	
	public function addAbbinamentoToCart()
	{
		$is_accessorio = false;
		$is_accessorio_of = false;
		
		$id_user = $this->userManager->getUserId();		
		$abbinamento = $this->productManager->getAbbinamento($_GET['id_abbinamento']);
		
		$id_prodotto[] = $abbinamento['id_prodotto1'];
		$id_prodotto[] = $abbinamento['id_prodotto2'];
		
		foreach($id_prodotto as $idp)
		{
			if(!$res = $this->carrello->prodottoEsistenteNelCarrello($idp))
			{
				//informazioni prodotto
				$prodotto = $this->productManager->getInfoProduct($idp);
				
				//se il prodotto non esiste
				if(count($prodotto) == 0){ return $this->sendAjaxMsg(_WARN_3); }
				
				$qta = 1;
				//se non è presente in magazzino esco
				if($prodotto['qta_stock'] < $qta){ return $this->sendAjaxMsg(_WARN_13); }
				
				//aggiungo il prodotto al carrello
				$this->carrello->prodotto = $prodotto;
				if(!$this->carrello->addProdotto($idp, $qta, $is_accessorio, $is_accessorio_of, false, array(), $id_user))
				{
					return $this->sendAjaxMsg(_WARN_3);
				}				
			}
			else
			{
				$qta = $res['qta'];
				$qta = $qta +1 ;
				
				//id del carrello da aggiornare
				$id_record = $res['id'];
				
				//informazioni prodotto
				$prodotto = $this->productManager->getInfoProduct($idp);
				
				//se non è presente in magazzino esco
				if($prodotto['qta_stock'] < $qta){ return $this->sendAjaxMsg(_WARN_13); }
				
				//modifico il prodotto al carrello
				$this->carrello->prodotto = $prodotto;
				if(!$this->carrello->modifyQtaProdotto($id_record, $qta))
				{
					return $this->sendAjaxMsg(_WARN_3);
				}
				
			}
		}
		
		$ret = new stdClass();
		$ret->msg = _ADDCARRELLO;
		$ret->tot = $this->getCartCount();
		echo json_encode($ret);
		exit();
			
	}
	
	
	public function registrazione()
	{
		$_POST = array_map("trim" , $_POST);
		$ret = new stdClass();
		
		//alcuni controlli oltre a quelli fatti da jquery validate (per sicurezza)		
		if(!Utils::isEmail($_POST['email'])){ $this->sendAjaxMsg(_WARN_2);}		
		if($_POST['password'] != $_POST['password2']){ $this->sendAjaxMsg("Le due password specificate sono diverse");}
		
		
		//email dell'utente da registrare
		$email=trim($_POST['email']);
		$emailDestinatario = $email;
		
		//se email già registrata lo butto fuori
		if($this->userManager->emailRegistrata($emailDestinatario)){ $this->sendAjaxMsg(_WARN_5);}			
		
		$token_salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);		
		$pw = $_POST['password'];
		$password_chiaro = $_POST['password'];
		$pw = md5($pw.$token_salt).":".$token_salt;
		
		//inserisco l'utente nella tabella tb_users
		if(!$this->userManager->addUser($_POST['nome'], $_POST['cognome'], $emailDestinatario, $emailDestinatario, $pw))
		{
			$this->sendAjaxMsg(_WARN_3);
		}
				
		$user_id = $this->userManager->getUserId();
		
		//memorizzo la password in chiaro
		if(!$this->userManager->insertClearPassword($user_id, $password_chiaro))
		{
			$this->sendAjaxMsg(_WARN_3);
		}
		
		//inserisco i dettagli dell'utente
		$this->userManager->inserimentoDettagli($_POST['nascita'], $_POST['luogo_nascita']);		
	
		//inserisco nella newsletter
		$this->userManager->inserimentoNewsLetter($emailDestinatario, $this->langDir);
		
		//invio email di registrazione
		$this->mailManager->invioEmailRegistrazione($_POST['lang'], $_POST['nome'], $_POST['cognome'], $password_chiaro, $emailDestinatario);
		
		
		$this->sendAjaxMsg(_REGISTRAZIONE_MSG_1);
				
	}
	
	public function modifica_account()
	{		 
		$id_user = $this->userManager->getUserId();
		$email = trim($_POST['email']);
	
		if(!Utils::isEmail($email)){ $this->sendAjaxMsg(_WARN_2); }
		
		
		//vedo se c'è da modificare la password
		if(isset($_POST['mod_pwd']))
		{
		    if($_POST['mod_pwd']=="1")
		    {
		    	//password vecchia errata esco
		        if(!$this->userManager->checkPassword($_POST['vecchia_password'], $id_user)){ return $this->sendAjaxMsg(_WARN_8);}
		        
		        //password nuova vuota esco
		        if($_POST['nuova_password'] == ''){return  $this->sendAjaxMsg(_WARN_11);}
		        
		        //modifico la password
		        if(!$this->userManager->modifyPwd($_POST['nuova_password']))
		        {
		        	return  $this->sendAjaxMsg(_WARN_3);
		        }
		    }
		}		
		
		//Se l'email esiste già nel DB per un altro utente
		if($this->userManager->emailRegistrataPerAltroUser($email)){ return $this->sendAjaxMsg(_WARN_5);}		
		
		//aggiorno il record in tb_users
		if(!$this->userManager->updateUserInfo($_POST['nome'], $_POST['cognome'], $email))
		{
			return  $this->sendAjaxMsg(_WARN_3);
		}		
		return  $this->sendAjaxMsg(_ACCOUNT_MSG_1);
		
	}	
	
	public function recupera_password()
	{
	    $email = trim($_POST['email']);
	    
	    if(!Utils::isEmail($email)){ $this->sendAjaxMsg(_WARN_2); }
	    
	    //recupero l'id user tramite email
	    $id_user = $this->userManager->getUserIdFromEmail($email);	    
	    
	    if($id_user == null)
	    {
	        $this->sendAjaxMsg(_WARN_12);
	    }
	    
	    //recupero informazioni utente
	    $user = $this->userManager->getUserInfo($id_user);
	    //recupero la password in chiaro
	    $clear_pwd = $this->userManager->getUserClearPwd($id_user);
	    
	    //invio l'email
	    if($this->mailManager->sendPasswordEmail($this->lang,$email, $user, $clear_pwd))
	    {
	    	$this->sendAjaxMsg(_ACCOUNT_MSG_2);
	    }
	    else
	    {
	    	$this->sendAjaxMsg(_WARN_3);
	    }
	    
	}
	
	public function couponRedeem()
	{
		
		
		$code = $_GET['coupon'];
		
		//se � un coupon generale
		$valid_for_all = $this->couponManager->isValidForAll($code);
		if($valid_for_all != -2 && $valid_for_all != -1)
		{
			if($valid_for_all == -4){return $this->sendAjaxMsg(_WARN_17);}//coupon scaduto
			if($valid_for_all == -5){return $this->sendAjaxMsg(_WARN_19);}//coupon non valido oggi
			
			$coupon = $this->couponManager->getCoupon($code,0);
			
			
			$_SESSION['carrello']['coupon']['id'] = $coupon['id'];
			$_SESSION['carrello']['coupon']['tipo_sconto'] = $coupon['tipo_sconto'];
			$_SESSION['carrello']['coupon']['ammontare_sconto'] = $coupon['ammontare_sconto'];
			
			
			
			return $this->sendAjaxMsg(_ADDCOUPON);
		}
		
		//se non � loggato lo butto fuori
		if(!$this->isLogged()){	return $this->sendAjaxMsg(_WARN_15);}
		$id_user = $this->userManager->getUserId();
		
		
		$valid_coupon = $this->couponManager->isValidCoupon($code, $id_user);
		
		if($valid_coupon == -1){ return $this->sendAjaxMsg(_WARN_3);} //errore nella query
		if($valid_coupon == -2){ return $this->sendAjaxMsg(_WARN_18);} //coupon inesistente
		if($valid_coupon == -3){ return $this->sendAjaxMsg(_WARN_16);} //coupon gi� utilizzato
		if($valid_coupon == -4){ return $this->sendAjaxMsg(_WARN_17);} //coupon scaduto
		
		$coupon = $this->couponManager->getCoupon($code,$id_user);
		
		//Setto il coupon in sessione
		$_SESSION['carrello']['coupon']['id'] = $coupon['id'];
		$_SESSION['carrello']['coupon']['tipo_sconto'] = $coupon['tipo_sconto'];
		$_SESSION['carrello']['coupon']['ammontare_sconto'] = $coupon['ammontare_sconto'];
		
		return $this->sendAjaxMsg(_ADDCOUPON);
	}
	
	public function getProvince()
	{
		$sql = "SELECT * FROM tb_province ORDER BY provincia ASC";
		return $this->db->select($sql);
	}
	
	public function getNazioni()
	{
		if($this->lang == 'ita')
		{
			$sql = "SELECT * FROM tb_nazioni ORDER BY nome_it ASC";
		}
		else
		{
			$sql = "SELECT * FROM tb_nazioni ORDER BY nome_en ASC";
		}
		
		return $this->db->select($sql);
	}
	
	public function getNomeNazione($id)
	{
		$sql = "SELECT nome_$this->langDir FROM tb_nazioni WHERE id = $id";
		$row = $this->db->select($sql, true);
		$camp = 'nome_'.$this->langDir;
		return $row[$camp];
	}
	
	public function setSpeseSpedizione()
	{
		require_once('classes/SpedizioneManager.php');
		$spedizioneManager = new SpedizioneManager($this); 
		
		//calcola le spese e le inserisce in sessione
		$spedizioneManager->calcolaSpese();
	}
	
	public function addWatermarks($img)
	{
		$img = '/_ext/include/watermark.php?f=../../'.$img.'&amp;r=180&amp;b=100';
		return $img;
	}
	
	public function addToNewsletter()
	{
		$email = trim($_GET['email']);
		$lang = $_GET['lang'];
		
		//controllo che sia un email valida
		if(!Utils::isEmail($email)){ return $this->sendAjaxMsg(_WARN_2);}
		
		$inserimento = $this->userManager->inserimentoNewsLetter($email, $lang);
		if($inserimento == -2){ return $this->sendAjaxMsg(_ALREADYINNEWSLETTER);} //già iscritto
		if($inserimento == 1){ return $this->sendAjaxMsg(_ADDNEWSLETTER);} //operazione riuscita
		
		return $this->sendAjaxMsg(_WARN_3);
	}
	
	
	public function getPopUp()
	{
		$sql = "SELECT * FROM tb_news WHERE pop_up = 'si' AND visibile = 'si' ORDER BY id";
		$row = $this->db->select($sql, true);
		return $row;
	}
	
	
	public function getRecensioni()
	{
		$sql = "SELECT *, DATE_FORMAT(data_inserimento, '%d-%m-%Y') AS data_ins FROM tb_guestbook WHERE visibile = 'si' ORDER BY data_inserimento DESC";
		return $this->db->select($sql);
	}
	
	
}

?>