<?php
/************************************************************/
/* Helpers help you modify very easy some parts of the theme's functions. */
/************************************************************/

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'zen_breadcrumbs' ) ) :

    // original script you can find on http://dimox.net
    function zen_breadcrumbs($color_class = 'bullet-arrow') {

        $breadcrumbs_html = apply_filters( 'zen_get_breadcrumbs-html', '' );
        if ( $breadcrumbs_html ) {
            return $breadcrumbs_html;
        }

        $text['home']     = __('Home', 'zen7');
        $text['category'] = __('Category "%s"', 'zen7');
        $text['search']   = __('Results for "%s"', 'zen7');
        $text['tag']      = __('Entries tagged with "%s"', 'zen7');
        $text['author']   = __('Article author %s', 'zen7');
        $text['404']      = __('Error 404', 'zen7');

        $showCurrent = 1;
        $showOnHome  = 1;
        $delimiter   = '';
        $before      = '<li class="current">';
        $after       = '</li>';

        global $post;
        $homeLink = home_url() . '/';
        $linkBefore = '<li typeof="v:Breadcrumb">';
        $linkAfter = '</li>';
        $linkAttr = ' rel="v:url" property="v:title"';
        $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s" title="">%2$s</a>' . $linkAfter;


        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) {
                $breadcrumbs_html .= '<ul class="'. $color_class .' list-inline"><li><a href="' . $homeLink . '">' . $text['home'] . '</a></li></ul>';
            }

        } else {

            $breadcrumbs_html .= '<ul class="'. $color_class .' list-inline">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

            if ( is_category() ) {

                $thisCat = get_category(get_query_var('cat'), false);

                if ($thisCat->parent != 0) {

                    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                    if(preg_match( '/title="/', $cats ) ===0) {
                        $cats = preg_replace('/title=""/', 'title=""', $cats);
                    }

                    $breadcrumbs_html .= $cats;
                }

                $breadcrumbs_html .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;

            } elseif ( is_search() ) {

                $breadcrumbs_html .= $before . sprintf($text['search'], get_search_query()) . $after;

            } elseif ( is_day() ) {

                $breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                $breadcrumbs_html .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
                $breadcrumbs_html .= $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {

                $breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                $breadcrumbs_html .= $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {

                $breadcrumbs_html .= $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {

                if ( get_post_type() != 'post' && get_post_type() != 'zen_portfolio' ) {

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $homeLink . '' . $slug['slug'] . '/', $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } elseif ( get_post_type() == 'zen_portfolio' ) {

                    global $zen7_data;

                    $portfolio_url = get_permalink( $zen7_data['zen_portfolio_page'] );

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $breadcrumbs_html .= sprintf($link, $portfolio_url, $post_type->labels->singular_name);

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                    }

                } else {

                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);

                    if ($showCurrent == 0) {
                        $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    }

                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                    $breadcrumbs_html .= $cats;

                    if ($showCurrent == 1) {
                        $breadcrumbs_html .= $before . get_the_title() . $after;
                    }
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

                $post_type = get_post_type_object(get_post_type());
                if ( $post_type ) {
                    $breadcrumbs_html .= $before . $post_type->labels->singular_name . $after;
                }

            } elseif ( is_attachment() ) {

                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

                $breadcrumbs_html .= $cats;

                $breadcrumbs_html .= sprintf($link, get_permalink($parent), $parent->post_title);

                if ($showCurrent == 1) {
                    $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                }

            } elseif ( is_page() && !$post->post_parent ) {

                if ($showCurrent == 1) {
                    $breadcrumbs_html .= $before . get_the_title() . $after;
                }

            } elseif ( is_page() && $post->post_parent ) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    $breadcrumbs_html .= $breadcrumbs[$i];

                    if ($i != count($breadcrumbs)-1) {
                        $breadcrumbs_html .= $delimiter;
                    }
                }

                if ($showCurrent == 1) {
                    $breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
                }

            } elseif ( is_tag() ) {

                $breadcrumbs_html .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            } elseif ( is_author() ) {

                global $author;
                $userdata = get_userdata($author);
                $breadcrumbs_html .= $before . sprintf($text['author'], $userdata->display_name) . $after;

            } elseif ( is_404() ) {

                $breadcrumbs_html .= $before . $text['404'] . $after;
            }

            if ( get_query_var('paged') ) {

                $breadcrumbs_html .= $before;

                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
                    $breadcrumbs_html .= ' (';
                }

                $breadcrumbs_html .= __('Page', 'zen7') . ' ' . get_query_var('paged');

                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
                    $breadcrumbs_html .= ')';
                }

                $breadcrumbs_html .= $after;

            }

            $breadcrumbs_html .= '</ul>';
        }

        return apply_filters('zen_get_breadcrumbs', $breadcrumbs_html);
    }

endif;

if( ! function_exists( 'zen_entry_has_tags' ) ) :

    function zen_entry_has_tags() {
        $tag_list = get_the_tags();
        return ( $tag_list );
    }

endif;

