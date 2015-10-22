<?php
/**
 * Stylish YouTube Links Plugin Class
 *
 * @package   Zen Theme Controller
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */

class ZenThemeController {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'zen_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    private function __construct() {

        require_once ( plugin_dir_path( __FILE__ ) . 'post-types/zen-portfolio.php' );
        add_action( 'init', array( 'PortfolioPostType', 'get_instance' ) );

        require_once ( plugin_dir_path( __FILE__ ) . 'post-types/zen-team.php' );
        add_action( 'init', array( 'TeamPostType', 'get_instance' ) );

        require_once ( plugin_dir_path( __FILE__ ) . 'post-types/zen-testimonials.php' );
        add_action( 'init', array( 'TestimonialPostType', 'get_instance' ) );

        require_once ( plugin_dir_path( __FILE__ ) . 'post-types/zen-clients.php' );
        add_action( 'init', array( 'CustomersPostType', 'get_instance' ) );

        require_once ( plugin_dir_path( __FILE__ ) . 'post-types/zen-gallery.php' );
        add_action( 'init', array( 'GalleryPostType', 'get_instance' ) );

        require_once ( plugin_dir_path( __FILE__ ) . 'widgets/zen-contact-form.php' );

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

    /**
     * Fired when the plugin is activated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public static function activate( $network_wide ) {
        if ( function_exists( 'is_multisite' ) && is_multisite() ) {
            if ( $network_wide  ) {
                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {
                    switch_to_blog( $blog_id );
                    self::single_activate();
                }
                restore_current_blog();
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
        delete_site_transient('update_plugins');
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
     */
    public static function deactivate( $network_wide ) {
        if ( function_exists( 'is_multisite' ) && is_multisite() ) {
            if ( $network_wide ) {
                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ( $blog_ids as $blog_id ) {
                    switch_to_blog( $blog_id );
                    self::single_deactivate();
                }
                restore_current_blog();
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
        delete_option( 'ZenThemeController');
    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @since    1.0.0
     *
     * @param	int	$blog_id ID of the new blog.
     */
    public function activate_new_site( $blog_id ) {
        if ( 1 !== did_action( 'wpmu_new_blog' ) )
            return;

        switch_to_blog( $blog_id );
        self::single_activate();
        restore_current_blog();
    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @since    1.0.0
     *
     * @return	array|false	The blog ids, false if no matches.
     */
    private static function get_blog_ids() {
        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        /** @noinspection PhpUndefinedMethodInspection */
        return $wpdb->get_col( $sql );
    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.0.0
     */
    private static function single_activate() {

        // Nothing is betther than something ?

    }

    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.0.0
     */
    private static function single_deactivate() {


    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        $domain = $this->plugin_slug;
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/ClubixGalleryCore/lang' );

    }

}