<?php
global $xoouserultra;
?>



<form method="post" action="">
<input type="hidden" name="update_settings" />
<?php wp_nonce_field( 'update_settings', 'uultra_nonce_check' ); ?>


<div class="user-ultra-sect ">
  <h3><?php _e('Customizer','xoousers'); ?></h3>
  
  <p><?php _e('Use this section to add custom CSS styles.','xoousers'); ?></p>
  
   <table class="form-table">
<?php 

$this->create_plugin_setting(
        'textarea',
        'xoousersultra_custom_css',
        __('Custom CSS Style','xoousers'),array(),
        __('You can write some custom CSS style coding here','xoousers'),
        __('You can write some custom CSS style coding here','xoousers')
);

?>
  
 
 </table>

  
</div>




<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes','xoousers'); ?>"  />

</p>

</form>

