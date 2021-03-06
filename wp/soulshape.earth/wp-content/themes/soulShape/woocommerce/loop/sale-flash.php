<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$population = $product->get_attribute('population');
$country = $product->get_attribute('country');

//Product caption
echo "<div class='product-caption'>";
echo "<h2>$post->post_title</h2>";
echo $population." - ".$country;
echo "</div>";

if ($post->post_author == '1') 
    echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'HQ', 'woocommerce' ) . '</span>', $post, $product ); 
?>
