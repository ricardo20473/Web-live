<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract(shortcode_atts(array(
    'color' => 'btn-default',
    'size' => '',
    'icon' => 'none',
    'target' => '_self',
    'href' => '#',
    'el_class' => '',
    'title' => __('Text on the button', "js_composer"),
    'position' => ''
), $atts));
$a_class = '';

if ( $target == 'same' || $target == '_self' ) { $target = ''; }
$target = ( $target != '' ) ? ' target="'.$target.'"' : '';

$output .= '<a href="'.$href.'" class="btn '.$color.' '.$size.' '.$el_class.'" '.$target.'>'.$title.'</a>';

echo $output . $this->endBlockComment('button') . "\n";