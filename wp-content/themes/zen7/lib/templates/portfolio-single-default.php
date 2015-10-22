<?php
/**
 * Page to display portfolio single type default
 *
 * @since 1.0.0
 * @author Stylish Themes
 */

$classes = 'portfolio-post clearfix';
$prefix  = 'zen_prtf_';
array('post-container', 'post-container-single')

?>

<div id="portfolio-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <div class="col-sm-1 row-left fadeInUp-Big">

        <!-- Post Navigation -->
        <?php zen_portfolio_single_nav(get_the_ID()); ?>
        <!-- End Post Navigation -->

        <?php zen_portfolio_gallery_nav(); ?>

        <?php zen_favorite_post_button(); ?>

        <?php zen_display_share_buttons(); ?>

    </div>

    <div class="col-sm-11 fadeInUp">

        <div class="col-sm-12 row-left row-right">

            <?php if ( zen_is_title_active() ) : ?>
                <h1 class="title-proj">

                    <?php the_title(); ?>

                </h1>
            <?php endif; ?>

            <!-- Here comes the page slider -->
                <?php echo zen_get_portfolio_slider(get_the_ID()); ?>
            <!-- Portfolio slider end -->

        </div>

        <div class="col-sm-9 row-left">

            <div class="about-portfolio-post">
                <h1><?php _e('About', 'zen7'); ?></h1>

                <?php the_content(); ?>
            </div>

        </div>

        <div class="col-sm-3 row-right">

            <div class="content-post-portfolio">

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

            </div>

        </div>

    </div>

</div>