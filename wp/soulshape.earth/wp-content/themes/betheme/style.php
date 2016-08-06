<?php
/**
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

/* ==============================================================================================================================
/*
/*	Background																										Background
/*
/* ============================================================================================================================ */
	
html { 
	background-color: <?php mfn_opts_show( 'background-html', '#FCFCFC' ) ?>;
}

#Wrapper, #Content { 
	background-color: <?php mfn_opts_show( 'background-body', '#FCFCFC' ) ?>;
}

<?php if( mfn_opts_get( 'img-subheader-bg' ) ): ?>
	body:not(.template-slider) #Header_wrapper { background-image: url("<?php mfn_opts_show( 'img-subheader-bg' ) ?>"); }
<?php endif; ?>



/* ==============================================================================================================================
/*
/*	Font | Family																									Font | Family
/*
/* ============================================================================================================================ */

body, button, span.date_label, .timeline_items li h3 span, input[type="submit"], input[type="reset"], input[type="button"],
input[type="text"], input[type="password"], input[type="tel"], input[type="email"], textarea, select, .offer_li .title h3 {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-content', 'Roboto' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 400;
}

#menu > ul > li > a, .action_button, #overlay-menu ul li a {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-menu', 'Roboto' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 400;
}

#Subheader .title {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-title', 'Roboto' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 400;
}

h1, .text-logo #logo {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-headings', 'Patua One' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 300;
}

h2 {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-headings', 'Patua One' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 300;
}

h3 {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-headings', 'Patua One' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 300;
}

h4 {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-headings', 'Patua One' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 300;
}

h5 {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-headings-small', 'Roboto' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 700;
}

h6 {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-headings-small', 'Roboto' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
	font-weight: 400;
}

blockquote {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-blockquote', 'Patua One' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
}

.chart_box .chart .num, .counter .desc_wrapper .number-wrapper, .how_it_works .image .number,
.pricing-box .plan-header .price, .quick_fact .number-wrapper, .woocommerce .product div.entry-summary .price {
	<?php $font = str_replace( '#', '', mfn_opts_get( 'font-decorative', 'Patua One' ) ); ?>
	font-family: "<?php echo $font; ?>", Arial, Tahoma, sans-serif;
}



/* ==============================================================================================================================
/*
/*	Font | Size																										Font | Size
/*
/* ============================================================================================================================ */

<?php 
	$aFontSize = $aFontSizeDefault = array(
		'content'	=> mfn_opts_get( 'font-size-content', '13' ),
		'menu'		=> mfn_opts_get( 'font-size-menu', '14' ),
		'title'		=> mfn_opts_get( 'font-size-title', '25' ),
		'h1'		=> mfn_opts_get( 'font-size-h1', '25' ),
		'h2'		=> mfn_opts_get( 'font-size-h2', '30' ),
		'h3'		=> mfn_opts_get( 'font-size-h3', '25' ),
		'h4'		=> mfn_opts_get( 'font-size-h4', '21' ),
		'h5'		=> mfn_opts_get( 'font-size-h5', '15' ),
		'h6'		=> mfn_opts_get( 'font-size-h6', '13' ),
		'intro'		=> mfn_opts_get( 'font-size-single-intro', '70' ),
	);
?>

	
/* Body */

	body {
		font-size: <?php echo $aFontSize['content']; ?>px;
		line-height: <?php echo $aFontSize['content'] + 8; ?>px;
	}	
	#menu > ul > li > a, .action_button {
		font-size: <?php echo $aFontSize['menu']; ?>px;
	}
	#Subheader .title {
		font-size: <?php echo $aFontSize['title']; ?>px;
		line-height: <?php echo $aFontSize['title'] + 0; ?>px;
	}
	
