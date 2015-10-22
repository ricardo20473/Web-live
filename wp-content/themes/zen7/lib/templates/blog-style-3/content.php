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
$has_widgets = Zen_Blog_Shortcode::get_instance()->has_widgets;
$query = Zen_Blog_Shortcode::get_instance()->blog_query;
$no_featured_image_style = '';
if ( ! has_post_thumbnail() ) {
    $no_featured_image_style = 'style="margin-left: 0; width: 100%;"';
}

?>

<?php
/**
 * Remove filter because it stays activated throw all posts.
 */
remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);
?>

<div class="blog-post-min clearfix">

    <div class="<?php if ($has_widgets) {echo 'col-sm-1-5';} else {echo 'col-sm-1';} ?> row-left">

        <?php if( $query->current_post == 0 ) : ?>
            <div class="up-down-buttons">
                <a href="#" class="btn-up"></a>
                <a href="#" class="btn-down"></a>
            </div>
        <?php endif; ?>

    </div>

    <div class="<?php if ($has_widgets) {echo 'col-sm-11-5';} else {echo 'col-sm-11';} ?> row-right">

        <!-- Post Container -->
        <div id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

                <a href="<?php the_permalink(); ?>" class="image-post">

                    <?php the_post_thumbnail('custom_blog_image_2'); ?>

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
                <!-- End Post Content/Excerpt -->

                <div class="clear"></div>

            </div>

        </div>
        <!-- End Post Container -->

    </div>

</div>

