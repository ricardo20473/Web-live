<?php
/************************************************************/
/* The main header of Zen7. It will be used on all pages that doesn't have another header-template declared. */
/************************************************************/
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<?php

global $zen7_data;
$html_class = '';
$html_style = '';
if ($zen7_data['zen_layout'] == '2') { $html_class .= ' boxed '; }
if (isset($zen7_data['zen_bg_image']['url']) && $zen7_data['zen_bg_image']['url'] != '' ) {
    $html_style = 'style="background: url('.$zen7_data['zen_bg_image']['url'].') fixed;"';
} elseif (isset($zen7_data['zen_bg_image_option'])) {
    $html_style = 'style="background: url('.$zen7_data['zen_bg_image_option'].') fixed;"';
}
?>

<!DOCTYPE html>
<html <?php echo $html_style; ?> class="<?php echo $html_class; ?>" <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php echo '<style type="text/css">'. $zen7_data['zen_css_code'] . '</style>' ?>

    <!-- Script required for extra functionality on the comment form -->
    <?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="menu-affix"></div>
<div class="header header-style-01" data-affix="header">
    <div class="container">
        <div class="col-md-2">
            <div class="logo">

                <?php $logo = IMAGES . '/header/logo.png'; ?>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php if(isset($zen7_data)) { echo $zen7_data['zen_logo']['url'];} else {echo $logo;} ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>">
                </a>

            </div>
            <nav class="phone-menu">
                <ul>

                    <li>

                        <a><?php _e('Home','zen7'); ?></a>

                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'main-menu',
                                'menu_class'      => '',
                                'container_class' => ''
                            ));
                        ?>

                    </li>

                </ul>
            </nav>
        </div>
        <div class="col-md-10">
            <nav class="menu clearfix">
                <?php wp_nav_menu(
                    array(
                        'theme_location'    => 'main-menu',
                        'container'         => '',
                        'fallback_cb'       => false,
                        'walker'            => new ZenControllerExtensionNavWalker()
                    ));
                ?>
            </nav>
        </div>
    </div>
</div>



