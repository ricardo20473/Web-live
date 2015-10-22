<?php
/**
 * Zen Theme Controller
 *
 * Installs Zen7 Custom Post Types, Shortcodes, etc.
 * WordPress coding standards and PHP best practices have been kept.
 *
 * @package   Zen Theme Controller
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 *
 * @wordpress-plugin
 * Plugin Name: Zen Theme Controller
 * Plugin URI:  http://stylishthemes.co/zen7/
 * Description: Installs Zen7 Custom Post Types, Shortcodes, etc.
 * Version:     1.0.0
 * Author:      Vlad Mustiata
 * Author URI:  http://stylishthemes.co
 * Text Domain: zen-theme-controller
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once ( plugin_dir_path( __FILE__ ) . 'app/controller.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'ZenThemeController', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ZenThemeController', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'ZenThemeController', 'get_instance' ) );