/* Headings */

	h1, .text-logo #logo { 
		font-size: <?php echo $aFontSize['h1']; ?>px;
		line-height: <?php echo $aFontSize['h1'] + 0; ?>px;
	}	
	h2 { 
		font-size: <?php echo $aFontSize['h2']; ?>px;
		line-height: <?php echo $aFontSize['h2'] + 0; ?>px;
	}	
	h3 {
		font-size: <?php echo $aFontSize['h3']; ?>px;
		line-height: <?php echo $aFontSize['h3'] + 2; ?>px;
	}	
	h4 {
		font-size: <?php echo $aFontSize['h4']; ?>px;
		line-height: <?php echo $aFontSize['h4'] + 4; ?>px;
	}	
	h5 {
		font-size: <?php echo $aFontSize['h5']; ?>px;
		line-height: <?php echo $aFontSize['h5'] + 5; ?>px;
	}	
	h6 {
		font-size: <?php echo $aFontSize['h6']; ?>px;
		line-height: <?php echo $aFontSize['h6'] + 7; ?>px;
	}
	
/* Advanced */

	#Intro .intro-title { 
		font-size: <?php echo $aFontSize['intro']; ?>px;
		line-height: <?php echo $aFontSize['intro'] + 0; ?>px;
	}	

	
/* Responsive */
	<?php if( mfn_opts_get('responsive') && mfn_opts_get('font-size-responsive') ): ?>
	
		<?php
			// Tablet (Landscape) ------------------------- 768 - 959
			$min = 13;
			$multiplier = 0.85;
			
			foreach( $aFontSize as $k => $v ){
				$aFontSize[$k] = round( $v * $multiplier );
				if( $aFontSize[$k] < $min ) $aFontSize[$k] = $min;
			}
		?>
		
		@media only screen and (min-width: 768px) and (max-width: 959px){
			body {
				font-size: <?php echo $aFontSize['content']; ?>px;
				line-height: <?php echo $aFontSize['content'] + 7; ?>px;
			}
			#menu > ul > li > a {
				font-size: <?php echo $aFontSize['menu']; ?>px;
			}
			#Subheader .title {
				font-size: <?php echo $aFontSize['title']; ?>px;
				line-height: <?php echo $aFontSize['title'] + 0; ?>px;
			}
				
			h1, .text-logo #logo {
				font-size: <?php echo $aFontSize['h1']; ?>px;
				line-height: <?php echo $aFontSize['h1'] + 0; ?>px;
			}
			h2 {
				font-size: <?php echo $aFontSize['h2']; ?>px;
				line-height: <?php echo $aFontSize['h2'] + 0; ?>px;
			}
			h3 {
				font-size: <?php echo $aFontSize['h3']; ?>px;
				line-height: <?php echo $aFontSize['h3'] + 2; ?>px;
			}
			h4 {
				font-size: <?php echo $aFontSize['h4']; ?>px;
				line-height: <?php echo $aFontSize['h4'] + 4; ?>px;
			}
			h5 {
				font-size: <?php echo $aFontSize['h5']; ?>px;
				line-height: <?php echo $aFontSize['h5'] + 4; ?>px;
			}
			h6 {
				font-size: <?php echo $aFontSize['h6']; ?>px;
				line-height: <?php echo $aFontSize['h6'] + 6; ?>px;
			}
			#Intro .intro-title { 
				font-size: <?php echo $aFontSize['intro']; ?>px;
				line-height: <?php echo $aFontSize['intro'] + 0; ?>px;
			}
			
			blockquote { font-size: 15px;}
			
			.chart_box .chart .num { font-size: 45px; line-height: 45px; }
			
			.counter .desc_wrapper .number-wrapper { font-size: 45px; line-height: 45px;}
			.counter .desc_wrapper .title { font-size: 14px; line-height: 18px;}
			
			.faq .question .title { font-size: 14px; }
			
			.fancy_heading .title { font-size: 38px; line-height: 38px; }
			
			.offer .offer_li .desc_wrapper .title h3 { font-size: 32px; line-height: 32px; }
			.offer_thumb_ul li.offer_thumb_li .desc_wrapper .title h3 {  font-size: 32px; line-height: 32px; }
			
			.pricing-box .plan-header h2 { font-size: 27px; line-height: 27px; }
			.pricing-box .plan-header .price > span { font-size: 40px; line-height: 40px; }
			.pricing-box .plan-header .price sup.currency { font-size: 18px; line-height: 18px; }
			.pricing-box .plan-header .price sup.period { font-size: 14px; line-height: 14px;}
			
			.quick_fact .number { font-size: 80px; line-height: 80px;}

			.trailer_box .desc h2 { font-size: 27px; line-height: 27px; }
		}
		
		<?php
			// Tablet (Portrait) & Mobile (Landscape) ----- 480 - 767
			$min = 13;
			$multiplier = 0.75;
			
			$aFontSize = $aFontSizeDefault;
			foreach( $aFontSize as $k => $v ){
				$aFontSize[$k] = round( $v * $multiplier );
				if( $aFontSize[$k] < $min ) $aFontSize[$k] = $min;
			}
		?>
		
		@media only screen and (min-width: 480px) and (max-width: 767px){
			body {
				font-size: <?php echo $aFontSize['content']; ?>px;
				line-height: <?php echo $aFontSize['content'] + 7; ?>px;
			}
			#menu > ul > li > a {
				font-size: <?php echo $aFontSize['menu']; ?>px;
			}
			#Subheader .title {
				font-size: <?php echo $aFontSize['title']; ?>px;
				line-height: <?php echo $aFontSize['title'] + 0; ?>px;
			}
			
			h1, .text-logo #logo {
				font-size: <?php echo $aFontSize['h1']; ?>px;
				line-height: <?php echo $aFontSize['h1'] + 0; ?>px;
			}
			h2 {
				font-size: <?php echo $aFontSize['h2']; ?>px;
				line-height: <?php echo $aFontSize['h2'] + 0; ?>px;
			}
			h3 {
				font-size: <?php echo $aFontSize['h3']; ?>px;
				line-height: <?php echo $aFontSize['h3'] + 2; ?>px;
			}
			h4 {
				font-size: <?php echo $aFontSize['h4']; ?>px;
				line-height: <?php echo $aFontSize['h4'] + 4; ?>px;
			}
			h5 {
				font-size: <?php echo $aFontSize['h5']; ?>px;
				line-height: <?php echo $aFontSize['h5'] + 4; ?>px;
			}
			h6 {
				font-size: <?php echo $aFontSize['h6']; ?>px;
				line-height: <?php echo $aFontSize['h6'] + 5; ?>px;
			}
			#Intro .intro-title { 
				font-size: <?php echo $aFontSize['intro']; ?>px;
				line-height: <?php echo $aFontSize['intro'] + 0; ?>px;
			}
			
			blockquote { font-size: 14px;}
			
			.chart_box .chart .num { font-size: 40px; line-height: 40px; }
			
			.counter .desc_wrapper .number-wrapper { font-size: 40px; line-height: 40px;}
			.counter .desc_wrapper .title { font-size: 13px; line-height: 16px;}

			.faq .question .title { font-size: 13px; }

			.fancy_heading .title { font-size: 34px; line-height: 34px; }
			
			.offer .offer_li .desc_wrapper .title h3 { font-size: 28px; line-height: 28px; }
			.offer_thumb_ul li.offer_thumb_li .desc_wrapper .title h3 {  font-size: 28px; line-height: 28px; }
			
			.pricing-box .plan-header h2 { font-size: 24px; line-height: 24px; }
			.pricing-box .plan-header .price > span { font-size: 34px; line-height: 34px; }
			.pricing-box .plan-header .price sup.currency { font-size: 16px; line-height: 16px; }
			.pricing-box .plan-header .price sup.period { font-size: 13px; line-height: 13px;}
			
			.quick_fact .number { font-size: 70px; line-height: 70px;}

			.trailer_box .desc h2 { font-size: 24px; line-height: 24px; }
		}
		
		<?php
			// Mobile (Portrait) ------------------------------ < 479
			$min = 13;
			$multiplier = 0.6;
			
			$aFontSize = $aFontSizeDefault;
			foreach( $aFontSize as $k => $v ){
				$aFontSize[$k] = round( $v * $multiplier );
				if( $aFontSize[$k] < $min ) $aFontSize[$k] = $min;
			}
		?>
		
		@media only screen and (max-width: 479px){
			body {
				font-size: <?php echo $aFontSize['content']; ?>px;
				line-height: <?php echo $aFontSize['content'] + 7; ?>px;
			}
			#menu > ul > li > a {
				font-size: <?php echo $aFontSize['menu']; ?>px;
			}
			#Subheader .title {
				font-size: <?php echo $aFontSize['title']; ?>px;
				line-height: <?php echo $aFontSize['title'] + 0; ?>px;
			}
			
			h1, .text-logo #logo {
				font-size: <?php echo $aFontSize['h1']; ?>px;
				line-height: <?php echo $aFontSize['h1'] + 0; ?>px;
			}
			h2 { 
				font-size: <?php echo $aFontSize['h2']; ?>px;
				line-height: <?php echo $aFontSize['h2'] + 0; ?>px;
			}
			h3 {
				font-size: <?php echo $aFontSize['h3']; ?>px;
				line-height: <?php echo $aFontSize['h3'] + 2; ?>px;
			}
			h4 {
				font-size: <?php echo $aFontSize['h4']; ?>px;
				line-height: <?php echo $aFontSize['h4'] + 3; ?>px;
			}
			h5 {
				font-size: <?php echo $aFontSize['h5']; ?>px;
				line-height: <?php echo $aFontSize['h5'] + 3; ?>px;
			}
			h6 {
				font-size: <?php echo $aFontSize['h6']; ?>px;
				line-height: <?php echo $aFontSize['h6'] + 4; ?>px;
			}
			#Intro .intro-title { 
				font-size: <?php echo $aFontSize['intro']; ?>px;
				line-height: <?php echo $aFontSize['intro'] + 0; ?>px;
			}
			
			blockquote { font-size: 13px;}
			
			.chart_box .chart .num { font-size: 35px; line-height: 35px; }
			
			.counter .desc_wrapper .number-wrapper { font-size: 35px; line-height: 35px;}
			.counter .desc_wrapper .title { font-size: 13px; line-height: 26px;}

			.faq .question .title { font-size: 13px; }
			
			.fancy_heading .title { font-size: 30px; line-height: 30px; }
			
			.offer .offer_li .desc_wrapper .title h3 { font-size: 26px; line-height: 26px; }
			.offer_thumb_ul li.offer_thumb_li .desc_wrapper .title h3 {  font-size: 26px; line-height: 26px; }
			
			.pricing-box .plan-header h2 { font-size: 21px; line-height: 21px; }
			.pricing-box .plan-header .price > span { font-size: 32px; line-height: 32px; }
			.pricing-box .plan-header .price sup.currency { font-size: 14px; line-height: 14px; }
			.pricing-box .plan-header .price sup.period { font-size: 13px; line-height: 13px;}
			
			.quick_fact .number { font-size: 60px; line-height: 60px;}

			.trailer_box .desc h2 { font-size: 21px; line-height: 21px; }
		}
		
	<?php endif; ?>


	
