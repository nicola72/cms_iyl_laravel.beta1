<?php
class SpedizioneManager
{
	protected $site;
	protected $db;
	protected $conn;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->db = $site->db;
		$this->conn = $site->conn;
	}
	
	public function calcolaSpese()
	{
		if($_POST['nazione']=="101") //per ITALIA
		{
			
			if($_SESSION['carrello']['peso'] > 0 && $_SESSION['carrello']['peso'] < 1)
			{
				$_SESSION['carrello']['ss']=9;
			} else 
			{
				$_SESSION['carrello']['ss']=0;
			}
		
			$_SESSION['carrello']['elimina_iva'] = "0";
			
		} 
		elseif($_POST['nazione']=="181") // per USA
		{	
			$_SESSION['carrello']['elimina_iva'] = "1";
			
			if($_SESSION['carrello']['peso'] > 0 && $_SESSION['carrello']['peso'] <= 5)
			{
				$_SESSION['carrello']['ss']=59;
			}
			if($_SESSION['carrello']['peso'] > 5 && $_SESSION['carrello']['peso'] <= 10)
			{
				$_SESSION['carrello']['ss']=79;
			}
			if($_SESSION['carrello']['peso'] > 10 && $_SESSION['carrello']['peso'] <= 15)
			{
				$_SESSION['carrello']['ss']=119;
			}
			if($_SESSION['carrello']['peso'] > 15 && $_SESSION['carrello']['peso'] <= 20)
			{
				$_SESSION['carrello']['ss']=159;
			}
			if($_SESSION['carrello']['peso'] > 20 && $_SESSION['carrello']['peso'] <= 30)
			{
				$_SESSION['carrello']['ss']=189;
			}
			if($_SESSION['carrello']['peso'] > 30 && $_SESSION['carrello']['peso'] <= 50)
			{
				$_SESSION['carrello']['ss']=239;
			}
			if($_SESSION['carrello']['peso'] > 50 && $_SESSION['carrello']['peso'] <= 100)
			{
				$_SESSION['carrello']['ss']=390;
			}
			if($_SESSION['carrello']['peso'] > 100)
			{
				$_SESSION['carrello']['ss']=690;
			}
		} 
		else 
		{
			//Determino se la nazione è europea oppure no...
			$sql = "SELECT is_europa,eu FROM tb_nazioni WHERE id=".$_POST['nazione'];
			
			$row = $this->db->select($sql,true);
		
			if($row['is_europa']=="1") // EUROPA
			{
				if($row['eu']=="0") //Paese Extra-UE
				{ 
					$_SESSION['carrello']['elimina_iva'] = "1";
					
					if($_SESSION['carrello']['peso'] > 0 && $_SESSION['carrello']['peso'] <= 5)
					{
					    $_SESSION['carrello']['ss']=89;
					}
					if($_SESSION['carrello']['peso'] > 5 && $_SESSION['carrello']['peso'] <= 15)
					{
					    $_SESSION['carrello']['ss']=98;
					}
					if($_SESSION['carrello']['peso'] > 15 && $_SESSION['carrello']['peso'] <= 20)
					{
					    $_SESSION['carrello']['ss']=109;
					}
					if($_SESSION['carrello']['peso'] > 20 && $_SESSION['carrello']['peso'] <= 30)
					{
					    $_SESSION['carrello']['ss']=119;
					}
					if($_SESSION['carrello']['peso'] > 30 && $_SESSION['carrello']['peso'] <= 50)
					{
					    $_SESSION['carrello']['ss']=139;
					}
					if($_SESSION['carrello']['peso'] > 50 && $_SESSION['carrello']['peso'] <= 100)
					{
					    $_SESSION['carrello']['ss']=179;
					}
					if($_SESSION['carrello']['peso'] > 100)
					{
					    $_SESSION['carrello']['ss']=390;
					}
				} 
				else 
				{
					$_SESSION['carrello']['elimina_iva'] = "0";
					
					if($_SESSION['carrello']['peso'] > 0 && $_SESSION['carrello']['peso'] <= 5)
					{
					    $_SESSION['carrello']['ss']=39;
					}
					if($_SESSION['carrello']['peso'] > 5 && $_SESSION['carrello']['peso'] <= 15)
					{
					    $_SESSION['carrello']['ss']=48;
					}
					if($_SESSION['carrello']['peso'] > 15 && $_SESSION['carrello']['peso'] <= 20)
					{
					    $_SESSION['carrello']['ss']=59;
					}
					if($_SESSION['carrello']['peso'] > 20 && $_SESSION['carrello']['peso'] <= 30)
					{
					    $_SESSION['carrello']['ss']=69;
					}
					if($_SESSION['carrello']['peso'] > 30 && $_SESSION['carrello']['peso'] <= 50)
					{
					    $_SESSION['carrello']['ss']=89;
					}
					if($_SESSION['carrello']['peso'] > 50 && $_SESSION['carrello']['peso'] <= 100)
					{
					    $_SESSION['carrello']['ss']=129;
					}
					if($_SESSION['carrello']['peso'] > 100)
					{
					    $_SESSION['carrello']['ss']=290;
					}
				}
		
				
		
				//Per Svizzera (186) e Norvegia (137) aggiungo altri 50 euro di dogana
				if($_POST['nazione'] == "186" || $_POST['nazione']=="137"
						|| $_POST['nazione']=="2" || $_POST['nazione']=="5" || $_POST['nazione']=="28"
						|| $_POST['nazione']=="30" || $_POST['nazione']=="93" || $_POST['nazione']=="113"
						|| $_POST['nazione']=="117" || $_POST['nazione']=="128" || $_POST['nazione']=="130"
				    || $_POST['nazione']=="150" || $_POST['nazione']=="170" || $_POST['nazione']=="196"|| $_POST['nazione']=="16"
				    || $_POST['nazione']=="198" || $_POST['nazione']=="123" || $_POST['nazione']=="26" || $_POST['nazione']=="71"
				    || $_POST['nazione']=="46" || $_POST['nazione']=="12")
				{
					$_SESSION['carrello']['ss']+=50;
				}
			} 
			else // NON EUROPA
			{
				$_SESSION['carrello']['elimina_iva'] = "1";
				
				if($_SESSION['carrello']['peso'] > 0 && $_SESSION['carrello']['peso'] <= 1)
				{
				    $_SESSION['carrello']['ss']=69;
				}		
				if($_SESSION['carrello']['peso'] > 1 && $_SESSION['carrello']['peso'] <= 5)
				{
					$_SESSION['carrello']['ss']=89;
				}
				if($_SESSION['carrello']['peso'] > 5 && $_SESSION['carrello']['peso'] <= 10)
				{
					$_SESSION['carrello']['ss']=119;
				}
				if($_SESSION['carrello']['peso'] > 10 && $_SESSION['carrello']['peso'] <= 15)
				{
					$_SESSION['carrello']['ss']=169;
				}
				if($_SESSION['carrello']['peso'] > 15 && $_SESSION['carrello']['peso'] <= 20)
				{
					$_SESSION['carrello']['ss']=229;
				}
				if($_SESSION['carrello']['peso'] > 20 && $_SESSION['carrello']['peso'] <= 30)
				{
					$_SESSION['carrello']['ss']=269;
				}
				if($_SESSION['carrello']['peso'] > 30 && $_SESSION['carrello']['peso'] <= 50)
				{
					$_SESSION['carrello']['ss']=329;
				}
				if($_SESSION['carrello']['peso'] > 50 && $_SESSION['carrello']['peso'] <= 100)
				{
					$_SESSION['carrello']['ss']=590;
				}
				if($_SESSION['carrello']['peso'] > 100)
				{
					$_SESSION['carrello']['ss']=980;
				}
			}
		}
	}
}