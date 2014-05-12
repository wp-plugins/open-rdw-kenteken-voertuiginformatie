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