/* ==============================================================================================================================
/*
/*	Sidebar | Width																									Sidebar | Width
/*
/* ============================================================================================================================ */
	
<?php 
	$sidebarW 	= mfn_opts_get( 'sidebar-width', '23' );
	$contentW 	= 100 - $sidebarW;
	$sidebar2W 	= $sidebarW - 5;
	$content2W 	= 100 - ( $sidebar2W * 2 );
	$sidebar2M 	= $content2W + $sidebar2W;
	$content2M 	= $sidebar2W;
?>

.with_aside .sidebar.columns {
	width: <?php echo $sidebarW; ?>%;
}
.with_aside .sections_group {
	width: <?php echo $contentW; ?>%;
}

.aside_both .sidebar.columns {
	width: <?php echo $sidebar2W; ?>%;
}
.aside_both .sidebar.sidebar-1{ 
	margin-left: -<?php echo $sidebar2M; ?>%;
}
.aside_both .sections_group {
	width: <?php echo $content2W; ?>%;
	margin-left: <?php echo $content2M; ?>%;
}
	
	
	
/* ==============================================================================================================================
/*
/*	Grid | Width																									Grid | Width
/*
/* ============================================================================================================================ */

<?php if( mfn_opts_get('responsive') ): ?>

	<?php 
		$gridW = mfn_opts_get( 'grid-width', 1240 );
	?>
	
	@media only screen and (min-width:1240px){
		#Wrapper, .with_aside .content_wrapper {
			max-width: <?php echo $gridW; ?>px;
		}
		.section_wrapper, .container {
			max-width: <?php echo $gridW - 20; ?>px;
		}
		.layout-boxed.header-boxed #Top_bar.is-sticky{
			max-width: <?php echo $gridW; ?>px;
		}
	}
	
	<?php 
		if( $box_padding = mfn_opts_get( 'layout-boxed-padding' ) ):
	?>
	
		@media only screen and (min-width:768px){
		
			.layout-boxed #Subheader .container,
			.layout-boxed:not(.with_aside) .section:not(.full-width),
			.layout-boxed.with_aside .content_wrapper,
			.layout-boxed #Footer .container { padding-left: <?php echo $box_padding; ?>; padding-right: <?php echo $box_padding; ?>;}
			
			.layout-boxed.header-modern #Action_bar .container,
			.layout-boxed.header-modern #Top_bar:not(.is-sticky) .container { padding-left: <?php echo $box_padding; ?>; padding-right: <?php echo $box_padding; ?>;}
		}
	
	<?php endif; ?>

