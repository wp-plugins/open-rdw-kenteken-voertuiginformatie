<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" class="vwe-kenteken-widget">
	<p><input type="text" name="open_data_rdw_kenteken" value="<?php echo $_POST['open_data_rdw_kenteken'] ?>" maxlength="8"></p>
	<p><input name="submit" type="submit" id="submit" value="<?php _e('Kenteken opzoeken', 'open_data_rdw') ?>"></p>
</form>
<?php if($data): ?>
	<h3><?php _e('Voertuiggegevens', 'open_data_rdw') ?></h3>
	<table>
		<?php
		$categories = array();
		foreach ($data as $d) {
			if( !is_array($fields) || in_array($d['name'], $fields) ) {
				if( !in_array($d['category'], $categories) ) {
					$categories[] = $d['category'];
					echo '<tr class="open-rdw-header">';
					echo '<td colspan="2" style="font-weight: bold;">';
					echo '<a href="#">'.$d['category'].'</a>';
					echo '</td>';
					echo '</tr>';
				}
				echo '<tr style="display:none">';
				echo '<td>'.$d['label'].'</td>';
				echo '<td>'.$d['value'].'</td>';
				echo '</tr>';
			}
		}
		?>
	</table>
<?php endif; ?>