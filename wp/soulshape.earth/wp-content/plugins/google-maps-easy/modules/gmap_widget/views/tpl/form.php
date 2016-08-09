<?php
	if(empty($this->data['width']))
		$this->data['width'] = '100%';
	if(empty($this->data['img_width']))
		$this->data['img_width'] = 175;
	if(empty($this->data['img_height']))
		$this->data['img_height'] = 175;
?>
<div class="gmpWidgetRow">
	<label for="<?php echo $this->widget->get_field_id('id')?>"><?php _e('Select map', GMP_LANG_CODE)?>:
	<?php
	echo htmlGmp::selectbox($this->widget->get_field_name('id'), array(
		'attrs' => 'id="'. $this->widget->get_field_id('id'). '" style="width: 100%;"',
		'value' => isset($this->data['id']) ? $this->data['id'] : 0,
		'options' => $this->mapsOpts,
	));
	?>
	</label>
</div>
<div class="gmpWidgetRow">
	<label for="<?php echo $this->widget->get_field_id('width')?>"><?php _e('Widget Map width (in % or px)', GMP_LANG_CODE)?>:</label>
	<?php
		echo htmlGmp::text($this->widget->get_field_name('width'), array(
			'attrs' => 'id="'. $this->widget->get_field_id('width'). '"',
			'value' => isset($this->data['width']) ? $this->data['width'] : '100%',
		));
	?><br />
	<i><?php _e('for example, 100% or 200px', GMP_LANG_CODE)?></i>
</div>
<div class="gmpWidgetRow">
	<label for="<?php echo $this->widget->get_field_id('height')?>"><?php _e('Widget Map height (in px)', GMP_LANG_CODE)?>:</label>
	<?php
		echo htmlGmp::text($this->widget->get_field_name('height'), array(
			'attrs' => 'id="'. $this->widget->get_field_id('height'). '"',
			'value' => isset($this->data['height']) ? $this->data['height'] : '',
		));
	?><br />
	<i><?php _e('for example, 200 or 400', GMP_LANG_CODE)?></i><br />
</div>
<div class="gmpWidgetRow">
	<?php
		echo htmlGmp::checkbox($this->widget->get_field_name('display_as_img'), array(
			'attrs' => 'id="'. $this->widget->get_field_id('display_as_img'). '"',
			'checked' => isset($this->data['display_as_img']),
		));
	?>
	<label for="<?php echo $this->widget->get_field_id('display_as_img')?>"><?php _e('Display as image', GMP_LANG_CODE)?></label><br />
	<i><?php _e('Map will be displayed as image at sidebar, on click - will be opened in popup', GMP_LANG_CODE)?></i><br />
	<div class="gmpWidgetSuboptions" id="<?php echo $this->widget->get_field_id('img_params_shell')?>" style="display: none;">
		<label for="<?php echo $this->widget->get_field_id('img_width')?>"><?php _e('Image width (in px)', GMP_LANG_CODE)?>:</label>
		<?php
		echo htmlGmp::text($this->widget->get_field_name('img_width'), array(
			'attrs' => 'id="'. $this->widget->get_field_id('img_width'). '"',
			'value' => $this->data['img_width'],
		));
		?><br />
		<label for="<?php echo $this->widget->get_field_id('img_height')?>"><?php _e('Image height (in px)', GMP_LANG_CODE)?>:</label>
		<?php
		echo htmlGmp::text($this->widget->get_field_name('img_height'), array(
			'attrs' => 'id="'. $this->widget->get_field_id('img_height'). '"',
			'value' => $this->data['img_height'],
		));
		?><br />
		<script type="text/javascript">
			// <!--
			jQuery(function(){
				function checkOpenImgParams() {
					if(jQuery('#<?php echo $this->widget->get_field_id('display_as_img')?>').attr('checked')) {
						jQuery('#<?php echo $this->widget->get_field_id('img_params_shell')?>').show();
					} else {
						jQuery('#<?php echo $this->widget->get_field_id('img_params_shell')?>').hide();
					}
				}
				checkOpenImgParams();
				jQuery('#<?php echo $this->widget->get_field_id('display_as_img')?>').change(function(){
					checkOpenImgParams();
				});
			});
			// -->
		</script>
	</div>
</div>