<?php endif; ?>



/* ==============================================================================================================================
/*
/*	Other																													Other
/*
/* ============================================================================================================================ */

/* Logo Height */

<?php
	$aLogo = array(
		'height' => intval( mfn_opts_get( 'logo-height', 60 ) ),
		'vertical_padding' => intval( mfn_opts_get( 'logo-vertical-padding', 15 ) ),
	);

	$aLogo['top_bar_right_H'] = $aLogo['height'] + ( $aLogo['vertical_padding'] * 2 );
	$aLogo['top_bar_right_T'] = ( $aLogo['top_bar_right_H'] / 2 ) - 20;
	
	$aLogo['menu_padding'] = ( $aLogo['top_bar_right_H'] / 2 ) - 30;
	$aLogo['menu_margin'] = ( $aLogo['top_bar_right_H'] / 2 ) - 25;
	$aLogo['responsive_menu_T'] = ( $aLogo['top_bar_right_H'] / 2 ) - 17;
	
	$aLogo['header_fixed_LH'] = ( $aLogo['top_bar_right_H'] - 30 ) / 2 ;
?>

#Top_bar #logo,
.header-fixed #Top_bar #logo,
.header-plain #Top_bar #logo,
.header-transparent #Top_bar #logo {
	height: <?php echo $aLogo['height']; ?>px;
	line-height: <?php echo $aLogo['height']; ?>px;
	padding: <?php echo $aLogo['vertical_padding']; ?>px 0;
}
.logo-overflow #Top_bar:not(.is-sticky) .logo {
    height: <?php echo $aLogo['top_bar_right_H']; ?>px;
}
#Top_bar .menu > li > a {
    padding: <?php echo $aLogo['menu_padding']; ?>px 0;
}
.menu-highlight:not(.header-creative) #Top_bar .menu > li > a {
	margin: <?php echo $aLogo['menu_margin']; ?>px 0;
}
.header-plain:not(.menu-highlight) #Top_bar .menu > li > a span:not(.description) {
    line-height: <?php echo $aLogo['top_bar_right_H']; ?>px;
}

