<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package StylishThemes
 * @subpackage Zen7
 * @since Zen7 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php
$classes = array('post-container');
$prefix = 'zen_post_';
$has_widgets = Zen_Blog_Shortcode::get_instance()->has_widgets;
$preview_type = 'featured';
?>

<?php
/**
 * Remove filter because it stays activated throw all posts.
 */
remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);
?>

<div class="blog-post clearfix fadeInUp">

    <div class="<?php if ($has_widgets) {echo 'col-sm-1-5';} else {echo 'col-sm-1';} ?> row-left">

        <?php zen_the_date(); ?>

        <?php zen_favorite_post_button(); ?>

        <?php zen_display_share_buttons(); ?>

    </div>

    <div class="<?php if ($has_widgets) {echo 'col-sm-11-5';} else {echo 'col-sm-11';} ?> row-right">

        <!-- Post Container -->
        <div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

            <?php
            if (function_exists( 'rwmb_meta' )) {
                $preview_type = rwmb_meta("{$prefix}gallery_style");
            }

            if ( $preview_type == 'featured' ) {

                // Print here only the featured image
                if ( has_post_thumbnail() && ! post_password_required() ) { ?>

                    <a href="<?php the_permalink(); ?>" class="image-post">

                        <?php the_post_thumbnail('custom_blog_image_1'); ?>

                    </a>

                <?php
                }

            } else {

                // Print the slider with the images & videos
                $gallery_images = zen_get_gallery_images();
                if ( has_post_thumbnail() && ! post_password_required() ) {

                    $featured_image_id = get_post_thumbnail_id( $post->ID );
                    $featured_image = get_post($featured_image_id);
                    array_unshift($gallery_images['images'], $featured_image);
                    $gallery_images['count']++;

                }

                echo zen_the_post_rs($gallery_images);

            }

            ?>

            <div class="content-post-blog">

                <?php if ( is_single() ) : ?>

                    <h1 class="title-post"><?php the_title(); ?></h1>

                <?php else : ?>

                    <a href="<?php the_permalink(); ?>" class="title-post"><?php the_title(); ?></a>

                <?php endif; ?>

                <h2><?php zen_entry_meta(); ?><?php zen_comments_information(); ?> <?php zen_edit_link(); ?></h2>

                <!-- Post Content/Excerpt -->
                <?php zen_the_excerpt(); ?>

                <?php echo zen_get_content_more(); ?>
                <!-- End Post Content/Excerpt -->

                <div class="clear"></div>

            </div>

        </div>
        <!-- End Post Container -->

    </div>

</div>

