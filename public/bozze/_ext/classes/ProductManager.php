<?php

class ProductManager 
{
	protected $site;
	protected $db;
	protected $conn;
	
	public $nr_prodotti = 0;
	
	public function __construct($site)
	{
		$this->site = $site;
		$this->db = $site->db;
		$this->conn = $site->conn;
	}
	
	public function getProdottiNovita()
	{
		$sql = "SELECT * FROM tb_prodotti WHERE visibile='si' AND disponibilita !='non_disponibile' AND novita='si' ORDER BY RAND() ";
		return $this->db->select($sql);
	}
	
	public function getProdottiOfferte()
	{
		$sql = "SELECT * FROM tb_prodotti WHERE visibile='si' AND disponibilita !='non_disponibile' AND offerta='si' ORDER BY RAND() ";
		return $this->db->select($sql);	
	}
	
	public function getAbbinamentiNovita()
	{	
		$sql = "SELECT *, 'abbinamento' FROM tb_abbinamenti WHERE visibile='si' AND novita='si' ORDER BY RAND() ";
		return $this->db->select($sql);
	}
	
	public function getAbbinamentiOfferte()
	{
		$sql = "SELECT *, 'abbinamento' FROM tb_abbinamenti WHERE visibile='si' AND offerta='si' ORDER BY RAND() ";
		return $this->db->select($sql);		 
	}
	
	public function getInfoProduct($id)
	{
		$sql = "SELECT * FROM tb_prodotti WHERE id = $id";
		return $this->db->select($sql,true);		
	}
	
	public function getMacroCategorie()
	{
		$sql = "SELECT * FROM tb_categorie_principali ORDER BY ordine";
		return $this->db->select($sql);		 
	}
	
	public function getMacroCategoria($macroId)
	{		
		$sql = "SELECT * FROM tb_categorie_principali WHERE id = $macroId";
		return $this->db->select($sql,true);	
	}
	
	public function getCategorie($macroId)
	{
		$sql = "SELECT * FROM tb_categorie WHERE id_categoria_liv1 = $macroId ORDER BY ordine";
		return $this->db->select($sql);
	}
	
	public function getCategoria($categoriaId)
	{
		$sql = "SELECT * FROM tb_categorie WHERE id= $categoriaId";
		return $this->db->select($sql,true);
	}
	
	public function getProdotto($id)
	{
		$prodotto = null;
		/*$sql="SELECT pr.*, c.categoria_{$this->lang}
		FROM tb_prodotti AS pr
		LEFT JOIN tb_categorie_prodotti AS c ON c.id = pr.id_categoria
		WHERE pr.id={$id}";*/
		
		$sql = "SELECT * FROM tb_prodotti WHERE id = $id";
	
		if($res = $this->conn->query($sql))
		{
			if ($res->rowCount() > 0)
			{
				$row = $res->fetch(PDO::FETCH_ASSOC);
				$prodotto = $row;
	
				if($varianti = $this->getVarianti($id))
				{
					$prodotto['varianti'] = $varianti;
				}
			
				//Se il prodotto ha accessori => li aggiungo a $ret
				if($accessori = $this->getAccessori($id))
				{
					$prodotto['accessori'] = $accessori;
				}
			}
				
		}
		return $prodotto;
	}
	