if( ! function_exists( 'zen_entry_tags' ) ) :

    function zen_entry_tags() {
        $tag_list = get_the_tags();
        if ( $tag_list ) {
            echo '<div class="tags-single">';
            echo '<h1>' . __('Tags:', 'zen7') . '</h1>';
            echo '<ul>';

            foreach($tag_list as $tag)
                echo '<li><a href="' . home_url( '/' ) . '?tag=' . $tag->slug . '">' . $tag->name . '</a></li>';

            echo '</ul></div>';
        }
    }

endif;

if( ! function_exists( 'zen_the_date' ) ) :

    /**
     * Display the date in the ZEN format.
     *
     * @since 1.0.0
     */

    function zen_the_date() {

        $zen_date = get_the_time('d-M-Y');

        $zen_day = substr($zen_date, 0, 2);
        $zen_month = substr($zen_date, 3, 3);
        $zen_month = strtoupper($zen_month);
        $zen_year = substr($zen_date, 7, 4);

        $output = '<div class="post-date">';
        $output .= '<span class="day">' . $zen_day . '</span>';
        $output .= '<span class="month">' . $zen_month . '</span>';
        $output .= '<span class="year">' . $zen_year . '</span>';
        $output .= '</div>';

        echo $output;

    }

endif;

if( ! function_exists( 'zen_the_date_masonry' ) ) :

    /**
     * Display the date in the ZEN format.
     *
     * @since 1.0.0
     */

    function zen_the_date_masonry() {

        $zen_date = get_the_time('d-M-Y');

        $zen_day = substr($zen_date, 0, 2);
        $zen_month = substr($zen_date, 3, 3);
        $zen_month = strtoupper($zen_month);
        $zen_year = substr($zen_date, 7, 4);

        $output = '<div class="btn-date">';
        $output .= '<span>' . $zen_day . '</span>/';
        $output .= '<span>' . $zen_month . '</span>/';
        $output .= '<span>' . $zen_year . '</span>';
        $output .= '</div>';

        echo $output;

    }

endif;

if( ! function_exists( 'zen_next_prev_posts' ) ) :

    function zen_next_prev_posts() {

        $next_post = get_next_post();

        if ( !empty( $next_post ) ) : ?>

            <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="btn-next-article fadeInUp">
                <div class="simple-tipsy tipsy-next">
                    <div class="arrow-simple-tipsy"></div>
                    <h1>
                        <?php _e('Read next article:', 'zen7'); ?>
                    </h1>
                    <p>"<?php echo $next_post->post_title; ?>"</p>
                </div>
            </a>

        <?php endif;

        $prev_post = get_previous_post();

        if ( !empty( $prev_post ) ) : ?>

            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="btn-prev-article fadeInUp">
                <div class="simple-tipsy tipsy-prev">
                    <div class="arrow-simple-tipsy"></div>
                    <h1>
                        <?php _e('Read previous article:', 'zen7'); ?>
                    </h1>
                    <p>"<?php echo $prev_post->post_title; ?>"</p>
                </div>
            </a>

        <?php endif;

    }

endif;

if( ! function_exists( 'zen_comments_information' ) ) :

    function zen_comments_information(){
        if ( comments_open() ) {
            comments_popup_link(
                __( ' | 0 comments', 'zen7' ),
                __( ' | 1 comment', 'zen7' ),
                __( ' | % comments', 'zen7' )
            );
        }
    }

endif;

if( ! function_exists( 'zen_entry_meta' ) ) :
    function zen_entry_meta() {
        if ( 'post' == get_post_type() ) : ?>

            <?php _e('In ', 'zen7'); ?><?php the_category(' ,&nbsp; '); ?>

        <?php endif;
    }
endif;

if( ! function_exists( 'zen_edit_link' ) ) :
    function zen_edit_link() {
        edit_post_link( __( 'Edit', 'zen7' ), '| ', '' );
    }
endif;

if( ! function_exists( 'zen_get_the_clear_content' ) ) :

    /**
     * Return content passed throw these functions:
     *	strip_shortcodes( $content );
     *	apply_filters( 'the_content', $content );
     *	str_replace( ']]>', ']]&gt;', $content );
     *
     * @return string
     */
    function zen_get_the_clear_content() {
        $content = get_the_content( '' );
        $content = strip_shortcodes( $content );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );

        return $content;
    }

endif;

if( ! function_exists( 'zen_the_excerpt' ) ) :
    function zen_the_excerpt() {
        echo zen_get_the_excerpt();
    }
endif;

if( ! function_exists( 'zen_get_the_excerpt' ) ) :

    /**
     * Returns a nice excerpt/content for the blog page.
     *
     * @return mixed|string|void
     *
     * @since 1.0.0
     *
     */

    function zen_get_the_excerpt() {

        global $post, $more, $pages;
        $more = 0;

        if ( !has_excerpt( $post->ID ) ) {

            $excerpt_length = apply_filters('excerpt_length', 55);
            $content = zen_get_the_clear_content();

            // check for more tag
            if ( preg_match( '/<!--more(.*?)?-->/', $post->post_content, $matches ) ) {

                //$content .= zen_get_content_more();

            // check content length
            } elseif ( st_count_words( $content ) <= $excerpt_length ) {

                add_filter('zen_get_content_more', 'zen_return_empty_string', 15);

            } else {

                $content = '';

            }

        }

        // if we got excerpt or content more than $excerpt_length
        if ( empty($content) && get_the_excerpt() ) {

            $content = apply_filters( 'the_excerpt', get_the_excerpt() );

        }

        return $content;

    }
