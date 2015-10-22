<?php
/**
 * Zen Gallery it creates a custom Post-Type for Galleries and teams.
 *
 * @package   ZenGallery
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */


class GalleryPostType {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'zen_pt_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    protected $postType = 'zen_gallery';

    protected $postTypeTax = 'zen_gal_tax';

    private function __construct() {

        //$this->zen_pt_init();

        if ( is_admin() ) {
            add_filter( 'enter_title_here', array( &$this, 'change_default_title' ) );
        }

    }

    public function zen_pt_init() {

        $labels = array(
            'name'                  => __('Galleries', 'zen-admin'),
            'singular_name'         => __('Gallery', 'zen-admin'),
            'add_new'               => __('Add new', 'zen-admin'),
            'add_new_item'          => __('Add new gallery', 'zen-admin'),
            'edit_item'             => __('Edit Gallery', 'zen-admin'),
            'new_item'              => __('New Gallery', 'zen-admin'),
            'view_item'             => __('View Gallery', 'zen-admin'),
            'search_items'          => __('Search Gallery', 'zen-admin'),
            'not_found'             => __('No gallery found.', 'zen-admin'),
            'not_found_in_trash'    => __('No gallery found in trash.', 'zen-admin'),
            'parent_item_colon'     => ''
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => true,
            'hierarchical'          => false,
            'menu_position'         => null,
            'capability_type'       => 'post',
            'supports'              => array('title'),
            //'menu_icon'             => plugin_dir_url(__FILE__) . 'ClubixGalleryCore/assets/img/icon2.png'
        );

        register_post_type( $this->postType, $args );

        register_taxonomy(
            $this->postTypeTax, $this->postType,
            array(
                'hierarchical'      => true,
                'label'             => __('Categories', 'zen-admin'),
                'singular_label'    => __('Category', 'zen-admin'),
                'public'           => true
            )
        );

    }

    function change_default_title( $title ){

        $screen = get_current_screen();

        if ( $this->postType == $screen->post_type ){
            $title = __('Gallery name...', 'zen-admin');
        }

        return $title;
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}