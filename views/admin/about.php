<div class="wrap open-data">
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab nav-tab-active" href="admin.php?page=open_data_rdw_about"><?php _e('Information', 'open_data_rdw'); ?></a>
		<a class="nav-tab" href="admin.php?page=open_data_rdw_settings"><?php _e('Settings', 'open_data_rdw'); ?></a>
	</h2>
	<div class="section">
		<div class="grid-12" style="max-width: 800px">
			<h2><?php _e('Open data RDW vehicle information', 'open_data_rdw') ?></h2>
			<p>Met deze plugin kunt u eenvoudig voertuiginformatie van de Open RDW database ophalen en weergeven op uw website. Om deze plugin te kunnen gebruiken is het nodig om een RDW Open Data account te hebben. Deze gegevens dienen ingevoerd te worden onder het tabblad <a href="admin.php?page=open_data_rdw_settings">Instellingen</a>.</p>
		</div>
	</div>


	<div class="section info">
		<div class="grid-8">
			<h3><?php _e('Add widget', 'open_data_rdw') ?></h3>
			<div style="max-width: 600px">
				<p>De widget kan toegevoegd worden door naar <strong>Weergave</strong> en dan <strong>Widgets</strong> te gaan. Vervolgens kunt u hier de <strong>Open data RDW kenteken widget</strong> naar het gewenste widget gebied te slepen. Door de widget uit te klappen kan geselecteerd worden welke velden weergegeven moeten worden. Door de CSS class te wijzigen kan de widget opgemaakt worden met een aangepast opmaak.</p>
			</div>
		</div>
		<div class="grid-4" style="text-align: right">
			<img src="<?php echo OPEN_RDW_PLUGIN_URL . '/resources/uitleg-widget.png' ?>">
		</div>
	</div>

	<div class="section info">
		<div class="grid-8">
			<h3><?php _e('Add shortcode', 'open_data_rdw') ?></h3>
			<div style="max-width: 600px">
				<p>Het is ook mogelijk om de kenteken check in te sluiten in een pagina. Klik hiervoor bij het bewerken van een pagina op het auto icoontje en vink de gewenste opties aan. Door op <strong>Shortcode toevoegen</strong> te klikken wordt de shortcode gegenereerd met de geselecteerde opties.</p>
			</div>
		</div>
		<div class="grid-4" style="text-align: right">
			<img src="<?php echo OPEN_RDW_PLUGIN_URL . '/resources/uitleg-shortcodes.png' ?>">
		</div>
	</div>

	<div class="section info">
		<div class="grid-8">
			<h3>Contact Form 7 integratie</h3>
			<div style="max-width: 600px">
				<p>Door aan Contact Form 7 de shortcode <strong>[open_rdw open_rdw]</strong> toe te voegen is het mogelijk om velden automatisch aan te laten vullen aan de hand van het ingevoerde kenteken. De plugin zal opzoek gaan naar specifieke veldnamen en deze aanvullen. Zie voor de juist veldnamen de onderstaande tabel.</p>
				<table class="open-data-settings-table" style="max-width: 350px">
					<?php $categories = array(); ?>
					<?php foreach ($fields as $f): ?>
						<?php if ( ! in_array($f['category'], $categories)): ?>
							<tr class="open-rdw-header">
								<th>
									<a href="#"><?= $f['category'] ?></a>
								</th>
							</tr>
							<?php $categories[] = $f['category']; ?>
						<?php endif; ?>
						<tr style="display:none">
							<td><pre>[text <?php echo $f['name'] ?>]</pre></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<div class="grid-4" style="text-align: right">
			<img src="<?php echo OPEN_RDW_PLUGIN_URL . '/resources/uitleg-cf.png' ?>">
		</div>
	</div>

	<div class="section footer">
		<div class="grid-8">
			<h2>Vragen, support of ondersteuning?</h2>
			<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FTussendoorHQ&amp;width=268&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=401010490009584" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:180px;" allowtransparency="true"></iframe>
			<p>Like ons op Facebook</p>
		</div>
		<div class="grid-4">
			<h2>Meer plugins?</h2>
			<ul class="more-plugins">
				<li><a href="http://wordpress.org/plugins/tussendoor-shopp-12-nl" target="_blank">Tussendoor Shopp 1.2.* NL / Dutch plugin</a></li>
				<li><a href="http://wordpress.org/plugins/minimum-length-for-contact-form-7" target="_blank">Contact Form 7 minlength extension</a></li>
				<li><a href="http://codecanyon.net/item/uberwidget-wordpress-sidebar-widget-plugin/3444977?WT.ac=portfolio_item&amp;WT.seg_1=portfolio_item&amp;WT.z_author=Tussendoor&amp;ref=Tussendoor" target="_blank">Uberwidget! Wordpress sidebar &amp; widget plugin</a></li>
				<li><a href="http://codecanyon.net/item/combine-messages/3177125?WT.ac=portfolio_item&amp;WT.seg_1=portfolio_item&amp;WT.z_author=Tussendoor&amp;ref=Tussendoor" target="_blank">Combine messages</a></li>
				<li><a href="http://codecanyon.net/item/anywall/403570?WT.ac=portfolio_item&amp;WT.seg_1=portfolio_item&amp;WT.z_author=Tussendoor&amp;ref=Tussendoor" target="_blank">Anywall</a></li>
				<li><a href="http://codecanyon.net/item/landingpages/301422?WT.ac=portfolio_item&amp;WT.seg_1=portfolio_item&amp;WT.z_author=Tussendoor&amp;ref=Tussendoor" target="_blank">Landingpages</a></li>
				<li><a href="http://www.tussendoor.nl/wordpress-plugins/" target="_blank">Tussendoor plugins</a></li>
			</ul>
		</div>
	</div>

</div>