endif;

if( ! function_exists( 'zen_return_empty_string' ) ) :
    /**
     * Return empty string.
     *
     * @return string
     */
    function zen_return_empty_string() {
        return '';
    }
endif;

if( ! function_exists( 'zen_get_content_more' ) ) :

    /**
     * A filter for the "Read More" button
     *
     * @return mixed|void
     *
     * @since 1.0.0
     */

    function zen_get_content_more() {
        $more_button = '<a href="';
        $more_button .= get_permalink();
        $more_button .= '" class="btn-blue-arrow">';
        $more_button .= __('Read more','zen7');
        $more_button .= '</a>';

        return apply_filters('zen_get_content_more', $more_button);
    }

endif;

if( ! function_exists( 'zen_numbers_pagination' ) ) :

    /**
     * Outputs the numbered pagination
     *
     * @param string $pages
     * @param int $range
     *
     * @since 1.0.0
     *
     */

    function zen_numbers_pagination($pages = '', $range = 2) {
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo "<ul class='pagination'>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
            if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
                }
            }

            if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
            echo "</ul>\n";
        }
    }

endif;

if( ! function_exists( 'zen_numbers_pagination_query' ) ) :

    /**
     * Outputs the numbered pagination
     *
     * @param string $pages
     * @param int $range
     *
     * @since 1.0.0
     *
     */

    function zen_numbers_pagination_query($query, $pages = '', $range = 2) {
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            $pages = $query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo "<ul class='pagination'>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
            if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
                }
            }

            if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
            echo "</ul>\n";
        }
    }

endif;

if( ! function_exists( 'zen_single_post_pagination' ) ) :

    /**
     * Outputs the single post pagination.
     *
     * @since 1.0.0
     */

    function zen_single_post_pagination() {

        $output = wp_link_pages(
            array(
                'before'            => '<ul class="pager">',
                'after'             => '</ul>',
                'next_or_number'    =>'next',
                'previouspagelink'  => __(' &laquo; Previous Page','zen7'),
                'nextpagelink'      => __(' Next Page &raquo; ', 'zen7'),
                'separator'         => ' ', 'link_before' => '<li>',
                'link_after'        => '</li>',
                'echo'              => 0
            ));

        $output = str_replace('li></a>', 'a></li>', $output);
        $output = str_replace('<li>', '', $output);
        $output = str_replace('<a href', '<li><a href', $output);

        echo $output;

    }

endif;

if( ! function_exists( 'zen_get_gallery_images' ) ) :

    /**
     * Return the images from the gallery.
     *
     * @return array
     * @since 1.0.0
     */
    function zen_get_gallery_images() {
        global $post; $ids = '';

        $gallery_images = array();

        $array = get_post_gallery( $post->ID, false );
        if ( $array['ids'] != '' )
        $ids = explode(",", $array['ids']);

        foreach( $ids as $id ) {

            array_unshift($gallery_images, get_post( $id ));

        }

        if (!empty($gallery_images)) {
            $gallery_count = count($gallery_images);

            return array(
                'images' => $gallery_images,
                'count'  => $gallery_count
            );
        }

        return array(
            'images' => array(),
            'count'  => 0
        );
    }

endif;

if( ! function_exists( 'zen_page_header_controller' ) ) :

    add_filter('zen_before_content', 'zen_page_header_controller');

    /**
    * Controls the hole header display.
     *
     * @since 1.0.0
    */
    function zen_page_header_controller() {
        $prefix = 'zen_';

        if ( function_exists( 'rwmb_meta' ) ) :

            $option = rwmb_meta( "{$prefix}header_style" );

            switch ($option) {
                case 'none' :
                    //add_action('zen_before_content', 'zen_return_empty_string');
                    break;
                case 'default' :
                    zen_normal_header();
                    break;
                case 'parallax' :
                    zen_parallax_header();
                    break;
                case 'slider' :
                    zen_slider_header();
                    break;
                default :
                    zen_normal_header();
            }

        else  :

            zen_normal_header();

        endif;
    }

endif;

