<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Zen_Tables_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'zen_table', array( &$this, 'table_shortcode' ) );
    }

    public function table_shortcode( $atts, $content ) {
        $output = $type = $heading = $price = $currency = $divider = $button_text = $button_url = '';

        extract( shortcode_atts( array(
            'type'          => '',
            'heading'       => '',
            'price'         => '',
            'currency'      => '$',
            'divider'       => '/m',
            'button_text'   => '',
            'button_url'    => '#'
        ), $atts ) );

        $output .= '<div class="table '.$type.'"><div class="price">';
        $output .= '<sup>'.$currency.'</sup><span>'.$price.'</span><sub>'.$divider.'</sub>';
        $output .= '<h2 class="uppercase">'.$heading.'</h2></div>';
        $output .= do_shortcode($content);
        $output .= '<a href="'.$button_url.'" class="btn btn-default btn-lg">'.$button_text.'</a>';
        $output .= '</div>';

        return $output;
    }

}

Zen_Tables_Shortcode::get_instance();