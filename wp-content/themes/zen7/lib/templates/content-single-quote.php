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