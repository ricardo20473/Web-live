<?php
/**
 * This file is used to configure all theme's functions and this is the place where magic happens.
 *
 * @since 1.0.0
 * @author Stylish Themes
 */

/***********************************************************************************************/
/*  Define Constants */
/***********************************************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/assets/img');

define('SB_AVAILABLE_ITEMS', json_encode(array('.col-sm-1-5', '.vc_span3', '.vc_span4', '.vc_span6', '.vc_span12', '.wpb_text_column', '.vc_span2', '.post', '.widget', '.tagcloud > a')));

if ( !defined( 'LANGUAGE_ZONE' ) ) {
    define( 'LANGUAGE_ZONE', 'zen7' );
}

/************************************************************/
/* Theme Setup */
/************************************************************/
add_action( 'after_setup_theme', 'zen_theme_setup' );

function zen_theme_setup() {

    add_theme_support('woocommerce');

    /************************************************************/
    /* Load the textdomain, for later translations. */
    /************************************************************/
    load_theme_textdomain( 'zen7', get_template_directory() . '/lang' );


    /***********************************************************************************************/
    /* Set the max width of the uploaded images */
    /***********************************************************************************************/
    if (!isset($content_width)) $content_width = 1028;


    /***********************************************************************************************/
    /* Set the vc_path to the new folder */
    /***********************************************************************************************/
    if ( function_exists('vc_set_template_dir') ) {
        $dir = get_stylesheet_directory() . '/vc_templates/';
        vc_set_template_dir($dir);
    }

    if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);

    /***********************************************************************************************/
    /* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
    /***********************************************************************************************/
    if (function_exists('add_theme_support')) {

        // This theme supports a variety of post formats.
        add_theme_support('post-formats', array('quote', 'gallery', 'video', 'audio'));

        add_theme_support('post-thumbnails');

        set_post_thumbnail_size(125, 125, true);

        update_option('thumbnail_size_w', 350);

        update_option('thumbnail_size_h', 350);

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();
    }

    if ( function_exists( 'add_image_size' ) ) {

        add_image_size('custom_blog_image_1', 705, 350, true);

        add_image_size('custom_blog_image_2', 295, 9999);

        add_image_size('custom_masonry_image_1', 261, 9999);

        add_image_size('custom_masonry_image_2', 553, 9999);

        add_image_size('zen_gallery_images_1', 705, 276, true);

        add_image_size('zen_gallery_images_1_single', 730, 470, true);

        add_image_size('blog_single_1', 170, 170, true);

        add_image_size('parallax_header_bg', 1366, 247);

        add_image_size('portfolio_single_big', 1015, 532, true);

        add_image_size('portfolio_single_gallery', 255, 255, true);

        add_image_size('portfolio_blog_1', 350, 236, true);

        add_image_size('portfolio_blog_3', 758, 9999);

        add_image_size('blog_single_gallery', 400, 400, true);

        add_image_size('zen_testimonials', 74, 74, true);

        add_image_size('zen_team', 350, 297, true);

    }


    /************************************************************/
    /* Load custom Scripts and Styles for Zen7. */
    /************************************************************/
    add_action('wp_enqueue_scripts', 'zen_load_custom_scripts');

    add_action('wp_enqueue_scripts', 'zen_load_custom_styles');


    /************************************************************/
    /* Register the menus. */
    /************************************************************/
    add_action('init', 'zen_register_my_menus');


    /************************************************************/
    /* Filters for the comments forms. */
    /************************************************************/
    add_filter('comment_form_defaults', 'zen_custom_comment_form');

    add_filter('comment_form_default_fields', 'zen_custom_comment_fields');

    add_action('print_media_templates', 'zen_media_gallery');

    add_filter( 'attachment_fields_to_edit', 'zen_attachment_fields_to_edit', 10, 2 );

    add_action( 'edit_attachment', 'zen_save_attachment_fields' );

    add_filter('widget_text', 'do_shortcode');

    add_action('wp_head','zen_google_analytics');

}

