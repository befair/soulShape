=== WooCommerce Products Filter ===
Contributors: RealMag777
Donate link: http://codecanyon.net/item/woof-woocommerce-products-filter/11498469?ref=realmag777
Tags: woocommerce filter, ajax products filter, woocommerce products filter, woocommerce product filter, products filter, ajax products filter, filter for woocommerce, filter, shortcode, widget, woocommerce, products, ajax
Requires at least: 4.1.0
Tested up to: 4.5.3
Stable tag: 1.1.5.1

WooCommerce Products Filter – flexible and easy professional filter for products in the WooCommerce store

== Description ==

WooCommerce Products Filter - WOOF - is a plugin that allows you filter products by products categories, products attributes, products tags, products custom taxonomies. Supports latest version of the WooCommerce plugin. A must have plugin for your WooCommerce powered online store! Maximum flexibility!

If you are WP+PHP developer and you want to create something unusual in the seacrh form interface – Welcome: using WOOF extension API and default extensions as an examples you can create any html-items for the search form and even custom woo-products loop template for your own purposes. Also its possible create any connectors for layout plugins: http://www.woocommerce-filter.com/extensions/


### The Plugin Features:

* Shortcode&Widget -> [woof]
* Products shortcode [woof_products per_page=8 columns=3 is_ajax=1 taxonomies=product_cat:9]
* Uses native woocommerce API only
* Products searching by AJAX
* Dynamic products recount
* You can show your taxonomies as: radio, checkbox, drop-down, multi-drop-down and (color,label,hierarchy drop-down) in the premium version
* Different skins for radio and checkboxes in the plugin settings
* Simple options
* Compatible with WooCommerce Currency Switcher - https://wordpress.org/plugins/woocommerce-currency-switcher/
* Compatible with WooCommerce Brands - http://codecanyon.net/item/woocommerce-brands/8039481?ref=realmag777
* Compatible with WooCommerce Products Per Page - https://wordpress.org/plugins/woocommerce-products-per-page/
* WPML compatibility
* Possibility to create any extensions for the plugin (for developers only) 
* Demo site is: http://demo.woocommerce-filter.com
* Documentation: http://www.woocommerce-filter.com/documentation/ and http://www.woocommerce-filter.com/codex/
* The premium version: http://codecanyon.net/item/woof-woocommerce-products-filter/11498469?ref=realmag777


https://www.youtube.com/watch?v=jZPtdWgAxKk


== Installation ==
* Download to your plugin directory or simply install via Wordpress admin interface.
* Activate.
* Set product taxonomies in the plugin settings tab of the wocommerce settings page
* Drop the WooCommerce Products Filter widget in the sidebar.
* Use.


== Frequently Asked Questions ==

Q: Where can I see demo?
R: http://demo.woocommerce-filter.com

Q: Where can I see video tutorials?
R: http://www.woocommerce-filter.com/video-tutorials/

Q: Where can I get the Premium version of WOOF
R: http://codecanyon.net/item/woof-woocommerce-products-filter/11498469?ref=realmag777

Q: How to create a custom taxomomy?
R: Use this plugin https://wordpress.org/plugins/custom-post-type-ui/

Q: FAQ?
R: http://www.woocommerce-filter.com/category/faq/

Q: Documentation?
R: http://www.woocommerce-filter.com/documentation/ and http://www.woocommerce-filter.com/codex/


== Screenshots ==
1. The plugin settings
2. The plugin settings
3. The plugin settings
4. The plugin settings
5. The plugin settings

== Changelog ==

= 1.1.5.1 =
* One hot fix

= 1.1.5 =
* Some little bugs fixed reported from customers
* 2 Security Vulnerability issues fixed - thanks to pluginvulnerabilities.com
* Adopting to WooCommerce 2.6.x
* New attribute tax_exclude: [woof tax_exclude='pa_size,pa_test']
* New hook filter 'woof_use_chosen'
* New hook filter 'woof_main_query_tax_relations' added, wacth more here: https://drive.google.com/file/d/0B4zUhfhZlonlNkVXMEZIdUxlWFU/view?usp=sharing
* Toggle improvement based on request from https://wordpress.org/support/topic/toggle-open-them-all?replies=3
* Disable the tooltips option for the color filter only
* New hook filter 'woof_text_autocomplete_items' - how many founded items mto show if text autocomplete mode enabled
* Links to posts in suggestion - new option for text search if autocomplete enabled
* A lot of minor improvements in the code

= 1.1.4.2 =
* Fixed 2 bugs in classes/helper.php: terms ordering and non-latin terms characters for sub-categories

= 1.1.4.1 =
* Fixed 1 bug with hiding terms from options

= 1.1.4 =
* Fixed bugs from customers
* A lot of the code has been remade
* Extension installation functionality from backend is added and its API is finished and can be used in production
* Using default extension php developers can create: types of filter elements using any 
  custom html templates, any products loop templates
* Possibility to write custom templates for woocommerce products loop using extensions
* Improved SKU searching for variable products and autocomplete added
add_filter('woof_text_autocomplete_items', function($count){       
       return 2;
}); (enabled optionally from admin panel)
* Improved by Text searching and autocomplete added
add_filter('woof_sku_autocomplete_items', function($count){       
   return 2;
}); (enabled optionally from admin panel)
* Improved InStock searching for variable products
* Toggles for taxonomies on the front added
* New attribute: [woof_author_filter role="author"]
* New attribute: custom_tpl for [woof_products]. Example: [woof_products custom_tpl='themes/twentytwelve/woo_tpl_1.php' per_page=8 columns=3 is_ajax=0 taxonomies=product_cat:9]
* New attribute: [woof_products get_args_only=1] - possibility get array of arguments only
* New attribute: [woof excluded_terms="33,44,55,66,77"]
* New attribute: [woof_products predict_ids_and_continue=1]
[woof_products_ids_prediction taxonomies=product_cat:8] - use for AJAX mode only for correct price range slider work
* New option: Range-slider skin - tab Design
* New option: Init plugin on the next site pages only - tab Advanced
* New option: <strong>In the terms slugs uses non-latin characters</strong> - from now doesn matter which language uses in slug names - tab Advanced
* New hook added: add_filter('woof_title_tag', function($tag){       
       return 'h3';
   });
