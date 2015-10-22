<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Zen Theme Controller
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2014 StylishThemes, Inc.
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}