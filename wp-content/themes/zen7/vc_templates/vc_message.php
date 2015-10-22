<?php
$output = $color = $style = $el_class = $css_animation = '';
extract(shortcode_atts(array(
    'color' => 'alert-info',
    'style' => '',
    'el_class' => '',
    'css_animation' => ''
), $atts));
$el_class = $this->getExtraClass($el_class);

$style_class = $color.$style;

$output .= '<div class="alert '.$style_class.' '.$el_class.'"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$content.'</div>'.$this->endBlockComment('alert box')."\n";

echo $output;