* New hook added: add_filter('woof_widget_title_tag', function($tag){       
       return 'h3';
   });
* New hook added: $price_slider_html = apply_filters('woof_price_slider_html', $price_slider_html, $price_slider_data);  
* New hook added: $orderby = apply_filters('woof_get_terms_orderby', $taxonomy);
* New hook added: $order = apply_filters('woof_get_terms_order', $taxonomy, $orderby);

= 1.1.3.1 =
* Hot js fix: https://wordpress.org/support/topic/variable-products-not-working-3

= 1.1.3 =
* ATTENTION: before update from v.1.1.2 to v.1.1.3 read this please http://www.woocommerce-filter.com/migration-v-2-1-2-or-1-1-2-and-lower-to-2-1-3-or-1-1-3-and-higher/
* Fixed bugs from customers
* New wp filter: $wr = apply_filters('woof_products_query', $wr); in [woof_products]
* New attributes added: [woof tax_only='pa_color,pa_size' items_only='by_text,by_author']
* http://www.woocommerce-filter.com/documentation/#!/hierarchy-drop-down
* Color type improved, now its possible set background image too
* Search by text: by excerpt, by content OR excerpt, by title OR content OR excerpt
* Added new shortcode: [woof_text_filter]
* Added new shortcode: [woof_author_filter]
* Added new shortcode: [woof_search_options]
* Improved shortcode: [woof_price_filter type="slider"] //slider,select
* Improved shortcode: [woof_products behaviour='recent' per_page=12 columns=3]
* Improved shortcode: [woof redirect="xxx" autosubmit=1]
* Improved shortcode: [woof redirect="http://www.dev.woocommerce-filter.com/test-all/" autosubmit=1 ajax_redraw=1 is_ajax=1 tax_only="locations" by_only="none"] - new attributes - tax_only,by_only,redirect
* Disable swoof influence option
* Custom front css styles file link option
* Additional text in the widget optionally
* Additional options in the widget optionally
* Custom extensions possibility implemented
* Show helper button option
* Old v.1.1.2: http://www.woocommerce-filter.com/wp-content/uploads/2015/12/woocommerce-products-filter-112.zip


= 1.1.2 =
* Fixed minor issues from customers
* Added: Search by SKU - premium only
* Added: Filter by price as drop-down - premium only
* Added shortcode: [woof_title_filter placeholder="custom placeholder text"]
* the color description selectable so that it can be highlighted and pasted into colour selector by the term description textarea
* Added condition attribute 'taxonomies': [woof taxonomies=product_cat:9 sid="auto_shortcode"][woof_products is_ajax=1 per_page=8 taxonomies=product_cat:9]
* Added: the "eyeball" search icon image - can be changed in the plugin settings -> tab Miscellaneous
* Added: dynamic recount cron cache periods of cleaning
* Added: option - Hide woof top panel buttons
* Added: option - storage type: session or transient
* PHP code optimization
* Added some features to API: http://www.woocommerce-filter.com/documentation/#!/section_6

= 1.1.1.1 =
* Hot fix update for compatibility with WordPress 4.3

= 1.1.1 =
* Some little bugs fixed + 1 strict notice
* Added compatibility for WOOCS 2.0.9 and 1.0.9

= 1.1.0 =
* Too much improvements
* AJAX mode added!!

= 1.0.7 =
* Too much improvements
* Premium version on codecanyon: http://codecanyon.net/item/woof-woocommerce-products-filter/11498469?ref=realmag777

= 1.0.5 =
* Heap of bugs from customers is fixed
* Possibility to add a FILTER button, so the plugin dont search automatically until someone click on Filter
* New option 'Use chosen' - you can switch off/on this js lib from now
* In stock only checkbox on the front

= 1.0.4 =
Partly WPML compatibility + some little fixes

= 1.0.3 =
Adopted to woocommerce 2.3.2 and higher for products attributes filtering

= 1.0.2 =
Very important 1 bug fixed with Fatal Error. Corrected work with the native price filter (dynamic recount)

= 1.0.1 =
Dynamic products recount

= 1.0.0 =
Plugin release. Operate all the basic functions.



== License ==

This plugin is copyright pluginus.net ɠ2012-2016 with [GNU General Public License][] by realmag777.

This program is free software; you can redistribute it and/or modify it under
the terms of the [GNU General Public License][] as published by the Free
Software Foundation; either version 2 of the License, or (at your option) any
later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY. See the GNU General Public License for more details.

  [GNU General Public License]: http://www.gnu.org/copyleft/gpl.html


== Upgrade Notice ==
Old v.1.1.2: http://www.woocommerce-filter.com/wp-content/uploads/2015/12/woocommerce-products-filter-112.zip
Old v.1.1.3.1: http://www.woocommerce-filter.com/wp-content/uploads/2016/03/woocommerce-products-filter-1131.zip
Old v.1.1.4.2: http://www.woocommerce-filter.com/wp-content/uploads/2016/07/woocommerce-products-filter-1142.zip
