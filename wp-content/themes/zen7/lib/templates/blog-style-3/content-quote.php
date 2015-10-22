<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */
?>

<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = array('post-container');
$has_widgets = Zen_Blog_Shortcode::get_instance()->has_widgets;
$query = Zen_Blog_Shortcode::get_instance()->blog_query;
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

            <article class="category-quote-post-format">

                <div class="entry-content">

                    <blockquote>

                        <p>

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

                        </p>

                        <p class="author">- <?php the_title(); ?>	</p>

                    </blockquote>

                </div>

            </article>

        </div>
        <!-- End Post Container -->

    </div>

</div>


