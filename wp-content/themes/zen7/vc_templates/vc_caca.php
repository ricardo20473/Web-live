<?php
$title = $el_class = $value = $label_value= $units = $color = $size = '';
extract(shortcode_atts(array(
    'title'         => '',
    'el_class'      => '',
    'value'         => '50',
    'units'         => '',
    'color'         => '#8dc2e6',
    'label_value'   => 'title',
    'size'          => '.01'
), $atts));

//wp_enqueue_script('vc_pie');

$el_class = $this->getExtraClass( $el_class );
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'circle-skills '.$el_class, $this->settings['base']);
$output = "\n\t".'<div class= "'.$css_class.'">';
    $output .= "\n\t\t".'<input class="knob" data-width="165" data-fgColor="'.$color.'" data-readOnly="true" data-thickness="'.$size.'" data-bgColor="#f1f1f1" value="'.$value.'" />';
    $output .= "\n\t\t".'<h1 style="color: '.$color.';">'.$label_value.'</h1>';
        if ($title!='') {
        $output .= '<h4 class="wpb_heading wpb_pie_chart_heading">'.$title.'</h4>';
        }
$output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";

echo $output;