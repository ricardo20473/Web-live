<?php
/* Template Name: 404 Style 2 */

get_header(); ?>

    <div class="bg-404 fadeInDown">
        <div class="error-404-big">
            <span class="error-icon"></span>
            <h1>
                <?php _e('404 error','zen7'); ?>
            </h1>
            <h2>
                <?php _e('This file may have been moved or deleted. Be sure to check your spelling.','zen7'); ?>
            </h2>
        </div>
    </div>

<?php get_footer(); ?>