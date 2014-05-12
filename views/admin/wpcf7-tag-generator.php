<div id="wpcf7-tg-pane-open-rdw" class="hidden">
<form action="">
<table>
<tr><td><input type="checkbox" name="required" />&nbsp;<?php echo esc_html( __( 'Required field?', 'contact-form-7' ) ); ?></td></tr>
<tr>
	<td><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?><br /><input type="text" name="name" class="tg-name oneline" /></td>
	<td><code>class</code> (<?php echo esc_html( __( 'optional', 'contact-form-7' ) ); ?>)<br />
<input type="text" name="class" class="classvalue oneline option" /></td>
</tr>
</table>

<table>

<tr>
<td><?php echo esc_html( __( 'Default value', 'contact-form-7' ) ); ?> (<?php echo esc_html( __( 'optional', 'contact-form-7' ) ); ?>)<br /><input type="text" name="values" class="oneline" /></td>

<td>
<br /><input type="checkbox" name="placeholder" class="option" />&nbsp;<?php echo esc_html( __( 'Use this text as placeholder?', 'contact-form-7' ) ); ?>
</td>
</tr>
</table>

<strong>Gebruik deze shortcode in combinatie met de volgende velden:</strong>
<table class="open-data-settings-table">
	<tbody>
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
	</tbody>
</table>

<div class="tg-tag"><?php echo esc_html( __( "Copy this code and paste it into the form left.", 'contact-form-7' ) ); ?><br /><input type="text" name="open_rdw" class="tag" readonly="readonly" onfocus="this.select()" /></div>

<div class="tg-mail-tag"><?php echo esc_html( __( "And, put this code into the Mail fields below.", 'contact-form-7' ) ); ?><br />&nbsp;<input type="text" class="mail-tag" readonly="readonly" onfocus="this.select()" /></div>
</form>
</div>