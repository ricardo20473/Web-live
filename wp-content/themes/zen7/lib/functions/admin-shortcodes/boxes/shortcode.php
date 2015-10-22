<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Zen_Boxes_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'zen_box', array( &$this, 'box_shortcode' ) );
    }

    public function box_shortcode( $atts ) {
        $output = $type = $heading = $text = $border_color = $icon = $icon_color = $box_bg_color = $head_color = '';

        extract( shortcode_atts( array(
            'text'          => '',
            'type'          => '',
            'heading'       => '',
            'border_color'  => '',
            'icon'          => 'icon-rocket',
            'icon_color'    => '',
            'box_bg_color'  => '',
            'head_color'    => ''
        ), $atts ) );


        $border_style = 'border-color: transparent;';
        if ($border_color != '') {
            $border_style = 'border-color: '.$border_color.';';
        }

        $icon_bg_color = '';
        if ($box_bg_color != '') {
            $icon_bg_color = 'background: '.$box_bg_color.';';
        }

        $icon_text_color = '';
        if ($icon_color != '') {
            $icon_text_color = 'color: '.$icon_color.';';
        }

        $head_text_color = '';
        if ($head_color != '') {
            $head_text_color = 'color: '.$head_color.';';
        }

        $output .= '<div class="features-icon '.$type.' clearfix">';
        $output .= '<div class="icon-feature" style="'.$border_style.$icon_bg_color.'"><span style="'.$icon_text_color.'" class="'.$icon.'"></span></div>';
        $output .= '<div class="content" style="'.$head_text_color.'"><h1>'.$heading.'</h1>';
        $output .= '<p>'.$text.'</p>';
        $output .= '</div></div>';

        return $output;
    }

}

Zen_Boxes_Shortcode::get_instance();