if( ! function_exists( 'zen_normal_header' ) ) :

    /**
     * Returns the default header style.
     *
     * @since 1.0.0
     */
    function zen_normal_header() {

        $prefix = 'zen_';

        if ( function_exists( 'rwmb_meta' ) ) :

            // Background image to insert in the parallax style
            $selected_style = rwmb_meta( "{$prefix}default_style", array('type' => 'select') );

            if ( $selected_style == 'theme_color' ) {
                $output = '<div class="source-page-blue">';
                $output .= '<div class="container"><h1>';
                $output .= get_the_title();
                $output .= '</h1>';

                $output .= zen_breadcrumbs('bullet-arrow-white');

                $output .= '</div></div>';
            } else {
                $output = '<div class="source-page">';
                $output .= '<div class="container"><h1>';
                $output .= get_the_title();
                $output .= '</h1>';

                $output .= zen_breadcrumbs();

                $output .= '</div></div>';
            }

        else :

            $output = '<div class="source-page">';
            $output .= '<div class="container"><h1>';
            $output .= get_the_title();
            $output .= '</h1>';

            $output .= zen_breadcrumbs();

            $output .= '</div></div>';

        endif;


        echo $output;

    }

endif;

if( ! function_exists( 'zen_shop_normal_header' ) ) :

    add_action( 'zen_shop_header', 'zen_shop_normal_header', 10);
    add_filter( 'woocommerce_breadcrumb_defaults', 'zen_shop_breadcrumbs_args' );

    function zen_shop_breadcrumbs_args() {

        $args = array(
            'delimiter'   => '',
            'wrap_before' => '<ul class="bullet-arrow list-inline" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );


        return $args;
    }

    /**
     * Returns the default header style.
     *
     * @since 1.0.0
     */
    function zen_shop_normal_header() {

        echo '<div class="source-page">';
        echo '<div class="container"><h1>';

        if(is_single()) {
            echo get_the_title();
        } else {
            woocommerce_page_title();
        }


        echo '</h1>';

        do_action( 'zen_shop_breadcrumbs' );

        echo '</div></div>';

    }

endif;

if( ! function_exists( 'zen_parallax_header' ) ) :

    /**
     * Returns the parallax header with its features.
     *
     * @since 1.0.0
     */
    function zen_parallax_header() {
        $prefix = 'zen_';

        // Background image to insert in the parallax style
        $bg_image = rwmb_meta( "{$prefix}parallax_image", array('type' => 'image_advanced', 'size' => 'parallax_header_bg') );
        $bg_image = array_shift($bg_image);

        // The color of the tile & breadcrumbs
        // TODO: Insert the color on the parallax somehow, when you do the breadcrumbs
        $txt_color = rwmb_meta( "{$prefix}parallax_color", array('type' => 'color') );

        if ( $txt_color == 'dark' ) {

            $style = 'style="background: url(' . $bg_image['full_url'] . ') fixed center center; -webkit-background-size: cover; background-size: cover; color: #333333;"';

            $output = '<div class="source-page source-bg-01" ' . $style .'>';
            $output .= '<div class="container"><h1>';
            $output .= get_the_title();
            $output .= '</h1>';

            $output .= zen_breadcrumbs();

            $output .= '</div></div>';

        } else {

            $style = 'style="background: url(' . $bg_image['full_url'] . ') fixed center center; -webkit-background-size: cover; background-size: cover;"';

            $output = '<div class="source-page source-bg-01" ' . $style .'>';
            $output .= '<div class="container"><h1>';
            $output .= get_the_title();
            $output .= '</h1>';

            $output .= zen_breadcrumbs('bullet-arrow-white');

            $output .= '</div></div>';

        }

        echo $output;

    }

endif;

if( ! function_exists( 'zen_slider_header' ) ) :

    /**
     * Returns the Revolution slider in a shortcode to the page.
     *
     * @since 1.0.0
     */
    function zen_slider_header() {
        $prefix = 'zen_';

        // Background image to insert in the parallax style
        $slider_slug = rwmb_meta( "{$prefix}slider_style", array('type' => 'select') );

        if ( $slider_slug != 'none' ) {

            echo do_shortcode('[rev_slider '.$slider_slug.']');

        }

    }

endif;

if( ! function_exists( 'zen_is_title_active' ) ) :

    /**
     * @return bool
     * @since 1.0.0
     */
    function zen_is_title_active() {
        $option = ''; $prefix = 'zen_';

        if ( function_exists( 'rwmb_meta' ) ) {

            $option = rwmb_meta( "{$prefix}header_style" );

            if ($option == 'slider' || $option == 'none') {
                return true;
            } else {
                return false;
            }

        } else {
            return true;
        }
    }

endif;

if( ! function_exists( 'buildParallaxStyle' ) ) :

    /**
     * @param string $bg_image
     * @param string $bg_color
     * @param string $padding
     * @param string $margin_bottom
     * @param string $font_color
     * @param string $bg_image_repeat
     * @return string
     */
    function buildParallaxStyle($bg_image = '', $bg_color = '', $padding = '', $margin_bottom = '', $font_color = '', $bg_image_repeat = '') {
        $has_image = false;
        $style = '';
        if((int)$bg_image > 0 && ($image_url = wp_get_attachment_url( $bg_image, 'large' )) !== false) {
            $has_image = true;
            $style .= "background: url(".$image_url.") repeat-y fixed center top;";
            $style .= "-webkit-background-size: cover; background-size: cover;";
        }
        if(!empty($bg_color)) {
            $style .= 'background-color: '.$bg_color.';';
        }
        if(!empty($bg_image_repeat) && $has_image) {
            if($bg_image_repeat === 'cover') {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif($bg_image_repeat === 'contain') {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif($bg_image_repeat === 'no-repeat') {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if( !empty($font_color) ) {
            $style .= 'color: '.$font_color.';';
        }
        if( $padding != '' ) {
            $style .= 'padding: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding.'px').';';
        }
        if( $margin_bottom != '' ) {
            $style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom.'px').';';
        }
        return empty($style) ? $style : ' style="'.$style.'"';
    }

endif;

if( ! function_exists( 'zen_get_portfolio_slider' ) ) :

    /**
     * @param int $id
     * @return string
     */
    function zen_get_portfolio_slider($id = 1993) {
        $output = ''; $prefix = 'zen_'; $divs = ''; $prefix_prtf = 'zen_prtf_';

        $images = rwmb_meta( "{$prefix}images_gallery", array('type' => 'image_advanced', 'size' => 'full') );
        $is_thumb_active = rwmb_meta( "{$prefix_prtf}featured_image" );

        if (has_post_thumbnail() && !$is_thumb_active) {

            $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

            $divs .= '<img class="rsImg" data-rsBigImg="'.$img_src[0].'" src="'.$img_src[0].'" />';

        }

        foreach ($images as $image) {

            $divs .= '<img class="rsImg" data-rsBigImg="'.$image['url'].'" src="'.$image['url'].'" alt="'.$image['caption'].'" />';

        }

        $output .= ' <div class="rsZenPortfolioSingle rsDefault">'. $divs .'</div>';

        return $output;
    }

endif;

if( ! function_exists( 'zen_get_portfolio_category' ) ) :

    /**
     * @return string
     */
    function zen_get_portfolio_category() {
        $output = ''; global $post;

        $term_list = wp_get_post_terms($post->ID, 'zen_port_cat', array("fields" => "all"));

        $output .= '<ul>';

        foreach ( $term_list as $term ) {

            $url = get_term_link( $term->term_id, $term->taxonomy );

            if( is_wp_error( $url ) )
                continue;

            $output .= '<li>';
            $output .= '<a href="'.$url.'">'.$term->name.'</a>';
            $output .= '</li>';

        }

        $output .= '</ul>';

        return $output;
    }

endif;

if( ! function_exists( 'zen_get_portfolio_meta' ) ) :
    /**
     * @return string
     */
    function zen_get_portfolio_meta() {
        $output = ''; $prefix = 'zen_prtf_';

        $output .= '<h1>'.rwmb_meta("{$prefix}custom_meta_title").'</h1>';

        $output .= '<ul><li>'.rwmb_meta("{$prefix}custom_meta_value").'</li></ul>';

        return $output;
    }

endif;

if( ! function_exists( 'zen_portfolio_single_nav' ) ) :

    function zen_portfolio_single_nav($current_id) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => 'zen_portfolio',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => $posts_array[$i+1]->guid);
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => $posts_array[$i-1]->guid);
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => $posts_array[$i-1]->guid);
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => $posts_array[$i+1]->guid);
                }

            }
        }

        ?>
        <?php if ($has_next) : ?>
            <a href="<?php echo $next_portfolio['link']; ?>" class="btn-next-article">
                <div class="simple-tipsy tipsy-next">
                    <div class="arrow-simple-tipsy"></div>
                    <h1>
                        <?php _e('Next Portfolio Item:','zen7'); ?>
                    </h1>
                    <p>"<?php echo $next_portfolio['title']; ?>"</p>
                </div>
            </a>
        <?php endif; ?>

        <?php if ($has_previous) : ?>
            <a href="<?php echo $previous_portfolio['link']; ?>" class="btn-prev-article">
                <div class="simple-tipsy tipsy-prev">
                    <div class="arrow-simple-tipsy"></div>
                    <h1>
                        <?php _e('Previous Portfolio Item:','zen7'); ?>
                    </h1>
                    <p>"<?php echo $previous_portfolio['title']; ?>"</p>
                </div>
            </a>
        <?php endif;

    }

