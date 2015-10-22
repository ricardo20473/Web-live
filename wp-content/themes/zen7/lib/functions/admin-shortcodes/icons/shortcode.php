<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Zen_Icons_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'zen_social_icon', array( &$this, 'social_icons_shortcode' ) );
        add_shortcode( 'zen_header_icon', array( &$this, 'header_icons_shortcode' ) );
        add_shortcode( 'zen_icon', array( &$this, 'icons_shortcode' ) );
        add_shortcode( 'zen_label', array( &$this, 'labels_shortcode' ) );
    }

    public function labels_shortcode( $atts ) {
        $output = $style = $text = '';

        extract( shortcode_atts( array(
            'style'      => 'success',
            'text'       => 'NEW'
        ), $atts ) );

        $output .= '<span class="label label-' . $style . '">'.$text.'</span>';

        return $output;
    }

    public function icons_shortcode( $atts ) {
        $output = $icon = '';

        extract( shortcode_atts( array(
            'icon'      => 'icon-diamond'
        ), $atts ) );

        $output .= '<span class="' . $icon . '"></span>';

        return $output;
    }

    public function social_icons_shortcode( $atts ) {
        $output = $name = $type = '';

        extract( shortcode_atts( array(
            'name'      => '',
            'type'      => ''
        ), $atts ) );

        $class = '';
        if($type != '') { $class .= 'c-'; }
        $class .= $name;

        $output .= '<span class="social-icon ' . $class . '"></span>';

        return $output;
    }

    public function header_icons_shortcode( $atts ) {
        $output = $name = $type = $url = $tooltip_position = '';

        extract( shortcode_atts( array(
            'name'      => '',
            'type'      => '',
            'url'       => '#',
            'tooltip_position' => 'top'
        ), $atts ) );

        $class = '';
        if($tooltip_position == 'top') { $class = 'toptip'; }
        if($tooltip_position == 'left') { $class = 'lefttip'; }
        if($tooltip_position == 'bottom') { $class = 'bottomtip'; }
        if($tooltip_position == 'right') { $class = 'righttip'; }

        $output .= '<a href="'.$url.'" class="'.$class.' '.$type.'" original-title="'.$name.'"></a>';

        return $output;
    }

}

Zen_Icons_Shortcode::get_instance();