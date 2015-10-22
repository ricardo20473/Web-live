<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Zen7
 * @subpackage Zen7
 * @since Zen7 1.0.0
 */

$prefix = 'zen_';

if ( function_exists( 'rwmb_meta' ) ) {

    $option = rwmb_meta( "{$prefix}page_sidebar" );

    if( $option == 'none' ) {
        $has_widget = false;
        $content_class = 'col-sm-11';
    } else {
        $has_widget = true;
        $content_class = 'col-sm-8';
    }

} else {

    $content_class = 'col-sm-8';
    $has_widget = true;

}

get_header(); ?>

    <?php do_action('zen_before_content'); ?>

    <div class="container container-m-tb-small">

        <?php while ( have_posts() ) : the_post(); ?>

            <!-- Social Bar Container -->
            <div class="col-sm-1 row-left">

                <?php zen_the_date(); ?>

                <?php zen_favorite_post_button(); ?>

                <?php zen_display_share_buttons(); ?>

                <?php zen_next_prev_posts(); ?>

            </div>
            <!-- End Social Bar Container -->

            <!-- Post Content Container -->
            <div class="<?php echo $content_class; ?>">

                <!-- Start Single Content -->
                <?php get_template_part( 'lib/templates/content-single', get_post_format() ); ?>
                <!-- End Single Content -->

                <!-- Start Comments Container -->
                <div class="comment-container fadeInUp">

                    <?php comments_template('', true); ?>

                </div>
                <!-- End Comments Container -->

            </div>
            <!-- End Post Content Container -->

        <?php endwhile; ?>

        <?php if ( $has_widget ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('main-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>

    </div>

<?php get_footer(); ?>