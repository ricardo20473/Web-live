<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Zen_Portfolio_Shortcode {

    protected static $instance = null;

    public $portfolio_query = null;

    public $portfolio_cat = array();

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'zen_portfolio', array( &$this, 'portfolio_shortcode' ) );
    }

    public function portfolio_shortcode( $atts ) {
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

        // Construct the query
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
        elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
        else { $paged = 1; }
        $args = array(
            'post_type'         => 'zen_portfolio',
            'post_status'       => 'publish',
            'paged'             => $paged,
            'posts_per_page'    => (int)$posts_per_page,
            'orderby'           => $orderby,
            'order'             => $order,
            'tax_query'         => ($category != '' ? array(
                array(
                    'taxonomy' => 'zen_port_cat',
                    'field' => 'id',
                    'terms' => $categories
                ),
            ) : false ),
            'author__in'        => $authors
        );

        $query = new WP_Query($args);
        $this->portfolio_query = $query;

        if ($category == '') {
            $this->portfolio_cat = get_terms('zen_port_cat');
        } else {
            $cat_aux = array();
            foreach($categories as $id) {
                array_push($cat_aux, get_term($id, 'zen_port_cat'));
            }
            $this->portfolio_cat = $cat_aux;
        }

        switch($type) {
            case '1':
                $this->portfolio_style_1();
                break;
            case '2':
                $this->portfolio_style_2();
                break;
            case '3':
                $this->portfolio_style_3();
                break;
        }

        return $output;
    }

    private function portfolio_style_1() {
        $query = $this->portfolio_query;

        ?>
        <nav class="categories-portfolio">
            <ul data-option-key="filter" class="option-set">
                <li>
                    <a class="button-white-bxs-grey selected" data-option-value="*" class="selected"><?php _e('All', 'zen7'); ?></a>
                </li>
                <?php foreach($this->portfolio_cat as $cat) : ?>
                <li>
                    <a class="button-white-bxs-grey" data-option-value=".<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <nav class="posts-list clearfix">
            <ul class="clearfix">

                <?php /* The Loop */ ?>
                <?php if ( $query->have_posts() ) : ?>

                    <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                        <?php
                        /* Get the content template */
                        get_template_part( 'lib/templates/portfolio/content', 'one' );
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

                <div class="clearfix"></div>
            </ul>
        </nav>

        <div class="portfolio_bottom_nav">
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

    }

    private function portfolio_style_2() {
        $query = $this->portfolio_query;

        ?>
        <nav class="categories-portfolio">
            <ul data-option-key="filter" class="option-set">
                <li>
                    <a class="button-white-bxs-grey selected" data-option-value="*" class="selected"><?php _e('All', 'zen7'); ?></a>
                </li>
                <?php foreach($this->portfolio_cat as $cat) : ?>
                    <li>
                        <a class="button-white-bxs-grey" data-option-value=".<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <nav class="posts-list post-list-postfolio-02">
            <ul>

                <?php /* The Loop */ ?>
                <?php if ( $query->have_posts() ) : ?>

                    <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                        <?php
                        /* Get the content template */
                        get_template_part( 'lib/templates/portfolio/content', 'two' );
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

                <div class="clearfix"></div>
            </ul>
        </nav>

        <div class="portfolio_bottom_nav">
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
    }

    private function portfolio_style_3() {
        $query = $this->portfolio_query;

        ?>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                if(typeof ZenBlog04 != "undefined")
                    ZenBlog04.init();
            });
        </script>

        <?php /* The Loop */ ?>
        <?php if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) :  $query->the_post(); ?>

                <?php
                /* Get the content template */
                get_template_part( 'lib/templates/portfolio/content', 'three' );
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



        <div class="portfolio_bottom_nav">
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

    }

}

Zen_Portfolio_Shortcode::get_instance();