endif;

if( ! function_exists( 'zen_portfolio_single_nav_bottom' ) ) :

    function zen_portfolio_single_nav_bottom($current_id) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => 'zen_portfolio',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => $posts_array[$i+1]->guid);
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => $posts_array[$i-1]->guid);
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => $posts_array[$i-1]->guid);
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => $posts_array[$i+1]->guid);
                }

            }
        }

        ?>

        <div class="col-sm-1 row-left">
        <?php if ($has_previous) : ?>
            <a href="<?php echo $previous_portfolio['link']; ?>" class="btn-prev-article">
                <div class="simple-tipsy tipsy-prev">
                    <div class="arrow-simple-tipsy"></div>
                    <h1>
                        <?php _e('Previous Portfolio Item:','zen7'); ?>
                    </h1>
                    <p>"<?php echo $previous_portfolio['title']; ?>"</p>
                </div>
            </a>
        <?php endif; ?>
        </div>

        <div class="col-sm-1 col-sm-offset-4-5 row-left">

            <?php zen_portfolio_gallery_nav(); ?>

        </div>

        <div class="col-sm-1 col-sm-offset-4-5 row-right">
        <?php if ($has_next) : ?>
            <a href="<?php echo $next_portfolio['link']; ?>" class="btn-next-article">
                <div class="simple-tipsy tipsy-next">
                    <div class="arrow-simple-tipsy"></div>
                    <h1>
                        <?php _e('Next Portfolio Item:','zen7'); ?>
                    </h1>
                    <p>"<?php echo $next_portfolio['title']; ?>"</p>
                </div>
            </a>
        <?php endif; ?>
        </div>

        <?php

    }