	public function getVarianti($prodottoId)
	{
		$varianti = false;
	
		$sql = "SELECT * FROM tb_varianti_prodotto WHERE id_prodotto={$prodottoId}";
	
		if($res = $this->conn->query($sql))
		{
			if ($res->rowCount() > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					$varianti[] = $row;
				}
			}
		}
		return $varianti;
	}
	
	public function getAccessori($prodottoId, $visibile = 1)
	{
		$visibile = ($visibile==1) ? "si" : "no";
		$accessori = false;
	
		$sql = "SELECT p.*
		FROM tb_accessori_br AS a
		LEFT JOIN tb_prodotti AS p ON p.id = a.id_accessorio
		WHERE a.id_prodotto={$prodottoId}
		AND p.visibile = '{$visibile}'";
	
		if($res = $this->conn->query($sql))
		{
			if ($res->rowCount() > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					$accessori[] = $row;
				}
			}
		}
		return $accessori;	
	}
	
	public function getAbbinamenti()
	{		
		$price_limits = false;
		$price_limit_min = false;
		$price_limit_max = false;
		$type_filter = false;
		
		$nr_prodotti_per_pagina = $this->site->nr_prod_per_page; //numero di prodotti da visualizzare per pagina
		$pagina = $this->site->p; //numero della pagina del paginatore $_GET['p']
		$id_categoria = $this->site->categoria['id'];
		
		$sql = "SELECT *, prezzo1+prezzo2 AS prezzo_comp, (IF(prezzo_scontato1 = '0.00', prezzo1, prezzo_scontato1) + IF(prezzo_scontato2 = '0.00', prezzo2, prezzo_scontato2)) as minimalComp
		FROM (
		SELECT a.*, pr1.prezzo AS prezzo1, pr2.prezzo AS prezzo2, pr1.prezzo_scontato AS prezzo_scontato1, pr2.prezzo_scontato AS prezzo_scontato2, pr1.codice
		
		FROM tb_abbinamenti AS a
		LEFT JOIN tb_prodotti AS pr1 ON pr1.id=a.id_prodotto1
		LEFT JOIN tb_prodotti AS pr2 ON pr2.id=a.id_prodotto2
		
		WHERE a.visibile='si'
		AND a.id_tipologia = {$id_categoria}
		AND pr1.prezzo IS NOT NULL
		AND pr2.prezzo IS NOT NULL";
		
		if(isset($_GET['id_tipologia']) && $_GET['id_tipologia']!="")
		{
			if(strpos ($_GET['id_tipologia'], "p_")===0)
			{
				$price_limits = str_replace("p_", "", $_GET['id_tipologia']);
				list($price_limit_min, $price_limit_max) = explode("_" , $price_limits);
						
				$price_limit_min = ($price_limit_min!="") ? $price_limit_min : false;
				$price_limit_max = ($price_limit_max!="") ? $price_limit_max : false;
			}
			elseif(strpos ($_GET['id_tipologia'], "st_")===0)
			{
				$type_filter = str_replace("st_", "", $_GET['id_tipologia']);
				$type_filter = str_replace("_", " ", $type_filter);
			
				$sql .= " AND a.stile_per_filtro = '".$type_filter."'";
			}
			else
			{
				$sql .=" AND (pr1.id_categoria IN (".$_GET['id_tipologia'].") OR pr2.id_categoria IN (".$_GET['id_tipologia']."))";
			}		
		}
		
		$sql.=") AS tmp";	
		
		if($price_limits)
		{
			$sql .= " HAVING minimalComp >= {$price_limit_min}";
		}
		if($price_limit_max)
		{
			$sql .= " AND minimalComp <= {$price_limit_max}";
		}		
		//echo $sql;
		$prodotti = array();
		
		//echo $sql;
		
		if($res = $this->conn->query($sql))
		{
			$this->nr_prodotti = $res->rowCount();
			if ($this->nr_prodotti > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					$prodotti[] = $row;
				}
			}
		}
		
		//se il numero totale dei prodotti è minore del numero di prodotti da fare vedere per pagina allora esce con il risultato della prima query
		/*if($this->nr_prodotti < $nr_prodotti_per_pagina)
		{
			return $prodotti;
		}*/ #commentato perchè non faceva l'ordinamento se c'erano pochi prodotti
		
		//determino il numero delle pagine ---- variabile che userà il paginatore
		$this->site->nr_totale_pagine = ceil($this->nr_prodotti/$nr_prodotti_per_pagina);
		
		//determino l'offset
		$start = $pagina * $nr_prodotti_per_pagina;
		$order_by="minimalComp ASC";
		
		if(isset($_GET['order']) && $_GET['order']!="")
		{
			list($item, $verso) = explode("|", $_GET['order']);
			
			
			if(strpos($item,'pre') !== false )
			{
				$order_by = $item."_comp ".$verso;
			}
			elseif(strpos($item,'codice') !== false)
			{
				//$order_by = "codice ".$verso;
				$order_by = "titolo ".$verso;
			}
			else
			{
				$order_by = $item." ".$verso;
			}
			
			
		}
		
		$sql .= " ORDER BY {$order_by} LIMIT {$start},{$nr_prodotti_per_pagina}";		
		
		$this->site->log_error('debug', $sql);
		
		//echo $sql;
		$abbinamenti = array();
		if($res = $this->conn->query($sql))
		{
			if ($res->rowCount() > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					$abbinamenti[] = $row;
				}
			}
		}
		return $abbinamenti;
	}
	
	public function getAbbinamento($id)
	{
		$sql = "SELECT * FROM tb_abbinamenti WHERE id = $id";
		return $this->db->select($sql, true);
	}
	
	public function getProdotti()
	{
		$price_limits = false;
		$price_limit_min = false;
		$price_limit_max = false;
		$type_filter = false;
		
		$nr_prodotti_per_pagina = $this->site->nr_prod_per_page; //numero di prodotti da visualizzare per pagina
		$pagina = $this->site->p; //numero della pagina del paginatore $_GET['p']
		
		if ( !$this->site->categoria ){
			$macroCategoria = $this->site->macroCategoria['id'];
			$sql = "SELECT id FROM tb_categorie 
				WHERE " . ($this->site->macroCategoria ? "id_categoria_liv1 = $macroCategoria" : 'id_categoria_liv1 NOT IN (18,20,21,19,30)');

			$result = $this->conn->query($sql);
			$result = $result->fetchAll(PDO::FETCH_ASSOC);
			$id_categoria = [];
			foreach ($result as $key => $value) {
				$id_categoria[] = $value['id'];
			}
			$id_categoria = implode(',', $id_categoria);
		} else {
			$id_categoria = $this->site->categoria['id'];
		}
		
		$sql = "SELECT *, IF(prezzo_scontato = '0.00', prezzo, prezzo_scontato) as minimal FROM tb_prodotti 
				WHERE is_accessorio = 0 AND visibile = 'si' AND disponibilita!='non_disponibile' AND id_categoria IN( $id_categoria )";
		
		$prodotti = array();
		
		if($res = $this->conn->query($sql))
		{
			$this->nr_prodotti = $res->rowCount();
			if ($this->nr_prodotti > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					$prodotti[] = $row;
				}
			}
		}
		
		//determino il numero delle pagine ---- variabile che userà il paginatore
		$this->site->nr_totale_pagine = ceil($this->nr_prodotti/$nr_prodotti_per_pagina);
		if($pagina >= $this->site->nr_totale_pagine) {
			$pagina = 0;
			unset($_GET['p']);
		}
		//determino l'offset
		$start = $pagina * $nr_prodotti_per_pagina;
		$order_by="minimal ASC";
		
		if(isset($_GET['order']) && $_GET['order']!="")
		{
			list($item, $verso) = explode("|", $_GET['order']);
			$order_by = $item." ".$verso;
		}
		
		$sql .= " ORDER BY {$order_by} LIMIT {$start},{$nr_prodotti_per_pagina}";
		
		$prodotti_da_visualizzare = array();
		if($res = $this->conn->query($sql))
		{
			if ($res->rowCount() > 0)
			{
				while($row = $res->fetch(PDO::FETCH_ASSOC))
				{
					$prodotti_da_visualizzare[] = $row;
				}
			}
		}
		return $prodotti_da_visualizzare;	
		
	}
	
	public function getAbbinamentiCorrelati($prod_1,$prod_2, $id_abbinamento)
	{
		$sql = sprintf("SELECT * FROM tb_abbinamenti 
				WHERE id_prodotto1 = %s AND id <> %s OR id_prodotto2 = %s AND id <> %s ",
				$prod_1,
				$id_abbinamento,
				$prod_2,
				$id_abbinamento);
		
		
		return $this->db->select($sql);
	}
	
	public function getDisponibilita($prodotto)
	{
		if($prodotto['disponibilita']=="disponibile")
		{
			$disponibilita = "Available immediately";
			if($this->site->lang == 'ita')
			{
				$disponibilita = "Disponibile subito";
			}
			
		} 
		elseif($prodotto['disponibilita']=="non_disponibile")
		{
			$disponibilita = "Not available at the time";
			if($this->site->lang == 'ita')
			{
				$disponibilita = "Non disponibile al momento";
			}
		} 
		elseif($prodotto['disponibilita']=="disponibile_a_breve")
		{
			$disponibilita = "Available soon. For info conact our <a class='customer-service' href=\"mailto:customerservice@chess-store.it\">Customer Service</a>";
			if($this->site->lang == 'ita')
			{
				$disponibilita = "Disponibile a breve. Per info contattare il <a class='customer-service' href=\"mailto:customerservice@chess-store.it\">Customer Service</a>";
			}
			
		} 
		elseif($prodotto['disponibilita']=="su_ordinazione")
		{
			$disponibilita = "Article made to order. For info conact our <a class='customer-service' href=\"mailto:customerservice@chess-store.it\">Customer Service</a>";
			if($this->site->lang == 'ita')
			{
				$disponibilita = "Articolo realizzato su ordinazione. Per info contattare il <a class='customer-service' href=\"mailto:customerservice@chess-store.it\">Customer Service</a>";
			}
			$disponibilita = '<div style="font-size:140%;">' . $disponibilita . '</div>';
		}
		
		return $disponibilita;
	}
	
	public function searchProducts($search)
	{
		$prodotti = array();
		
		$sql = "SELECT * FROM tb_prodotti 
				WHERE visibile='si' 
				AND (modello_it LIKE :search
				OR nome_it LIKE :search 
				OR descrizione_it LIKE :search 
				OR codice LIKE :search)";
		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(':search' => "%".$search."%"	));
		
		if ($stmt->rowCount() > 0)
		{
			$this->nr_prodotti = $stmt->rowCount();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$prodotti[] = $row;
			}
		}
		
		return $prodotti;
	}
	
	public function searchAbbinamenti($search)
	{
		$prodotti = array();
	
		$temp = explode("+", $search);
	
		$set = array();
		foreach ($temp as $tp) {
			$tp = trim($tp);
			$set[] = "'".$tp."'";
		}
		$set = implode(",", $set);
	
		$sql = "SELECT *, 'abbinamento' FROM tb_abbinamenti
		WHERE visibile='si'
		AND (id_prodotto1 IN (SELECT id FROM tb_prodotti WHERE codice IN ({$set}))
		OR id_prodotto2 IN (SELECT id FROM tb_prodotti WHERE codice IN ({$set})))";
	
		return $this->db->select($sql);
	}
	
	public function searchAbbinamenti2($search)
	{
		$prodotti = array();	
		
		
		/*$sql = "SELECT * FROM tb_abbinamenti 
				WHERE visibile='si' 
				AND (titolo LIKE :search
				OR titolo_en LIKE :search 
				OR descrizione LIKE :search 
				OR descrizione_en LIKE :search
				)";*/
		
		$search = utf8_decode("%".$search."%");
		/*$sql = sprintf("
				SELECT * FROM tb_abbinamenti WHERE visibile='si' 
				AND (titolo LIKE '%s'	
				OR titolo_en LIKE '%s'	OR descrizione LIKE '%s' OR descrizione_en LIKE '%s')",
				$search,$search,$search,$search);*/
		
		$sql = "SELECT * FROM tb_abbinamenti WHERE visibile='si'
				AND (titolo LIKE :search
				OR titolo_en LIKE :search	OR descrizione LIKE :search OR descrizione_en LIKE :search)";
		
		//echo 'sql'.$sql;
		
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':search', $search, PDO::PARAM_STR);
		//$stmt->execute(array(':search' => $search));
		$stmt->execute();
		
		if ($stmt->rowCount() > 0)
		{
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$prodotti[] = $row;
			}
		}
		
		
		return $prodotti;
	}
	
	public function searchAbbinamenti3($prodotti)
	{
		$abbinamenti = array();
		
		if(count($prodotti > 0))
		{
			foreach ($prodotti as $item)
			{
				$id = $item['id'];
				$sql = "SELECT * FROM tb_abbinamenti WHERE visibile = 'si' AND (id_prodotto1 = $id OR id_prodotto2 = $id)";
				
				$array = $this->db->select($sql);
				$abbinamenti = array_merge($abbinamenti,$array);
			}
		}
		return $abbinamenti;
	}
}

?>