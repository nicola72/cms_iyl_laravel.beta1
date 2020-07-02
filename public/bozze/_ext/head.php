<head>
	
	<meta charset="utf-8">
	
	<?php if($this->page == 'categoria'):?>
	<?php $categoria = ($this->lang == 'ita')? $this->categoria['nome_it']: $this->categoria['nome_en'];?>
	<?php if ( empty($categoria) ) $categoria = ($this->lang == 'ita')? $this->macroCategoria['nome_it']: $this->macroCategoria['nome_en'];?>
	<title><?php echo sprintf($this->seo[$this->page][$this->lang]['title'], $categoria, $categoria, $categoria)?></title>
	
	<?php elseif($this->page == 'scheda_prodotto' && $this->is_abbinamento == true):?>
	<?php $prodotto = ($this->lang == 'ita')? $this->prodotto['titolo']: $this->categoria['titolo_en'];?>
	<title><?php echo utf8_encode(sprintf($this->seo[$this->page][$this->lang]['title'], $prodotto, $prodotto, $prodotto))?></title>
	
	<?php elseif($this->page == 'scheda_prodotto' && $this->is_abbinamento == false):?>	
	<?php $prodotto = ($this->lang == 'ita')? $this->prodotto['nome_it']: $this->categoria['nome_en'];?>
	<title><?php echo utf8_encode(sprintf($this->seo[$this->page][$this->lang]['title'], $prodotto, $prodotto, $prodotto))?></title>
	
	<?php else:?>
	<title><?php echo $this->seo[$this->page][$this->lang]['title'] ?></title>	
	<?php endif;?>
		
	<meta name="Keywords" content="<?php echo $this->seo['keywords'][$this->lang]; ?>" />	
	
	<?php if($this->page == 'categoria'):?>
	<meta name="Description" content="<?php echo sprintf($this->seo[$this->page][$this->lang]['description'],$categoria)?>" />   
	
	<?php elseif($this->page == 'scheda_prodotto'):?>
	<meta name="Description" content="<?php echo sprintf($this->seo[$this->page][$this->lang]['description'],utf8_encode($prodotto)) ?>" /> 
	<?php else:?>
	<meta name="Description" content="<?php echo $this->seo[$this->page][$this->lang]['description'] ?>" />
	<?php endif;?> 
	
	<?php if($this->lang == 'spa'):?>
	 <meta name="language" content="es" />
	<?php else:?>
	<meta name="language" content="<?php echo $this->langDir?>" />
	<?php endif;?>
    
    
    <?php if($this->page == 'scheda_prodotto'):?>
    	<?php if($this->is_abbinamento):?>
    		<?php if($prodotto['img'] !=""):?>
    			<meta property="og:image" content="<?php echo "https://www.chess-store.it/file/".$prodotto['img']; ?>" />
    		<?php endif;?>
    	<?php else:?>
    		<?php if($prodotto['img_1'] !=""):?>
    			<meta property="og:image" content="<?php echo "https://www.chess-store.it/file/".$prodotto['img_1']; ?>" />
    		<?php endif;?>
    	<?php endif;?>
    <?php endif;?>
   
    <?php if($this->page == 'policy' || $this->noIndex == true || $this->page == 'scrivi_recensione'){?>
    <meta name="robots" content="noindex">
    <?php }?>
    
    <meta http-equiv="Cache-control" content="public">
    <meta name="author" content="Designed by InYourLife- http://www.inyourlife.info" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="shortcut icon" href="/favicon.png"/>
	
	<!-- fine dei meta obbligatori -->
    
    <!-- <link href="/plugins/jquery-ui/jquery-ui.css" rel="stylesheet"> -->
    
    <link href="/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/plugins/selectbox/select_option1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/plugins/rs-plugin/css/settings.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/plugins/owl-carousel/owl.carousel.css" media="screen">
    
    <link rel="stylesheet" type="text/css" href="/css/magnific-popup.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/css/lightbox.css" media="screen">

    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
    
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet"> 
    
    <!-- CUSTOM CSS -->
    <?php if($this->lang == 'spa'):?>
    <link href="/css/style_es.css" rel="stylesheet">
    <?php else:?>
    <link href="/css/style.css" rel="stylesheet">
    <?php endif;?>
    
    
    
    <link rel="stylesheet" href="/css/colors/default.css" id="option_color">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/custom.css" >
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

</head>