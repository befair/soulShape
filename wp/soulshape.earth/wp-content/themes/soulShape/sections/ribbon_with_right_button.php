<?php
/**
 *	The template for dispalying the Ribbon With Right Button section.
 *
 *	@package WordPress
 *	@subpackage rise-lite
 */
?>
<?php
$rise_lite_ribbonbottom_text = get_theme_mod( 'rise_lite_ribbonbottom_text', __( 'Use these ribbons to display calls to action mid-page.', 'rise-lite' ) );
if( !empty( $rise_lite_ribbonbottom_text ) ):
	$rise_lite_ribbonbottom_buttonlabel = get_theme_mod( 'rise_lite_ribbonbottom_buttonlabel', __( 'Button', 'rise-lite' ) );
	$rise_lite_ribbonbottom_buttonlink = get_theme_mod( 'rise_lite_ribbonbottom_buttonlink', esc_url( '#' ) );

	if( !empty( $rise_lite_ribbonbottom_buttonlabel ) && !empty( $rise_lite_ribbonbottom_buttonlink ) ):
		echo '<section class="purchase-now">';
	else:
		echo '<section class="purchase-now ribbon-without-button">';
	endif;

		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-md-12" data-scrollreveal="enter left after 0s over 1s">';
					echo '<h3 class="white-text">';
						echo esc_html( $rise_lite_ribbonbottom_text );
					echo '</h3>';	
				echo '</div>';
				if( !empty( $rise_lite_ribbonbottom_buttonlabel ) && !empty( $rise_lite_ribbonbottom_buttonlink ) ):
					echo '<div class="col-md-12" data-scrollreveal="enter right after 0s over 1s">';
						echo '<a href="'. esc_url( $rise_lite_ribbonbottom_buttonlink ) .'" class="btn btn-primary custom-button red-btn">'. esc_attr( $rise_lite_ribbonbottom_buttonlabel ) .'</a>';
					echo '</div>';
				endif;
			echo '</div>';
		echo '</div>';
	echo '</section>';	
endif;
?>