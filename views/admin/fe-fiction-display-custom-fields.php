<?php if (!defined('ABSPATH')) die('No direct access allowed!'); ?>

<?php
global $post;

$output = false;
?>

<div class="form-wrap">
	<div class="form-field form-required">
		<table class="form-table">

		<?php foreach ( $GLOBALS['FIC_POST_CUSTOM_FIELDS'] as $custom_field ): ?>
			<?php //var_dump($custom_field); ?>
			<?php foreach ( $custom_field['object_type'] as $custom_field_object_type ): ?>
				<?php if ( $custom_field_object_type == $post->post_type ): ?>
					<?php $output = true; break; ?>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php if ( $output ): ?>
					<?php if ( $custom_field['field_type'] == 'hidden' ): ?>
						<input type="hidden" name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" value="<?php echo ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )); ?>" />
					<?php endif; ?>

					<?php if ( $custom_field['field_type'] == 'text' ): ?>
						<tr>
							<th>
								<label for="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>"><?php echo ( $custom_field['field_title'] ); ?></label>
							</th>
							<td>
								<input type="text" <?php if(isset($custom_field['field_length'])) { if((int)$custom_field['field_length']*10 < 150) { ?> size="<?php echo $custom_field['field_length']; ?>" style="width:<?php echo ((int)$custom_field['field_length']*10); ?>px;"<?php } ?> maxlength="<?php echo $custom_field['field_length']; ?>" <?php } ?> name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" value="<?php echo ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )); ?>" />
								<p><?php echo ( $custom_field['field_description'] ); ?></p>
							</td>
						</tr>
					<?php endif; ?>

					<?php if ( $custom_field['field_type'] == 'textarea' ): ?>
						<tr>
							<th>
								<label for="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>"><?php echo ( $custom_field['field_title'] ); ?></label>
							</th>
							<td>
								<textarea name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" rows="5" cols="40" ><?php echo ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )); ?></textarea>
								<p><?php echo ( $custom_field['field_description'] ); ?></p>
							</td>
						</tr>
					<?php endif; ?>

					<?php if ( $custom_field['field_type'] == 'radio' ): ?>
						<tr>
							<th>
								<label for="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>"><?php echo ( $custom_field['field_title'] ); ?></label>
							</th>
							<td>
								<?php if ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )): ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<input type="radio" name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" value="<?php echo ( $field_option ); ?>" <?php if ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true ) == $field_option ) echo ( 'checked="checked"' ); ?> /> <?php echo ( $field_option ); ?><br />
									<?php endforeach; ?>
								<?php else: ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<input type="radio" name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" value="<?php echo ( $field_option ); ?>" <?php if ( $custom_field['field_default_option'] == $key ) echo ( 'checked="checked"' ); ?> /> <?php echo ( $field_option ); ?><br />
									<?php endforeach; ?>
								<?php endif; ?>
								<p><?php echo ( $custom_field['field_description'] ); ?></p>
							</td>
						</tr>
					<?php endif; ?>

					<?php if ( $custom_field['field_type'] == 'checkbox' ): ?>
						<tr>
							<th>
								<label for="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>"><?php echo ( $custom_field['field_title'] ); ?></label>
							</th>
							<td>
								<?php if ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )): ?>
									<?php $field_values = get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true ); ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<input type="checkbox" name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>[<?php echo ( $key ); ?>]" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" value="<?php echo ( $field_option ); ?>" <?php if ( $field_values[$key] == $field_option ) echo ( 'checked="checked"' ); ?> /> <?php echo ( $field_option ); ?><br />
									<?php endforeach; ?>
								<?php else: ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<input type="checkbox" name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>[<?php echo ( $key ); ?>]" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" value="<?php echo ( $field_option ); ?>" <?php if ( $custom_field['field_default_option'] == $key ) echo ( 'checked="checked"' ); ?> /> <?php echo ( $field_option ); ?><br />
									<?php endforeach; ?>
								<?php endif; ?>
								<p><?php echo ( $custom_field['field_description'] ); ?></p>
							</td>
						</tr>
					<?php endif; ?>

					<?php if ( $custom_field['field_type'] == 'selectbox' ): ?>
						<tr>
							<th>
								<label for="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>"><?php echo ( $custom_field['field_title'] ); ?></label>
							</th>
							<td>
								<select name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>">
								<?php if ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )): ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<option value="<?php echo ( $field_option ); ?>" <?php if ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true ) == $field_option ) echo ( 'selected="selected"' ); ?> ><?php echo ( $field_option ); ?></option>
									<?php endforeach; ?>
								<?php else: ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<option value="<?php echo ( $field_option ); ?>" <?php if ( $custom_field['field_default_option'] == $key ) echo ( 'selected="selected"' ); ?> ><?php echo ( $field_option ); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
								</select>
								<p><?php echo ( $custom_field['field_description'] ); ?></p>
							</td>
						</tr>
					<?php endif; ?>

					<?php if ( $custom_field['field_type'] == 'multiselectbox' ): ?>
						<tr>
							<th>
								<label for="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>"><?php echo ( $custom_field['field_title'] ); ?></label>
							</th>
							<td>
								<select name="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>[]" id="<?php echo ( FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'] ); ?>" multiple="multiple" class="ct-select-multiple">
								<?php if ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true )): ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<option value="<?php echo ( $field_option ); ?>"
										<?php foreach ( get_post_meta( $post->ID, FIC_POST_CUSTOM_FIELDS_PREFIX . $custom_field['field_id'], true ) as $field_value ): ?>
											<?php if ( $field_value == $field_option ) { echo ( 'selected="selected"' ); break; } ?>
										<?php endforeach; ?> ><?php echo ( $field_option ); ?></option>
									<?php endforeach; ?>
								<?php else: ?>
									<?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
										<option value="<?php echo ( $field_option ); ?>" <?php if ( $custom_field['field_default_option'] == $key ) echo ( 'selected="selected"' ); ?> ><?php echo ( $field_option ); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
								</select>
								<p><?php echo ( $custom_field['field_description'] ); ?></p>
							</td>
						</tr>
					<?php endif; ?>

			<?php endif; $output = false; ?>
		<?php endforeach; ?>

		</table>
	</div>
</div>