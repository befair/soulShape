<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package zerif
 */
get_header(); ?>
<div class="clear"></div>
</header> <!-- / END HOME SECTION  -->
<div id="content" class="site-content">
    <div class="container">
        <?php 
            if($_GET['post_type'] == "product") { ?>
                <div class="content-left-wrap col-md-9">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php woocommerce_content(); ?>
                        </main>
                    </div>
                </div>
                <div class="sidebar-wrap col-md-3 content-left-wrap">
                    <?php get_sidebar(); ?>
                </div>
            <?php 
            }
            else { ?>
                <div class="content-left-wrap col-md-12">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php woocommerce_content(); ?>
                        </main>
                    </div>
                </div>
            <?php
            } ?> 
    </div>
<?php get_footer(); ?>
