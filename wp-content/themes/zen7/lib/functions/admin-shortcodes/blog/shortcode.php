<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


class Zen_Blog_Shortcode {

    protected static $instance = null;

    public $has_widgets = true;

    public $blog_query = null;

    private $content_class = 'col-sm-9';

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {

        add_shortcode( 'zen_blog', array( &$this, 'blog_shortcode' ) );

    }

    // Construct the blog shortcode
    public function blog_shortcode( $atts ) {
        $output = $category = $author = $posts_per_page = $type = $orderby = $order = '';

        extract( shortcode_atts( array(
            'type'              => '1',
            'posts_per_page'    => 5,
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
                $this->content_class = 'col-sm-12';
            } else {
                $this->has_widgets = true;
                $this->content_class = 'col-sm-9';
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

        switch($type) {
            case '1':
                $this->blog_style_1($query);
                break;
            case '2':
                $this->blog_style_2($query);
                break;
            case '3':
                $this->blog_style_3($query);
                break;
        }

        return $output;
    }

    /**
     * @param $query
     *
     * @since 1.0.0
     */
    private function blog_style_1( $query ) {
        ?>

        <?php if( $this->has_widgets ) : ?>
        <div class="<?php echo $this->content_class; ?>">
        <?php endif; ?>

            <?php /* The Loop */ ?>
            <?php if ( $query->have_posts() ) : ?>

                <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                    <?php
                    /* Get the content template */
                    get_template_part( 'content', get_post_format() );
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

            <?php if( $this->has_widgets ) : ?>
            <div class="col-sm-1-5"></div>

            <div class="col-sm-11-5">
            <?php else : ?>
            <div class="col-sm-1"></div>

            <div class="col-sm-11">
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

        <?php if( $this->has_widgets ) : ?>
        </div>
        <?php endif; ?>

        <!-- WIDGETS SIDEBAR -->
        <?php if ( $this->has_widgets ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('main-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>

        <?php
    }

    /**
     * @param $query
     *
     * @since 1.0.0
     */
    private function blog_style_2( $query ) {
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                if(typeof ZenBlog03 != "undefined")
                    ZenBlog03.init();
            });
        </script>

        <?php if( $this->has_widgets ) : ?>
            <div class="<?php echo $this->content_class; ?>">
        <?php endif; ?>

        <?php /* The Loop */ ?>
        <?php if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                <?php
                /* Get the content template */
                get_template_part( 'lib/templates/blog-style-2/content', get_post_format() );
                ?>

            <?php endwhile; ?>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            get_template_part( 'lib/templates/blog-style-2/content', 'none' );
            ?>

        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        <?php /* End Of The Loop */ ?>

        <?php if( $this->has_widgets ) : ?>
        <div class="col-sm-1-5"></div>

        <div class="col-sm-11-5">
        <?php else : ?>
        <div class="col-sm-1"></div>

        <div class="col-sm-11">
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

        <?php if( $this->has_widgets ) : ?>
        </div>
        <?php endif; ?>

        <!-- WIDGETS SIDEBAR -->
        <?php if ( $this->has_widgets ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('main-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>

        <?php
    }

    /**
     * @param $query
     *
     * @since 1.0.0
     */
    private function blog_style_3( $query ) {
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                if(typeof ZenBlog02 != "undefined")
                    ZenBlog02.init();
            });
        </script>

        <?php if( $this->has_widgets ) : ?>
            <div class="<?php echo $this->content_class; ?>">
        <?php endif; ?>

        <?php /* The Loop */ ?>
        <?php if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                <?php
                /* Get the content template */
                get_template_part( 'lib/templates/blog-style-3/content', get_post_format() );
                ?>

            <?php endwhile; ?>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            get_template_part( 'lib/templates/blog-style-3/content', 'none' );
            ?>

        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        <?php /* End Of The Loop */ ?>

        <?php if( $this->has_widgets ) : ?>
        <div class="col-sm-1-5"></div>

        <div class="col-sm-11-5">
        <?php else : ?>
        <div class="col-sm-1"></div>

        <div class="col-sm-11">
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

        <?php if( $this->has_widgets ) : ?>
        </div>
        <?php endif; ?>

        <!-- WIDGETS SIDEBAR -->
        <?php if ( $this->has_widgets ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('main-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>

        <?php
    }

}

Zen_Blog_Shortcode::get_instance();
