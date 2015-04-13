<div class="wrap vwe-kenteken">
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="admin.php?page=open_data_rdw_about"><?php _e('Information', 'open_data_rdw'); ?></a>
		<a class="nav-tab nav-tab-active" href="admin.php?page=open_data_rdw_settings"><?php _e('Settings', 'open_data_rdw'); ?></a>
	</h2>
	<div class="section">
		<div class="grid-12">
			<div id="icon-vwe-kenteken" class="icon32"><br></div>
			<h2><?php _e('Open data RDW settings', 'open_data_rdw') ?></h2>
			<p><?php _e('Enter the open data RDW settings', 'open_data_rdw') ?>:</p>
			<form method="post" action="admin.php?page=open_data_rdw_settings&amp;saved=1">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="account_key"><?php _e('Account key', 'open_data_rdw') ?></label></th>
						<td>
							<input name="open_data_rdw_key" type="text" id="account_key" value="<?php echo get_option('open_data_rdw_key'); ?>" class="regular-text"><br>
							<?php echo sprintf( __('No account key?, click %shere%s to register one.', 'open_data_rdw'), '<a href="http://datamarket.azure.com/dataset/opendata.rdw/vrtg.open.data" target="_blank">', '</a>'); ?>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save changes', 'open_data_rdw') ?>">
				</p>
			</form>
		</div>
	</div>

	<?php get_tsd_footer_iframe(1, 'wordpress-plugin.html'); ?>
	
</div>