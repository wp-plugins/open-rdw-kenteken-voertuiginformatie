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

	<?php get_tsd_footer_iframe(1, 'wordpress-plugin.html'); ?>

</div>