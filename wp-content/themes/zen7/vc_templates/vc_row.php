<?php
$output = $zen_container_style = $zen_parallax_image = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';
extract(shortcode_atts(array(
    'el_class'              => '',
    'bg_image'              => '',
    'bg_color'              => '',
    'bg_image_repeat'       => '',
    'font_color'            => '',
    'padding'               => '',
    'margin_bottom'         => '',
    'zen_container_style'   => '',
    'zen_parallax_image'    => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$style_parallax = buildParallaxStyle($zen_parallax_image, $bg_color, $padding, $margin_bottom);

switch($zen_container_style) {

    case '' :
        $output .= '<div class="'.$css_class.'"'.$style.'>';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>'.$this->endBlockComment('row');
        break;

    case 'container' :
        $output .= '<div class="'.$css_class.' container-m-tb"'.$style.'>';
        $output .= '<div class="container">';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>';
        $output .= '</div>'.$this->endBlockComment('row');
        break;

    case 'parallax' :
        $output .= '<div class="'.$css_class.' container-m-tb"'.$style_parallax.'>';
        $output .= '<div class="container">';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>';
        $output .= '</div>'.$this->endBlockComment('row');
        break;

    case 'feature-slider' :
        $output .= '<div class="one-feature-slider '.$css_class.'">';
        $output .= '<div class="container">';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>';
        $output .= '</div>'.$this->endBlockComment('row');
        break;
}

echo $output;