<?php
/**
 *	The template for displaying the Ribbon With Bottom Button section.
 *
 *	@package WordPress
 *	@subpackage rise-lite
 */
?>
<?php
$rise_lite_leftribbon_text = get_theme_mod( 'rise_lite_leftribbon_text', __( 'Check out this cool parallax scrolling effect. Plus, you can change the background image.', 'rise-lite' ) );
if( !empty($rise_lite_leftribbon_text) ):
	echo '<section class="separator-one">';
		echo '<div class="color-overlay">';
			echo '<div class="container">';
				$rise_lite_leftribbon_buttonlabel = get_theme_mod( 'rise_lite_leftribbon_buttonlabel', __( 'Button', 'rise-lite' ) );
				$rise_lite_leftribbon_buttonlink = get_theme_mod( 'rise_lite_leftribbon_buttonlink', esc_url( '#' ) );
				if( !empty( $rise_lite_leftribbon_buttonlabel ) && !empty( $rise_lite_leftribbon_buttonlink ) ):
					echo '<div class="button-box" data-scrollreveal="enter right after 0s over 1s">';
						echo '<a href="'. esc_url( $rise_lite_leftribbon_buttonlink ) .'" class="child-btn btn btn-primary custom-button green-btn">'. esc_html( $rise_lite_leftribbon_buttonlabel ) .'</a>';
					echo '</div><!--/.button-box-->';
				endif;

				if( $rise_lite_leftribbon_text ) {
					echo '<div class="separator-description">';
						echo esc_html( $rise_lite_leftribbon_text );
					echo '</div><!--/.separator-description-->';
				}
			echo '</div><!--/.container-->';
		echo '</div>';
	echo '</section>';	
endif;
?>