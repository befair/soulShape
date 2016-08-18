<h3><?php _e('General Settings','xoousers'); ?></h3>
<form method="post" action="">
<input type="hidden" name="update_settings" />

<?php wp_nonce_field( 'update_settings', 'uultra_nonce_check' ); ?>

<div class="user-ultra-sect ">
  <h3><?php _e('Miscellaneous  Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
$this->create_plugin_setting(
                'checkbox',
                'hide_admin_bar',
                __('Hide WP Admin Tool Bar','xoousers'),
                '1',
                __('If checked, User will not see the WP Admin Tool Bar','xoousers'),
                __('If checked, User will not see the WP Admin Tool Bar.','xoousers')
        ); 

$this->create_plugin_setting(
                'checkbox',
                'disable_default_lightbox',
                __('Disable Default Ligthbox','xoousers'),
                '1',
                __("If checked, the default lightbox files included in the plugin won't be loaded",'xoousers'),
                __("If checked, the default lightbox files included in the plugin won't be loaded",'xoousers')
        ); 
		

$this->create_plugin_setting(
                'checkbox',
                'uultra_allow_guest_rating',
                __('Allow Guests to use the rating system','xoousers'),
                '1',
                __('If checked, users will be able to leave rates without being logged in','xoousers'),
                __('If checked, User will not see the WP Admin Tool Bar.','xoousers')
        ); 
		
		
		$this->create_plugin_setting(
                'checkbox',
                'uultra_allow_guest_like',
                __('Allow Guests to like other users ','xoousers'),
                '1',
                __('If checked, users will be able to like users without being logged in','xoousers'),
                __('If checked, users will be able to like users without being logged in','xoousers')
        ); 
		
		

$this->create_plugin_setting(
	'select',
	'hide_user_navigator',
	__('Hide user dashboard navigator','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("If you select 'yes', the left side navigator bar on the user's dashboard will be removed",'xoousers'),
  __("If you select 'yes', the left side navigator bar on the user's dashboard will be removed",'xoousers')
       );
	   
		
		
		 $this->create_plugin_setting(
	'select',
	'uultra_delete_plugin_info_on_unistall',
	__('Delete Plugin Information from the Database','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("If you select 'yes', all the Users Ultra information will be deleted from the database. <strong>ATTENTION: This action can't be reverted. </strong>",'xoousers'),
  __("if you select 'yes', all the Users Ultra information will be deleted from the database.",'xoousers')
       );
		
		
		  $this->create_plugin_setting(
	'select',
	'uultra_rotation_fixer',
	__('Auto Rotation Fixer','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("If you select 'yes', Users Ultra will Automatically fix the rotation of JPEG images using PHP's EXIF extension, immediately after they are uploaded to the server. This is implemented for iPhone rotation issues",'xoousers'),
  __("If you select 'yes', Users Ultra will Automatically fix the rotation of JPEG images using PHP's EXIF extension, immediately after they are uploaded to the server. This is implemented for iPhone rotation issues",'xoousers')
       );
	   
	   $this->create_plugin_setting(
	'select',
	'uultra_override_avatar',
	__('Use Users Ultra Avatar','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__('If you select "yes", Users Ultra will override the default WordPress Avatar','xoousers'),
  __('If you select "yes", Users Ultra will override the default WordPress Avatar','xoousers')
       );
	   
	    $this->create_plugin_setting(
	'select',
	'uultra_auto_redirect_loggedin_user',
	__('Redirect Users To My Account - Login Page','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("If you select yes, the user will be redirected to the <strong>my account</strong> page when clicking on the <strong>login link</strong>. Otherwise, the user will see the standard login box. WARNING: Do not set it to 'yes' if you are using the login shortcode in WP side widgets.",'xoousers'),
  __("If you select yes, the user will be redirected to the my account page. Otherwise, the user will see the standard login box. WARNING: Do not set it to 'yes' if you are using the login shortcode in WP side widgets",'xoousers')
       );
	   
	 $this->create_plugin_setting(
	'select',
	'uultra_auto_redirect_loggedin_user_registration',
	__('Redirect Users To My Account - Registration Page','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("If you select yes, the user will be redirected to the <strong>my account</strong> page when clicking on the <strong>registration link</strong>. Otherwise, the user will see the standard login box. WARNING: Do not set it to 'yes' if you are using the registration shortcode in WP side widgets.",'xoousers'),
  __("If you select yes, the user will be redirected to the <strong>my account</strong> page when clicking on the <strong>registration link</strong>. Otherwise, the user will see the standard login box. WARNING: Do not set it to 'yes' if you are using the registration shortcode in WP side widgets.",'xoousers')
       );
		
		
?>
</table>

  
</div>


<div class="user-ultra-sect ">
  <h3><?php _e('Password Strength Settings','xoousers'); ?></h3>
  
  <p><?php _e("You can help protect your users' accounts by managing and monitoring the strength of their passwords.",'xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 

$this->create_plugin_setting(
        'input',
        'uultra_password_lenght',
        __('Minimum password length:','xoousers'),array(),
        __('By default a Password must be at least 7 characters long','xoousers'),
        __('By default a Password must be at least 7 characters long','xoousers')
);

   
$this->create_plugin_setting(
                'checkbox',
                'uultra_password_1_letter_1_number',
                __('Must contain at least one number and one letter','xoousers'),
                '1',
                __('The password must contain at least one number and one letter','xoousers'),
                __('The password must contain at least one number and one letter','xoousers')
        ); 

$this->create_plugin_setting(
                'checkbox',
                'uultra_password_one_uppercase',
                __('Must contain at least one upper case character','xoousers'),
                '1',
                __('The password must contain at least one upper case character','xoousers'),
                __('The password must contain at least one upper case character','xoousers')
        );

$this->create_plugin_setting(
                'checkbox',
                'uultra_password_one_lowercase',
                __('Must contain at least one lower case character','xoousers'),
                '1',
                __('The password must contain at least one lower case character','xoousers'),
                __('The password must contain at least one lowercase character','xoousers')
        );
		
		
?>
</table>

  
</div>

<div class="user-ultra-sect ">
  <h3><?php _e('Membership Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
$this->create_plugin_setting(
                'checkbox',
                'membership_display_selected_only',
                __('Display Only Selected Package','xoousers'),
                '1',
                __('If checked, Only the Selected package will be displayed in the payment form. <strong>PLEASE NOTE: </strong>This setting is used only if you are using the pricing tables feature.','xoousers'),
                __('If checked, Only the Selected package will be displayed in the payment form','xoousers')
        ); 
$this->create_plugin_setting(
        'input',
        'membership_display_zero',
        __('Text for free membership:','xoousers'),array(),
        __('This text will be displayed for the free membership rather than showing <strong>"$0.00"<strong>. Please input some text like: "Free"','xoousers'),
        __('This text will be displayed for the free membership rather than showing <strong>"$0.00"<strong>. Please input some text like:','xoousers')
);		
?>
</table>

  
</div>

<div class="user-ultra-sect ">
  <h3><?php _e('Media Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
		
$this->create_plugin_setting(
        'input',
        'media_uploading_folder',
        __('Upload Folder:','xoousers'),array(),
        __('This is the folder where the user photos will be stored in. Please make sure to assign 755 privileges to it. The default folder is <strong>usersultramedia</strong>','xoousers'),
        __('This is the folder where the user photos will be stored in. Please make sure to assign 755 privileges to it. The default folder is <strong>usersultramedia</strong>','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_photo_mini_width',
        __('Mini Thumbnail Width','xoousers'),array(),
        __('Set width in pixels','xoousers'),
        __('Set width in pixels','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_photo_mini_height',
        __('Mini Thumbnail Height','xoousers'),array(),
        __('Set Height in pixels','xoousers'),
        __('Set Height in pixels','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_photo_thumb_width',
        __('Thumbnail Width','xoousers'),array(),
        __('Set Width in pixels','xoousers'),
        __('Set Width in pixels','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_photo_thumb_height',
        __('Thumbnail Height','xoousers'),array(),
        __('Set Height in pixels','xoousers'),
        __('Set Height in pixels','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_photo_large_width',
        __('Large Photo Max Width','xoousers'),array(),
        __('Set Width in pixels','xoousers'),
        __('Set Width in pixels','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_photo_large_height',
        __('Large Photo Max Height','xoousers'),array(),
        __('Set Height in pixels','xoousers'),
        __('Set Height in pixels','xoousers')
);
		
?>
</table>

  
</div>

<div class="user-ultra-sect ">
  <h3><?php _e('Frontend Publishing  Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
		
$this->create_plugin_setting(
        'input',
        'uultra_front_publisher_default_amount',
        __('Max Posts Per User:','xoousers'),array(),
        __('Please set 9999 for unlimited posts. This value is used for free and general users','xoousers'),
        __('Please set 9999 for unlimited posts. This value is used for free and general users','xoousers')
);


 $this->create_plugin_setting(
                        'select',
                        'enable_post_edit',
                        __('Users can edit post?', 'xoousers'),
                        array(
                            'yes' => __('YES', 'xoousers'),
                            'no' => __('NO', 'xoousers'),
                            
                        ),
                        __('Users will be able to edit their own posts.', 'xoousers'),
                        __('Users will be able to edit their own posts.', 'xoousers')
                );


 $this->create_plugin_setting(
                        'select',
                        'enable_post_del',
                        __('User can delete post?', 'xoousers'),
                        array(
                            'yes' => __('YES', 'xoousers'),
                            'no' => __('NO', 'xoousers'),
                            
                        ),
                        __('Users will be able to delete their own posts.', 'xoousers'),
                        __('Users will be able to delete their own posts.', 'xoousers')
                );

$this->create_plugin_setting(
	'select',
	'uultra_front_publisher_default_status',
	__('Default Status','xoousers'),
	array(
		'pending' => __('Pending','xoousers'), 
		'publish' => __('Publish','xoousers'),
		),
		
	__('This is the status of the post when the users submit new posts through Users Ultra.','xoousers'),
  __('This is the status of the post when the users submit new posts through Users Ultra.','xoousers')
       );
	   
$this->create_plugin_setting(
	'select',
	'uultra_front_publisher_allows_category',
	__('Alows users to select category','xoousers'),
	array(
		'yes' => __('Yes','xoousers'), 
		'no' => __('No','xoousers'),
		),
		
	__('If "yes" authors will be able to select the category, if "no" is set the default category will be used to save the post.','xoousers'),
  __('If "yes" authors will be able to select the category, if "no" is set the default category will be used to save the post.','xoousers')
       );
	   
   $this->create_plugin_setting(
            'select',
            'uultra_front_publisher_default_category',
            __('Default Category','xoousers'),
            $this->get_all_sytem_cagegories(),
            __('The category if authors are not allowed to select a custom category.','xoousers'),
            __('The category if authors are not allowed to select a custom category.','xoousers')
    );

		
?>
</table>

  
</div>

<div class="user-ultra-sect ">
  <h3><?php _e('Terms & Conditions','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
		

$this->create_plugin_setting(
	'select',
	'uultra_terms_and_conditions',
	__('Allows Terms & Conditions Text Before Registration','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__('If you select "yes", users will have to accept terms and conditions when registering.','xoousers'),
  __('If you select "yes", users will have to accept terms and conditions when registering.','xoousers')
       );
	   
	   
	     $this->create_plugin_setting(
                                        'textarea',
                                        'uultra_terms_and_conditions_text',
                                        __('Terms & Conditions Text/HTML', 'xoousers'), array(),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers'),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers')
                                );



 $this->create_plugin_setting(
                                        'textarea',
                                        'uultra_terms_and_conditions_text_2',
                                        __('Terms & Conditions Text/HTML 2', 'xoousers'), array(),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers'),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers')
                                );
		 $this->create_plugin_setting(
                                        'textarea',
                                        'uultra_terms_and_conditions_text_3',
                                        __('Terms & Conditions Text/HTML 3', 'xoousers'), array(),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers'),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers')
                                );
		
		 $this->create_plugin_setting(
                                        'textarea',
                                        'uultra_terms_and_conditions_text_4',
                                        __('Terms & Conditions Text/HTML 4', 'xoousers'), array(),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers'),
                                        __('Enter text to display, example "I agree to the Terms & Conditions".', 'xoousers')
                                );
                                                    

                              

		
?>
</table>

  
</div>



<div class="user-ultra-sect ">
  <h3><?php _e('Avatar Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
		
$this->create_plugin_setting(
        'input',
        'media_avatar_width',
        __('Avatar Width:','xoousers'),array(),
        __('Set width in pixels','xoousers'),
        __('Set width in pixels','xoousers')
);

$this->create_plugin_setting(
        'input',
        'media_avatar_height',
        __('Avatar Height','xoousers'),array(),
        __('Set Height in pixels','xoousers'),
        __('Set Height in pixels','xoousers')
);

		
?>
</table>

  
</div>


<div class="user-ultra-sect ">
  <h3><?php _e('Mailchimp Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
		
$this->create_plugin_setting(
        'input',
        'mailchimp_api',
        __('MailChimp API Key','xoousers'),array(),
        __('Fill out this field with your MailChimp API key here to allow integration with MailChimp subscription.','xoousers'),
        __('Fill out this field with your MailChimp API key here to allow integration with MailChimp subscription.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'mailchimp_list_id',
        __('MailChimp List ID','xoousers'),array(),
        __('Fill out this field your list ID.','xoousers'),
        __('Fill out this field your list ID.','xoousers')
);

$this->create_plugin_setting(
                'checkbox',
                'mailchimp_active',
                __('Activate/Deactivate Mailchimp','xoousers'),
                '1',
                __('If checked, Users will be asked to subscribe through mailchimp','xoousers'),
                __('If checked, Users will be asked to subscribe through mailchimp','xoousers')
        );
$this->create_plugin_setting(
        'input',
        'mailchimp_text',
        __('MailChimp Text','xoousers'),array(),
        __('Please input the text that will appear when asking users to get periodical updates.','xoousers'),
        __('Please input the text that will appear when asking users to get periodical updates.','xoousers')
);


	$this->create_plugin_setting(
        'input',
        'mailchimp_header_text',
        __('MailChimp Header Text','xoousers'),array(),
        __('Please input the text that will appear as header when mailchip is active.','xoousers'),
        __('Please input the text that will appear as header when mailchip is active.','xoousers')
);

		
?>
</table>

  
</div>
<div class="user-ultra-sect ">
  <h3><?php _e('Registration Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 

$this->create_plugin_setting(
	'select',
	'registration_rules',
	__('Registration Type','xoousers'),
	array(
		1 => __('Login automatically after registration','xoousers'), 
		2 => __('E-mail Activation -  An confirmation link is sent to the user email','xoousers'),
		3 => __('Manually Activation - The admin approves the accounts manually','xoousers'),
		4 => __('Paid Activation - Enables the Membership Features','xoousers')),
		
	__('Please note: Paid Activation does not work with social connects at this moment.','xoousers'),
  __('Please note: Paid Activation does not work with social connects at this moment.','xoousers')
       );
	   
	   
	     $this->create_plugin_setting(
                        'select',
                        'social_login_activation_type',
                        __('Activate Accounts When Using Social', 'xoousers'),
                        array(
                            'yes' => __('YES', 'xoousers'),
                            'no' => __('NO', 'xoousers'),
                            
                        ),
                        __('If YES, the account will be activated automatically when using social login options. ', 'xoousers'),
                        __('If YES, the account will be activated automatically when using social login options. ', 'xoousers')
                );
	   
	   
	    // Captcha Plugin Selection Start
                $this->create_plugin_setting(
                        'select',
                        'captcha_plugin',
                        __('Captcha Plugin', 'xoousers'),
                        array(
                            'none' => __('None', 'xoousers'),
                           
                            'recaptcha' => __('reCaptcha', 'xoousers')
                        ),
                        __('By activating this setting reCaptcha will be displayed in the registration form. <br /> ', 'xoousers'),
                        __('If you are using a captcha that requires a plugin, you must install and activate the selected captcha plugin. Some captcha plugins require you to register a free account with them.', 'xoousers')
                );
// Captcha Plugin Selection End


 $this->create_plugin_setting(
                        'input',
                        'captcha_heading',
                        __('CAPTCHA Heading Text', 'xoousers'), array(),
                        __("By default the following heading is displayed when the captcha is activate 'Prove you're not a robot'. You can set your custom heading here", 'xoousers'),
                        __("By default the following heading is displayed when the captcha is activate 'Prove you're not a robot'. You can set your custom heading here", 'xoousers')
                );

                $this->create_plugin_setting(
                        'input',
                        'captcha_label',
                        __('CAPTCHA Field Label', 'xoousers'), array(),
                        __('Enter text which you want to show in form in front of CAPTCHA.', 'xoousers'),
                        __('Enter text which you want to show in form in front of CAPTCHA.', 'xoousers')
                );

                $this->create_plugin_setting(
                        'input',
                        'recaptcha_public_key',
                        __('reCaptcha Public Key', 'xoousers'), array(),
                        __('Enter your reCaptcha Public Key. You can sign up for a free reCaptcha account <a href="http://www.google.com/recaptcha" title="Get a reCaptcha Key" target="_blank">here</a>.', 'xoousers'),
                        __('Your reCaptcha keys are required to use reCaptcha. You can register your site for a free key on the Google reCaptcha page.', 'xoousers')
                );

                $this->create_plugin_setting(
                        'input',
                        'recaptcha_private_key',
                        __('reCaptcha Private Key', 'xoousers'), array(),
                        __('Enter your reCaptcha Private Key.', 'xoousers'),
                        __('Your reCaptcha kays are required to use reCaptcha. You can register your site for a free key on the Google reCaptcha page.', 'xoousers')
                );
				
				 $this->create_plugin_setting(
                        'textarea',
                        'msg_register_success',
                        __('Register success message', 'xoousers'),
                        null,
                        __('Show a text message when users complete the registration process.', 'xoousers'),
                        __('This message will be shown to users after registration is completed.', 'xoousers')
                );

                $this->create_plugin_setting(
                        'textarea',
                        'html_register_success_after',
                        __('Text/HTML below the Register Success message.', 'xoousers'),
                        null,
                        __('Show a text/HTML content under success message when users complete the registration process.', 'xoousers'),
                        __('This message will be shown to users under the success message after registration is completed.', 'xoousers')
                );
    
    
?>
</table>

  
</div>

<div class="user-ultra-sect ">
  <h3><?php _e('User Profiles Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 

$this->create_plugin_setting(
	'select',
	'uprofile_setting_display_name',
	__('Profile Display Name: ','xoousers'),
	array(
		'username' => __('Display User Name','xoousers'), 
		'display_name' => __('Use the Display Name set by the User in the Profile','xoousers')),
		
	__('Set how the users ultra will make the user name.','xoousers'),
  __('Set how the users ultra will make the user name.','xoousers')
       );

$this->create_plugin_setting(
	'select',
	'uurofile_setting_display_photos',
	__('Display Photos: ','xoousers'),
	array(
		'private' => __('Only for registered/logged in users','xoousers'), 
		'public' => __('All visitor can see the user photos without registration','xoousers')
		),
		
	__('Specify if the user photos are public or private','xoousers'),
  __('Specify if the user photos are public or private','xoousers')
       );
    
    
?>
</table>

  
</div>





<div class="user-ultra-sect ">
  <h3><?php _e('Social Media Settings','xoousers'); ?></h3>
  
  <p><?php _e('.','xoousers'); ?></p>
  
  
  <table class="form-table">
<?php 
   
   
$this->create_plugin_setting(
                'checkbox',
                'social_media_fb_active',
                __('Facebook Connect','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through Facebook.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through Facebook.','xoousers')
        );
		
$this->create_plugin_setting(
        'input',
        'social_media_facebook_app_id',
        __('Facebook App ID','xoousers'),array(),
        __('Obtained when you created the Facebook Application.','xoousers'),
        __('Obtained when you created the Facebook Application.','xoousers')
);



$this->create_plugin_setting(
        'input',
        'social_media_facebook_secret',
        __('Facebook App Secret','xoousers'),array(),
        __('Facebook settings','xoousers'),
        __('Obtained when you created the Facebook Application.','xoousers')
);

$this->create_plugin_setting(
                'checkbox',
                'social_media_linked_active',
                __('LinkedIn Connect','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through LinkedIn.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through LinkedIn.','xoousers')
        );
    
$this->create_plugin_setting(
        'input',
        'social_media_linkedin_api_public',
        __('LinkedIn API Key Public','xoousers'),array(),
        __('Obtained when you created your application.','xoousers'),
        __('Obtained when you created your application.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'social_media_linkedin_api_private',
        __('LinkedIn API Key Private','xoousers'),array(),
        __('<br><br> VERY IMPORTANT: Set OAuth 1.0 Accept Redirect URL to "?uultralinkedin=1". Example: http://yourdomain.com/?uultralinkedin=1','xoousers'),
        __('VERY IMPORTANT: Set OAuth 1.0 Accept Redirect URL to "?uultralinkedin=1','xoousers')
);  


$this->create_plugin_setting(
                'checkbox',
                'social_media_yahoo',
                __('Yahoo Sign up','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through Yahoo.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through Yahoo.','xoousers')
        );
$this->create_plugin_setting(
                'checkbox',
                'social_media_google',
                __('Google Sign up','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through Google.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through Google.','xoousers')
        ); 

$this->create_plugin_setting(
        'input',
        'google_client_id',
        __('Google Client ID','xoousers'),array(),
        __('Paste the client id that you got from google API Console','xoousers'),
        __('Paste the client id that you got from google API Console','xoousers')
);  

$this->create_plugin_setting(
        'input',
        'google_client_secret',
        __('Google Client Secret','xoousers'),array(),
        __('Set the client secret','xoousers'),
        __('Obtained when you created the Google Application.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'google_redirect_uri',
        __('Google Redirect URI','xoousers'),array(),
        __('Paste the redirect URI where you given in APi Console. You will get the Access Token here during login success. Find more information here https://developers.google.com/console/help/new/#console.  <br><br> VERY IMPORTANT: Your URL should end with "?uultraplus=1". Example: http://yourdomain.com/?uultraplus=1','xoousers'),
        __('Your URL should end with "?uultraplus=1". Example: http://yourdomain.com/?uultraplus=1','xoousers')
);

//instagram

$this->create_plugin_setting(
                'checkbox',
                'instagram_connect',
                __('Instagram Sign up','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through Instagram.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through Instagram.','xoousers')
        );
$this->create_plugin_setting(
        'input',
        'instagram_client_id',
        __('Instagram Client ID','xoousers'),array(),
        __('Paste the client id that you got from Instagram API Console','xoousers'),
        __('Obtained when you created your application.','xoousers')
);  

$this->create_plugin_setting(
        'input',
        'instagram_client_secret',
        __('Instagram Client Secret','xoousers'),array(),
        __('Set the client secret','xoousers'),
        __('Obtained when you created your application.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'instagram_redirect_uri',
        __('Instagram Redirect URI','xoousers'),array(),
        __('Paste the redirect URI where you given in APi Console. You will get the Client ID and Client Secret here http://instagram.com/developer/clients/register/#. <br><br> VERY IMPORTANT: Your Redirect URI should end with "?instagram=1". Example: http://yourdomain.com/?instagram=1','xoousers'),
        __('Paste the redirect URI where you given in APi Console. You will get the Access Token here during login success. ','xoousers')
);



/// add to array
$this->create_plugin_setting(
                'checkbox',
                'twitter_connect',
                __('Twitter Sign up','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through Twitter.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through Twitter.','xoousers')
        );
		

$this->create_plugin_setting(
        'input',
        'twitter_consumer_key',
        __('Consumer Key','xoousers'),array(),
        __('Paste the Consumer Key','xoousers'),
        __('Obtained when you created your Application at Twitter Developer Center','xoousers')
);  

$this->create_plugin_setting(
        'input',
        'twitter_consumer_secret',
        __('Consumer Secret','xoousers'),array(),
        __('Paste the Consumer Secret','xoousers'),
        __('Obtained when you created your Applicatoin at Twitter Developer Center','xoousers')
);

$this->create_plugin_setting(
                'checkbox',
                'twitter_autopost',
                __('Twitter Auto Post','xoousers'),
                '1',
                __('If checked, Users Ultra will post a message automatically to the user twitter timeline when registering.','xoousers'),
                __('If checked, Users Ultra will post a message automatically to the user twitter timeline when registering.','xoousers','xoousers')
        );

$this->create_plugin_setting(
        'input',
        'twitter_autopost_msg',
        __('Message','xoousers'),array(),
        __('Input the message that will be posted right after user registration','xoousers'),
        __('Input the message that will be posted right after user registration','xoousers')
);		
/// yammer
$this->create_plugin_setting(
                'checkbox',
                'yammer_connect',
                __('Yammer Sign up','xoousers'),
                '1',
                __('If checked, User will be able to Sign up & Sign in through Yammer.','xoousers'),
                __('If checked, User will be able to Sign up & Sign in through Yammer.','xoousers')
        );
		

$this->create_plugin_setting(
        'input',
        'yammer_client_id',
        __('Client Id','xoousers'),array(),
        __('Paste the Yammer Client ID','xoousers'),
        __('The same used when you signed up.','xoousers')
);  

$this->create_plugin_setting(
        'input',
        'yammer_client_secret',
        __('Client Secret','xoousers'),array(),
        __('Paste the Yammer Client Secret','xoousers'),
        __('Obtained at Yammer developer center.','xoousers')
);

$this->create_plugin_setting(
        'input',
        'yammer_redir_url',
        __('Redirect URL','xoousers'),array(),
        __('Paste the Yammer Client Secret','xoousers'),
        __('<br><br> VERY IMPORTANT: Your URL should end with "?uultryammer=1". Example: http://yourdomain.com/?uultryammer=1','xoousers')
);


		
?>
</table>

  
</div>

<div class="user-ultra-sect ">
  <h3><?php _e("Logged In Users Pages and Posts Protection Settings",'xoousers'); ?></h3>
  
  <p><?php _e("In this section you can manage Posts & Pages Protection module settings.",'xoousers'); ?></p>
   <p><?php _e("This module will let you block pages and any post types and make them visible only to logged in users.",'xoousers'); ?></p>
  
  
   <h4><?php _e("Set up the behaviour of locked posts.",'xoousers'); ?></h4>
  <table class="form-table">
<?php 


$this->create_plugin_setting(
                'checkbox',
                'uultra_loggedin_activated',
                __('Activate Logged in Post Protection','xoousers'),
                '1',
                __('If checked, You will be able to protect pages and post bassed on logged in users.','xoousers'),
                __('If checked, You will be able to protect pages and post bassed on logged in users.','xoousers')
        ); 


$this->create_plugin_setting(
	'select',
	'uultra_loggedin_hide_complete_post',
	__('Hide Complete Posts?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will hide posts if the user has no access. <strong>Please note: </strong> a 404 error message will be displayed since the post will be completely locked out.",'xoousers'),
  __("By selecting 'yes' will hide posts if the user has no access. Please note: a 404 error message will be displayed since the post will be completely locked out.",'xoousers')
       );

$this->create_plugin_setting(
	'select',
	'uultra_loggedin_hide_post_title',
	__('Hide Post Title?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will show the text which is defined at 'Post title' if user has no access.",'xoousers'),
  __("By selecting 'yes' will show the text which is defined at 'Post title' if user has no access.",'xoousers')
       );
	   
$this->create_plugin_setting( 
        'input',
        'uultra_loggedin_post_title',
        __('Post Title:','xoousers'),array(),
        __('This will be the displayed text as post title if user has no access.','xoousers'),
        __('This will be the displayed text as post title if user has no access.','xoousers')
);  


$this->create_plugin_setting(
	'select',
	'uultra_loggedin_post_content_before_more',
	__('Show post content before &lt;!--more--&gt; tag?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__('By selecting "Yes"  will display the post content before the &lt;!--more--&gt; tag and after that the defined text at "Post content". If no &lt;!--more--&gt;  is set he defined text at "Post content" will shown.','xoousers'),
  __('By selecting "Yes"  will display the post content before the &lt;!--more--&gt; tag and after that the defined text at "Post content". If no &lt;!--more--&gt;  is set he defined text at "Post content" will shown.','xoousers')
       );


$this->create_plugin_setting(
        'textarea',
        'uultra_loggedin_post_content',
        __('Post Content','xoousers'),array(),
        __('This content will be displayed if user has no access. ','xoousers'),
        __('This content will be displayed if user has no access. ','xoousers')
);


$this->create_plugin_setting(
	'select',
	'uultra_loggedin_hide_post_comments',
	__('Hide Post Comments?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will show the text which is defined at 'Post comment text' if user has no access.",'xoousers'),
  __("By selecting 'yes' will show the text which is defined at 'Post comment text' if user has no access.",'xoousers')
       );
	  
$this->create_plugin_setting( 
        'input',
        'uultra_loggedin_post_comment_content',
        __('Post Comment Text:','xoousers'),array(),
        __('This will be displayed text as post comment text if user has no access.','xoousers'),
        __('This will be displayed text as post comment text if user has no access.','xoousers')
);  
$this->create_plugin_setting(
	'select',
	'uultra_loggedin_allow_post_comments',
	__('Allows Post Comments?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' allows users to comment on locked posts",'xoousers'),
  __("By selecting 'yes' allows users to comment on locked posts",'xoousers')
       );	  
		
?>
</table>


   <h4><?php _e("Set up the behaviour of locked pages.",'xoousers'); ?></h4>
  <table class="form-table">
<?php 


$this->create_plugin_setting(
	'select',
	'uultra_loggedin_hide_complete_page',
	__('Hide Complete Pages?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will hide pages if the user has no access. <strong>Please note: </strong> a 404 error message will be displayed since the page will be completely locked out.",'xoousers'),
  __("By selecting 'yes' will hide pages if the user has no access",'xoousers')
       );

$this->create_plugin_setting(
	'select',
	'uultra_loggedin_hide_page_title',
	__('Hide Page Title?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will show the text which is defined at 'Page title' if user has no access.",'xoousers'),
  __("By selecting 'yes' will show the text which is defined at 'Page title' if user has no access.",'xoousers')
       );
	   
$this->create_plugin_setting( 
        'input',
        'uultra_loggedin_page_title',
        __('Page Title:','xoousers'),array(),
        __('This will be the displayed text as page title if user has no access.','xoousers'),
        __('This will be the displayed text as page title if user has no access.','xoousers')
);  


$this->create_plugin_setting(
        'textarea',
        'uultra_loggedin_page_content',
        __('Page Content','xoousers'),array(),
        __('This content will be displayed if user has no access. ','xoousers'),
        __('This content will be displayed if user has no access. ','xoousers')
);


$this->create_plugin_setting(
	'select',
	'uultra_loggedin_hide_page_comments',
	__('Hide Page Comments?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will show the text which is defined at 'Page comment text' if user has no access.",'xoousers'),
  __("By selecting 'yes' will show the text which is defined at 'Page comment text' if user has no access.",'xoousers')
       );
	  
	  
	  	  
$this->create_plugin_setting( 
        'input',
        'uultra_loggedin_page_comment_content',
        __('Page Comment Text:','xoousers'),array(),
        __('This will be displayed text as page comment text if user has no access.','xoousers'),
        __('This will be displayed text as page comment text if user has no access.','xoousers')
);  
$this->create_plugin_setting(
	'select',
	'uultra_loggedin_allow_page_comments',
	__('Allows Page Comments?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' allows users to comment on locked pages",'xoousers'),
  __("By selecting 'yes' allows users to comment on locked pages",'xoousers')
       );	 
  
		
?>
</table>

<h4><?php _e("Other Settings.",'xoousers'); ?></h4>
  <table class="form-table">
<?php 



$this->create_plugin_setting(
	'select',
	'uultra_loggedin_protect_feed',
	__('Hide Post Title?','xoousers'),
	array(
		'no' => __('No','xoousers'), 
		'yes' => __('Yes','xoousers'),
		),
		
	__("By selecting 'yes' will show the text which is defined at 'Post title' if user has no access.",'xoousers'),
  __("By selecting 'yes' will show the text which is defined at 'Post title' if user has no access.",'xoousers')
       );
	   
  
		
?>
</table>
  
</div>


<div class="user-ultra-sect ">
 <h3><?php _e('Redirect Settings','xoousers'); ?></h3>

  <p><?php _e('.','xoousers'); ?></p>



<table class="form-table">
    <?php 
        $this->create_plugin_setting(
                'checkbox',
                'redirect_backend_profile',
                __('Redirect Backend Profiles','xoousers'),
                '1',
                __('If checked, non-admin users who try to access backend WP profiles will be redirected to Users Ultra Profile Page specified above.','xoousers'),
                __('Checking this option will send all users to the front-end Users Ultra Profile Page if they try to access the default backend profile page in wp-admin. The page can be selected in the Users Ultra System Pages settings.','xoousers')
        );
        
        $this->create_plugin_setting(
                'checkbox',
                'redirect_backend_login',
                __('Redirect Backend Login','xoousers'),
                '1',
                __('If checked, non-admin users who try to access backend login form will be redirected to the front end Users Ultra Login Page specified above.','xoousers'),
                __('Checking this option will send all users to the front-end Users Ultra Login Page if they try to access the default backend login form. The page can be selected in the Users Ultra System Pages settings.','xoousers')
        );
        
        $this->create_plugin_setting(
                'checkbox',
                'redirect_backend_registration',
                __('Redirect Backend Registrations','xoousers'),
                '1',
                __('If checked, non-admin users who try to access backend registration form will be redirected to the front end Users Ultra Registration Page specified above.','xoousers'),
                __('Checking this option will send all users to the front-end Users Ultra Registration Page if they try to access the default backend registraiton form. The page can be selected in the Users Ultra System Pages settings.','xoousers')
        );
		
		
		    $this->create_plugin_setting(
            'select',
            'redirect_after_registration_login',
            __('After Registration','xoousers'),
            $this->get_all_sytem_pages(),
            __('The user will be taken to this page after registration if the account activation is set to automatic ','xoousers'),
            __('The user will be taken to this page after registration if the account activation is set to automatic','xoousers')
    );
        
    ?>
</table>

</div>

<h3><?php _e('Registration Options','xoousers'); ?></h3>
<table class="form-table">

<?php

$this->create_plugin_setting(
	'select',
	'set_password',
	__('User Selected Passwords','xoousers'),
	array(
		1 => __('Enabled, allow users to set password','xoousers'), 
		0 => __('Disabled, email a random password to users','xoousers')),
	__('Enable/disable setting a user selected password at registration','xoousers'),
  __('If enabled, users can choose their own password at registration. If disabled, WordPress will email users a random password when they register.','xoousers')
        );
		
				
		$this->create_plugin_setting(
	'select',
	'set_password_retype',
	__('User Forced to retype Email?','xoousers'),
	array(
		'yes' => __('Yes','xoousers'), 
		'no' => __('No','xoousers'),
		),
		
	__("By selecting 'yes' the users will forced to re-type the email.",'xoousers'),
  __("By selecting 'yes'  the users will forced to re-type the email.",'xoousers')
       );
		

?>

</table>

<h3><?php _e('Privacy Options','xoousers'); ?></h3>
<table class="form-table">

<?php

$this->create_plugin_setting(
	'select',
	'users_can_view',
	__('Logged-in user viewing of other profiles','xoousers'),
	array(
		1 => __('Enabled, logged-in users may view other user profiles','xoousers'), 
		0 => __('Disabled, users may only view their own profile','xoousers')),
	__('Enable or disable logged-in user viewing of other user profiles. Admin users can always view all profiles.','xoousers'),
  __('If enabled, logged-in users are allowed to view other user profiles. If disabled, logged-in users may only view their own profile.','xoousers')
        );

$this->create_plugin_setting(
	'select',
	'guests_can_view',
	__('Guests viewing of profiles','xoousers'),
	array(
		1 => __('Enabled, make profiles publicly visible','xoousers'), 
		0 => __('Disabled, users must login to view profiles','xoousers')),
	__('Enable or disable guest and non-logged in user viewing of profiles.','xoousers'),
  __('If enabled, profiles will be publicly visible to non-logged in users. If disabled, guests must log in to view profiles.','xoousers')
       );
	   
	   
	    $this->create_plugin_setting(
	'select',
	'uultra_display_not_confirmed_profiles',
	__('Display Inactive User Profiles','xoousers'),
	array(
		1 => __('Enabled, Yes. Display Inactive User Profils ','xoousers'), 
		0 => __('Disabled, Do Not Display Inactive User Profiles.','xoousers')),
	__('The user profiles are visible by default it does not matter if the user is active or not. You can switch this setting off here.','xoousers'),
  __('The user profiles are visible by default it does not matter if the user is active or not. You can deactivate this function here.','xoousers')
       );
	   
	   
	   $this->create_plugin_setting(
        'textarea',
        'uultra_display_not_confirmed_profiles_message',
        __('Custom Message:','xoousers'),array(),
        __('This message will be displayed and a visitor is viwing an inactive profile. Example: The profile is not active, yet.','xoousers'),
        __('This message will be displayed and a visitor is viwing an inactive profile. Example: The profile is not active, yet. ','xoousers')
);

?>

</table>


<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes','xoousers'); ?>"  />
</p>

</form>