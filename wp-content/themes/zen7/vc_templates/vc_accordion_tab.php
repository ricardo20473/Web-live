<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer")
), $atts));

$instance = ZenShortcodes::get_instance()->accordion_instance;
$style = ZenShortcodes::get_instance()->accordion_class;
$count = ZenShortcodes::get_instance()->accordion_count;

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel ' . $style, $this->settings['base']);
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= '<div class="panel-heading">';
    $output .= "\n\t\t\t\t" . '<h4 class="panel-title"><a class="accordion-toggle '.($count==1 ? '' : 'collapsed').'" data-toggle="collapse" data-parent="#accordion-0'.$instance.'" href="#'.sanitize_title($title).$instance.'">'.$title.'</a></h4>';
    $output .= '</div>';
    $output .= "\n\t\t\t\t" . '<div id="'.sanitize_title($title).$instance.'" class="panel-collapse '. ($count==1 ? 'collapse in' : 'collapse') .'"><div class="panel-body">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div></div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;

ZenShortcodes::get_instance()->accordion_count++;