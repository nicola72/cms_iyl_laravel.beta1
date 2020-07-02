<?php $prezzi = $site->getPrezzi()?>
<section style="background-color: #fff;">
	<div class="container">
		<div class="row">
	
			<div
				class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 text-center"
				style="color: #333; padding-top: 30px; padding-bottom: 30px;">
				<h3>Prezzi</h3>
	
				Prezzi al giorno, per appartamento:
				<div class="tb-prezzi-container">
					<?php echo $prezzi['paragrafo_sopra_ita']?>
				</div>
	
				<div class="col-md-12 text-left"
					style="font-style: italic; margin-top: 5px;">I prezzi si intendono
					per soggiorni minimi di 3 notti; per soggiorni inferiori valgono i
					prezzi dell’alta stagione anche in bassa.</div>
			</div>
			<div id="prezzi-tbl" class="col-md-12" style="color: #333;">
				<?php echo $prezzi['paragrafo_sotto_ita']?>
			</div>
		</div>
	</div>
</section>
<section class="module" style="padding-top: 20px; padding-bottom: 20px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<!-- ACCORDION-->
				<div id="accordion" class="panel-group">
					<div class="panel panel-default">
						<div id="heading" class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion"
									href="#collapse1" aria-expanded="false">Prenotazione e politica
									di cancellazione</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse collapse">
							<div class="panel-body">
								la prenotazione sarà valida solo in seguito alla ricezione del
								20% di acconto tramite carta di credito, bonifico bancario o
								vaglia postale. Alla partenza il saldo può avvenire con:
								contanti, bancomat e carta di credito (Visa, Mastercard). Di
								seguito la nostra politica di cancellazione:<br />


								<table class="prezzi" style="width: 100%; text-align: center">
									<tr>
										<th class="text-center">da</th>
										<th class="text-center">a</th>
										<th class="text-center">penale</th>
									</tr>

									<tr>
										<td>giorno della prenotazione</td>
										<td>30 giorni prima del check-in</td>
										<td>30%</td>
									</tr>
									<tr>
										<td>30 giorni prima del check-in</td>
										<td>15 giorni prima del check-in</td>
										<td>50%</td>
									</tr>
									<tr>
										<td>15 giorni prima del check-in</td>
										<td>3 giorni prima del check-in o mancato arrivo</td>
										<td>100%</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div id="heading" class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion"
									href="#collapse2" aria-expanded="false" class="collapsed">Animali</a>
							</h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								gli animali sono i benvenuti, ma dobbiamo comunque rispettare
								delle semplici regole di convivenza; devono essere tenuti al
								guinzaglio, non possono andare attorno alla piscina né essere
								lasciati da soli negli appartamenti.<br /> I proprietari devono
								raccogliere i bisogni fisiologici dei loro animali e assicurarsi
								che non rechino disturbo agli altri ospiti dell’agriturismo.
								Eventuali danni procurati a terzi e alla struttura da parte
								degli animali sono di completa responsabilità del proprietario.
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div id="heading" class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion"
									href="#collapse3" aria-expanded="false" class="collapsed">Parcheggio</a>
							</h4>
						</div>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">è gratuito, ma non custodito; gli ospiti
								hanno a disposizione un parcheggio all’esterno ed alcuni
								posti-auto sotto una tettoia di legno. Per le biciclette è
								possibile utilizzare degli spazi chiusi comuni.</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div id="heading" class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion"
									href="#collapse4" aria-expanded="false" class="collapsed">Servizi
									nelle vicinanze</a>
							</h4>
						</div>
						<div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li>fermata del bus (500 m quello extraurbano e 8 Km quello
										urbano);</li>
									<li>stazione ferroviaria (Siena, 18 Km);</li>
									<li>supermercati, farmacie, posta, banche, panifici, edicole,
										bar, pizzerie e ristoranti (ad 8 e 10 Km i più vicini).</li>
								</ul>

							</div>
						</div>
					</div>
				</div>
				<!-- END ACCORDION-->
			</div>
		</div>
	</div>
</section>
