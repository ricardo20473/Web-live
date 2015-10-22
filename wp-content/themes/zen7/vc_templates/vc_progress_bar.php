<?php
$output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = $value = '';
extract( shortcode_atts( array(
    'title' => '',
    'values' => '',
    'units' => '',
    'bgcolor' => 'progress-bar-info',
    'custombgcolor' => '',
    'options' => '',
    'el_class' => '',
    'value' => '50'
), $atts ) );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass($el_class);

$bar_options = '';
$hover = '';

$options = explode(",", $options);
if (in_array("animated", $options)) $bar_options .= " active";
if (in_array("striped", $options)) $bar_options .= " progress-striped";
if (! in_array("hover", $options)) $hover .= " no-hover";

$output .= '<div class="progress-bar-with-title"><div class="clearfix">';
$output .= '<span class="left-skill">'.$title.'</span>';
$output .= '<span class="right-percent">'.$value.$units.'</span></div>';
$output .= '<div class="progress '.$bar_options.'">';
$output .= '<div class="progress-bar '.$bgcolor.' '.$hover.'" role="progressbar" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$value.'%;"></div>';
$output .= '</div></div>';

echo $output . $this->endBlockComment('progress_bar') . "\n";