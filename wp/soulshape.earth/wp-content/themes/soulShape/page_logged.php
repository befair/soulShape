<?php if(is_user_logged_in()):?>

<?php
/**
Template Name: Logged-In Users Page
*/
get_header(); ?>

<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->
<?php zerif_after_header_trigger(); ?>
<div id="content" class="site-content">

	<div class="container">

		<?php zerif_before_page_content_trigger(); ?>

		<div class="content-left-wrap col-md-12">

			<?php zerif_top_page_content_trigger(); ?>

			<div id="primary" class="content-area">

				<main id="main" class="site-main">

					<?php 
						while ( have_posts() ) : the_post(); 
						
							get_template_part( 'content', 'page-no-title' );
							
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() ) :
								comments_template();
							endif;
							
						endwhile;
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php zerif_bottom_page_content_trigger(); ?>

		</div><!-- .content-left-wrap -->

		<?php zerif_after_page_content_trigger(); ?>

	</div><!-- .container -->

<?php get_footer(); ?>

<?php else:
wp_die('<img src="wp-content/uploads/2016/08/Senza-titolo-1.png" style="width: 100%; filter: invert(100%);"/>
        <p>Sorry, you must first <a href="?page_id=90">log in</a> to view this page. You can <a href="?page_id=113">register free here</a>.</p>');
endif; ?>
