<?php
/**
 *	The template for displaying the Big Title section.
 *
 *	@package WordPress
 *	@subpackage rise-lite
 */
?>
<div class="home-header-wrap">
<?php
$zerif_parallax_img1 = get_theme_mod( 'zerif_parallax_img1', get_template_directory_uri() . '/images/background1.jpg' );
$zerif_parallax_img2 = get_theme_mod( 'zerif_parallax_img2', get_template_directory_uri() . '/images/background2.png' );
$zerif_parallax_use = get_theme_mod( 'zerif_parallax_show' );

if ( $zerif_parallax_use == 1 && (!empty($zerif_parallax_img1) || !empty($zerif_parallax_img2)) ) {
	echo '<ul id="parallax_move">';
			if( !empty($zerif_parallax_img1) ) { 
			echo '<li class="layer layer1" data-depth="0.10" style="background-image: url(' . esc_url( $zerif_parallax_img1 ) . ');"></li>';
		}
		if( !empty($zerif_parallax_img2) ) { 
			echo '<li class="layer layer2" data-depth="0.20" style="background-image: url(' . esc_url( $zerif_parallax_img2 ) . ');"></li>';
		}

	echo '</ul>';
}
    $soulshape_videoback = get_theme_mod('soulshape_videoback');
    $soulshape_videoback_show = get_theme_mod('soulshape_videoback_show');

    if($soulshape_videoback_show && !empty($soulshape_videoback)):
?>
    <video id="homevideo" autoplay loop mute>
        <source src="<?php echo wp_get_attachment_url($soulshape_videoback); ?>" type="video/mp4">
    </video>
<?php
    endif;

echo '<div class="header-content-wrap">';
	echo '<div class="container">';
		$zerif_bigtitle_title = get_theme_mod( 'zerif_bigtitle_title',__('BUSINESS ONE PAGE WORDPRESS THEME', 'rise-lite' ) );
		if( !empty($zerif_bigtitle_title) ):
			echo '<h1 class="intro-text">'. esc_html( $zerif_bigtitle_title ) .'</h1>';
		endif;

		$rise_lite_bigtitle_subtitle = get_theme_mod('rise_lite_bigtitle_subtitle',__('','rise-lite'));
        if(!empty($rise_lite_bigtitle_subtitle))
            echo '<p class="intro-text subtitle">'.esc_html($rise_lite_bigtitle_subtitle).'</p>';

		echo '<div class="big-title-separator"></div>';

		$rise_lite_bigtitle_yellowbutton_label = get_theme_mod('rise_lite_bigtitle_yellowbutton_label',__('Features','rise-lite'));
		$rise_lite_bigtitle_yellowbutton_url = get_theme_mod('rise_lite_bigtitle_yellowbutton_url', esc_url( home_url( '/' ) ).'#focus');
		$rise_lite_bigtitle_redbutton_label = get_theme_mod('rise_lite_bigtitle_redbutton_label',__("What's inside",'rise-lite'));
		$rise_lite_bigtitle_redbutton_url = get_theme_mod('rise_lite_bigtitle_redbutton_url',esc_url( home_url( '/' ) ).'#focus');

		if( (!empty($rise_lite_bigtitle_yellowbutton_label) && !empty($rise_lite_bigtitle_yellowbutton_url)) || (!empty($rise_lite_bigtitle_redbutton_label) && !empty($rise_lite_bigtitle_redbutton_url))):
			echo '<div class="buttons">';
				if ( !empty($rise_lite_bigtitle_yellowbutton_label) && !empty($rise_lite_bigtitle_yellowbutton_url) ):
					echo '<a href="'. esc_url( $rise_lite_bigtitle_yellowbutton_url ) .'" class="btn-child btn btn-primary custom-button yellow-btn">'. esc_html( $rise_lite_bigtitle_yellowbutton_label ) .'</a>';
				endif;
				if ( !empty($rise_lite_bigtitle_redbutton_label) && !empty($rise_lite_bigtitle_redbutton_url) ):
					echo '<a href="'. esc_url( $rise_lite_bigtitle_redbutton_url ) .'" class="btn-child btn btn-primary custom-button red-btn">'. esc_html( $rise_lite_bigtitle_redbutton_label ) .'</a>';
				endif;
			echo '</div>';
		endif;
	echo '</div><!--/.container-->';
echo '</div><!-- .header-content-wrap -->';
echo '<div class="clear"></div>';
?>
</div><!--/.home-header-wrap-->