function zen_load_custom_scripts() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('show-submenu', THEMEROOT . '/assets/js/show-submenu.js', array(), '1.0', true);
    wp_enqueue_script('elements-nav', THEMEROOT . '/assets/js/elements-nav.js', array(), '1.0', true);
    wp_enqueue_script('zenplug', THEMEROOT . '/assets/js/zenplug.js', array(), '1.0', true);
    wp_enqueue_script('min', THEMEROOT . '/assets/js/min.js', array(), '1.0', true);
    wp_enqueue_script('masonry', THEMEROOT . '/assets/js/masonry.js', array(), '1.0', true);
    wp_enqueue_script('jquery-nicescroll', THEMEROOT . '/assets/js/jquery.nicescroll.min.js', array(), '1.0', true);
    wp_enqueue_script('prettyPhoto', THEMEROOT . '/assets/prettyPhoto/js/jquery.prettyPhoto.js', array(), '1.0', true);
    wp_enqueue_script('royalSliderJs', THEMEROOT . '/assets/royalslider/jquery.royalslider.min.js', array(), '1.0', true);
    wp_enqueue_script('application', THEMEROOT . '/assets/js/application.js', array(), '1.0', true);
    wp_enqueue_script('chosen', THEMEROOT . '/assets/js/chosen.jquery.js', array(), '1.0', true);
    wp_enqueue_script('jparallax', THEMEROOT . '/assets/js/jparallax.js', array(), '1.0', true);
    wp_enqueue_script('fitvids', THEMEROOT . '/assets/js/jquery.fitvids.js', array(), '1.0', true);
    wp_enqueue_script('portfolio', THEMEROOT . '/assets/js/portfolio.js', array(), '1.0', true);
    wp_enqueue_script('portfolio-filter', THEMEROOT . '/assets/js/portfolio-filter.js', array(), '1.0', true);
    wp_enqueue_script('select-js', THEMEROOT . '/assets/js/select-js.js', array(), '1.0', true);
    wp_enqueue_script('booty', THEMEROOT . '/assets/js/booty.js', array(), '1.0', true);

    wp_register_script('google-maps-api', 'http://maps.google.com/maps/api/js?sensor=false', array(), '1.0', true);

    if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT']))
    {
        wp_enqueue_script('html5shiv', THEMEROOT . '/assets/js/html5shiv.js', array(), '1.0', true);
    }

}

function zen_load_custom_styles() {

    wp_enqueue_style( 'style', get_stylesheet_uri());
    wp_enqueue_style( 'bootstrap', THEMEROOT . '/assets/less/bootstrap.css');
    wp_enqueue_style( 'prettyPhoto', THEMEROOT . '/assets/prettyPhoto/css/prettyPhoto.css');
    wp_enqueue_style( 'royalSliderCss', THEMEROOT . '/assets/royalslider/royalslider.css');
    wp_enqueue_style( 'royalSliderCssDefault', THEMEROOT . '/assets/royalslider/skins/default/rs-default.css');
    wp_enqueue_style( 'royalSliderCssDefault', THEMEROOT . '/assets/royalslider/skins/default/rs-default.css');
    wp_enqueue_style( 'nProgressCSS', THEMEROOT . '/assets/nprogress/nprogress.css');
    //wp_enqueue_style( 'ZenColors', THEMEROOT . '/assets/less/colors/colors.css');

    if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT']))
    {
        wp_enqueue_style( 'IE8', THEMEROOT . '/assets/less/css/ie-8.css');
        //wp_enqueue_style( 'ZenColors', THEMEROOT . '/assets/less/colors/ie-colors.css');
    }

    if(preg_match('/(?i)msie [9]/',$_SERVER['HTTP_USER_AGENT']))
    {
        wp_enqueue_style( 'IE9', THEMEROOT . '/assets/less/css/ie-9.css');
    }

}

function zen_google_analytics() {
    global $zen7_data;

    print_r(stripslashes($zen7_data['zen_tracking_code']));
}

function zen_register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', 'zen-admin')
        )
    );
}

/**
 * This function adds a special 'style' field on the Gallery Settings.
 *
 * @since 1.0.0
 */
function zen_media_gallery() {

    ?>
    <script type="text/html" id="tmpl-zen-gallery-style">
        <label class="setting">
            <span><?php _e('Style', 'zen-admin'); ?></span>
            <select data-setting="style">
                <option value="slideshow"> Slideshow </option>
                <option value="wp_default"> Wordpress Default </option>
            </select>
        </label>
    </script>

    <script>

        jQuery(document).ready(function(){

            _.extend(wp.media.gallery.defaults, {
                style: 'wp_default'
            });

            wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                template: function(view){
                    return wp.media.template('gallery-settings')(view)
                        + wp.media.template('zen-gallery-style')(view);
                }
            });

        });

    </script>
