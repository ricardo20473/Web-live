<?php
/**
 * Page to display portfolio single type with sidebar 2
 *
 * @since 1.0.0
 * @author Stylish Themes
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = 'portfolio-post clearfix';
$prefix  = 'zen_prtf_';
$about_style = '';
array('post-container', 'post-container-single')

?>

<div id="portfolio-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <div class="col-sm-9 fadeInUp">

        <div class="post-portfolio-container">
            <?php if ( 'slider' == rwmb_meta("{$prefix}sidebar_2_type") ) : ?>

                <!-- Here comes the page slider -->
                <?php echo zen_get_portfolio_slider(get_the_ID()); ?>
                <!-- Portfolio slider end -->

            <?php else : ?>

                <!-- Portfolio Gallery Style -->
                <?php zen_portfolio_gallery_style_2(); ?>
                <!-- End Portfolio Gallery -->

            <?php endif; ?>
        </div>

        <div class="clear"></div>
    </div>

    <div class="col-sm-3 row-right fadeInUp-Big">

        <div class="content-post-portfolio">

            <?php if ( zen_is_title_active() ) : ?>
                <a class="title-post">

                    <?php the_title(); ?>

                </a>
            <?php else : ?>

                <?php $about_style = 'style="margin-top:0;"'; ?>

            <?php endif; ?>

            <div class="description no-icon" <?php echo $about_style; ?>>
                <h1><?php _e('About', 'zen7'); ?></h1>

                <?php echo zen_get_the_clear_content(); ?>
            </div>

            <div class="category no-icon">

                <h1><?php _e('Category', 'zen7'); ?></h1>

                <?php echo zen_get_portfolio_category(); ?>

                <div class="clear"></div>

            </div>

            <?php if ( rwmb_meta("{$prefix}custom_meta") ) : ?>
                <div class="technology no-icon">

                    <?php echo zen_get_portfolio_meta(); ?>

                    <div class="clear"></div>

                </div>
            <?php endif; ?>

            <?php if ( rwmb_meta("{$prefix}portfolio_link_option") ) : ?>
                <div class="links no-icon">

                    <h1><?php _e('Links', 'zen7'); ?></h1>

                    <?php if ( rwmb_meta("{$prefix}portfolio_link_title") != '' ) : ?>
                        <a href="<?php echo rwmb_meta("{$prefix}portfolio_link"); ?>" target="<?php echo rwmb_meta("{$prefix}link_open"); ?>"><?php echo rwmb_meta("{$prefix}portfolio_link_title"); ?></a>
                    <?php else : ?>
                        <a href="<?php echo rwmb_meta("{$prefix}portfolio_link"); ?>" target="<?php echo rwmb_meta("{$prefix}link_open"); ?>"><?php echo rwmb_meta("{$prefix}portfolio_link"); ?></a>
                    <?php endif; ?>

                    <div class="clear"></div>

                </div>
            <?php endif; ?>

            <div class="col-sm-4 row-left">

                <?php zen_display_share_buttons(); ?>

            </div>

            <div class="col-sm-4 row-left">

                <?php zen_favorite_post_button(); ?>

            </div>

        </div>

    </div>

    <div class="clear"></div>

    <div class="col-sm-12 fadeInUp-Big">

        <div class="portfolio-post-control">

            <!-- Post Navigation -->
            <?php zen_portfolio_single_nav_bottom(get_the_ID()); ?>
            <!-- End Post Navigation -->

        </div>

        <div class="clear"></div>

    </div>

</div>