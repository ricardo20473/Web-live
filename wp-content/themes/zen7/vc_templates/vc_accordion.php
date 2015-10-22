<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = $style = '';

extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1',
    'style' => 'panel-default'
), $atts));

$instance = ZenShortcodes::get_instance()->accordion_instance;
ZenShortcodes::get_instance()->accordion_class = $style;
ZenShortcodes::get_instance()->accordion_count = 1;

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel-group '.$el_class.' ', $this->settings['base']);

$output .= "\n\t".'<div class="'.$css_class.'" data-collapsible='.$collapsible.' data-active-tab="'.$active_tab.'" id="accordion-0'.$instance.'">'; //data-interval="'.$interval.'"
//$output .= "\n\t\t".'<div class="panel-group wpb_wrapper wpb_accordion_wrapper ui-accordion" id="accordion-01">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
//$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');

echo $output;

ZenShortcodes::get_instance()->accordion_instance++;