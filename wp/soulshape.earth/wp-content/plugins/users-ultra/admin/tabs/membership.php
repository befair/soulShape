<?php
global $xoouserultra;
$currency_symbol =  $xoouserultra->get_option('paid_membership_symbol');

$ajax_nonce = wp_create_nonce( "uultra-nonce-check-db-az-346" );
?>

<form method="post" action="">
<input type="hidden" name="update_settings" />
<?php wp_nonce_field( 'update_settings', 'uultra_nonce_check' ); ?>


<div class="user-ultra-sect ">
  <h3><?php _e('Paid Membership Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>  
  
  <table class="form-table">
<?php 
   
$this->create_plugin_setting(
        'input',
        'paid_membership_currency',
        __('Currency','xoousers'),array(),
        __('The default symbol for PayPal payments is USD','xoousers'),
        __('The default symbol for PayPal payments is USD','xoousers')
);

$this->create_plugin_setting(
        'input',
        'paid_membership_symbol',
        __('Currency Symbol','xoousers'),array(),
        __('Input the currency symbol: Example: $','xoousers'),
        __('Input the currency symbol: Example: $','xoousers')
);


		
?>
</table>
<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes','xoousers'); ?>"  />

</p>
</div>

  </form> 
        
        <div class="user-ultra-sect ">
        
        <h3> <?php _e('Membership Packages','xoousers'); ?></h3>
        
        <p>
        <a href="#" class="button-primary uultra-add-new-package" ><?php _e('Add New Plan','xoousers'); ?></a>
        </p>
        
        <div class="user-ultra-success uultra-notification"><?php _e('Sucess ','xoousers'); ?></div>
        
        <div class="user-ultra-sect-second user-ultra-rounded" id="uultra-add-package">
        
         <h3><?php _e('Add New Membership Package','xoousers'); ?></h3>
         
         <input type="hidden" id="uultra_wp_nonce" value="<?php echo $ajax_nonce?>"  />
         
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td width="24%"><?php _e('Name:','xoousers'); ?></td>
             <td width="76%"><input type="text" id="p_name"  /></td>
           </tr>
           <tr>
             <td> <?php _e('Description:','xoousers'); ?></td>
             <td> <textarea  cols=""  name="p_desc" id="p_desc" style="height:80px; width:50%;"></textarea></td>
           </tr>
           <tr>
             <td> <?php _e('Price:','xoousers'); ?></td>
             <td><input type="text" name="p_price" id="p_price" /></td>
           </tr>
           <tr>
             <td> <?php _e('Every:','xoousers'); ?></td>
             <td>
             <select name="p_every" id="p_every">
             <option value="1" selected="selected">1</option>
              <?php
			  
			  $i = 2;
              
			  while($i <=12){
			  ?>
              
                 <option value="<?php echo $i?>"><?php echo $i?></option>
               
               
               <?php 
			    $i++;
			   }?>
             </select></td>
           </tr>
           <tr>
             <td> <?php _e('Billing Period:','xoousers'); ?></td>
             <td><label for="p_period"></label>
               <select name="p_period" id="p_period">
                 <option value="M"> <?php _e('Months','xoousers'); ?></option>
                 <option value="W"> <?php _e('Weeks','xoousers'); ?></option>
                 <option value="D"><?php _e('Days','xoousers'); ?></option>
                  <option value="Y"><?php _e('Years','xoousers'); ?></option>
               </select></td>
           </tr>
           <tr>
             <td><?php _e('Type','xoousers'); ?></td>
             <td><select name="p_type" id="p_type">
               <option value="recurring" selected="selected"> <?php _e('Recurring','xoousers'); ?></option>
               <option value="onetime"> <?php _e('One-Time','xoousers'); ?></option>
             </select></td>
           </tr>
           <tr>
             <td> <?php _e('Requires Admin Moderation:','xoousers'); ?></td>
             <td><select name="p_moderation" id="p_moderation">
               <option value="yes"><?php _e('Yes','xoousers'); ?></option>
               <option value="no" selected="selected"><?php _e('No','xoousers'); ?></option>
             </select></td>
           </tr>
          </table>
          
            <h3><?php echo _e('Pricing Table Customization','xoousers')?></h3>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
                <td width="24%"> <?php echo _e('Name/Price Font Color','xoousers')?></td>
                <td width="76%"><input name="p_price_color" type="text" id="p_price_color" value="" class="color-picker" data-default-color=""/> 
         </td>
              </tr>
              <tr>
                <td> <?php echo _e('Name/Price Background Color','xoousers')?></td>
                <td><input name="p_price_bg_color" type="text" id="p_price_bg_color" value="" class="color-picker"  data-default-color="" /> 
               </td>
              </tr>
              
               <tr>
                <td> <?php echo _e('Sign Up Button Text Color','xoousers')?></td>
                <td><input name="p_signup_color" type="text" id="p_signup_color" value="" class="color-picker"  data-default-color="" /> 
               </td>
              </tr>
              
              <tr>
                <td> <?php echo _e('Sign Up Button Background Color','xoousers')?></td>
                <td><input name="p_signup_bg_color" type="text" id="p_signup_bg_color" value="" class="color-picker"  data-default-color="" /> 
               </td>
              </tr>
            
            </table>
          
          <p>
          <a href="#" class="button uultra-close-new-package" ><?php _e('Cancel','xoousers'); ?></a>
           <a href="#" class="button-primary uultra-add-new-package-confirm" ><?php _e('Confirm','xoousers'); ?></a>
        </p>
        </div>
        
        <div id="usersultra-data_list">
        
        <?php echo _e('loading ...','xoousers'); ?>
        
        </div>
        


        
        
        
        
        </div>
        
         <script type="text/javascript">		  
		 var package_error_message_name = "<?php _e('Please, input a name ','xoousers'); ?>";
		 var package_error_message_desc = "<?php _e('Please, input a description ','xoousers'); ?>";
		 var package_error_message_price = "<?php _e('Please, input a price ','xoousers'); ?>";
		  var package_confirmation = "<?php _e('Are you totally sure that you want to delete this package? ','xoousers'); ?>";		 
		 </script>
         
          <script type="text/javascript">
				jQuery(document).ready(function($){
               
					   $.post(ajaxurl, {
									action: 'get_packages_ajax'
									
									}, function (response){									
																
									$("#usersultra-data_list").html(response);
									
														
							});
							
					
				});
                    
                 </script>