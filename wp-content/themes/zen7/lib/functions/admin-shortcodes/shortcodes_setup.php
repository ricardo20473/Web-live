<?php
/**
 * Here is the place that shortcodes are registered on Wordpress.
 *
 * @since 1.0.0
 *
 * @author Vlad Mustiata
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action('init', array('ZenShortcodes','get_instance'));


class ZenShortcodes {

    protected $prefix = 'zen_';

    protected static $instance = null;

    /**
     * Little trick for the accordion
     * @var int
     */
    public $accordion_instance = 0;
    public $accordion_class = '';
    public $accordion_count = 1;

    private function __construct() {

        add_shortcode( 'zen_testimonials', array( &$this, 'zen_testimonials_sc' ) );
        add_shortcode( 'zen_team', array( &$this, 'zen_team_sc' ) );
        add_shortcode( 'zen_employee', array( &$this, 'zen_employee_sc' ) );

        add_filter( 'post_gallery', array($this, 'zen_gallery_shortcode'), 15, 2 );

        // Let's take the blog shortcode
        require_once('blog/shortcode.php');
        require_once('blog-masonry/shortcode.php');
        require_once('portfolio/shortcode.php');
        require_once('icons/shortcode.php');
        require_once('boxes/shortcode.php');
        require_once('tables/shortcode.php');
        require_once('typography/shortcode.php');

        require_once('vc_setup.php');
    }

    public function zen_gallery_shortcode( $content = '', $attr = array() ) {
        static $instance = 0; $style = $order = $orderby = $id = $itemtag = $icontag = $captiontag = $columns = $size = $include = $exclude = $link = '';

        // return if this is standard mode or gallery already modified
        if ( !empty($content) ) {
            return $content;
        }

        $instance++;

        $post = get_post();

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post ? $post->ID : 0,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => '',
            'link'       => '',
            'style'      => ''
        ), $attr, 'gallery'));

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $icontag = tag_escape($icontag);
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) )
            $itemtag = 'dl';
        if ( ! isset( $valid_tags[ $captiontag ] ) )
            $captiontag = 'dd';
        if ( ! isset( $valid_tags[ $icontag ] ) )
            $icontag = 'dt';

        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';

        switch ( $style ) {

            case 'slideshow' :

                $gallery_style = "
                    <style type='text/css'>
                        .rsZenPortfolioSingle {
                            margin-bottom: 20px;
                        }
                        /* see gallery_shortcode() in lib/functions/admin-shortcodes/shortcodes_setup.php */
                    </style>";

                $output = apply_filters( 'gallery_style', $gallery_style );

                $count = count($attachments);

                $attachments = array(
                    'images'    => $attachments,
                    'count'     => $count
                );

                $royal_slider = zen_the_post_rs($attachments);

                $output .= $royal_slider;

                break;

            default :

                if ( apply_filters( 'use_default_gallery_style', true ) )
                    $gallery_style = "
                    <style type='text/css'>
                        #{$selector} {
                            margin: auto;
                        }
                        #{$selector} .gallery-item {
                            float: {$float};
                            margin-top: 10px;
                            text-align: center;
                            width: {$itemwidth}%;
                        }
                        #{$selector} .gallery-caption {
                            margin-left: 0;
                        }

                        #{$selector} dt {
                            margin: 0px 10px !important;
                        }
                        /* see gallery_shortcode() in wp-includes/media.php */
                    </style>";
                $size_class = sanitize_html_class( $size );
                $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
                $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

                $i = 0;
                foreach ( $attachments as $id => $attachment ) {

                    $img_html = wp_get_attachment_image( $id, 'blog_single_gallery', false );

                    $img_html = '<div class="hover-item"><span></span></div>'.$img_html;

                    $img_link = wp_get_attachment_url( $id );
                    $img_video_url = get_post_meta( $id, 'zen_video_url', true );

                    if ( $img_video_url != '' ) {
                        $image_output = '<a href="'.$img_video_url.'" rel="prettyPhoto[pp_gal]" alt="">'.$img_html.'</a>';
                    } else {
                        $image_output = '<a href="'.$img_link.'" rel="prettyPhoto[pp_gal]" alt="">'.$img_html.'</a>';
                    }

                    $image_meta  = wp_get_attachment_metadata( $id );

                    $orientation = '';
                    if ( isset( $image_meta['height'], $image_meta['width'] ) )
                        $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

                    $output .= "<{$itemtag} class='gallery-item'>";
                    $output .= "
                        <{$icontag} class='gallery-icon {$orientation}'>
                            $image_output
                        </{$icontag}>";
                    $output .= "</{$itemtag}>";
                    if ( $columns > 0 && ++$i % $columns == 0 )
                        $output .= '<br style="clear: both" />';
                }

                $output .= "
                        <br style='clear: both;' />
                    </div>\n";
        }

        return $output;
    }

    /**
     * Testimonials shortcode
     *
     * @param $atts
     * @return string
     */
    public function zen_testimonials_sc( $atts ){
        $output = $type = $category = $max_items = '';

        extract( shortcode_atts( array(
                'type'          => '',
                'category'      => '',
                'max_items'     => '9999'
        ), $atts ) );

        $post_type = 'zen_testimonial';
        $post_tax = 'zen_testimonials_cat';
        $test_ID = $type.$category.$max_items;
        $prefix = 'zen_testimonial_';

        $args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $post_tax,
                    'field' => 'id',
                    'terms' => $category
                )
            )
        );
        $query = new WP_Query( $args );

        switch($type) {
            case '' :
                $nav = ''; $testimonials = ''; $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $rev_name = get_the_title();
                        $rev_image = get_the_post_thumbnail($query->post->ID, 'zen_testimonials');
                        $rev_body = rwmb_meta("{$prefix}description");
                        $rev_position = rwmb_meta("{$prefix}position");
                        $rev_link = rwmb_meta("{$prefix}link");

                        if ( $i == 0 ) { $class = 'active'; } else { $class = ''; }

                        if ( $i < (int)$max_items ) {

                            // Construct the navigation
                            $nav .= '<li data-target="#testimonials-carousel-'.$test_ID.'" data-slide-to="'.$i.'" class="'.$class.'"></li>';

                            // Construct the testimonials
                            $testimonials .= '<div class="item '.$class.'">';
                            $testimonials .= $rev_image;
                            $testimonials .= '<div class="carousel-caption">';
                            $testimonials .= '<p>'.$rev_body.'</p>';
                            $testimonials .= '<h4>~ '.$rev_name.' ~</h4>';

                            if($rev_link!='') {
                                $testimonials .= '<h5><a href="'.$rev_link.'">'.$rev_position.'</a></h5>';
                            } else {
                                $testimonials .= '<h5>'.$rev_position.'</h5>';
                            }

                            $testimonials .= '</div></div>';
                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                // Construct the output
                $output .= '<div id="testimonials-carousel-'.$test_ID.'" class="carousel slide testimonial-slide">';
                $output .= '<ol class="carousel-indicators">' . $nav . '</ol>';
                $output .= '<div class="carousel-inner">' . $testimonials . '</div>';
                $output .= '<a class="left carousel-control" href="#testimonials-carousel-'.$test_ID.'" data-slide="prev"><span class="icon-prev"></span></a>';
                $output .= '<a class="right carousel-control" href="#testimonials-carousel-'.$test_ID.'" data-slide="next"><span class="icon-next"></span></a>';
                $output .= '</div>';

                break;
            case '1' :

                $nav = ''; $testimonials = ''; $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $rev_name = get_the_title();
                        $rev_image = get_the_post_thumbnail($query->post->ID, 'zen_testimonials');
                        $rev_body = rwmb_meta("{$prefix}description");
                        $rev_position = rwmb_meta("{$prefix}position");
                        $rev_link = rwmb_meta("{$prefix}link");

                        if ( $i == 0 ) { $class = 'active'; } else { $class = ''; }

                        if ( $i < (int)$max_items ) {

                            // Construct the navigation
                            $nav .= '<li data-target="#testimonials-carousel-'.$test_ID.'" data-slide-to="'.$i.'" class="'.$class.'"></li>';

                            // Construct the testimonials
                            $testimonials .= '<div class="item '.$class.'">';
                            $testimonials .= $rev_image;
                            $testimonials .= '<div class="author">';
                            $testimonials .= '<h4>'.$rev_name.' ~</h4>';

                            if($rev_link!='') {
                                $testimonials .= '<h5><a href="'.$rev_link.'">'.$rev_position.'</a></h5>';
                            } else {
                                $testimonials .= '<h5>'.$rev_position.'</h5>';
                            }

                            $testimonials .= '</div><div class="clear"></div>';
                            $testimonials .= '<div class="carousel-caption">';
                            $testimonials .= '<p>'.$rev_body.'</p>';
                            $testimonials .= '</div></div>';
                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                // Construct the output
                $output .= '<div id="testimonials-carousel-'.$test_ID.'" class="carousel slide testimonial-slide testimonial-slide-left blue-testimonials">';
                $output .= '<ol class="carousel-indicators">' . $nav . '</ol>';
                $output .= '<div class="carousel-inner">' . $testimonials . '</div>';
                $output .= '<a class="left carousel-control" href="#testimonials-carousel-'.$test_ID.'" data-slide="prev"><span class="icon-prev"></span></a>';
                $output .= '<a class="right carousel-control" href="#testimonials-carousel-'.$test_ID.'" data-slide="next"><span class="icon-next"></span></a>';
                $output .= '</div>';

                break;
            case '2' :

                $nav = ''; $testimonials = ''; $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $rev_name = get_the_title();
                        $rev_image = get_the_post_thumbnail($query->post->ID, 'zen_testimonials');
                        $rev_body = rwmb_meta("{$prefix}description");
                        $rev_position = rwmb_meta("{$prefix}position");
                        $rev_link = rwmb_meta("{$prefix}link");

                        if ( $i == 0 ) { $class = 'active'; } else { $class = ''; }

                        if ( $i < (int)$max_items ) {

                            // Construct the navigation
                            $nav .= '<li><div class="bg-author" data-file="#testimonial-'.$i.'">';
                            $nav .= $rev_image;
                            $nav .= '<span></span></div></li>';

                            // Construct the testimonials
                            $testimonials .= '<div class="conteiner-testimonial" id="testimonial-'.$i.'">';
                            $testimonials .= '<p>'.$rev_body.'</p>';
                            $testimonials .= '<p class="author">';
                            $testimonials .= $rev_name.', ';

                            if($rev_link!='') {
                                $testimonials .= '<span><a href="'.$rev_link.'">'.$rev_position.'</a></span>';
                            } else {
                                $testimonials .= '<span>'.$rev_position.'</span>';
                            }

                            $testimonials .= '</p></div>';
                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                // Construct the output
                $output .= '<ul class="testimonial-author">' . $nav . '</ul>';
                $output .= '<div class="col-md-12 conteiner-testimonial-bg">' . $testimonials . '</div>';

                break;
        }

        return $output;
    }


    /**
     * Team shortcode
     *
     * @param $atts
     * @return string
     */
    public function zen_team_sc( $atts ){
        $output = $type = $category = $items = '';

        extract( shortcode_atts( array(
            'type'          => '',
            'category'      => '',
            'items'         => '9999'
        ), $atts ) );

        $post_type = 'zen_employee';
        $post_tax = 'teams';
        $team_ID = $type.$category.$items;
        $prefix = 'zen_team_';

        $args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $post_tax,
                    'field' => 'id',
                    'terms' => $category
                )
            )
        );
        $query = new WP_Query( $args );

        switch($type) {

            case '':

                $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $employee_name = get_the_title();
                        $employee_image = get_the_post_thumbnail($query->post->ID, 'zen_team');

                        $employee_position = rwmb_meta("{$prefix}position");
                        $employee_fb = rwmb_meta("{$prefix}facebook");
                        $employee_twit = rwmb_meta("{$prefix}twitter");
                        $employee_pin = rwmb_meta("{$prefix}pinterest");
                        $employee_gplus = rwmb_meta("{$prefix}googleplus");
                        $employee_body = rwmb_meta("{$prefix}description", 'type=textarea');

                        if ( $i < (int)$items ) {

                            // Construct the employee
                            $output .= '<div class="col-sm-4 team-member-single"><figure>';
                            $output .= $employee_image;
                            $output .= '<figcaption><header><h1>';
                            $output .= $employee_name;
                            $output .= '</h1></header><section>';
                            $output .= $employee_body;
                            $output .= '</section><footer><nav class="social"><ul>';

                            // Handle social part
                            if ($employee_fb != '') { $output .= '<li><a href="'.$employee_fb.'" class="toptip facebook" original-title="Facebook"></a></li>'; }
                            if ($employee_twit != '') { $output .= '<li><a href="'.$employee_twit.'" class="toptip twitter" original-title="Twitter"></a></li>'; }
                            if ($employee_pin != '') { $output .= '<li><a href="'.$employee_pin.'" class="toptip pinterest" original-title="Pinterest"></a></li>'; }
                            if ($employee_gplus != '') { $output .= '<li><a href="'.$employee_gplus.'" class="toptip g-plus" original-title="Google+"></a></li>'; }

                            $output .= '</ul></nav><div class="domain">';
                            $output .= $employee_position;
                            $output .= '</div></footer></figcaption></figure></div>';

                            if (($i+1)%3 == 0) { $output .= '<div class="clear" style="margin-bottom: 30px;"></div>'; }

                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                break;
            case '1':

                $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $employee_name = get_the_title();
                        $employee_image = get_the_post_thumbnail($query->post->ID, 'zen_team');

                        $employee_position = rwmb_meta("{$prefix}position");
                        $employee_fb = rwmb_meta("{$prefix}facebook");
                        $employee_twit = rwmb_meta("{$prefix}twitter");
                        $employee_pin = rwmb_meta("{$prefix}pinterest");
                        $employee_gplus = rwmb_meta("{$prefix}googleplus");
                        $employee_body = rwmb_meta("{$prefix}description", 'type=textarea');

                        if ( $i < (int)$items ) {

                            // Construct the employee
                            $output .= '<div class="team-member-single-hover"><figure><figcaption><header><h1>';
                            $output .= $employee_name;
                            $output .= '</h1><h2 class="domain">';
                            $output .= $employee_position;
                            $output .= '</h2></header><section><p>';
                            $output .= $employee_body;
                            $output .= '</p><nav class="social"><ul>';

                            // Handle social part
                            if ($employee_fb != '') { $output .= '<li><a href="'.$employee_fb.'" class="toptip facebook" original-title="Facebook"></a></li>'; }
                            if ($employee_twit != '') { $output .= '<li><a href="'.$employee_twit.'" class="toptip twitter" original-title="Twitter"></a></li>'; }
                            if ($employee_pin != '') { $output .= '<li><a href="'.$employee_pin.'" class="toptip pinterest" original-title="Pinterest"></a></li>'; }
                            if ($employee_gplus != '') { $output .= '<li><a href="'.$employee_gplus.'" class="toptip g-plus" original-title="Google+"></a></li>'; }

                            $output .= '</ul></nav></section></figcaption>';
                            $output .= $employee_image;
                            $output .= '</figure></div>';

                            //if (($i+1)%3 == 0) { $output .= '<div class="clear" style="margin-bottom: 30px;"></div>'; }

                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                break;

        }

        return $output;
    }

    public function zen_employee_sc( $atts ){
        $output = $type = $id = $items = '';

        extract( shortcode_atts( array(
            'type'          => '',
            'id'            => '',
            'items'         => '1'
        ), $atts ) );

        $category = $id;

        $post_type = 'zen_employee';
        $post_tax = 'teams';
        $team_ID = $type.$category.$items;
        $prefix = 'zen_team_';

        $args = array(
            'p'         => $id,
            'post_type' => $post_type,
        );
        $query = new WP_Query( $args );

        switch($type) {

            case '':

                $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $employee_name = get_the_title();
                        $employee_image = get_the_post_thumbnail($query->post->ID, 'zen_team');

                        $employee_position = rwmb_meta("{$prefix}position");
                        $employee_fb = rwmb_meta("{$prefix}facebook");
                        $employee_twit = rwmb_meta("{$prefix}twitter");
                        $employee_pin = rwmb_meta("{$prefix}pinterest");
                        $employee_gplus = rwmb_meta("{$prefix}googleplus");
                        $employee_body = rwmb_meta("{$prefix}description", 'type=textarea');

                        if ( $i < (int)$items ) {

                            // Construct the employee
                            $output .= '<div class="col-sm-12 team-member-single"><figure>';
                            $output .= $employee_image;
                            $output .= '<figcaption><header><h1>';
                            $output .= $employee_name;
                            $output .= '</h1></header><section>';
                            $output .= $employee_body;
                            $output .= '</section><footer><nav class="social"><ul>';

                            // Handle social part
                            if ($employee_fb != '') { $output .= '<li><a href="'.$employee_fb.'" class="toptip facebook" original-title="Facebook"></a></li>'; }
                            if ($employee_twit != '') { $output .= '<li><a href="'.$employee_twit.'" class="toptip twitter" original-title="Twitter"></a></li>'; }
                            if ($employee_pin != '') { $output .= '<li><a href="'.$employee_pin.'" class="toptip pinterest" original-title="Pinterest"></a></li>'; }
                            if ($employee_gplus != '') { $output .= '<li><a href="'.$employee_gplus.'" class="toptip g-plus" original-title="Google+"></a></li>'; }

                            $output .= '</ul></nav><div class="domain">';
                            $output .= $employee_position;
                            $output .= '</div></footer></figcaption></figure></div>';

                            if (($i+1)%3 == 0) { $output .= '<div class="clear" style="margin-bottom: 30px;"></div>'; }

                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                break;
            case '1':

                $i = 0;
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        $employee_name = get_the_title();
                        $employee_image = get_the_post_thumbnail($query->post->ID, 'zen_team');

                        $employee_position = rwmb_meta("{$prefix}position");
                        $employee_fb = rwmb_meta("{$prefix}facebook");
                        $employee_twit = rwmb_meta("{$prefix}twitter");
                        $employee_pin = rwmb_meta("{$prefix}pinterest");
                        $employee_gplus = rwmb_meta("{$prefix}googleplus");
                        $employee_body = rwmb_meta("{$prefix}description", 'type=textarea');

                        if ( $i < (int)$items ) {

                            // Construct the employee
                            $output .= '<div class="team-member-single-hover" style="width: 97.48%;"><figure><figcaption><header><h1>';
                            $output .= $employee_name;
                            $output .= '</h1><h2 class="domain">';
                            $output .= $employee_position;
                            $output .= '</h2></header><section><p>';
                            $output .= $employee_body;
                            $output .= '</p><nav class="social"><ul>';

                            // Handle social part
                            if ($employee_fb != '') { $output .= '<li><a href="'.$employee_fb.'" class="toptip facebook" original-title="Facebook"></a></li>'; }
                            if ($employee_twit != '') { $output .= '<li><a href="'.$employee_twit.'" class="toptip twitter" original-title="Twitter"></a></li>'; }
                            if ($employee_pin != '') { $output .= '<li><a href="'.$employee_pin.'" class="toptip pinterest" original-title="Pinterest"></a></li>'; }
                            if ($employee_gplus != '') { $output .= '<li><a href="'.$employee_gplus.'" class="toptip g-plus" original-title="Google+"></a></li>'; }

                            $output .= '</ul></nav></section></figcaption>';
                            $output .= $employee_image;
                            $output .= '</figure></div>';

                            //if (($i+1)%3 == 0) { $output .= '<div class="clear" style="margin-bottom: 30px;"></div>'; }

                        }

                        $i++;
                    }
                }
                wp_reset_postdata();
                // End The Loop

                break;

        }

        return $output;
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}
