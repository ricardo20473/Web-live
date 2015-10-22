<?php
$output = $title = $interval = $el_class = $type = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'type'     => ''
), $atts));

wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';

$nav_content_class = 'nav nav-pills';
$content_class_container = 'tab-content';
if ( $type == '2' ) { $nav_content_class = 'nav nav-tabs tabs-bd'; $content_class_container = 'tab-content tabs-bd'; }
if ( $type == '3' ) { $nav_content_class = 'nav nav-tabs tabs-bd tabs-blue'; $content_class_container = 'tab-content tabs-bd tabs-blue'; }
if ( $type == '4' ) { $nav_content_class = 'nav nav-tabs tabs-bd tabs-blue tabs-bd-blue'; $content_class_container = 'tab-content tabs-bd tabs-bd-blue'; }
if ( 'vc_tour' == $this->shortcode ) { $nav_content_class = 'nav nav-tabs nav-stacked tabs-bd left-tabs-content'; $content_class_container = 'tab-content tabs-bd tabs-blue right-tab-content'; }

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\")(\sstyle\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();


/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul id="myTab" class="'.$nav_content_class.'">';
$i = 0;
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\")(\sstyle\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );

    if(isset($tab_matches[1][0]) && $i != 0) {
        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" data-toggle="tab" class="'. (isset($tab_matches[5][0]) && 'vc_tour' == $this->shortcode ? $tab_matches[5][0] : '' ) .'">' . $tab_matches[1][0] . '</a></li>';
    } else {
        $tabs_nav .= '<li class="active"><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" data-toggle="tab" class="'. (isset($tab_matches[5][0]) && 'vc_tour' == $this->shortcode ? $tab_matches[5][0] : '' ) .'">' . $tab_matches[1][0] . '</a></li>';
    }
    $i++;
}
$tabs_nav .= '</ul>'."\n";

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.$el_class), $this->settings['base']);

$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
$output .= "\n\t\t\t".$tabs_nav;
$output .= '<div id="myTabContent" class="'.$content_class_container.'">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;