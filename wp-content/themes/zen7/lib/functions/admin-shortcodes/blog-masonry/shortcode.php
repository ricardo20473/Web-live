<?php
/**
 * Class Zen_Blog_Masonry_Shortcode
 *
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Zen_Blog_Masonry_Shortcode {

    protected static $instance = null;

    public $has_widgets = false;

    public $blog_query = null;

    private $content_class = 'col-sm-9 posts-masonry';

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'zen_blog_masonry', array( &$this, 'blog_masonry_shortcode' ) );
    }

    public function blog_masonry_shortcode( $atts ) {
        $output = $category = $author = $posts_per_page = $type = $orderby = $order = '';

        extract( shortcode_atts( array(
            'type'              => '1',
            'posts_per_page'    => 6,
            'category'          => '',
            'author'            => '',
            'orderby'           => 'date',
            'order'             => 'DESC'
        ), $atts ) );

        // Explode all categories and authors ids into arrays
        if ($category == '') { $categories = array(); } else { $categories = explode(",", $category); }
        if ($author == '') { $authors = array(); } else { $authors = explode(",", $author); }

        $prefix = 'zen_';

        if ( function_exists( 'rwmb_meta' ) ) {

            $option = rwmb_meta( "{$prefix}page_sidebar" );

            if( $option == 'none' ) {
                $this->has_widgets = false;
                $this->content_class = 'posts-masonry row-padding';
            } else {
                $this->has_widgets = true;
                $this->content_class = 'col-sm-9 posts-masonry';
            }

        }

        // Construct the query
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
        elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
        else { $paged = 1; }
        $args = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'paged'             => $paged,
            'posts_per_page'    => (int)$posts_per_page,
            'orderby'           => $orderby,
            'order'             => $order,
            'category__in'      => $categories,
            'author__in'        => $authors
        );

        $query = new WP_Query($args);
        $this->blog_query = $query;

        ?>

        <div class="<?php echo $this->content_class; ?>">

            <?php /* The Loop */ ?>
            <?php if ( $query->have_posts() ) : ?>

                <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                    <?php
                    /* Get the content template */
                    get_template_part( 'lib/templates/blog-masonry/content', get_post_format() );
                    ?>

                <?php endwhile; ?>

            <?php else : ?>

                <?php
                /* Get the none-content template (error) */
                get_template_part( 'content', 'none' );
                ?>

            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            <?php /* End Of The Loop */ ?>

        </div>

        <!-- WIDGETS SIDEBAR -->
        <?php if ( $this->has_widgets ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('main-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>

        <div class="clear"></div>

        <?php if( $this->has_widgets ) : ?>
            <div class="col-sm-9">
        <?php else : ?>
            <div>
        <?php endif; ?>

        <?php
        global $zen7_data;
        if($zen7_data['zen_pag_style'] == '2')
            zen_paging_nav_query($query);
        else
            zen_numbers_pagination_query($query);
        ?>

        <div class="clear"></div>

        </div>

        <?php

        return $output;
    }

}

Zen_Blog_Masonry_Shortcode::get_instance();