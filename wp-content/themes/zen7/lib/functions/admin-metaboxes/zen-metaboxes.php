<?php
/**
 * Add a custom meta-box for posts/pages or other custom post-types
 *
 * @author Vlad Mustiata
 * @using Meta Box plugin
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

define('ZEN_META_PATH', get_template_directory_uri() . '/lib/functions/admin-metaboxes/');

if ( class_exists( 'RW_Meta_Box' ) ) {

    if ( is_admin() ) {
        add_action( 'admin_enqueue_scripts', 'zen_meta_admin_init' );
    }

    /**
     * @since 1.0.0
     *
     */
    function zen_meta_admin_init() {
        global $pagenow;

        if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' || $pagenow == 'edit.php' ) {

            wp_register_script('zen_meta_js', ZEN_META_PATH .'assets/zen-meta-js.js', array('jquery'));
            wp_enqueue_script('zen_meta_js');

            wp_enqueue_style( 'zen_meta_css', ZEN_META_PATH .'assets/zen-meta-css.css');

        }
    }

    // Get the Sliders
    $rev_sliders = array( 'none' => __('none', 'zen-admin') );

    if ( class_exists('RevSlider') ) {

        $rev = new RevSlider();

        $arrSliders = $rev->getArrSliders();
        foreach ( (array) $arrSliders as $revSlider ) {
            $rev_sliders[ $revSlider->getAlias() ] = $revSlider->getTitle();
        }
    }

    add_filter('rwmb_meta_boxes', 'zen_register_meta_boxes');

    /**
     * @param $meta_boxes
     * @return array
     */
    function zen_register_meta_boxes( $meta_boxes ) {
        $prefix = 'zen_';
        $prefix_prtf = 'zen_prtf_';
        $prefix_team = 'zen_team_';
        $prefix_testimonial = 'zen_testimonial_';
        $prefix_post = 'zen_post_';

        global $rev_sliders;

        $meta_boxes[] = array(
            'id'        => "{$prefix}page_title",
            'title'     => __('Page/Post Header Style', 'zen-admin'),
            'pages'     => array('post','page','zen_portfolio'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                array(
                    'id'            => "{$prefix}header_style",
                    'type'          => 'radio',
                    'class'         => 'custom-header-select',
                    'options'       => array(
                        'default'       => __('Default', 'zen-admin'),
                        'none'          => __('None', 'zen-admin'),
                        'parallax'      => __('Parallax', 'zen-admin'),
                        'slider'        => __('Slider', 'zen-admin'),
                    ),
                    'std'           => 'default',
                ),

                array(
                    'type'      => 'divider',
                    'id'        => 'fake_divider_id', // Not used, but needed
                    'class'     => 'zen-meta-divider header_style_divider',
                ),

                // Default header style
                array(
                    'name'          => __('Select Header Style:','zen-admin'),
                    'id'            => "{$prefix}default_style",
                    'type'          => 'select',
                    'std'			=> 'default',
                    'options'  		=> array(
                        'default'           => __('Default', 'zen-admin'),
                        'theme_color'       => __('Use theme color', 'zen-admin'),
                    ),
                    'multiple' 		=> false,
                    'class'         => 'default_header_style'
                ),


                // Revolution Slider Selector
                array(
                    'name'          => __('Select slider:','zen-admin'),
                    'id'            => "{$prefix}slider_style",
                    'type'          => 'select',
                    'std'			=> 'none',
                    'options'  		=> $rev_sliders,
                    'multiple' 		=> false,
                    'class'         => 'rev_slider_meta'
                ),

                // COLOR
                /**
                 * TODO: On an update do the color-picker for the header-parallax content, and delete the select option for color scheme.
                 */
                /*array(
                    'name'          => __( 'Text color:', 'zen-admin' ),
                    'id'            => "{$prefix}parallax_color",
                    'type'          => 'color',
                    'class'         => 'parallax_meta',
                ),*/

                // Parallax color scheme (for text)
                array(
                    'name'          => __('Select Text Color Scheme:','zen-admin'),
                    'id'            => "{$prefix}parallax_color",
                    'type'          => 'select',
                    'std'			=> 'default',
                    'options'  		=> array(
                        'default'           => __('Default', 'zen-admin'),
                        'dark'             => __('Dark', 'zen-admin'),
                    ),
                    'multiple' 		=> false,
                    'class'         => 'parallax_meta'
                ),

                // PARALLAX BACKGROUND IMAGE
                array(
                    'name'             => __( 'Background Image:', 'rwmb' ),
                    'id'               => "{$prefix}parallax_image",
                    'type'             => 'image_advanced',
                    'max_file_uploads' => 1,
                    'class'            => 'parallax_meta',
                ),
            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix_post}post_options",
            'title'     => __('Post Options', 'zen-admin'),

            'fields'    => array(
                array(
                    'name' => __( 'Hide featured image on single page:', 'zen-admin' ),
                    'id'   => "{$prefix_post}featured_image",
                    'type' => 'checkbox',
                    'std'  => 0,
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Post preview style', 'rwmb' ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name' => __( 'Post preview on masonry:', 'zen-admin' ),
                    'id'   => "{$prefix_post}masonry_style",
                    'type' => 'radio',
                    'options' => array(
                        '' => __( 'normal', 'zen-admin' ),
                        'wide' => __( 'wide', 'zen-admin' ),
                    ),
                    'std'  => '',
                    'desc' => __( 'This will influence how the post is displayed on masonry style.' , 'zen-admin'),
                ),

                array(
                    'name' => __( 'Gallery post preview:', 'zen-admin' ),
                    'id'   => "{$prefix_post}gallery_style",
                    'type' => 'radio',
                    'options' => array(
                        '' => __( 'gallery slideshow', 'zen-admin' ),
                        'featured' => __( 'featured image', 'zen-admin' ),
                    ),
                    'std'  => '',
                    'desc' => __( 'This will influence how the gallery post will show up.' , 'zen-admin'),
                ),

                array(
                    'name' => __( 'Video post preview:', 'zen-admin' ),
                    'id'   => "{$prefix_post}video_style",
                    'type' => 'radio',
                    'options' => array(
                        '' => __( 'video', 'zen-admin' ),
                        'featured' => __( 'featured image', 'zen-admin' ),
                    ),
                    'std'  => '',
                    'desc' => __( 'This will influence how the video post will show up.' , 'zen-admin'),
                ),

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}page_layout",
            'title'     => __('Page Layout', 'zen-admin'),
            'pages'     => array('post','page'),
            'context'   => 'side',
            'priority'  => 'default',

            'fields'    => array(
                array(
                    'id'            => "{$prefix}page_sidebar",
                    'type'          => 'radio',
                    'class'         => 'custom_sidebar_select',
                    'options'       => array(
                        'left'          => __('Left Sidebar', 'zen-admin'),
                        'none'          => __('No Sidebar', 'zen-admin'),
                    ),
                    'std'           => 'left',
                    'desc'          => '<br>*** This option only works on some pages (i.e. Blog, Shop, Single Posts). If you create a simple page, use the
                                        <b>Visual Composer\'s</b> sidebar shortcode for the sidebar.',
                ),
            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}post_media",
            'title'     => __('Add/Edit Project Media', 'zen-admin'),
            'pages'     => array('zen_portfolio','zen_gallery'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                array(
                    'id'            => "{$prefix}images_gallery",
                    'type'          => 'image_advanced',
                    'max_file_uploads' => 999
                ),
            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix_prtf}portfolio_single_style",
            'title'     => __('Portfolio Style', 'zen-admin'),
            'pages'     => array('zen_portfolio'),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(
                array(
                    'id'            => "{$prefix_prtf}portfolio_media_style",
                    'type'          => 'radio',
                    'class'         => 'custom-portfolio-select',
                    'options'       => array(
                        'default'       => __('Media above content', 'zen-admin'),
                        'sidebar_1'     => __('Media on center', 'zen-admin'),
                        'sidebar_2'     => __('Media on left', 'zen-admin'),
                    ),
                    'std'           => 'default',
                ),

                array(
                    'type'      => 'divider',
                    'id'        => 'fake_divider_id', // Not used, but needed
                    'class'     => 'zen-meta-divider portfolio_style_divider',
                ),

                array(
                    'id'            => "{$prefix_prtf}sidebar_2_type",
                    'type'          => 'radio',
                    'class'         => 'sidebar_media_type',
                    'options'       => array(
                        'slider'       => __('Slider', 'zen-admin'),
                        'gallery'     => __('Gallery', 'zen-admin'),
                    ),
                    'std'           => 'slider',
                ),

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix_prtf}portfolio_options",
            'title'     => __('Portfolio Options', 'zen-admin'),
            'pages'     => array('zen_portfolio'),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(
                array(
                    'name' => __( 'Project link:', 'zen-admin' ),
                    'id'   => "{$prefix_prtf}portfolio_link_option",
                    'type' => 'checkbox',
                    'std'  => 0,
                ),

                array(
                    'name'  => __( 'Link:', 'zen-admin' ),
                    'id'    => "{$prefix_prtf}portfolio_link",
                    'type'  => 'url'
                ),

                array(
                    'name'  => __( 'Title to show:', 'zen-admin' ),
                    'id'    => "{$prefix_prtf}portfolio_link_title",
                    'type'  => 'text',
                    'desc'  => __( 'If no title is added, the URL will be shown.', 'zen-admin'),
                ),

                array(
                    'id'            => "{$prefix_prtf}link_open",
                    'name'          => __('Target:', 'zen-admin'),
                    'type'          => 'radio',
                    'class'         => 'prtf_link_open',
                    'options'       => array(
                        '_self'       => __('_self', 'zen-admin'),
                        '_blank'     => __('_blank', 'zen-admin'),
                    ),
                    'std'           => '_blank',
                ),

                array(
                    'type'      => 'divider',
                    'id'        => 'fake_divider_id', // Not used, but needed
                    'class'     => 'zen-meta-divider',
                ),

                array(
                    'name' => __( 'Custom field:', 'zen-admin' ),
                    'id'   => "{$prefix_prtf}custom_meta",
                    'type' => 'checkbox',
                    'std'  => 0,
                    'desc' => __( 'You can use this to display the "technologies" you have used on the project.', 'zen-admin'),
                ),

                array(
                    'name'  => __( 'Title to show:', 'zen-admin' ),
                    'id'    => "{$prefix_prtf}custom_meta_title",
                    'type'  => 'text',
                ),

                array(
                    'name'  => __( 'Value:', 'zen-admin' ),
                    'id'    => "{$prefix_prtf}custom_meta_value",
                    'type'  => 'text',
                ),

                array(
                    'type'      => 'divider',
                    'id'        => 'fake_divider_id', // Not used, but needed
                    'class'     => 'zen-meta-divider',
                ),

                array(
                    'name' => __( 'Hide featured image on single page:', 'zen-admin' ),
                    'id'   => "{$prefix_prtf}featured_image",
                    'type' => 'checkbox',
                    'std'  => 0,
                ),

                array(
                    'type'      => 'divider',
                    'id'        => 'fake_divider_id', // Not used, but needed
                    'class'     => 'zen-meta-divider',
                ),

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix_team}options",
            'title'     => __('Employee Options', 'zen-admin'),
            'pages'     => array('zen_employee'),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(
                array(
                    'name'  => __( 'Position:', 'zen-admin' ),
                    'id'    => "{$prefix_team}position",
                    'type'  => 'text',
                ),

                array(
                    'name' => __( 'Short Description', 'zen-admin' ),
                    'id'   => "{$prefix_team}description",
                    'type' => 'textarea',
                    'cols' => 20,
                    'rows' => 3,
                ),

                array(
                    'name'  => __( 'Facebook:', 'zen-admin' ),
                    'id'    => "{$prefix_team}facebook",
                    'type'  => 'url',
                    'std'   => 'http://facebook.com',
                ),

                array(
                    'name'  => __( 'Twitter:', 'zen-admin' ),
                    'id'    => "{$prefix_team}twitter",
                    'type'  => 'url',
                    'std'   => 'http://twitter.com',
                ),

                array(
                    'name'  => __( 'Google+:', 'zen-admin' ),
                    'id'    => "{$prefix_team}googleplus",
                    'type'  => 'url',
                    'std'   => 'http://plus.google.com',
                ),

                array(
                    'name'  => __( 'Pinterest:', 'zen-admin' ),
                    'id'    => "{$prefix_team}pinterest",
                    'type'  => 'url',
                    'std'   => 'https://pinterest.com',
                ),

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix_testimonial}options",
            'title'     => __('Testimonial Options', 'zen-admin'),
            'pages'     => array('zen_testimonial'),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(

                array(
                    'name' => __( 'Testimonial:', 'zen-admin' ),
                    'id'   => "{$prefix_testimonial}description",
                    'type' => 'textarea',
                    'cols' => 20,
                    'rows' => 3,
                ),

                array(
                    'name'  => __( 'Position Title:', 'zen-admin' ),
                    'id'    => "{$prefix_testimonial}position",
                    'type'  => 'text',
                ),

                array(
                    'name'  => __( 'Position Link:', 'zen-admin' ),
                    'id'    => "{$prefix_testimonial}link",
                    'type'  => 'url',
                    'std'   => '',
                ),

            ),
        );

        return $meta_boxes;
    }

}