<?php
}

/**
 * Add video url field for attachments.
 *
 */
function zen_attachment_fields_to_edit( $fields, $post ) {

    if ( strpos( get_post_mime_type( $post->ID ), 'image' ) !== false ) {
        $video_url = get_post_meta( $post->ID, 'zen_video_url', true );

        $fields['zen_video_url'] = array(
            'label' 		=> __('Video URL: ', 'zen-admin'),
            'input' 		=> 'text',
            'value'			=> $video_url ? $video_url : '',
            'show_in_edit' 	=> true
        );

    }

    return $fields;
}

/**
 * Save video url attachment field.
 *
 */
function zen_save_attachment_fields( $attachment_id ) {

    // video url
    if ( isset( $_REQUEST['attachments'][$attachment_id]['zen_video_url'] ) ) {

        $location = esc_url($_REQUEST['attachments'][$attachment_id]['zen_video_url']);
        update_post_meta( $attachment_id, 'zen_video_url', $location );
    }

}

/**
 * Custom Function for Displaying Comments
 *
 * @since 1.0.0
 */
function zen_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>

        <li class="pingback" id="comment-<?php comment_ID(); ?>">

        <article <?php comment_class('clearfix'); ?>>

            <header>

                <h4><?php _e('Pingback:', 'zen7'); ?></h4>
                <p><?php edit_comment_link(); ?></p>

            </header>

            <?php comment_author_link(); ?>

        </article>

    <?php endif; ?>

    <?php if (get_comment_type() == 'comment') : ?>
        <li id="comment-<?php comment_ID(); ?>">

        <div <?php comment_class('clearfix the-comment-container'); ?>>

            <div class="left-section">

                <?php
                $avatar_size = 80;
                if ($comment->comment_parent != 0) {
                    $avatar_size = 70;
                }

                echo get_avatar($comment, $avatar_size);
                ?>

            </div>

            <div class="right-section">

                <h1 class="name">
                    <?php comment_author_link(); ?>
                </h1>

                <div class="top-comment-sec">

                    <ul class="top-ul-comment">

                        <li>
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </li>
                        <li>
                            <p class="time-comment"><?php comment_date(); ?>, <?php comment_time(); ?></p>
                        </li>

                    </ul>

                </div>

                <div class="clear"></div>

                <div class="comment-text">

                    <?php if ($comment->comment_approved == '0') : ?>

                        <p class="awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'zen7'); ?></p>

                    <?php endif; ?>

                    <?php comment_text(); ?>

                </div>

            </div>

            <div class="clear"></div>

        </div>

    <?php endif;
}

function zen_custom_comment_form($defaults) {
    $comment_notes_after = '' .
        '<div class="allowed-tags">' .
        '<p><strong>' . __('Allowed Tags', 'zen7') . '</strong></p>' .
        '<code> ' . allowed_tags() . ' </code>' .
        '</div> <!-- end allowed-tags -->';

    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = $comment_notes_after;
    $defaults['id_form'] = 'comment-form';
    $defaults['comment_field'] = '<textarea name="comment" id="comment" placeholder="'. __('Message *', 'zen7') .'"></textarea>';

    return $defaults;
}

function zen_custom_comment_fields() {
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $fields = array(
        'author' => '<ul class="comment-form-inputs"><li>' .
            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req .
            ' placeholder="' . __('Name ', 'zen7') . ($req ? __('*', 'zen7') : '') . '" /></li>',
        'email' => '<li>' .
            '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req .
            ' placeholder="' . __('Email ', 'zen7') . ($req ? __('*', 'zen7') : '') . '"/>' .
            '</li>',
        'url' => '<li>' .
            '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
            '" placeholder="' . __('Website ', 'zen7') . '" />' .
            '</li></ul>'
    );

    return $fields;
}


if ( ! function_exists( 'zen_paging_nav' ) ) {
    /**
     * Displays navigation to next/previous set of posts when applicable.
     *
     * @since Zen7 1.0.0
     *
     * @return void
     */
    function zen_paging_nav() {
        global $wp_query;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 )
            return;
        ?>
        <ul class="pager">
            <li class="previous"><?php next_posts_link(__('« Older Posts', 'zen7')); ?></li>
            <li class="next"><?php previous_posts_link(__('Newer Posts »', 'zen7')); ?></li>
        </ul>
    <?php
    }
}

