<?php
/**
 * The Template for displaying 404.
 *
 * @package Zen7
 * @subpackage Zen7
 * @since Zen7 1.0.0
 */

get_header(); ?>

<?php global $zen7_data; ?>


    <?php switch($zen7_data['zen_404_style']) {

        case '1':

            ?>

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

            <?php

            break;
        case '2':
            ?>

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

            <?php
            break;
    } ?>


<?php get_footer(); ?>