endif;

if( ! function_exists( 'zen_portfolio_gallery_nav' ) ) :

    function zen_portfolio_gallery_nav() {
        ?>
        <?php global $zen7_data; ?>
        <a href="<?php echo get_permalink( $zen7_data['zen_portfolio_page'] ); ?>">
            <div class="menu-post">
                <span class="icon-post"></span>
            </div>
        </a>

        <?php

    }

endif;

if( ! function_exists( 'zen_portfolio_gallery_style' ) ) :

    function zen_portfolio_gallery_style() {
        $prefix = 'zen_'; $prefix_prtf = 'zen_prtf_';

        $images = rwmb_meta( "{$prefix}images_gallery", array('type' => 'image_advanced', 'size' => 'full') );
        $is_thumb_active = rwmb_meta( "{$prefix_prtf}featured_image" );

        ?>

        <ul class="portfolio-items">

            <?php if (has_post_thumbnail() && !$is_thumb_active) : ?>

                <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

                <li class="col-xs-4">

                    <div class="hover-item">
                        <a href="<?php echo $img_src[0]; ?>" rel="prettyPhoto[gallery3]">
                            <span></span>
                        </a>
                    </div>
                    <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'portfolio_single_gallery'); ?>

                </li>

            <?php endif; ?>
            <?php foreach ($images as $image) : ?>

                <li class="col-xs-4">

                    <div class="hover-item">
                        <a href="<?php echo $image['full_url']; ?>" rel="prettyPhoto[gallery3]">
                            <span></span>
                        </a>
                    </div>
                    <?php echo wp_get_attachment_image($image['ID'], 'portfolio_single_gallery'); ?>

                </li>

            <?php endforeach; ?>

        </ul>

    <?php

    }

endif;

if( ! function_exists( 'zen_portfolio_gallery_style_2' ) ) :

    function zen_portfolio_gallery_style_2() {
        $prefix = 'zen_'; $prefix_prtf = 'zen_prtf_';

        $images = rwmb_meta( "{$prefix}images_gallery", array('type' => 'image_advanced', 'size' => 'full') );
        $is_thumb_active = rwmb_meta( "{$prefix_prtf}featured_image" );
        $IDs = '';

        ?>

        <?php if (has_post_thumbnail() && !$is_thumb_active) : ?>

            <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

            <?php $IDs .= get_post_thumbnail_id() . ','; ?>

        <?php endif; ?>
        <?php foreach ($images as $image) : ?>

            <?php $IDs .= $image['ID'] . ','; ?>

        <?php endforeach; ?>

        <?php $shortcode = '[gallery style="metro" ids="'.$IDs.'"]'; ?>

        <?php echo do_shortcode($shortcode); ?>

    <?php

    }

endif;

if( ! function_exists( 'zen_post_gallery_style' ) ) :

    function zen_post_gallery_style( $attachments, $options = array() ) {
        $output = ''; global $post;

        if ( (int)$attachments['count'] != 0 ) {
            foreach ($attachments['images'] as $image) {

                $img_details = zen_get_attachment($image->ID);

                $output .= '<li class="col-xs-4">';
                //$output .= '<img src="'.$img_details['src'].'" alt="'.$img_details['caption'].'">';
                $output .= wp_get_attachment_image($image->ID, 'portfolio_single_gallery');;
                $output .= '<div class="hover-item">';

                if ( $img_details['video_url'] != '' ) {
                    //$output .= '<a class="rsImg" href="'.$img_details['src'].'" data-rsVideo="'.$img_details['video_url'].'" alt="'.$img_details['caption'].'" /></a>';
                    $output .= '<a href="'.$img_details['video_url'].'" rel="prettyPhoto[gallery'.$post->ID.']">';
                } else {
                    //$output .= '<img class="rsImg" data-rsBigImg="'.$img_details['src'].'" src="'.$img_details['src'].'" alt="'.$img_details['caption'].'" />';
                    $output .= '<a href="'.$img_details['src'].'" rel="prettyPhoto[gallery'.$post->ID.']">';
                }

                $output .= '<span></span></a></div></li>';
            }

            $output = '<ul class="portfolio-items">'.$output.'</ul><div class="clear"></div>';
        }

        return $output;
    }

endif;

