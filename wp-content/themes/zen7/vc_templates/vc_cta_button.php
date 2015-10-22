<?php
$output = $color = $icon = $size = $heading = $target = $href = $title = $call_text = $position = $el_class = '';
extract(shortcode_atts(array(
    'color' => '',
    'icon' => 'none',
    'size' => '',
    'target' => '',
    'href' => '#',
    'title' => __('Text on the button', "js_composer"),
    'call_text' => '',
    'position' => 'cta_align_right',
    'el_class' => '',
    'heading' => ''
), $atts));

$classes = array(
    'jumbotron' => 'btn-default',
    'jumbotron-primary' => 'btn-primary',
    'jumbotron-info' => 'btn-default',
    'jumbotron-success' => 'btn-success'

);

$output .= '<div class="jumbotron '.$color.'"><div class="container">';
$output .= '<h1>'.$heading.'</h1><p>'.$call_text.'</p><a href="'.$href.'" class="btn '.$classes[$color].' uppercase">'.$title.'</a></div></div>';


echo $output;