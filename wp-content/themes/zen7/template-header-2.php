<?php
/* Template Name: Header 2 */
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

get_header('two'); ?>

<?php do_action('zen_before_content'); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <!-- Start Single Content -->
    <?php the_content(); ?>
    <!-- End Single Content -->

    <!-- Start Comments Container -->
    <div class="comment-container fadeInUp">

        <?php //comments_template('', true); ?>

    </div>
    <!-- End Comments Container -->

<?php endwhile; ?>

<?php get_footer(); ?>