if( ! function_exists( 'zen_the_post_rs' ) ) :

    function zen_the_post_rs( $attachments, $options = array() ) {
        $output = '';

        // If we have some images, build the slider
        if ( (int)$attachments['count'] != 0 ) {
            foreach ($attachments['images'] as $image) {

                $img_details = zen_get_attachment($image->ID);

                if ( $img_details['video_url'] != '' ) {
                    $output .= '<a class="rsImg" href="'.$img_details['src'].'" data-rsVideo="'.$img_details['video_url'].'" alt="'.$img_details['caption'].'" /></a>';
                } else {
                    $output .= '<img class="rsImg" data-rsBigImg="'.$img_details['src'].'" src="'.$img_details['src'].'" alt="'.$img_details['caption'].'" />';
                }
            }

            $output = ' <div class="rsZenPortfolioSingle rsDefault">'. $output .'</div>';
        }

        return $output;
    }

endif;

if( ! function_exists( 'zen_get_attachment' ) ) :

    function zen_get_attachment( $attachment_id ) {

        $attachment = get_post( $attachment_id );

        return array(
            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'video_url' => get_post_meta( $attachment->ID, 'zen_video_url', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );

    }

endif;

if( ! function_exists( 'zen_display_share_buttons' ) ) :

    /**
     * Display share buttons.
     */
    function zen_display_share_buttons( $place = '', $options = array() ) {
        global $post;

        $buttons = array('facebook','twitter','google+', 'pinterest');

        $default_options = array(
            'echo'	=> true,
            'class'	=> array(),
            'id'	=> null,
        );
        $options = wp_parse_args($options, $default_options);

        $options['id'] = $options['id'] ? absint($options['id']) : $post->ID;

        $class = $options['class'];
        if ( !is_array($class) ) { $class = explode(' ', $class); }

        $class[] = 'post-share';

        $u = get_permalink( $options['id'] );
        $t = get_the_title( $options['id'] );

        $protocol = "http";
        if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) $protocol = "https";

        $buttons_list = array(
            'facebook' 	=> __('Facebook', 'zen7'),
            'twitter' 	=> __('Twitter', 'zen7'),
            'google+' 	=> __('Google+', 'zen7'),
            'pinterest' => __('Pinterest', 'zen7'),
        );

        $html = '';

        $html .= '<div class="' . esc_attr(implode(' ', $class)) . '">
                    <span class="icon-post"></span>
                    <span>'.__('Share','zen7').'</span>
					<div class="simple-tipsy social-tipsy">
					    <div class="arrow-simple-tipsy"></div>
                        <div class="post-social">';

        $soc_class = '';

        foreach ( $buttons as $button ) {
            $classes = array( 'share-button' );
            $url = '';
            $desc = $buttons_list[ $button ];
            $share_title = _x('share', 'share buttons', LANGUAGE_ZONE);
            $custom = '';

            global $zen7_data;
            if (! $zen7_data['zen_share']) { return ''; }

            switch( $button ) {
                case 'twitter':

                    $classes[] = 'twitter';
                    $soc_class = 'twitter';
                    $share_title = _x('tweet', 'share buttons', LANGUAGE_ZONE);
                    $url = add_query_arg( array('status' => urlencode($t . ' ' . $u) ), $protocol . '://twitter.com/home' );
                    break;
                case 'facebook':

                    $url_args = array( 's=100', urlencode('p[url]') . '=' . esc_url($u), urlencode('p[title]') . '=' . urlencode($t) );
                    if ( has_post_thumbnail( $options['id'] ) ) {
                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $options['id'] ), 'full' );
                        if ( $thumbnail ) {
                            $url_args[] = urlencode('p[images][0]') . '=' . esc_url($thumbnail[0]);
                        }
                    }

                    $classes[] = 'facebook';
                    $soc_class = 'facebook';

                    $url = $protocol . '://www.facebook.com/sharer.php?' . implode( '&', $url_args );
                    break;
                case 'google+':

                    $t = str_replace(' ', '+', $t);
                    $classes[] = 'google';
                    $soc_class = 'google-plus';
                    $url = add_query_arg( array('url' => $u, 'title' => $t), $protocol . '://plus.google.com/share' );
                    break;
                case 'pinterest':

                    $url = '//pinterest.com/pin/create/button/';
                    $custom = ' data-pin-config="above" data-pin-do="buttonBookmark"';

                    // if image
                    if ( wp_attachment_is_image($options['id']) ) {
                        $image = wp_get_attachment_image_src($options['id'], 'full');

                        if ( !empty($image) ) {
                            $url = add_query_arg( array(
                                    'url'			=> $u,
                                    'media'			=> $image[0],
                                    'description'	=> $t
                                ), $url
                            );

                            $custom = '';
                        }
                    }

                    $classes[] = 'pinterest';
                    $soc_class = 'pinterest';
                    $share_title = _x('pin it', 'share buttons', LANGUAGE_ZONE);

                    break;
            }

            $desc = esc_attr($desc);
            $share_title = esc_attr($share_title);
            $classes_str = esc_attr( implode(' ', $classes) );
            $url = esc_url( $url );

            $share_button = sprintf(
                '<div class="social-item %6$s"><a href="%2$s" class="%1$s" target="_blank" title="%3$s"%5$s><span class="icon-social"></span><span class="share-content">%4$s</span></a></div>',
                $classes_str,
                $url,
                $desc,
                $share_title,
                $custom,
                $soc_class
            );

            $html .= apply_filters( 'zen_share_button', $share_button, $button, $classes, $url, $desc, $share_title, $t, $u );
        }

        $html .= '</div></div>
			</div>';

        $html = apply_filters( 'zen_display_share_buttons', $html );

        if ( $options['echo'] ) {
            echo $html;
        }
        return $html;
    }

