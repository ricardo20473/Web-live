<?php
/* Template Name: Blog Style 1 */

get_header(); ?>

<?php do_action('zen_before_content'); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <!-- Start Single Content -->
    <div class="container-m-tb">
        <div class="container">

            <?php echo do_shortcode('[zen_blog type="1" orderby="date" order="DESC" posts_per_page="6"]'); ?>

        </div>
    </div>
    <!-- End Single Content -->

<?php endwhile; ?>

<?php get_footer(); ?>