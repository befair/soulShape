<h3><?php _e('Permalinks','xoousers'); ?></h3>
<form method="post" action="">
<input type="hidden" name="update_settings" />
<input type="hidden" name="update_uultra_slugs"  value="uultra_slugs"/>
<?php wp_nonce_field( 'update_settings', 'uultra_nonce_check' ); ?>



<div class="user-ultra-sect ">
  <h3><?php _e('Users Ultra Pages Setting','xoousers'); ?></h3>
  
  <p><?php _e('The following pages are automatically created when Users Ultra Plugin
   is activated. You can leave them as they are or change to custom pages here.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 


$this->create_plugin_setting(
            'select',
            'xoousersultra_my_account_page',
            __('Users Ultra My Account','xoousers'),
            $this->get_all_sytem_pages(),
            __('Make sure you have the <code>[usersultra_my_account]</code> shortcode on this page.','xoousers'),
            __('This page is where users will view their account.','xoousers')
    );
	
    $this->create_plugin_setting(
            'select',
            'profile_page_id',
            __('Users Ultra Profile Page','xoousers'),
            $this->get_all_sytem_pages(),
            __('Make sure you have the <code>[usersultra_profile]</code> shortcode on this page.','xoousers'),
            __('This page is where users will view their own profiles, or view other user profiles from the member directory if allowed.','xoousers')
    );
    
    $this->create_plugin_setting(
            'select',
            'login_page_id',
            __('Users Ultra Login Page','xoousers'),
            $this->get_all_sytem_pages(),
            __('If you wish to change default Users Ultra login page, you may set it here. Make sure you have the <code>[usersultra_login]</code> shortcode on this page.','xoousers'),
            __('The default front-end login page.','xoousers')
    );
    
    $this->create_plugin_setting(
            'select',
            'registration_page_id',
            __('Users Ultra Registration Page','xoousers'),
            $this->get_all_sytem_pages(),
            __('Make sure you have the <code>[usersultra_registration]</code> shortcode on this page.','xoousers'),
            __('The default front-end Registration page where new users will sign up.','xoousers')
    );
	
	$this->create_plugin_setting(
            'select',
            'directory_page_id',
            __('Users Ultra Directory Page','xoousers'),
            $this->get_all_sytem_pages(),
            __('Make sure you have the <code>[usersultra_directory]</code> shortcode on this page.','xoousers'),
            __('The default front-end Registration page where new users will sign up.','xoousers')
    );
	
	
	 
    
    
?>
</table>

  
</div>



<div class="user-ultra-sect ">
  <h3><?php _e('Users Ultra offers you the ability to create a custom URL structure for the main pages of your website','xoousers'); ?></h3>
  
  
  <table class="form-table">
<?php 

$this->create_plugin_setting(
        'input',
        'usersultra_slug',
        __('Profile Slug','xoousers'),array(),
        __('Enter your custom Slug for the profile page.','xoousers'),
        __('Enter your custom Slug for the profile page.','xoousers')
);



$this->create_plugin_setting(
	'select',
	'usersultra_permalink_type',
	__('Profile Link Field','xoousers'),
	array(
	    'ID' => __('The Profile Link is built by using the User ID','xoousers'),
		'username' => __('The Profile Link is built by using the Username','xoousers'), 
		
		),
		
	__('Please note: This option is used for permalinks. You can choice what field will be used in the Users Profile Link','xoousers'),
  __('Please note: This option is used for permalinks. You can choice what field will be used in the Users Profile Link','xoousers')
       );
    

$this->create_plugin_setting(
        'input',
        'usersultra_login_slug',
        __('Login Slug','xoousers'),array(),
        __('Enter your custom Slug for the Login Page.','xoousers'),
        __('Enter your custom Slug for the Login Page.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'usersultra_registration_slug',
        __('Registration Slug','xoousers'),array(),
        __('Enter your custom Slug for the Registration Page.','xoousers'),
        __('Enter your custom Slug for the Registration Page.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'usersultra_my_account_slug',
        __('My Account Slug','xoousers'),array(),
        __('Enter your custom Slug for the "My Account" Page.','xoousers'),
        __('Enter your custom Slug for the "My Account" Page.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'usersultra_directory_slug',
        __('Users Directory Slug','xoousers'),array(),
        __('Enter your custom Slug for the Users Directory Page.','xoousers'),
        __('Enter your custom Slug for the Users Directory Page.','xoousers')
);

		
?>
</table>

  
</div>


<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes','xoousers'); ?>"  />
	
</p>

</form>