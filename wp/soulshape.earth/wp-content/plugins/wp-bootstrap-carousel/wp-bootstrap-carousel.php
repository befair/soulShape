<?php
/**
 * Plugin Name: WP Bootstrap Carousel
 * Version: 1.0
 * Author: Peter J. Herrel
 * Author URI: http://peterherrel.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp_bootstrap_carousel
 * Domain Path: /lang
 */

/*
 * LICENSE
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 3, as 
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
if( ! class_exists( 'WP_Bootstrap_Carousel' ) ) {

class WP_Bootstrap_Carousel
{
    /**
     * @var WP_Bootstrap_Carousel The single instance of the class
     * @since 0.5.0
     */
    protected static $_instance = null;

    /**
     * @var string
     */
    public $version = '0.5.0';

    /**
     * @var string
     */
    public $version_bootstrap = '3.3.1';

    /**
     * WordPress default themes.
     *
     * @static
     * @access private
     * @since 0.5.0
     * @var array
     */
    private static $default_themes = array(
        'classic'        => 'WordPress Classic',
        'default'        => 'WordPress Default',
        'twentyten'      => 'Twenty Ten',
        'twentyeleven'   => 'Twenty Eleven',
        'twentytwelve'   => 'Twenty Twelve',
        'twentythirteen' => 'Twenty Thirteen',
        'twentyfourteen' => 'Twenty Fourteen',
        'twentyfifteen'  => 'Twenty Fifteen',
    );

    /**
     * Main WP_Bootstrap_Carousel instance
     *
     * Ensures only one instance of WP Bootstrap Carousel is loaded or can be loaded.
     *
     * @since 0.5.0
     * @static
     * @return WP_Bootstrap_Carousel, main instance
     */
    public static function instance()
    {
        if( is_null( self::$_instance ) )
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /**
     * Constructor.
     *
     * @since   0.1.1
     * @access  public
     * @uses    WP_Bootstrap_Carousel::be_display_posts_plugin()
     * @return  void
     */
    public function __construct()
    {
        // plugin localization
        add_action( 'init', array( $this, 'i18n' ), 10 );

        // front end actions
        if( ! is_admin() || defined( 'DOING_AJAX' ) ) {

            add_action( 'wp_enqueue_scripts',   array( $this, 'wp_enqueue_scripts' ),   25 );
            add_action( 'init',                 array( $this, 'init' ),                 10 );
            add_action( 'body_class',           array( $this, 'body_class' ),           10 );

            if( function_exists( 'be_display_posts_shortcode' ) ) {
                $this->be_display_posts_plugin();
            }

        }

        // add plugin row meta
        if( is_admin() ) {
            add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
        }

        // action hook
        do_action( 'wp_bootstrap_carousel_loaded' );
    }
    /**
     * Plugin localization.
     *
     * @since   0.2.0
     * @access  public
     * @return  void
     */
    public function i18n()
    {
        // load localization files
        load_plugin_textdomain( 'wp_bootstrap_carousel', false, plugin_basename( dirname( __FILE__ ) ) . '/lang/' );
    }
    /**
     * Register carousel shortcode.
     *
     * @since   0.1.1
     * @access  public
     * @return  void
     */
    public function init()
    {
        // register shortcode
        add_shortcode( 'carousel', array( $this, 'shortcode' ) );

        // action hook
        do_action( 'wp_bootstrap_carousel_init' );
    }
    /**
     * Carousel shortcode callback.
     *
     * @since   0.1.1
     * @access  public
     * @uses    WP_Bootstrap_Carousel::get_data()
     * @uses    WP_Bootstrap_Carousel::enqueue()
     * @param   array   $atts   Array of user defined shortcode attributes.
     * @return  string          Carousel HTML.
     */
    public function shortcode( $atts )
    {
        // parse data
        $data = (array) $this->get_data( $atts );

        // extract variables
        extract( $data, EXTR_SKIP );

        // set up variables
        $post_parent = ( $post_parent > 0 ) ? $post_parent : false;

        // check results
        if( false === $post_parent || empty( $query ) ) {
            /**
             * Filter what is returned when no results are found
             *
             * @param   bool    $return Default: false.
             */
            return apply_filters( 'wp_bootstrap_carousel_no_results', false );
        }

        // handle feed
        if( is_feed() ) {
            /**
             * Determine what is displayed in RSS feeds
             *
             * @param   string  $html   The default HTML
             * @param   array   $data   Array containing the query and display variables
             */
            return apply_filters( 
                'wp_bootstrap_carousel_feed',
                /** This filter is documented in wp-includes/link-template.php */
                '<p><a href="' . apply_filters( 'the_permalink', get_permalink( $GLOBALS['post']->ID ) ) . '#wp-bootstrap-carousel-' . $post_parent . '">' . __( 'Click here to view the embedded slideshow.', 'wp_bootstrap_carousel' ) . '</a></p>',
                $data
            );
        }

        // enqueue scripts
        self::enqueue( $thickbox );

        // set up variables
        $max_width   = ( $width > 0 ) ? $width : false;
        $max_width   = ( ! empty( $max_width ) ) ? "max-width:{$max_width}px;" : '';
        $unwrap      = ( false !== $unwrap ) ? ' data-wpbc_unwrap="1"' : '';

        // build html output
        $carousel = '';

        // open carousel outer div
        $carousel .= '<div id="wp-bootstrap-carousel-' . $post_parent . '" class="carousel' . ( ( $slide ) ? " slide" : "" ) . '" style="width:100%;' . $max_width . '" data-interval="' . $interval . '" data-pause="' . $pause . '" data-wrap="' . $wrap . '" data-keyboard="' . $keyboard . '">';

        // indicators
        if( $controls )
        {
            $carousel .= '<ol class="carousel-indicators">';

            $o = 0;

            foreach( $query as $item )
            {
                $carousel .= '<li data-target="#wp-bootstrap-carousel-' . $post_parent . '" data-slide-to="' . $o . '" class="' . ( ( $o == 0 ) ? "active" : "" ) . '"></li>';
                $o++;
            }

            $carousel .= '</ol>';
        }

        // open carousel inner div
        $carousel .= '<div class="carousel-inner" role="listbox">';

        // iterator
        $i = 0;

        // loop over items
        foreach( $query as $item_id => $item )
        {
            // variables
            $full    = wp_get_attachment_image_src( $item_id, 'full', false );      // full size
            $thumb   = wp_get_attachment_image_src( $item_id, $image_size, false ); // thumbnail size
            $link    = ( $file ) ? $full[0] : get_attachment_link( $item_id );
            $caption = ( ! empty( $item->post_excerpt ) ) ? wpautop( wptexturize( $item->post_excerpt ) ) : '';
            $var = get_post_field('post_content', $item_id);
            $button = preg_split("/%%%/", $var);

            // open item div
            $carousel .= '<div id="item-' . $item_id . '" class="' . ( ( $i == 0 ) ? "active" : "" ) . ' item">';

            /* OLD with <a>
            $carousel .= '<a class="' . ( ( $file && $thickbox ) ? "thickbox " : "" ) . '" rel="' . $rel . '" href="' . $link . '"><img src="' . $thumb[0] . '" style="width:100%;' . $max_width . '" alt="' . $item->post_title . '"' . $unwrap . '/></a>';**/

            // carousel image
            $carousel .= '<img src="' . $thumb[0] . '" style="width:100%;' . $max_width . '" alt="' . $item->post_title . '"' . $unwrap . '/>';

            // open caption div
            $carousel .= '<div class="carousel-caption">';

            // title
            $carousel .= '<h2 class="carousel-post-title">' . $item->post_title . '</h2>';

            // comments
            if( $comments && comments_open( $item_id ) )
            {
                $comments = ( get_comments_number( $item_id ) != 0 ) ? sprintf( _n( '1 Comment', '%1$s Comments', get_comments_number( $item_id ), 'wp_bootstrap_carousel' ), number_format_i18n( get_comments_number( $item_id ) ) ) : __( '0 Comments', 'wp_bootstrap_carousel' );

                $carousel .= '<p class="carousel-comments-link">
                    <a href="' . get_comments_link( $item_id ) . '" rel="bookmark">' . $comments . '</a>
                </p>';
            }

            /**
             * Filter the caption text
             *
             * @param   string  $caption   The caption text
             * @param   integer $item_id   The attachment ID
             */
            $carousel .= apply_filters( 'wp_bootstrap_carousel_caption_text', $caption, $item_id );

            $carousel .= '<div class="big-title-separator"></div>';
            $carousel .= '<a href="'.$button[0].'" class="btn-child btn btn-primary custom-button red-btn" style="margin: -15px 11px 0 11px" target="_blank">More</a>';
            $carousel .= '<a href="'.$button[1].'" class="btn-child btn btn-primary custom-button yellow-btn" style="margin: -15px 11px 0 11px" target="_blank">Shop</a>';

            // close caption div
            $carousel .= '</div><!-- .carousel-caption -->';

            // close item div
            $carousel .= '</div><!-- .item -->';

            $i++;
        }

        // close carousel inner div
        $carousel .= '</div><!-- .carousel-inner -->';

        // carousel controls
        if( $controls ) {
            $carousel .= '
<a class="left carousel-control" href="#wp-bootstrap-carousel-' . $post_parent . '" role="button" data-slide="prev" style="z-index:9999">
    <span class="glyphicon glyphicon-chevron-left icon-prev" aria-hidden="true"></span>
    <span class="sr-only">' . __( 'Previous' ) . '</span>
</a>
<a class="right carousel-control" href="#wp-bootstrap-carousel-' . $post_parent . '" role="button" data-slide="next" style="z-index:9999">
    <span class="glyphicon glyphicon-chevron-right icon-next" aria-hidden="true"></span>
    <span class="sr-only">' . __( 'Next' ) . '</span>
</a>';
        }

        // close carousel outer div
        $carousel .= '</div><!-- .carousel -->';

        // return carousel html
        return $carousel;
    }
    /**
     * Parse and sanitize carousel shortcode attributes.
     *
     * @since   0.1.1
     * @access  public
     * @param   array   $atts   Array of user defined shortcode attributes.
     * @return  array           Array containing an array of query args, and and array of display vars.
     */
    public function get_data( $atts )
    {
        // variables
        $post_parent    = intval( $GLOBALS['post']->ID );
        $thumbnail_id   = get_post_meta( $post_parent, '_thumbnail_id', true );

        // parse shortcode atts
        /**
         * Filter the default shortcode atts.
         *
         * @param   array  $atts   Array containing the default shortcode atts.
         */
        $atts = shortcode_atts( apply_filters( 'wp_bootstrap_carousel_shortcode_atts', array(

            'post_parent'       => $post_parent,
            'post_status'       => 'inherit',
            'post_type'         => 'attachment',
            'post_mime_type'    => 'image',
            'exclude'           => ( '' == $thumbnail_id ) ? '' : $thumbnail_id,
            'order'             => 'ASC',
            'orderby'           => 'ID',

            'width'             => 0,       // used for max-width as of 0.3.0
            'image_size'        => 'large',
            'rel'               => '',
            'file'              => 1,
            'comments'          => 0,
            'slide'             => 1,
            'controls'          => 1,

            'interval'          => 5000,    // (int) The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle.
            'pause'             => 'hover', // (string) Pauses the cycling of the carousel on mouseenter and resumes the cycling of the carousel on mouseleave.
            'wrap'              => 1,       // (bool) Whether the carousel should cycle continuously or have hard stops.
            'keyboard'          => 1,       // (bool) Whether the carousel should react to keyboard events.

            'thickbox'          => 1,       // (bool) Whether thickbox should be used.
            'unwrap'            => 0,       // (bool) Whether images should be hyperlinked.

        ) ), $atts, 'carousel' );

        // sanitize query vars
        $post_parent    = intval( $atts['post_parent'] );
        $post_status    = sanitize_text_field( $atts['post_status'] );
        $post_type      = sanitize_text_field( $atts['post_type'] );
        $post_mime_type = sanitize_text_field( $atts['post_mime_type'] );
        $exclude        = array_map( 'intval', explode( ',', $atts['exclude'] ) );
        $order          = sanitize_key( $atts['order'] );
        $orderby        = ( 'rand' == $order ) ? 'none' : sanitize_key( $atts['orderby'] );

        // sanitize display vars
        $width          = intval( str_replace( array( '%', 'px', ' ' ), '', trim( $atts['width'] ) ) );
        $image_size     = sanitize_text_field( $atts['image_size'] );
        $rel            = sanitize_text_field( $atts['rel'] );
        $file           = wp_bc_bool( $atts['file'] );
        $comments       = wp_bc_bool( $atts['comments'] );
        $slide          = wp_bc_bool( $atts['slide'] );
        $controls       = wp_bc_bool( $atts['controls'] );

        // sanitize js vars
        $interval       = intval( $atts['interval'] );
        $pause          = sanitize_text_field( $atts['pause'] );
        $wrap           = wp_bc_bool( $atts['wrap'] );
        $keyboard       = wp_bc_bool( $atts['keyboard'] );

        $thickbox       = wp_bc_bool( $atts['thickbox'] );
        $unwrap         = wp_bc_bool( $atts['unwrap'] );

        $query          = get_children( compact( 'post_parent', 'post_status', 'post_type', 'post_mime_type', 'exclude', 'order', 'orderby' ) );

        // return data
        return compact( 'query', 'post_parent', 'width', 'image_size', 'rel', 'file', 'comments', 'slide', 'controls', 'interval', 'pause', 'wrap', 'keyboard', 'thickbox', 'unwrap' );
    }
    /**
     * Enqueue scripts.
     *
     * @since   0.1.1
     * @access  public
     * @static
     * @param   bool    $thickbox   Whether to enqueue thickbox scripts and styles. Default: false.
     * @return  void
     */
    public static function enqueue( $thickbox = false )
    {
        // enqueue carousel script
        if( ! wp_script_is( 'wp-bootstrap-carousel-init', 'enqueued' ) ) {
            wp_enqueue_script( 'wp-bootstrap-carousel-init' );
        }

        // enqueue thickbox styles & script
        if( $thickbox && ! wp_script_is( 'thickbox', 'enqueued' ) ) {
            add_thickbox();
        }

        // action hook
        do_action( 'wp_bootstrap_carousel_enqueue' );
    }
    /**
     * Register scripts, enqueue styles.
     *
     * @since   0.2.0
     * @access  public
     * @uses    WP_Bootstrap_Carousel::plugin_url()
     * @return  void
     */
    public function wp_enqueue_scripts()
    {
        // script debug variable
        $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        // register carousel scripts
        wp_register_script( 'wp-bootstrap-carousel',        $this->plugin_url() . '/js/carousel' . $min . '.js', array( 'jquery' ), $this->version_bootstrap, true );
        wp_register_script( 'wp-bootstrap-carousel-init',   $this->plugin_url() . '/js/carousel-init' . $min . '.js', array( 'jquery', 'wp-bootstrap-carousel' ), $this->version, true );

        // enqueue styles
        wp_enqueue_style( 'wp-bootstrap-carousel',          $this->plugin_url() . '/css/carousel' . $min . '.css', array(), $this->version, 'screen' );
    }
    /**
     * Modify front end body class
     *
     * Adds prefixed and sanitized theme name to body class. Used for styling carousel used
     * with WordPress default themes.
     *
     * @since   0.2.0
     * @access  public
     * @param   array   $classes    Array of HTML classes.
     * @return  array               Modified array of HTML classes.
     */
    public function body_class( $classes )
    {
        $default_theme_slug = array_search( wp_get_theme()->Name, self::$default_themes );

        if( false !== $default_theme_slug )
        {
            $classes[] = "wpbc-{$default_theme_slug}";
        }

        return $classes;
    }
    /**
     * Include and instantiate DPS addon.
     *
     * @since   0.1.1
     * @access  public
     * @uses    WP_Bootstrap_Carousel_DPS
     * @return  object
     */
    public function be_display_posts_plugin()
    {
        if( ! class_exists( 'WP_Bootstrap_Carousel_DPS' ) )
        {
            include( 'inc/wp-bootstrap-carousel-dps.php' );

            WP_Bootstrap_Carousel_DPS::instance();
        }
    }
    /**
     * Admin plugin row meta.
     *
     * @since   0.1.1
     * @access  public
     * @param   array   $links  Array of links.
     * @param   string  $file   Plugin basename.
     * @return  array           Modified array of links.
     */
    public function plugin_row_meta( $links, $file )
    {
        if( plugin_basename( __FILE__ ) === $file )
        {
            $links[] = sprintf( '<a href="%1$s" target="_blank">' . __( 'Wiki', 'wp_bootstrap_carousel' ) . '</a>', esc_url( 'https://github.com/diggy/wp-bootstrap-carousel/wiki' ) );
            $links[] = sprintf( '<a href="%1$s" target="_blank">' . __( 'Donate', 'wp_bootstrap_carousel' ) . '</a>', esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JMEK9E362ALYJ' ) );
        }

        return $links;
    }
    /**
     * Get the plugin url.
     *
     * @since   0.4.0
     * @access  public
     * @return  string  The plugin url.
     */
    public function plugin_url()
    {
        return untrailingslashit( plugins_url( '/', __FILE__ ) );
    }

} // end class

/**
 * Init WP_Bootstrap_Carousel class.
 *
 * Initializes the main plugin class.
 *
 * @since 0.1.1
 */
WP_Bootstrap_Carousel::instance();

} // end class_exists check

/**
 * Convert string to boolean
 *
 * @since   0.2.1
 * @param   string  $value  Value to validate. Default: false.
 * @return  bool            True or false.
 */
function wp_bc_bool( $value = false )
{
    if( function_exists( 'wp_validate_boolean' ) ) {
        return wp_validate_boolean( $value );
    }

    return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
}
