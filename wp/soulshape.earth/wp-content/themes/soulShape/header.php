<?php
/**
*	The header for our theme.
*
*	This is the template that displays all of the <head> section and everything up until <div id="content">
*
*	@link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
*	@package WordPress
*	@subpackage rise-lite
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/ie.css" type="text/css">
		<![endif]-->
		<?php
		if ( ! function_exists( '_wp_render_title_tag' ) ) :
			function zerif_old_render_title() {
				?>
				<title><?php wp_title( '-', true, 'right' ); ?></title>
				<?php
			}
			add_action( 'wp_head', 'zerif_old_render_title' );
		endif;
		wp_head();
		?>
	</head>

	<?php if(isset($_POST['scrollPosition'])): ?>
		<body <?php body_class(); ?> onLoad="window.scrollTo(0,<?php echo intval($_POST['scrollPosition']); ?>)">
	<?php else: ?>
		<body <?php body_class(); ?> >
	<?php endif; ?>

		<?php
		global $wp_customize;
		if(is_front_page() && !isset( $wp_customize ) && get_option( 'show_on_front' ) != 'page' ): 
		$zerif_disable_preloader = get_theme_mod('zerif_disable_preloader');
		if( isset($zerif_disable_preloader) && ($zerif_disable_preloader != 1)):
		echo '<div class="preloader">';
			echo '<div class="status">&nbsp;</div>';
		echo '</div><!--/.preloader-->';
		endif;	
		endif; ?>

		<div id="mobilebgfix">
			<div class="mobile-bg-fix-img-wrap">
				<div class="mobile-bg-fix-img"></div>
			</div><!--/.mobile-bg-fix-img-wrap-->
			<div class="mobile-bg-fix-whole-site">
				<header id="home" class="header">
					<div id="main-nav" class="navbar navbar-inverse bs-docs-nav" role="banner">
						<div class="container">
							<div class="navbar-header responsive-logo">
								<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
									<span class="sr-only"><?php _e( 'Toggle navigation', 'rise-lite' ); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button><!--/.navbar-toggle.collapsed-->
								<?php
								$rise_lite_logo = get_theme_mod( 'rise_lite_logo', get_stylesheet_directory_uri() . '/assets/images/logo.png' );

								if(isset( $rise_lite_logo ) &&  $rise_lite_logo  != ""):
									echo '<a href="'.esc_url( home_url( '/' ) ).'" class="navbar-brand">';
										echo '<img src="'. esc_url( $rise_lite_logo ) .'" alt="'. esc_attr( get_bloginfo('title') ) .'">';
									echo '</a>';
								else:
									echo '<a href="'. esc_url( home_url( '/' ) ) .'" class="navbar-brand">';

								if( file_exists( get_stylesheet_directory() . '/assets/images/logo.png' ) ):
									echo '<img src="'. get_stylesheet_directory_uri() . '/assets/images/logo.png" alt="'. esc_attr( get_bloginfo('title') ) .'">';
								else:
									echo '<img src="'. get_template_directory_uri() .'/assets/images/logo.png" alt="'. esc_attr( get_bloginfo('title') ) .'">';
								endif;
									echo '</a>';
								endif;
								?>
							</div><!--/.navbar-header.responsive-logo-->
							<nav class="navbar-collapse bs-navbar-collapse collapse" role="navigation" id="site-navigation">
								<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content',  'rise-lite' ); ?></a>
								<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right responsive-nav main-nav-list', 'fallback_cb'     => 'zerif_wp_page_menu' )); ?>
							</nav><!--/#site-navigation.navbar-collapse.bs-navbar-collapse.collapse-->
						</div><!--/.container-->
					</div><!--/#main-nav.navbar.navbar-inverse.bs-docs-nav-->