<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
$post_categories = wp_get_post_terms( get_the_ID(), 'zen_port_cat' );
$cat_slugs = '';
foreach ($post_categories as $cat) {
    $cat_slugs .= ' ' . $cat->slug . ' ';
}

?>

<li id="portfolio-<?php the_ID(); ?>" class="element <?php echo $cat_slugs; ?> post-li col-sm-4">

    <div class="image-container">

        <div class="post-link-bg">

            <h1><?php the_title(); ?></h1>

            <nav class="tags">

                <ul>

                <?php foreach($post_categories as $cat) : ?>
                    <li>
                        <a href="<?php echo get_term_link($cat->term_id, 'zen_port_cat'); ?>"><?php echo $cat->name; ?></a>
                    </li>
                <?php endforeach; ?>

                </ul>

            </nav>

            <a href="<?php the_permalink(); ?>" class="link"><span></span></a>

            <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )  ); ?>" rel="prettyPhoto[gallery2]" class="zoom"><span></span></a>

        </div>

        <?php if ( has_post_thumbnail() ) : ?>

            <?php the_post_thumbnail('portfolio_blog_1'); ?>

        <?php endif; ?>

    </div>

</li>