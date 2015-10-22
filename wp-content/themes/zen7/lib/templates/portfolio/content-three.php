<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
$post_categories = wp_get_post_terms( get_the_ID(), 'zen_port_cat' );
$prefix  = 'zen_prtf_';
$cat_slugs = '';
foreach ($post_categories as $cat) {
    $cat_slugs .= ' ' . $cat->slug . ' ';
}
$query = Zen_Portfolio_Shortcode::get_instance()->portfolio_query;
?>

<div id="portfolio-<?php the_ID(); ?>" class="portfolio-post clearfix">

    <div class="col-sm-1 row-left">

        <?php if( $query->current_post == 0 ) : ?>
            <div class="up-down-buttons">
                <a href="#" class="btn-up"></a>
                <a href="#" class="btn-down"></a>
            </div>
        <?php endif; ?>

        <div class="social-media-container">

            <?php zen_favorite_post_button(); ?>

            <?php zen_display_share_buttons(); ?>

        </div>

    </div>

    <div class="post-bdb col-sm-11 row-left">

        <div class="col-sm-9 row-left">

            <div class="post-portfolio-container">

                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

                    <a href="<?php the_permalink(); ?>" class="image-post">

                        <?php the_post_thumbnail('portfolio_blog_3'); ?>

                    </a>

                <?php endif; ?>

            </div>

        </div>

        <div class="col-sm-3 row-right">

            <div class="content-post-portfolio">

                <a href="<?php the_permalink(); ?>" class="title-post"><?php the_title(); ?></a>

                <div class="description">
                    <h1><?php _e('Description','zen7'); ?></h1>

                    <?php zen_the_excerpt(); ?>
                </div>

                <div class="category">
                    <h1><?php _e('Category', 'zen7'); ?></h1>

                    <?php echo zen_get_portfolio_category(); ?>

                    <div class="clear"></div>
                </div>

                <?php if ( rwmb_meta("{$prefix}custom_meta") ) : ?>
                <div class="technology">

                    <?php echo zen_get_portfolio_meta(); ?>

                    <div class="clear"></div>
                </div>
                <?php endif; ?>

                <?php if ( rwmb_meta("{$prefix}portfolio_link_option") ) : ?>
                <div class="links">
                    <h1><?php _e('Links', 'zen7'); ?></h1>

                    <?php if ( rwmb_meta("{$prefix}portfolio_link_title") != '' ) : ?>
                        <a href="<?php echo rwmb_meta("{$prefix}portfolio_link"); ?>" target="<?php echo rwmb_meta("{$prefix}link_open"); ?>"><?php echo rwmb_meta("{$prefix}portfolio_link_title"); ?></a>
                    <?php else : ?>
                        <a href="<?php echo rwmb_meta("{$prefix}portfolio_link"); ?>" target="<?php echo rwmb_meta("{$prefix}link_open"); ?>"><?php echo rwmb_meta("{$prefix}portfolio_link"); ?></a>
                    <?php endif; ?>

                    <div class="clear"></div>

                </div>
                <?php endif; ?>

            </div>

        </div>

        <div class="clear"></div>

    </div>

</div>