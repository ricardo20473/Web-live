<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php

$classes = array('post-container', 'post-container-single');
$zen_post_class = '';
$prefix_post = 'zen_post_';
$is_featured_image_active = true;
if(function_exists('rwmb_meta')) {
    $is_featured_image_active = rwmb_meta("{$prefix_post}featured_image");
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <?php if ( has_post_thumbnail() && ! post_password_required() && ! $is_featured_image_active ) : ?>

        <a href="<?php the_permalink(); ?>" class="image-post">

            <?php

            // Let's grab the video URL
            $post_thumbnail_id = get_post_thumbnail_id();
            $post_attachment = zen_get_attachment($post_thumbnail_id);

            // Now let's test if we have a video URL
            if ( $post_attachment['video_url'] != '' ) {

                // Display the video
                echo wp_oembed_get( $post_attachment['video_url'], array('height' => '396'));

            } else {

                // Display the featured image of the post
                the_post_thumbnail('custom_blog_image_1');

            }

            ?>

        </a>

    <?php else : ?>

        <?php $zen_post_class = 'no_featured_image'; ?>

    <?php endif; ?>

    <div class="<?php echo $zen_post_class; ?> content-post-blog fadeInUp">

        <?php if ( zen_is_title_active() ) : ?>
            <?php if ( is_single() ) : ?>

                <h1 class="title-post"><?php the_title(); ?></h1>

            <?php else : ?>

                <a href="<?php the_permalink(); ?>" class="title-post"><?php the_title(); ?></a>

            <?php endif; ?>
        <?php endif; ?>

        <h2><?php zen_entry_meta(); ?><?php zen_comments_information(); ?> <?php zen_edit_link(); ?></h2>

        <?php the_content(); ?>

        <!-- Displaying post pagination links in case we have multiple page posts -->
        <?php zen_single_post_pagination(); ?>

        <?php zen_entry_tags(); ?>

    </div>

</div>

