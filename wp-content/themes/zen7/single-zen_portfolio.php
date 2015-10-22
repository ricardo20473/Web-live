<?php
/**
 * The Template for displaying all single portfolios.
 *
 * @package Zen7
 * @subpackage Zen7
 * @since Zen7 1.0.0
 */

$prefix = 'zen_prtf_';

if ( function_exists( 'rwmb_meta' ) ) {

    $portfolio_template = rwmb_meta( "{$prefix}portfolio_media_style" );

} else {

    $portfolio_template = 'default';

}

get_header(); ?>

<?php do_action('zen_before_content'); ?>

    <div class="container container-m-tb-small">

        <?php while ( have_posts() ) : the_post(); ?>
            
            <!-- Start Single Content -->
            <?php get_template_part( 'lib/templates/portfolio-single', $portfolio_template ); ?>
            <!-- End Single Content -->

        <?php endwhile; ?>

    </div>

<?php get_footer(); ?>