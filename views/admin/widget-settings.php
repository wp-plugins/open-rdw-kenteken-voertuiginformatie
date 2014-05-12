<?php $categories = array(); ?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'open_data_rdw_class' ); ?>"><?php _e( 'Widget class:' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('open_data_rdw_class')); ?>" name="<?php echo $this->get_field_name( 'open_data_rdw_class' ); ?>" type="text" value="<?php echo esc_attr( $open_data_rdw_class ); ?>">
</p>
<hr>
<table class="open-data-settings-table" style="margin-bottom: 15px;">
	<?php foreach ($fields as $f): ?>
		<?php if ( ! in_array($f['category'], $categories)): ?>
			<tr class="open-rdw-header">
				<th colspan="2">
					<a href="#"><?php echo $f['category']; ?></a>
				</th>
			</tr>
			<?php $categories[] = $f['category']; ?>
		<?php endif; ?>
		<?php $checked = ($instance[$f['name']] ? 'checked="checked"' : '') ?>
		<tr style="display:none">
			<td style="width: 16px;"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id($f['name']); ?>" name="<?php echo $this->get_field_name($f['name']); ?>" <?php echo $checked; ?>></td>
			<td><label for="<?php echo $this->get_field_id($f['name']); ?>"><?= $f['label'] ?></label></td>
		</tr>
	<?php endforeach; ?>
</table>