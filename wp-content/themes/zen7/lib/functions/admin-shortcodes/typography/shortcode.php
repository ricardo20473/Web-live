<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Zen_Typography_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'zen_list', array( &$this, 'list_shortcode' ) );
        add_shortcode( 'zen_list_item', array( &$this, 'list_item_shortcode' ) );
    }

    public function list_shortcode( $atts, $content ) {
        $output = $style = $text = '';

        extract( shortcode_atts( array(
            'style'      => 'bullet-arrow'
        ), $atts ) );

        $output .= '<ul class="' . $style . '">'.do_shortcode($content).'</ul>';

        return $output;
    }

    public function list_item_shortcode( $atts, $content ) {
        $output = $style = $text = '';

        extract( shortcode_atts( array(
            'style'      => 'bullet-arrow'
        ), $atts ) );

        $output .= '<li>'.do_shortcode($content).'</li>';

        return $output;
    }

}

Zen_Typography_Shortcode::get_instance();