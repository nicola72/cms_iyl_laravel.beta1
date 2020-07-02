<div class="topBar topBar-st" style="position: fixed; top: 0; z-index: 30000000;">
	
	<h1 class="h1 hidden-xs"><?php include_once($root . "/_ext/ru/h1.php")?></h1>

		<div class="container">
			<div class="row">
				<div class="col-md-6 hidden-sm hidden-xs" style="padding-top: 10px;">
					<ul class="list-inline">
						<li><a href="https://twitter.com/MarsiliCompany" target="blank" style="line-height: 0;"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://www.facebook.com/Marsilis-Company-316915328512344/" style="line-height: 0;" target="blank"><i class="fa fa-facebook"></i></a></li>

					</ul>
				</div>
				
				<div class="col-md-6 col-xs-12">
					<ul class="list-inline pull-right">

						
						<li><a href="http://www.chess-store.it"><img src="/_ext/img/flag_ita.jpg" alt=""></a></li>
						<li><a href="http://www.chess-store.org"><img src="/_ext/img/flag_eng.jpg" alt=""></a></li>
						<li><a href="http://www.chess-store.net"><img src="/_ext/img/flag_esp.jpg" alt=""></a></li>
						<li><a href="http://www.chessstore.de"><img src="/_ext/img/flag_deu.jpg" alt=""></a></li>
						
						<li><a href="https://www.chess-store.org" style="<?php if ($pageName =! 'home' ){ echo 'font-size: 80%;'; } ?> padding-left: 20px;">SHOP ON-LINE <i class="fa fa-angle-right"></i></a></li>



					</ul>
              	</div>

			</div>
		</div>
	</div>

<div class="header clearfix">
		<!-- NAVBAR -->
		<nav class="navbar navbar-main navbar-default" role="navigation" style="position: relative; margin-top: 30px;">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header text-center">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="/" style="min-height: 70px; display: block; float: none; text-align: center;"><img src="/_ext/img/logo/tienda_de_ajedrez_online_1.jpg" alt="Tienda de Ajedrez online" style="margin-bottom: 2px;"></a> <span class="negozio scritta hidden-sm hidden-md hidden-lg text-center" style="line-height: 1.1em; font-size: 20px;">ШАХМАТЫ И ШАХМАТНЫЕ ДОСКИ
					</span>

				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
						
						
						<?php
							foreach($pages as $key => $value) { ?>


								<li class="<?php if ($value == $page_name) { echo 'active'; } ?> ">
									<a href="<?php echo $pages_url[$key];?>"> <?php echo $pages_verbous_name[$key]; ?> </a>
								</li>

							<?php
							}
						?>
						

					</ul>
				</div>
				<!-- /.navbar-collapse -->




			</div>


			<div class="negozio scritta hidden-xs col-md-12 text-center abril shipping_sm">
				<span style="color: #000; font-family: 'Fjalla One', sans-serif; font-size: 50%;" class="hidden-sm"> </span><br>
				<br>
				<span style="line-height: 1.6em; font-size: 20px;">ШАХМАТЫ И ШАХМАТНЫЕ ДОСКИ</span>
			</div>




			<div class="col-md-6 col-md-offset-3" style="border-bottom: 1px dotted #850728; padding-top: 5px; margin-bottom: 10px;"></div>
		</nav>

	</div>

