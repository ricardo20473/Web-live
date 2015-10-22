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
$post_prefix = 'zen_post_';
$featured_display = rwmb_meta("{$post_prefix}video_style");
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

        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

            <a href="<?php the_permalink(); ?>" class="image-post">

                <?php

                // Let's grab the video URL
                $post_thumbnail_id = get_post_thumbnail_id();
                $post_attachment = zen_get_attachment($post_thumbnail_id);

                // Now let's test if we have a video URL
                if ( $post_attachment['video_url'] != '' && $featured_display == '' ) {

                    // Display the video
                    echo wp_oembed_get( $post_attachment['video_url'], array('height' => '250'));

                } else {

                    // Display the featured image of the post
                    if ($post_layout == '') {
                        the_post_thumbnail('custom_masonry_image_1');
                    } else {
                        the_post_thumbnail('custom_masonry_image_2');
                    }

                }

                ?>

            </a>

        <?php endif; ?>

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

