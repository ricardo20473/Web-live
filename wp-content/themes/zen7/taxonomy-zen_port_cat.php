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
            <?php single_cat_title(); ?>
        </h1>
        <?php echo zen_breadcrumbs(); ?>
    </div>
</div>

<div class="container container-m-tb-small">

    <?php $cat = single_cat_title('', false);
    $cat = get_term_by('name', $cat, 'zen_port_cat' );
    $shortcode = '[zen_portfolio type="1" category="'.$cat->term_id.'"]';
    echo do_shortcode($shortcode); ?>

</div>

<?php get_footer(); ?>