.header-fixed #Top_bar .menu > li > a {
    padding: <?php echo $aLogo['header_fixed_LH']; ?>px 0;
}

#Top_bar .top_bar_right,
.header-plain #Top_bar .top_bar_right {
	height: <?php echo $aLogo['top_bar_right_H']; ?>px;
}
#Top_bar .top_bar_right_wrapper { 
	top: <?php echo $aLogo['top_bar_right_T']; ?>px;
}
.header-plain #Top_bar a#header_cart, 
.header-plain #Top_bar a#search_button,
.header-plain #Top_bar .wpml-languages,
.header-plain #Top_bar a.button.action_button {
	line-height: <?php echo $aLogo['top_bar_right_H']; ?>px;
}

#Top_bar a.responsive-menu-toggle,
.header-plain #Top_bar a.responsive-menu-toggle,
.header-transparent #Top_bar a.responsive-menu-toggle { 
	top: <?php echo $aLogo['responsive_menu_T']; ?>px;
}


/* Before After Item */

<?php 
	$translate['before'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-before','Before') : __('Before','betheme');
	$translate['after'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-after','After') : __('After','betheme');
?>

.twentytwenty-before-label::before { content: "<?php echo $translate['before']; ?>";}
.twentytwenty-after-label::before { content: "<?php echo $translate['after']; ?>";}
