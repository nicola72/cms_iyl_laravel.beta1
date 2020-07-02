<?php $prezzi = $site->getPrezzi()?>
<section style="background-color: #fff;">
	<div class="container">
		<div class="row">
	
			<div
				class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 text-center"
				style="color: #333; padding-top: 30px; padding-bottom: 30px;">
				<h3>Prices</h3>
				Daily prices for apartments:
				<div class="tb-prezzi-container">
					<?php echo $prezzi['paragrafo_sopra_ita']?>
				</div>
	
				<div class="col-md-12 text-left"
					style="font-style: italic; margin-top: 5px;">The prices are for a minimum stay of three nights; for shorter stays the price of  the high season are worth even in low season.</div>
			</div>
			<div id="prezzi-tbl" class="col-md-12" style="color: #333;">
				<?php echo $prezzi['paragrafo_sotto_eng']?>
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
									href="#collapse1" aria-expanded="false">Booking and info</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse collapse">
							<div class="panel-body">
								Booking and cancellation policy: the booking will be valid only following the reception of the 20% of advances by credit card, bank transfer, or postal order.
								At the start, the payment can start with cash, cash dispenser, and credit card (Visa,Mastercard).:<br />


								<table class="prezzi" style="width: 100%; text-align: center">
									<tr>
										<th class="text-center">from</th>
										<th class="text-center">to</th>
										<th class="text-center">penalty clause</th>
									</tr>

									<tr>
										<td>day of booking</td>
										<td>30 days before check-in</td>
										<td>30%</td>
									</tr>
									<tr>
										<td>30 days before check-in</td>
										<td>15 days before check-in</td>
										<td>50%</td>
									</tr>
									<tr>
										<td>15 days before check-in</td>
										<td>3 days before check-in or no-show</td>
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
									href="#collapse2" aria-expanded="false" class="collapsed">Animals</a>
							</h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								Animals are welcome but we have to follow some simple cohabitation rules: they must be leashed, they are not allowed to go around the pool nor be left by themselves in the apartment.  The owners must pick up the physiological bodily needs of  their pets. More over they have to be sure that they don’t bother other guests of the Agriturismo.
Possible damages caused to third parties or to the structure by the animals are full responsibility of the owner.
							
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div id="heading" class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion"
									href="#collapse3" aria-expanded="false" class="collapsed">Parking</a>
							</h4>
						</div>
						<div id="collapse3" class="panel-collapse collapse">
							<div class="panel-body">It is free but it is not guarded.
The guests have available an outside parking and some park places under a wood canopy.
It is possible to use the common areas for the bicycles.
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div id="heading" class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion"
									href="#collapse4" aria-expanded="false" class="collapsed">Services nearby</a>
							</h4>
						</div>
						<div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li>Bus stop (500m for the extra-urban bus ),</li>
									<li>train station (Siena,18 km), </li>
									<li>supermarkets, pharmacy,  post office, banks, bakery, newsstand, coffee shops, pizzerias, and restaurants (the closest to 8 and 10 km).</li>
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
