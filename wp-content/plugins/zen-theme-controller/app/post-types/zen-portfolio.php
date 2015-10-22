<?php
/**
 * Zen Portfolio it creates a custom Post-Type for portfolios.
 *
 * @package   ZenPortfolio
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */


class PortfolioPostType {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'zen_pt_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    protected $postType = 'zen_portfolio';

    protected $taxonomyName = 'zen_port_cat';

    private function __construct() {

        $this->zen_pt_init();

        if ( is_admin() ) {
            add_filter( 'enter_title_here', array( &$this, 'change_default_title' ) );
        }

    }

    public function zen_pt_init() {

        $labels = array(
            'name'                  => __('Portfolios', 'zen-admin'),
            'singular_name'         => __('Portfolio', 'zen-admin'),
            'add_new'               => __('Add new', 'zen-admin'),
            'add_new_item'          => __('Add new portfolio', 'zen-admin'),
            'edit_item'             => __('Edit Portfolio', 'zen-admin'),
            'new_item'              => __('New Portfolio', 'zen-admin'),
            'view_item'             => __('View Portfolio', 'zen-admin'),
            'search_items'          => __('Search Portfolio', 'zen-admin'),
            'not_found'             => __('No portfolio found.', 'zen-admin'),
            'not_found_in_trash'    => __('No portfolio found in trash.', 'zen-admin'),
            'parent_item_colon'     => ''
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => true,
            'hierarchical'          => false,
            'menu_position'         => null,
            'capability_type'       => 'post',
            'supports'              => array('title','editor','thumbnail'),
            //'taxonomies'            => array( 'post_tag' ),
            'menu_icon'             => plugin_dir_url(__FILE__) . '/assets/portfolio.png'
        );

        register_post_type( $this->postType, $args );

        register_taxonomy(
            $this->taxonomyName, $this->postType,
            array(
                'hierarchical'      => true,
                'label'             => __('Portfolio Categories', 'zen-admin'),
                'singular_label'    => __('Portfolio Category', 'zen-admin'),
                'public'           => true
            )
        );

    }

    function change_default_title( $title ){

        $screen = get_current_screen();

        if ( $this->postType == $screen->post_type ){
            $title = __('Portfolio\Project name...', 'zen-admin');
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