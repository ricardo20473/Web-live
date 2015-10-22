<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = array('post-container');
$post_prefix = 'zen_post_';
$featured_display = '';
if (function_exists( 'rwmb_meta' )) {
    $featured_display = rwmb_meta("{$post_prefix}video_style");
}
$has_widgets = Zen_Blog_Shortcode::get_instance()->has_widgets;
$query = Zen_Blog_Shortcode::get_instance()->blog_query;
?>

<?php
/**
 * Remove filter because it stays activated throw all posts.
 */
remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);
?>

<div class="blog-post-separately clearfix">

    <div class="<?php if ($has_widgets) {echo 'col-sm-1-5';} else {echo 'col-sm-1';} ?> row-left">

        <?php if( $query->current_post == 0 ) : ?>
            <div class="up-down-buttons">
                <a href="#" class="btn-up"></a>
                <a href="#" class="btn-down"></a>
            </div>
        <?php endif; ?>

        <div class="social-media-container">

            <?php zen_the_date(); ?>

            <?php zen_favorite_post_button(); ?>

            <?php zen_display_share_buttons(); ?>

        </div>

    </div>

    <div class="<?php if ($has_widgets) {echo 'col-sm-11-5';} else {echo 'col-sm-11';} ?> row-right">

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
                        echo wp_oembed_get( $post_attachment['video_url'], array('height' => '396'));

                    } else {

                        // Display the featured image of the post
                        the_post_thumbnail('custom_blog_image_1');

                    }

                    ?>

                </a>

            <?php endif; ?>

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