<?php
/************************************************************/
/* This is the main template of Zen7. */
/************************************************************/
?>

<?php
$prefix = 'zen_';
global $zen7_data;

if ( function_exists( 'rwmb_meta' ) ) {

    $option = rwmb_meta( "{$prefix}page_sidebar" );

    if( $option == 'none' ) {
        $has_widget = false;
        $content_class = 'col-sm-12';
    } else {
        $has_widget = true;
        $content_class = 'col-sm-9';
    }

} else {

    $content_class = 'col-sm-9';
    $has_widget = true;

}
?>

<?php get_header(); ?>

    <!-- Page title -->
    <div class="source-page fadeInDown">
        <div class="container">
            <h1>
                <?php _e('Welcome to ','zen7'); bloginfo('name'); ?>
            </h1>
            <ul class="bullet-arrow list-inline">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home','zen7'); ?></a></li>
            </ul>
        </div>
    </div>

    <div class="container container-m-tb-small">

        <div class="<?php echo $content_class; ?>">

            <?php /* The Loop */ ?>
            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                        /* Get the content template */
                        get_template_part( 'content', get_post_format() );
                    ?>

                <?php endwhile; ?>

            <?php else : ?>

                <?php
                    /* Get the none-content template (error) */
                    get_template_part( 'content', 'none' );
                ?>

            <?php endif; ?>
            <?php /* End The Loop */ ?>

            <div class="col-sm-1-5"></div>

            <div class="col-sm-11-5">

                <?php
                    if($zen7_data['zen_pag_style'] == '2')
                        zen_paging_nav();
                    else
                        zen_numbers_pagination();
                ?>

                <div class="clear"></div>

            </div>

        </div>


        <!-- WIDGETS SIDEBAR -->
        <?php if ( $has_widget ) : ?>
            <!-- Widgets Sidebar Container -->
            <div class="col-sm-3">

                <?php get_sidebar('main-sidebar'); ?>

            </div>
            <!-- End Widgets Sidebar Container -->
        <?php endif; ?>

    </div>

<?php get_footer(); ?>

