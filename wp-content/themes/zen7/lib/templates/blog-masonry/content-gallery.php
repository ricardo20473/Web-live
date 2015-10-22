<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package StylishThemes
 * @subpackage Zen7
 * @since Zen7 1.0.0
 */
?>

<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = array('post-container');
$prefix = 'zen_post_';
$has_widgets = Zen_Blog_Masonry_Shortcode::get_instance()->has_widgets;
$query = Zen_Blog_Masonry_Shortcode::get_instance()->blog_query;
$no_featured_image_style = '';
if ( ! has_post_thumbnail() ) {
    $no_featured_image_style = 'style="margin-left: 0; width: 100%;"';
}

$post_layout = rwmb_meta('zen_post_masonry_style');

$masonry_post_class = '';
if ( $has_widgets ) {
    if ($post_layout == '') {
        $masonry_post_class = 'col-sm-4';
    } else {
        $masonry_post_class = 'col-sm-8';
    }
} else {
    if ($post_layout == '') {
        $masonry_post_class = 'col-sm-3';
    } else {
        $masonry_post_class = 'col-sm-6';
    }
}

?>

<?php
/**
 * Remove filter because it stays activated throw all posts.
 */
remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);
?>

<div class="blog-post post-masonry <?php echo $masonry_post_class; ?>">

    <!-- Post Container -->
    <div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

        <?php
        $preview_type = rwmb_meta("{$prefix}gallery_style");

        if ( $preview_type == 'featured' ) {

            // Print here only the featured image
            if ( has_post_thumbnail() && ! post_password_required() ) { ?>

                <a href="<?php the_permalink(); ?>" class="image-post">

                    <?php
                    if ($post_layout == '') {
                        the_post_thumbnail('custom_masonry_image_1');
                    } else {
                        the_post_thumbnail('custom_masonry_image_2');
                    }
                    ?>

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

            ?>
            <div class="image-post">
                <?php echo zen_the_post_rs($gallery_images); ?>
            </div>
        <?php

        }

        ?>

        <div class="content-post-blog" <?php echo $no_featured_image_style; ?>>

            <?php if ( is_single() ) : ?>

                <h1 class="title-post"><?php the_title(); ?></h1>

            <?php else : ?>

                <a href="<?php the_permalink(); ?>" class="title-post"><?php the_title(); ?></a>

            <?php endif; ?>

            <h2><?php zen_entry_meta(); ?><?php zen_comments_information(); ?> <?php zen_edit_link(); ?></h2>

            <!-- Post Content/Excerpt -->
            <?php zen_the_excerpt(); ?>

            <?php echo zen_get_content_more(); ?>

            <?php zen_the_date_masonry(); ?>
            <!-- End Post Content/Excerpt -->

            <div class="clear"></div>

        </div>

    </div>
    <!-- End Post Container -->


</div>

