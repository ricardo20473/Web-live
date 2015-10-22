<?php
/* Template Name: 404 Style 1 */

get_header(); ?>

    <div class="source-page-blue">
        <div class="container">
            <h1>
                <?php _e('<span>404</span> error','zen7'); ?>
            </h1>
            <ul class="bullet-arrow-white list-inline">
                <li>404</li>
            </ul>
        </div>
    </div>

    <div class="container container-m-tb fadeInUp">
        <div class="error-404">
            <h1>
                <?php _e('<span>404</span> error','zen7'); ?>
            </h1>
            <h2>
                <?php _e('This file may have been moved or deleted. Be sure to check your spelling.','zen7'); ?>
            </h2>
        </div>
    </div>

<?php get_footer(); ?>