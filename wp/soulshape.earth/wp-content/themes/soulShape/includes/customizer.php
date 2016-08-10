<?php
/**
 *	Customizer
 */
if( !function_exists( 'rise_lite_customizer' ) ) {
	add_action( 'customize_register', 'rise_lite_customizer', 50 );
	function rise_lite_customizer( $wp_customize ) {
		// Remove Section
		$wp_customize->remove_section( 'zerif_bottomribbon_section' );
		$wp_customize->remove_section( 'zerif_rightribbon_section' );

		// Remove Setting & Control
		$wp_customize->remove_setting( 'zerif_logo' );
		$wp_customize->remove_control( 'zerif_logo' );
		$wp_customize->remove_setting( 'zerif_bigtitle_redbutton_label' );
		$wp_customize->remove_control( 'zerif_bigtitle_redbutton_label' );
		$wp_customize->remove_setting( 'zerif_bigtitle_redbutton_url' );
		$wp_customize->remove_control( 'zerif_bigtitle_redbutton_url' );
		$wp_customize->remove_setting( 'zerif_bigtitle_greenbutton_label' );
		$wp_customize->remove_control( 'zerif_bigtitle_greenbutton_label' );
		$wp_customize->remove_setting( 'zerif_bigtitle_greenbutton_url' );
		$wp_customize->remove_control( 'zerif_bigtitle_greenbutton_url' );
		$wp_customize->remove_setting( 'zerif_email_icon' );
		$wp_customize->remove_control( 'zerif_email_icon' );
		$wp_customize->remove_setting( 'zerif_phone_icon' );
		$wp_customize->remove_control( 'zerif_phone_icon' );
		$wp_customize->remove_setting( 'zerif_address_icon' );
		$wp_customize->remove_control( 'zerif_address_icon' );

		// Change homepage CTA
		$wp_customize->get_setting('zerif_bigtitle_title')->default = esc_html__( 'BUSINESS ONE PAGE WORDPRESS THEME', 'rise-lite' );

		// Remove controls and settings for Pro Version 
		$wp_customize->remove_setting( 'zerif_testimonials_quote' );
		$wp_customize->remove_control( 'zerif_testimonials_quote' );

		//Change colors for Pro Version
		$wp_customize->get_setting( 'zerif_aboutus_background' )->default = esc_html__('#c23c3c', 'rise-lite');
		$wp_customize->get_setting( 'zerif_testimonials_box_color' )->default = esc_html__('#0f1e2d', 'rise-lite');
		$wp_customize->get_setting( 'zerif_testimonials_background' )->default = esc_html__('#0f1e2d', 'rise-lite');
		$wp_customize->get_setting( 'zerif_testimonials_text' )->default = esc_html__('#fff', 'rise-lite');
		$wp_customize->get_setting( 'zerif_testimonials_author' )->default = esc_html__('#fff', 'rise-lite');

		$wp_customize->get_setting( 'zerif_ribbonright_background' )->default = esc_html__('rgba(212, 153, 17, 0.82)', 'rise-lite');
		$wp_customize->get_setting( 'zerif_ribbonright_button_background' )->default = esc_html__('#fff', 'rise-lite');
		$wp_customize->get_setting( 'zerif_ribbonright_button_background_hover' )->default = esc_html__('rgba(255, 255, 255, 0.9)', 'rise-lite');
		$wp_customize->get_setting( 'zerif_ribbonright_button_button_color' )->default = esc_html__('#d39c1b', 'rise-lite');
		$wp_customize->get_setting( 'zerif_ribbonright_button_button_color_hover' )->default = esc_html__('#d39c1b', 'rise-lite');
		
		$wp_customize->get_setting( 'zerif_footer_background' )->default = esc_html__('rgba(20, 31, 51,.9)', 'rise-lite');
		$wp_customize->get_setting( 'zerif_contacus_background' )->default = esc_html__('rgba(20, 31, 51,.9)', 'rise-lite');
		// $wp_customize->get_setting( 'zerif_ribbonright_button_button_color_hover' )->default = esc_html__('#d39c1b', 'rise-lite');
		// $wp_customize->get_setting( 'zerif_ribbonright_button_button_color_hover' )->default = esc_html__('#d39c1b', 'rise-lite');

		// Logo
		$wp_customize->add_setting( 'rise_lite_logo', array( 'sanitize_callback' => 'esc_url_raw', 'default' => get_stylesheet_directory_uri() . '/assets/images/logo.png' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rise_lite_logo', array(
			'label'		=> __( 'Logo', 'rise-lite' ),
			'section'	=> 'title_tagline',
			'settings'	=> 'rise_lite_logo',
			'priority'	=> 1,
		)));

		// Yellow Button Label
		$wp_customize->add_setting( 'rise_lite_bigtitle_yellowbutton_label', array('sanitize_callback' => 'esc_html','default' => __('Features','rise-lite')));
		$wp_customize->add_control( 'rise_lite_bigtitle_yellowbutton_label', array(
			'label'    => __( 'Yellow button label', 'rise-lite' ),
			'section'  => 'zerif_bigtitle_section',
			'settings' => 'rise_lite_bigtitle_yellowbutton_label',
			'priority'    => 3,
		));

		// Yellow Button Label
		$wp_customize->add_setting( 'rise_lite_bigtitle_yellowbutton_url', array('sanitize_callback' => 'esc_url_raw','default' => esc_url( home_url( '/' ) ).'#focus'));
		$wp_customize->add_control( 'rise_lite_bigtitle_yellowbutton_url', array(
			'label'    => __( 'Yellow button link', 'rise-lite' ),
			'section'  => 'zerif_bigtitle_section',
			'settings' => 'rise_lite_bigtitle_yellowbutton_url',
			'priority'    => 4,
		));

		// Red Button Label
		$wp_customize->add_setting( 'rise_lite_bigtitle_redbutton_label', array('sanitize_callback' => 'esc_html','default' => __("What's inside",'rise-lite')));
		$wp_customize->add_control( 'rise_lite_bigtitle_redbutton_label', array(
			'label'    => __( 'Red button label', 'rise-lite' ),
			'section'  => 'zerif_bigtitle_section',
			'settings' => 'rise_lite_bigtitle_redbutton_label',
			'priority'    => 5,
		));

		// Red Button Link
		$wp_customize->add_setting( 'rise_lite_bigtitle_redbutton_url', array('sanitize_callback' => 'esc_url_raw','default' => esc_url( home_url( '/' ) ).'#focus'));
		$wp_customize->add_control( 'rise_lite_bigtitle_redbutton_url', array(
			'label'    => __( 'Green button link', 'rise-lite' ),
			'section'  => 'zerif_bigtitle_section',
			'settings' => 'rise_lite_bigtitle_redbutton_url',
			'priority'    => 6,
		));


		// LeftButton Ribbon Section
		$wp_customize->add_section( 'rise_lite_leftribbon_section' , array(
				'title'       => __( 'LeftButton Ribbon', 'rise-lite' ),
				'priority'    => 1,
				'panel'       => 'panel_ribbons'
		));
		
		// Button Text
		$wp_customize->add_setting( 'rise_lite_leftribbon_text', array(
			'sanitize_callback' => 'esc_html',
			'default'			=> __( 'Check out this cool parallax scrolling effect. Plus, you can change the background image.', 'rise-lite' )
		) );
		$wp_customize->add_control( 'rise_lite_leftribbon_text', array(
				'label'    => __( 'Text', 'rise-lite' ),
				'section'  => 'rise_lite_leftribbon_section',
				'settings' => 'rise_lite_leftribbon_text',
				'priority'    => 1,
		));

		// Button Label
		$wp_customize->add_setting( 'rise_lite_leftribbon_buttonlabel', array(
			'sanitize_callback' => 'esc_html',
			'default'			=> __( 'Button', 'rise-lite' )
		) );
		$wp_customize->add_control( 'rise_lite_leftribbon_buttonlabel', array(
				'label'    => __( 'Button label', 'rise-lite' ),
				'section'  => 'rise_lite_leftribbon_section',
				'settings' => 'rise_lite_leftribbon_buttonlabel',
				'priority'    => 2,
		));

		// Button Link
		$wp_customize->add_setting( 'rise_lite_leftribbon_buttonlink', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'			=> esc_url( '#' )
		) );
		$wp_customize->add_control( 'rise_lite_leftribbon_buttonlink', array(
				'label'    => __( 'Button link', 'rise-lite' ),
				'section'  => 'rise_lite_leftribbon_section',
				'settings' => 'rise_lite_leftribbon_buttonlink',
				'priority'    => 3,
		));


		// BottomButton Ribbon Section
		$wp_customize->add_section( 'rise_lite_bottomribbon_section' , array(
				'title'       => __( 'BottomButton Ribbon', 'rise-lite' ),
				'priority'    => 2,
				'panel'       => 'panel_ribbons'
		));

		// Text
		$wp_customize->add_setting( 'rise_lite_ribbonbottom_text', array(
			'sanitize_callback' => 'esc_html',
			'default'			=> __( 'Use these ribbons to display calls to action mid-page.', 'rise-lite' )
		) );
		$wp_customize->add_control( 'rise_lite_ribbonbottom_text', array(
				'label'    => __( 'Text', 'rise-lite' ),
				'section'  => 'rise_lite_bottomribbon_section',
				'settings' => 'rise_lite_ribbonbottom_text',
				'priority'    => 4,
		));

		// Button Label
		$wp_customize->add_setting( 'rise_lite_ribbonbottom_buttonlabel', array(
			'sanitize_callback' => 'esc_html',
			'default'			=> __( 'Button', 'rise-lite' )
		) );
		$wp_customize->add_control( 'rise_lite_ribbonbottom_buttonlabel', array(
				'label'    => __( 'Button label', 'rise-lite' ),
				'section'  => 'rise_lite_bottomribbon_section',
				'settings' => 'rise_lite_ribbonbottom_buttonlabel',
				'priority'    => 5,
		) );

		// Button Link
		$wp_customize->add_setting( 'rise_lite_ribbonbottom_buttonlink', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'			=> esc_url( '#' )
		) );
		$wp_customize->add_control( 'rise_lite_ribbonbottom_buttonlink', array(
				'label'    => __( 'Button link', 'rise-lite' ),
				'section'  => 'rise_lite_bottomribbon_section',
				'settings' => 'rise_lite_ribbonbottom_buttonlink',
				'priority'    => 6,
		) );

		// E-mail Icon
		$wp_customize->add_setting( 'rise_lite_email_icon', array(
			'sanitize_callback'	=> 'esc_url_raw',
			'default'			=> get_stylesheet_directory_uri() . '/assets/images/footer-email-icon.png'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rise_lite_email_icon', array(
			'label'		=> __( 'Email section - Icon', 'rise-lite' ),
			'section'	=> 'zerif_general_footer_section',
			'settings'	=> 'rise_lite_email_icon',
			'priority'	=> 9,
		) ) );

		// Telephone Number - Icon
		$wp_customize->add_setting( 'rise_lite_phone_icon', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'			=> get_stylesheet_directory_uri() . '/assets/images/footer-telephone-icon.png'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rise_lite_phone_icon', array(
			'label'		=> __( 'Phone number section - Icon', 'rise-lite' ),
			'section'	=> 'zerif_general_footer_section',
			'settings'	=> 'rise_lite_phone_icon',
			'priority'	=> 11,
		) ) );

		// Address - Icon
		$wp_customize->add_setting( 'zerif_rise_icon_address_icon', array(
			'sanitize_callback'	=> 'esc_url_raw',
			'default'			=> get_stylesheet_directory_uri() . '/assets/images/footer-address-icon.png'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zerif_rise_icon_address_icon', array(
			'label'		=> __( 'Address section - Icon', 'rise-lite' ),
			'section'	=> 'zerif_general_footer_section',
			'settings'	=> 'zerif_rise_icon_address_icon',
			'priority'	=> 13,
		)));
        ### Customed soulShape ###
        $wp_customize->add_panel( 'panel_ourfocus', array(
            'priority' => 32,
            'capability' => 'edit_theme_options',
            'title' => __( 'Problem section', 'zerif-lite' )
        ));

        $wp_customize->add_panel( 'panel_about', array(
            'priority' => 34,
            'capability' => 'edit_theme_options',
            'title' => __( 'Solution section', 'zerif-lite' )
        ));

        $wp_customize->add_panel( 'panel_ourteam', array(
            'priority' => 35,
            'capability' => 'edit_theme_options',
            'title' => __( 'Business section', 'zerif-lite' )
        ));
    
        $wp_customize->add_panel( 'panel_testimonials', array(
            'priority' => 36,
            'capability' => 'edit_theme_options',
            'title' => __( 'Map section', 'zerif-lite' )
        ));
	}
}
?>
