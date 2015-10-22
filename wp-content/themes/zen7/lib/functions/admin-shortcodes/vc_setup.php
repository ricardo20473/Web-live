<?php
/**
 * Here is the place that shortcodes are registered in the Visual Composer plugin.
 *
 * @author Vlad Mustiata
 */

if (class_exists('WPBakeryVisualComposer') && class_exists('ZenThemeController')) :

    // Dealing with the ROW Shortcode
    vc_remove_param('vc_row', 'font_color');
    vc_remove_param('vc_row', 'bg_image');
    vc_remove_param('vc_row', 'bg_image_repeat');

    // vc_accordion
    vc_remove_param('vc_accordion', 'collapsible');
    vc_remove_param('vc_accordion', 'active_tab');

    // vc_pie
    /*vc_remove_param('vc_pie', 'color');
    vc_remove_param('vc_pie', 'units');
    vc_remove_param('vc_pie', 'title');

    $attr = array(
        "type" => "colorpicker",
        "heading" => __('Pie Color', 'zen-admin'),
        "param_name" => "color",
        "description" => __("Select pie color.", "zen-admin")
    );
    vc_add_param('vc_pie', $attr);*/

    $attr = array(
        "type" => "dropdown",
        "heading" => __('Label & Title Color', 'zen-admin'),
        "param_name" => "color_text",
        "value" => array(
            __("Default (dark)", 'zen-admin') => '#888888',
            __("Light", 'zen-admin') => '#fcfcfc'
        ),
        "description" => __("Select the text & title color.", "zen-admin"),
    );
    vc_add_param('vc_pie', $attr);

    // vc_progress_bar
    vc_remove_param('vc_progress_bar', 'values');
    vc_remove_param('vc_progress_bar', 'bgcolor');
    vc_remove_param('vc_progress_bar', 'custombgcolor');
    vc_remove_param('vc_progress_bar', 'options');

    // remove elements
    vc_remove_element('vc_toggle');
    vc_remove_element('vc_carousel');
    vc_remove_element('vc_posts_slider');
    vc_remove_element('vc_posts_grid');
    vc_remove_element('vc_gallery');
    vc_remove_element('vc_images_carousel');


    // vc_progress_bar
    $attr = array(
        "type" => "textfield",
        "heading" => __("Value", "zen-admin"),
        "param_name" => "value",
        "description" => __('Input graph value here. Witihn a range 0-100.', 'zen-admin'),
        "value" => "50",
        "admin_label" => true
    );
    vc_add_param('vc_progress_bar', $attr);

    $attr = array(
        "type" => "checkbox",
        "heading" => __("Options", "zen-admin"),
        "param_name" => "options",
        "value" => array(__("Add Stripes?", "zen-admin") => "striped", __("Add animation? Will be visible with striped bars.", "zen-admin") => "animated", __("Add hover? Will be visible when you hover it.", "zen-admin") => "hover")
    );
    vc_add_param('vc_progress_bar', $attr);

    $attr = array(
        "type" => "dropdown",
        "heading" => __("Bar color", "zen-admin"),
        "param_name" => "bgcolor",
        "value" => array(__("Blue", "zen-admin") => "progress-bar-info", __("Green", "zen-admin") => "progress-bar-success", __("Orange", "zen-admin") => "progress-bar-warning", __("Red/Pink", "zen-admin") => "progress-bar-danger"),
        "description" => __("Select bar background color.", "zen-admin"),
        "admin_label" => true
    );
    vc_add_param('vc_progress_bar', $attr);

    // vc_row
    $attr = array(
        "type" => "dropdown",
        "heading" => __('Container Style', 'zen-admin'),
        "param_name" => "zen_container_style",
        "value" => array(
            __("None", 'zen-admin') => '',
            __("Default Container", 'zen-admin') => 'container',
            __("Parallax Container", 'zen-admin') => 'parallax',
            __("Slider Feature Container", 'zen-admin') => 'feature-slider'
        ),
        "description" => __("Select the container type - width", "zen-admin"),
    );
    vc_add_param('vc_row', $attr);

    $attr = array(
        "type" => "attach_image",
        "heading" => __('Parallax Background Image', 'zen-admin'),
        "param_name" => "zen_parallax_image",
        "description" => __("Select background image for your parallax background", "zen-admin"),
        "dependency" => Array('element' => "zen_container_style", 'value' => array('parallax'))
    );
    vc_add_param('vc_row', $attr);

    // vc_accordion
    $attr = array(
        "type" => "dropdown",
        "heading" => __('Accordion Style', 'zen-admin'),
        "param_name" => "style",
        "value" => array(
            __("Default Blue", 'zen-admin') => '',
            __("Solid Blue", 'zen-admin') => 'panel-primary',
            __("Default Pink", 'zen-admin') => 'panel-warning',
            __("Solid Pink", 'zen-admin') => 'panel-danger',
            __("Default Green", 'zen-admin') => 'panel-success',
            __("Solid Green", 'zen-admin') => 'panel-info',
            __("Large", 'zen-admin') => 'panel-large'
        ),
        //"description" => __("Select the icon type for the tab.", "zen-admin"),
    );
    vc_add_param('vc_accordion', $attr);


    // vc_tabs && vc_tab
    $attr = array(
        "type" => "dropdown",
        "heading" => __('Tab Icon', 'zen-admin'),
        "param_name" => "style",
        "value" => array(
            __("None", 'zen-admin') => '',
            __("Analyst 01", 'zen-admin') => 'analistic-01',
            __("Analyst 02", 'zen-admin') => 'analistic-02',
            __("Technical", 'zen-admin') => 'tehnical',
            __("Icon 4", 'zen-admin') => 'tab-04',
            __("Icon 5", 'zen-admin') => 'tab-05',
            __("Icon 6", 'zen-admin') => 'tab-06',
            __("Icon 7", 'zen-admin') => 'tab-07',
            __("Icon 8", 'zen-admin') => 'tab-08',
            __("Icon 9", 'zen-admin') => 'tab-09',
            __("Icon 10", 'zen-admin') => 'tab-10',
        ),
        "description" => __("Select the icon type for the tab.", "zen-admin"),
    );
    vc_add_param('vc_tab', $attr);

    $attr = array(
        "type" => "dropdown",
        "heading" => __('Tabs Style', 'zen-admin'),
        "param_name" => "type",
        "value" => array(
            __("Default", 'zen-admin') => '',
            __("With Border", 'zen-admin') => '2',
            __("Colored Tabs", 'zen-admin') => '3',
            __("Colored Text", 'zen-admin') => '4'
        ),
        "description" => __("Select the style for the tabs.", "zen-admin"),
    );
    vc_add_param('vc_tabs', $attr);


    // vc_message
    vc_remove_param('vc_message', 'css_animation');
    vc_remove_param('vc_message', 'color');
    vc_remove_param('vc_message', 'content');
    vc_remove_param('vc_message', 'el_class');

    $attr = array(
        "type" => "dropdown",
        "heading" => __("Message box type", "zen-admin"),
        "param_name" => "color",
        "value" => array(__('Informational', "zen-admin") => "alert-info", __('Warning', "zen-admin") => "alert-warning", __('Success', "zen-admin") => "alert-success", __('Error', "zen-admin") => "alert-danger"),
        "description" => __("Select message type.", "zen-admin")
    );
    vc_add_param('vc_message', $attr);

    $attr = array(
        "type" => "dropdown",
        "heading" => __("Message box style", "zen-admin"),
        "param_name" => "style",
        "value" => array(__('Full', "zen-admin") => "", __('Empty', "zen-admin") => "-empty"),
        "description" => __("Select message style.", "zen-admin")
    );
    vc_add_param('vc_message', $attr);

    $attr = array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "messagebox_text",
        "heading" => __("Message text", "zen-admin"),
        "param_name" => "content",
        "value" => __("I am message box. Click edit button to change this text.", "zen-admin")
    );
    vc_add_param('vc_message', $attr);

    $attr = array(
        "type" => "textfield",
        "heading" => __("Extra class name", "zen-admin"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zen-admin")
    );
    vc_add_param('vc_message', $attr);


    // vc_button
    vc_remove_param('vc_button', 'color');
    vc_remove_param('vc_button', 'icon');
    vc_remove_param('vc_button', 'size');

    $attr = array(
        "type" => "dropdown",
        "heading" => __("Color", "zen-admin"),
        "param_name" => "color",
        "value" => array(__('Default', "zen-admin") => "btn-default", __('Pink', "zen-admin") => "btn-primary", __('Green', "zen-admin") => "btn-success", __('Red', "zen-admin") => "btn-danger", __('Orange', "zen-admin") => "btn-warning"),
        "description" => __("Button color.", "zen-admin")
    );
    vc_add_param('vc_button', $attr);

    $attr = array(
        "type" => "dropdown",
        "heading" => __("Size", "zen-admin"),
        "param_name" => "size",
        "value" => array(__("Regular size", "zen-admin") => "", __("Large", "zen-admin") => "btn-lg", __("Small", "zen-admin") => "btn-sm", __("Mini", "zen-admin") => "btn-xs"),
        "description" => __("Button size.", "zen-admin")
    );
    vc_add_param('vc_button', $attr);


    // vc_cta

    vc_remove_param('vc_cta_button', 'size');
    vc_remove_param('vc_cta_button', 'icon');
    vc_remove_param('vc_cta_button', 'color');
    //vc_remove_param('vc_cta_button', 'position');

    $attr = array(
        "type" => "dropdown",
        "heading" => __("Color", "zen-admin"),
        "param_name" => "color",
        "value" => array(__('Default', "zen-admin") => "jumbotron", __('Pink', "zen-admin") => "jumbotron-primary", __('Green', "zen-admin") => "jumbotron-success", __('Black & Blue', "zen-admin") => "jumbotron-info"),
        "description" => __("Call to action color.", "zen-admin")
    );
    vc_add_param('vc_cta_button', $attr);

    $attr = array(
        "type" => "textfield",
        "heading" => __("Call to action title", "js_composer"),
        "param_name" => "heading",
    );
    vc_add_param('vc_cta_button', $attr);

    /**
     * Testimonials Shortcode Registration
     */
    function vc_zen_testimonials() {
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC'
        );

        $terms = get_terms('zen_testimonials_cat', $args);
        $testimonials_categories = array();

        foreach( $terms as $term ) {
            $testimonials_categories[$term->name] = $term->term_id;
        }

        vc_map( array(
            "name" => __('Testimonials', 'zen-admin'),
            "base" => "zen_testimonials",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
            //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Testimonials Type', 'zen-admin'),
                    "param_name" => "type",
                    "value" => array(
                        __("Default", 'zen-admin') => '',
                        __("Avatar left - Arrows right", 'zen-admin') => '1',
                        __('Tabs Style', 'zen-admin') => '2'
                    ),
                    "description" => __("Select what type of testimonials you want to display.", "zen-admin")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Testimonials Category', 'zen-admin'),
                    "param_name" => "category",
                    "value" => $testimonials_categories,
                    "description" => __("Select the category of testimonials you want to display.", "zen-admin")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Max Items', 'zen-admin'),
                    "param_name" => "max_items",
                    "description" => __("Number. How many testimonials you want to show, from the category. ", "zen-admin")
                ),
            )
        ) );
    }
    vc_zen_testimonials();

    /**
     * Boxes Shortcode Registration
     */
    function vc_zen_boxes() {

        vc_map( array(
            "name" => __('Zen Boxes', 'zen-admin'),
            "base" => "zen_box",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Box Type', 'zen-admin'),
                    "param_name" => "type",
                    "value" => array(
                        __("Default", 'zen-admin') => 'center-feature',
                        __("Left Icon", 'zen-admin') => '',
                        __("Left Above Icon", 'zen-admin') => 'left-feature'
                    ),
                    "description" => __("Select what type of box you want to display.", "zen-admin")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Icon', 'zen-admin'),
                    "param_name" => "icon",
                    "description" => __("The icon class you want to use. Choose from here : http://docs.stylishthemes.co/zen7wp/icons/ ", "zen-admin")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Head-text', 'zen-admin'),
                    "param_name" => "heading",
                    "description" => __("The box title. ", "zen-admin")
                ),
                array(
                    "type" => "textarea",
                    "heading" => __('Description', 'zen-admin'),
                    "param_name" => "text",
                    "description" => __("Some description of the feature. ", "zen-admin")
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Icon Border Color", "zen-admin"),
                    "param_name" => "border_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Icon Color", "zen-admin"),
                    "param_name" => "icon_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Icon Background Color", "zen-admin"),
                    "param_name" => "box_bg_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Heading Color", "zen-admin"),
                    "param_name" => "head_color"
                ),
            )
        )
        );
    }
    vc_zen_boxes();

    /**
     * Tables Shortcode Registration
     */
    function vc_zen_tables() {

        vc_map( array(
                "name" => __('Zen Tables', 'zen-admin'),
                "base" => "zen_table",
                "class" => "",
                "category" => __('By Stylish Themes', 'zen-admin'),
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => __('Table Type', 'zen-admin'),
                        "param_name" => "type",
                        "value" => array(
                            __("Default", 'zen-admin') => '',
                            __("With Color Border", 'zen-admin') => 'blue-table',
                            __("With Background", 'zen-admin') => 'light-grey-table'
                        ),
                        "description" => __("Select what type of table you want to display.", "zen-admin")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __('Head-text/Title', 'zen-admin'),
                        "param_name" => "heading",
                        "description" => __("The Table heading/title. ", "zen-admin")
                    ),
                    array(
                        "type" => "textarea_html",
                        "holder" => "div",
                        "heading" => __('Features List', 'zen-admin'),
                        "param_name" => "content",
                        "description" => __("Use a simple list to display features of the table/plan. ", "zen-admin"),
                        "value" => __("<ul><li>First Feature</li></ul>", "zen-admin")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __('Price', 'zen-admin'),
                        "param_name" => "price",
                        "description" => __("Number. The table price. ", "zen-admin")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __('Currency', 'zen-admin'),
                        "param_name" => "currency",
                        "description" => __("Sign. The table currency. ", "zen-admin")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __('Divider', 'zen-admin'),
                        "param_name" => "divider",
                        "description" => __("What table duration is (for example /m - per month). ", "zen-admin"),
                        "default" => '/m'
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __('Button Text', 'zen-admin'),
                        "param_name" => "button_text",
                        "description" => __("The button text. ", "zen-admin")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __('Button URL', 'zen-admin'),
                        "param_name" => "button_url",
                        "description" => __("The button url. ", "zen-admin")
                    ),
                )
            )
        );
    }
    vc_zen_tables();


    /**
     * Gallery Shortcode Registration
     */
    function vc_zen_gallery() {

        vc_map( array(
                "name" => __('Gallery/Slideshow', 'zen-admin'),
                "base" => "gallery",
                "class" => "",
                "icon" => "icon-wpb-images-stack",
                "category" => __('By Stylish Themes', 'zen-admin'),
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => __('Table Type', 'zen-admin'),
                        "param_name" => "style",
                        "value" => array(
                            __("Default", 'zen-admin') => '',
                            __("Slideshow", 'zen-admin') => 'slideshow'
                        ),
                        "description" => __("Select what type of gallery you want to display.", "zen-admin")
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __('Columns', 'zen-admin'),
                        "param_name" => "columns",
                        "value" => array(
                            __("1", 'zen-admin') => '1',
                            __("2", 'zen-admin') => '2',
                            __("3", 'zen-admin') => '3',
                            __("4", 'zen-admin') => '4',
                            __("5", 'zen-admin') => '5',
                            __("6", 'zen-admin') => '6',
                        )
                    ),
                    array(
                        "type" => "attach_images",
                        "heading" => __("Images", "zen-admin"),
                        "param_name" => "ids",
                        "value" => ""
                    ),
                )
            )
        );
    }
    vc_zen_gallery();

    /**
     * Team Shortcode Registration
     */
    function vc_zen_team() {
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC'
        );

        $terms = get_terms('teams', $args);
        $teams_categories = array();

        foreach( $terms as $term ) {
            $teams_categories[$term->name] = $term->term_id;
        }

        vc_map( array(
            "name" => __('Team', 'zen-admin'),
            "base" => "zen_team",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
            //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Team Type', 'zen-admin'),
                    "param_name" => "type",
                    "value" => array(
                        __("Default", 'zen-admin') => '',
                        __("Hover details", 'zen-admin') => '1'
                    ),
                    "description" => __("Select what type of team you want to display.", "zen-admin")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Team Name', 'zen-admin'),
                    "param_name" => "category",
                    "value" => $teams_categories,
                    "description" => __("Select the category of testimonials you want to display.", "zen-admin")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Number of employees', 'zen-admin'),
                    "param_name" => "items",
                    "description" => __("Number. How many employees you want to show, from the category. ", "zen-admin")
                ),
            )
        ) );
    }
    vc_zen_team();

    /**
     * Team Shortcode Registration
     */
    function vc_zen_employee() {
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC',
            'post_type'     => 'zen_employee'
        );

        $terms = get_posts($args);
        $teams_categories = array();

        foreach( $terms as $term ) {
            $teams_categories[$term->post_title] = $term->ID;
        }

        vc_map( array(
            "name" => __('Employee', 'zen-admin'),
            "base" => "zen_employee",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
            //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Team Type', 'zen-admin'),
                    "param_name" => "type",
                    "value" => array(
                        __("Default", 'zen-admin') => '',
                        __("Hover details", 'zen-admin') => '1'
                    ),
                    "description" => __("Select what type of team you want to display.", "zen-admin")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Employee', 'zen-admin'),
                    "param_name" => "id",
                    "value" => $teams_categories,
                    "description" => __("Select the category of testimonials you want to display.", "zen-admin")
                )
            )
        ) );
    }
    vc_zen_employee();


    /**
     * Blog Shortcode Registration
     */
    function vc_zen_blog() {
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC'
        );

        $terms = get_terms('category', $args);
        $teams_categories = array();

        foreach( $terms as $term ) {
            $teams_categories[$term->name] = $term->term_id;
        }

        $args = array(
            'who'   => 'authors'
        );
        $authors = get_users($args);
        $blog_authors = array();

        foreach( $authors as $author ) {
            $blog_authors[$author->user_login] = $author->ID;
        }

        vc_map( array(
            "name" => __('Blog', 'zen-admin'),
            "base" => "zen_blog",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
            //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Blog Type', 'zen-admin'),
                    "param_name" => "type",
                    "value" => array(
                        __("Blog Style 1", 'zen-admin') => '1',
                        __("Blog Style 2", 'zen-admin') => '2',
                        __("Blog Style 3", 'zen-admin') => '3'
                    ),
                    "description" => __("Select what type of blog you want to display.", "zen-admin")
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Categories', 'zen-admin'),
                    "param_name" => "category",
                    "value" => $teams_categories
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Authors', 'zen-admin'),
                    "param_name" => "author",
                    "value" => $blog_authors
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Number of posts/page', 'zen-admin'),
                    "param_name" => "posts_per_page",
                    "description" => __("Number. How many posts you want to show, on this blog. ", "zen-admin")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order By', 'zen-admin'),
                    "param_name" => "orderby",
                    "value" => array(
                        __("Date", 'zen-admin') => 'date',
                        __("Name", 'zen-admin') => 'name',
                        __("Author", 'zen-admin') => 'author',
                        __("ID", 'zen-admin') => 'ID',
                        __("Random", 'zen-admin') => 'rand',
                        __("Title", 'zen-admin') => 'title'
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order', 'zen-admin'),
                    "param_name" => "order",
                    "value" => array(
                        __("DESC", 'zen-admin') => 'DESC',
                        __("ASC", 'zen-admin') => 'ASC'
                    )
                ),
            )
        ) );
    }
    vc_zen_blog();

    /**
     * Blog Masonry Shortcode Registration
     */
    function vc_zen_masonry() {
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC'
        );

        $terms = get_terms('category', $args);
        $teams_categories = array();

        foreach( $terms as $term ) {
            $teams_categories[$term->name] = $term->term_id;
        }

        $args = array(
            'who'   => 'authors'
        );
        $authors = get_users($args);
        $blog_authors = array();

        foreach( $authors as $author ) {
            $blog_authors[$author->user_login] = $author->ID;
        }

        vc_map( array(
            "name" => __('Blog Masonry', 'zen-admin'),
            "base" => "zen_blog_masonry",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
            //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
            "params" => array(
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Categories', 'zen-admin'),
                    "param_name" => "category",
                    "value" => $teams_categories
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Authors', 'zen-admin'),
                    "param_name" => "author",
                    "value" => $blog_authors
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Number of posts/page', 'zen-admin'),
                    "param_name" => "posts_per_page",
                    "description" => __("Number. How many posts you want to show, on this blog. ", "zen-admin")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order By', 'zen-admin'),
                    "param_name" => "orderby",
                    "value" => array(
                        __("Date", 'zen-admin') => 'date',
                        __("Name", 'zen-admin') => 'name',
                        __("Author", 'zen-admin') => 'author',
                        __("ID", 'zen-admin') => 'ID',
                        __("Random", 'zen-admin') => 'rand',
                        __("Title", 'zen-admin') => 'title'
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order', 'zen-admin'),
                    "param_name" => "order",
                    "value" => array(
                        __("DESC", 'zen-admin') => 'DESC',
                        __("ASC", 'zen-admin') => 'ASC'
                    )
                ),
            )
        ) );
    }
    vc_zen_masonry();

    /**
     * Blog Masonry Shortcode Registration
     */
    function vc_zen_portfolio() {
        $args = array(
            'orderby'       => 'name',
            'order'         => 'ASC'
        );

        $terms = get_terms('zen_port_cat', $args);
        $teams_categories = array();

        foreach( $terms as $term ) {
            $teams_categories[$term->name] = $term->term_id;
        }

        $args = array(
            'who'   => 'authors'
        );
        $authors = get_users($args);
        $blog_authors = array();

        foreach( $authors as $author ) {
            $blog_authors[$author->user_login] = $author->ID;
        }

        vc_map( array(
            "name" => __('Portfolio', 'zen-admin'),
            "base" => "zen_portfolio",
            "class" => "",
            "category" => __('By Stylish Themes', 'zen-admin'),
            //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
            //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __('Blog Type', 'zen-admin'),
                    "param_name" => "type",
                    "value" => array(
                        __("Portfolio Style 1", 'zen-admin') => '1',
                        __("Portfolio Style 2", 'zen-admin') => '2',
                        __("Portfolio Style 3", 'zen-admin') => '3'
                    ),
                    "description" => __("Select what type of portfolio you want to display.", "zen-admin")
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Categories', 'zen-admin'),
                    "param_name" => "category",
                    "value" => $teams_categories
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __('Select Authors', 'zen-admin'),
                    "param_name" => "author",
                    "value" => $blog_authors
                ),
                array(
                    "type" => "textfield",
                    "heading" => __('Number of posts/page', 'zen-admin'),
                    "param_name" => "posts_per_page",
                    "description" => __("Number. How many posts you want to show, on this portfolio. ", "zen-admin")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order By', 'zen-admin'),
                    "param_name" => "orderby",
                    "value" => array(
                        __("Date", 'zen-admin') => 'date',
                        __("Name", 'zen-admin') => 'name',
                        __("Author", 'zen-admin') => 'author',
                        __("ID", 'zen-admin') => 'ID',
                        __("Random", 'zen-admin') => 'rand',
                        __("Title", 'zen-admin') => 'title'
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __('Order', 'zen-admin'),
                    "param_name" => "order",
                    "value" => array(
                        __("DESC", 'zen-admin') => 'DESC',
                        __("ASC", 'zen-admin') => 'ASC'
                    )
                ),
            )
        ) );
    }
    vc_zen_portfolio();

endif;