if ( ! function_exists( 'zen_paging_nav_query' ) ) {
    /**
     * @param $query
     *
     * @since 1.0.0
     */
    function zen_paging_nav_query($query) {
        //global $wp_query;

        // Don't print empty markup if there's only one page.
        if ( $query->max_num_pages < 2 )
            return;
        ?>
        <ul class="pager">
            <li class="previous"><?php next_posts_link(__('« Older Posts', 'zen7'), $query->max_num_pages); ?></li>
            <li class="next"><?php previous_posts_link(__('Newer Posts »', 'zen7')); ?></li>
        </ul>
    <?php
    }
}


/***********************************************************************************************/
/* Add Sidebar Support */
/***********************************************************************************************/
if (function_exists('register_sidebar')) {

    register_sidebar(
        array(
            'name' => __( 'Main Sidebar', 'zen-admin' ),
            'id' => 'main-sidebar',
            'description' => __( 'Appears on posts and pages, which has its own widgets', 'zen-admin' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="title-widget">',
            'after_title' => '</div>'
        )
    );

    register_sidebar(
        array(
            'name' => __( 'Contact Sidebar', 'zen-admin' ),
            'id' => 'contact-sidebar',
            'description' => __( 'Appears on contact page, which has its own widgets', 'zen-admin' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="title-widget">',
            'after_title' => '</div>'
        )
    );

    register_sidebar(
        array(
            'name' => __( 'Footer Sidebar', 'zen-admin' ),
            'id' => 'footer-sidebar',
            'description' => __( 'Appears on footer.', 'zen-admin' ),
            'before_widget' => '<div class="col-md-3"><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div><div class="clear"></div></div>',
            'before_title' => '<div class="title-widget">',
            'after_title' => '</div>'
        )
    );

    register_sidebar(
        array(
            'name' => __( 'WooCommerce Sidebar', 'zen-admin' ),
            'id' => 'woocommerce_sidebar',
            'description' => __( 'Appears on woocommerce pages.', 'zen-admin' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="title-widget">',
            'after_title' => '</div>'
        )
    );

}


/************************************************************/
/**
 * WooCommerce Support
 * @since 1.2.0
 */
/************************************************************/
if (defined( 'WOOCOMMERCE_VERSION' )) {
    if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    } else {
        define( 'WOOCOMMERCE_USE_CSS', false );
    }
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'zen_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'zen_wrapper_end', 10);

function zen_wrapper_start() {
    echo '<div class="container container-m-tb-small">';
}

function zen_wrapper_end() {
    echo '</div>';
}

/* ??? */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action( 'zen_shop_breadcrumbs', 'woocommerce_breadcrumb', 20);
add_filter( 'woocommerce_show_page_title' , '__return_false' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
/* ??? */

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 5);
add_action( 'woocommerce_before_shop_loop_item_title', 'zen_woo_loop_product_info', 5);
add_action( 'woocommerce_single_product_summary', 'zen_woo_single_product_border', 15);

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

function zen_woo_loop_product_info() {
    $output = '<div class="product-buttons"><div class="product-buttons-container clearfix"><a href="'.get_permalink().'" class="show_details_button">'.__('More info','zen7').'</a></div></div>';

    echo $output;
}

function zen_woo_single_product_border() {
    $output = '<div class="clear"></div>';
    $output .= '<div class="product-border"></div>';

    echo $output;
}

add_action( 'woocommerce_before_cart_table', 'zen_before_cart_table', 10);
function zen_before_cart_table(){
    echo '<div class="woocommerce-content-box clearfix">';
}

add_action( 'woocommerce_after_cart_table', 'zen_after_cart_table', 10);
function zen_after_cart_table(){
    echo '</div>';
}

/************************************************************/
/* End WooCommerce Support */
/************************************************************/


/************************************************************/
/* Request Helpers */
/************************************************************/
require_once('lib/functions/NavWalker.php');
require_once('lib/functions/helpers.php');
require_once('lib/functions/core-functions.php');
require_once('lib/functions/admin-metaboxes/zen-metaboxes.php');
require_once('lib/functions/admin-shortcodes/shortcodes_setup.php');
require_once('admin/tgm-plugin-activation/recommended-plugins.php');

if (class_exists('ReduxFramework')) {
    require_once('admin/redux-framework/sample-config.php');
}