endif;

if( ! function_exists( 'zen_favorite_post_button' ) ) :

    function zen_favorite_post_button() {

//        echo '
//            <div class="post-like">
//                <span class="icon-post"></span>
//                <span>112</span>
//            </div>';

    }

endif;

if( ! function_exists( 'zen_portfolio_favorite_post_button' ) ) :

    function zen_portfolio_favorite_post_button() {

//        echo '
//            <div class="right-sec">
//                <div class="heart"></div>
//                <p>112</p>
//            </div>';

    }

endif;

if( ! function_exists( 'zen_socials_top_bottom' ) ) :

    function zen_socials_top_bottom() {

        global $zen7_data;

        echo do_shortcode($zen7_data['zen_social_icons']);

    }

endif;

function mva_maps_show_map( $event_id , $address ) {

    if( $address ) :

        $coordinates = mva_maps_get_coordinates( $address );

        if( !is_array( $coordinates ) )
            return;

        $out = '<div class="map-full-w" id="sc_map_' . $event_id . '"></div>' . "\n\n";

        $out .= '<script type="text/javascript">
                jQuery(function(){
                var map_' . $event_id . ';
                function sc_run_map_' . $event_id . '(){
                  var myLatlng = new google.maps.LatLng(' . $coordinates['lat'] . ', ' . $coordinates['lng'] . ');
                  var map_options = {
                  zoom: 15,
                  center: myLatlng,
                  scrollwheel: false,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  map_' . $event_id . ' = new google.maps.Map(document.getElementById("sc_map_' . $event_id . '"), map_options);
                  var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map_' . $event_id . '
                  });
                }
                sc_run_map_' . $event_id . '();
                })</script>';

        echo $out;

    endif;
}

function zen_maps_enqueue(){
    wp_enqueue_script('google-maps-api');
}

function mva_maps_show_map_sec( $event_id , $address ) {

    if( $address ) :

        $coordinates = mva_maps_get_coordinates( $address );

        if( !is_array( $coordinates ) )
            return;

        $out = '<div style="margin-top: -187px; width: 100%; height:650px;" id="sc_map_' . $event_id . '"></div>' . "\n\n";

        $out .= '<script type="text/javascript">
                jQuery(function(){
                var map_' . $event_id . ';
                function sc_run_map_' . $event_id . '(){
                  var myLatlng = new google.maps.LatLng(' . $coordinates['lat'] . ', ' . $coordinates['lng'] . ');
                  var map_options = {
                  zoom: 15,
                  center: myLatlng,
                  scrollwheel: false,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  map_' . $event_id . ' = new google.maps.Map(document.getElementById("sc_map_' . $event_id . '"), map_options);
                  var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map_' . $event_id . '
                  });
                }
                sc_run_map_' . $event_id . '();
                })</script>';

        echo $out;

    endif;
}

function mva_maps_get_coordinates($address, $force_refresh = false) {
    $address_hash = md5( $address );

    $coordinates = get_transient( $address_hash );

    if ($force_refresh || $coordinates === false) {

        $args       = array( 'address' => urlencode( $address ), 'sensor' => 'false' );
        $url        = add_query_arg( $args, 'http://maps.googleapis.com/maps/api/geocode/json' );
        $response   = wp_remote_get( $url );

        if( is_wp_error( $response ) )
            return;

        $data = wp_remote_retrieve_body( $response );

        if( is_wp_error( $data ) )
            return;

        if ( $response['response']['code'] == 200 ) {

            $data = json_decode( $data );

            if ( $data->status === 'OK' ) {

                $coordinates = $data->results[0]->geometry->location;

                $cache_value['lat']   = $coordinates->lat;
                $cache_value['lng']   = $coordinates->lng;
                $cache_value['address'] = (string) $data->results[0]->formatted_address;

                // cache coordinates for 3 months
                set_transient($address_hash, $cache_value, 3600*24*30*3);
                $data = $cache_value;

            } elseif ( $data->status === 'ZERO_RESULTS' ) {
                return __( 'No location found for the entered address.', 'pw-maps' );
            } elseif( $data->status === 'INVALID_REQUEST' ) {
                return __( 'Invalid request. Did you enter an address?', 'pw-maps' );
            } else {
                return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'pw-maps' );
            }

        } else {
            return __( 'Unable to contact Google API service.', 'pw-maps' );
        }

    } else {
        // return cached results
        $data = $coordinates;
    }

    return $data;
}



