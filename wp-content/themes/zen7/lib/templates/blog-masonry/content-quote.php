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
                if ($post_layout == '') {
                    the_post_thumbnail('custom_masonry_image_1');
                } else {
                    the_post_thumbnail('custom_masonry_image_2');
                }
                ?>

            </a>

        <?php endif; ?>

        <div class="content-post-blog" <?php echo $no_featured_image_style; ?>>

            <article class="category-quote-post-format blockquote-empty">

                <div class="entry-content">

                    <blockquote>

                        <p>

                            "
                            <?php

                            // Let's get the content and filter it for <blockquotes>
                            $quote_content = get_the_content();
                            preg_match( '/<blockquote.*?>/', $quote_content, $matches );

                            // Test now the $matches to see if we have any blockquotes and remove them
                            if ( empty( $matches ) ) {
                                echo $quote_content;
                            } else {
                                // If we have blockquote tag in the text, remove it
                                $searching = array( "", "/</blockquote.*?>/" );
                                echo preg_replace( array("/<blockquote.*?>/", "/<\/blockquote.*?>/") , "", $quote_content);
                            }

                            ?>
                            "

                        </p>

                        <p class="author">- <?php the_title(); ?>	</p>

                    </blockquote>

                </div>

            </article>

            <div class="clear"></div>

        </div>

    </div>
    <!-- End Post Container -->


</div>

