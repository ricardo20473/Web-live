<?php
if (!function_exists('redux_init')) :
	function redux_init() {
	/**
		ReduxFramework Sample Config File
		For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
	**/


	/**
	 
		Most of your editing will be done in this section.

		Here you can override default values, uncomment args and change their values.
		No $args are required, but they can be overridden if needed.
		
	**/
	$args = array();


	// For use with a tab example below
	$tabs = array();

	ob_start();

	$ct = wp_get_theme();
	$theme_data = $ct;
	$item_name = $theme_data->get('Name'); 
	$tags = $ct->Tags;
	$screenshot = $ct->get_screenshot();
	$class = $screenshot ? 'has-screenshot' : '';

	$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','redux-framework-demo' ), $ct->display('Name') );

	?>
	<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
		<?php if ( $screenshot ) : ?>
			<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
			<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
				<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
			</a>
			<?php endif; ?>
			<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
		<?php endif; ?>

		<h4>
			<?php echo $ct->display('Name'); ?>
		</h4>

		<div>
			<ul class="theme-info">
				<li><?php printf( __('By %s','redux-framework-demo'), $ct->display('Author') ); ?></li>
				<li><?php printf( __('Version %s','redux-framework-demo'), $ct->display('Version') ); ?></li>
				<li><?php echo '<strong>'.__('Tags', 'redux-framework-demo').':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
			</ul>
			<p class="theme-description"><?php echo $ct->display('Description'); ?></p>
			<?php if ( $ct->parent() ) {
				printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
					__( 'http://codex.wordpress.org/Child_Themes','redux-framework-demo' ),
					$ct->parent()->display( 'Name' ) );
			} ?>
			
		</div>

	</div>

	<?php
	$item_info = ob_get_contents();
	    
	ob_end_clean();

	$sampleHTML = '';
	if( file_exists( dirname(__FILE__).'/info-html.html' )) {
		/** @global WP_Filesystem_Direct $wp_filesystem  */
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once(ABSPATH .'/wp-admin/includes/file.php');
			WP_Filesystem();
		}  		
		$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
	}

	// BEGIN Sample Config

	// Setting dev mode to true allows you to view the class settings/info in the panel.
	// Default: true
	$args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['dev_mode_icon_class'] = '';

	// Set a custom option name. Don't forget to replace spaces with underscores!
	$args['opt_name'] = 'zen7_data';

	// Setting system info to true allows you to view info useful for debugging.
	// Default: false
	//$args['system_info'] = true;


	// Set the icon for the system info tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['system_info_icon'] = 'info-sign';

	// Set the class for the system info tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['system_info_icon_class'] = 'icon-large';

	$theme = wp_get_theme();

	$args['display_name'] = $theme->get('Name');
	//$args['database'] = "theme_mods_expanded";
	$args['display_version'] = $theme->get('Version');

	// If you want to use Google Webfonts, you MUST define the api key.
	$args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

	// Define the starting tab for the option panel.
	// Default: '0';
	//$args['last_tab'] = '0';

	// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
	// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
	// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
	// Default: 'standard'
	//$args['admin_stylesheet'] = 'standard';

	// Setup custom links in the footer for share icons
	$args['share_icons']['twitter'] = array(
	    'link' => 'http://twitter.com/ghost1227',
	    'title' => 'Follow me on Twitter', 
	    'img' => ReduxFramework::$_url . 'assets/img/social/Twitter.png'
	);
	$args['share_icons']['linked_in'] = array(
	    'link' => 'http://www.linkedin.com/profile/view?id=52559281',
	    'title' => 'Find me on LinkedIn', 
	    'img' => ReduxFramework::$_url . 'assets/img/social/LinkedIn.png'
	);

	// Enable the import/export feature.
	// Default: true
	//$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	//$args['import_icon_class'] = '';

	/**
	 * Set default icon class for all sections and tabs
	 * @since 3.0.9
	 */
	//$args['default_icon_class'] = '';


	// Set a custom menu icon.
	//$args['menu_icon'] = '';

	// Set a custom title for the options page.
	// Default: Options
	$args['menu_title'] = __('Zen7 Options', 'redux-framework-demo');

	// Set a custom page title for the options page.
	// Default: Options
	$args['page_title'] = __('Options', 'redux-framework-demo');

	// Set a custom page slug for options page (wp-admin/themes.php?page=***).
	// Default: redux_optionsF
	$args['page_slug'] = 'redux_options';

	$args['default_show'] = true;
	$args['default_mark'] = '*';

	// Set a custom page capability.
	// Default: manage_options
	//$args['page_cap'] = 'manage_options';

	// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
	// Default: menu
	//$args['page_type'] = 'submenu';

	// Set the parent menu.
	// Default: themes.php
	// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$args['page_parent'] = 'options-general.php';

	// Set a custom page location. This allows you to place your menu where you want in the menu order.
	// Must be unique or it will override other items!
	// Default: null
	//$args['page_position'] = null;

	// Set a custom page icon class (used to override the page icon next to heading)
	//$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Elusive Icon, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';

	// Disable the panel sections showing as submenu items.
	// Default: true
	//$args['allow_sub_menu'] = false;
	    
	// Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
	$args['help_tabs'][] = array(
	    'id' => 'general-help',
	    'title' => __('General', 'zen-admin'),
	    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'zen-admin')
	);

	// Set the help sidebar for the options page.                                        
	$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'zen-admin');


	// Add HTML before the form.
//	if (!isset($args['global_variable']) || $args['global_variable'] !== false ) {
//		if (!empty($args['global_variable'])) {
//			$v = $args['global_variable'];
//		} else {
//			$v = str_replace("-", "_", $args['opt_name']);
//		}
//		$args['intro_text'] = sprintf( __('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
//	} else {
//		$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
//	}

	// Add content after the form.
	//$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');

	// Set footer/credit line.
	//$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', 'redux-framework-demo');


	$sections = array();              

	//Background Patterns Reader
	$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
	$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
	$sample_patterns      = array();

	if ( is_dir( $sample_patterns_path ) ) :
		
	  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
	  	$sample_patterns = array();

	    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

	      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
	      	$name = explode(".", $sample_patterns_file);
	      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
	      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
	      }
	    }
	  endif;
	endif;

        $sections[] = array(
            'type' => 'divide',
        );


    // Here starts the ZEN7 options

        $sections[] = array(
            'title' => __('General', 'zen7-admin'),
            'icon' => 'el-icon-cogs',

            'fields' => array(
                array(
                    'id'=>'zen_logo',
                    'type' => 'media',
                    'url'=> true,
                    'title' => __('Logo', 'zen-admin'),
                    'compiler' => 'true',
                    //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                    'desc'=> __('Upload here your website logo.', 'redux-framework-demo'),
                    //'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                    'default'=>array('url'=>'http://stylishthemes.co/zen7/assets/img/header/logo.png'),
                ),
                array(
                    'id'=>'zen_pag_style',
                    'type' => 'button_set',
                    'title' => __('Pagination Style', 'zen-admin'),
                    'desc' => __('Choose the pagination style Zen Master will use for your website :).', 'zen-admin'),
                    'options' => array('1' => 'Numbers','2' => 'Next/Prev'),//Must provide key => value pairs for radio options
                    'default' => '1'
                ),
                array(
                    'id'=>'zen_share',
                    'type' => 'switch',
                    'title' => __('Zen7 Social Sharing', 'zen-admin'),
                    "default" => 1,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),
                array(
                    'id'=>'zen_404_style',
                    'type' => 'button_set',
                    'title' => __('404 Style', 'zen-admin'),
                    'desc' => __('Choose the default 404 page style that Zen Master will use for your website :).', 'zen-admin'),
                    'options' => array('1' => 'Default','2' => 'Colored Background'),//Must provide key => value pairs for radio options
                    'default' => '1'
                ),
                array(
                    'id'=>'zen_tracking_code',
                    'type' => 'textarea',
                    'title' => __('Tracking Code', 'redux-framework-demo'),
                    'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'redux-framework-demo'),
                    //'validate' => 'js',
                    'desc' => 'Validate that it\'s javascript!',
                ),
                array(
                    'id'=>'zen_css_code',
                    'type' => 'ace_editor',
                    'title' => __('CSS Code', 'zen-admin'),
                    'subtitle' => __('Paste your CSS code here.', 'zen-admin'),
                    'mode' => 'css',
                    'theme' => 'monokai',
                    'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                    'default' => "#header{\nmargin: 0 auto;\n}"
                ),
            ),
        );

        $sections[] = array(
            'title' => __('Layout', 'zen7-admin'),
            'icon' => 'el-icon-eye-open',

            'fields' => array(
                array(
                    'id'=>'zen_layout',
                    'type' => 'image_select',
                    'compiler'=>true,
                    'title' => __('Main Layout', 'redux-framework-demo'),
                    'options' => array(
                        '1' => array('alt' => 'Wide', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                        '2' => array('alt' => 'Boxed', 'img' => ReduxFramework::$_url.'assets/img/3cm.png')
                    ),
                    'default' => '1',
                    'desc' => __('Select the theme layout that will be used for all website.', 'zen-admin')
                ),

                array(
                    'id'        => 'zen_bg_image_option',
                    'type'      => 'select_image',
                    'title'     => __('Select Background Pattern', 'zen-admin'),
                    'subtitle'  => __('You can either select one custom background from the right dropdown, or upload a new background pattern below.', 'zen-admin'),
                    //'options'   => $sample_patterns,
                    // Alternatively
                    'options' => array(
                                     //'img_name' => 'img_path'
                                    array( 'alt'=> '1','img' => IMAGES . '/boxed/1/1.jpg' ),
                                    array( 'alt'=> '2','img' => IMAGES . '/boxed/2/2.jpg' ),
                                    array( 'alt'=> '3','img' => IMAGES . '/boxed/3/3.jpg' ),
                                    array( 'alt'=> '4','img' => IMAGES . '/boxed/4/4.jpg' ),
                                    array( 'alt'=> '5','img' => IMAGES . '/boxed/5/5.jpg' ),
                                    array( 'alt'=> '6','img' => IMAGES . '/boxed/6/6.jpg' ),
                                    array( 'alt'=> '7','img' => IMAGES . '/boxed/7/7.jpg' ),
                                    array( 'alt'=> '8','img' => IMAGES . '/boxed/8/8.jpg' ),
                                    array( 'alt'=> '9','img' => IMAGES . '/boxed/9/9.jpg' ),
                                    array( 'alt'=> '10','img' => IMAGES . '/boxed/10/10.jpg' ),
                                    array( 'alt'=> '11','img' => IMAGES . '/boxed/11/11.jpg' ),
                                    array( 'alt'=> '12','img' => IMAGES . '/boxed/12/12.jpg' ),
                                 ),
                    'default'   => '7.jpg',
                ),

                array(
                    'id'=>'zen_bg_image',
                    'type' => 'media',
                    'url'=> true,
                    'title' => __('Background Image', 'zen-admin'),
                    'compiler' => 'true',
                    'desc'=> __('Upload here your website background image, if you have the boxed layout selected.', 'redux-framework-demo'),
                    //'default'=>array('url'=>'http://stylishthemes.co/zen7/assets/img/boxed/7/7.jpg'),
                ),

                array(
                    'id'=>'zen_scrollbar_type',
                    'type' => 'radio',
                    'title' => __('Scrollbar Type', 'zen-admin'),
                    'options' => array('1' => 'Fancy NiceScroll', '2' => 'Browser Default'),//Must provide key => value pairs for radio options
                    'default' => '1'
                ),
            ),
        );

        $sections[] = array(
            'title' => __('Header', 'zen7-admin'),
            'icon' => 'el-icon-website',

            'fields' => array(
                array(
                    'id'=>'zen_header_type',
                    'type' => 'radio',
                    'title' => __('Header Type', 'zen-admin'),
                    'desc' => __('Select your wanted header type. You can select one header for all pages.', 'zen-admin'),
                    'options' => array('1' => 'Default', '2' => 'Style 2', '3' => 'Style 3', '4' => 'Style 4', '5' => 'Style 5'),//Must provide key => value pairs for radio options
                    'default' => '1'
                ),
                array(
                    'id'=>'zen_header_address',
                    'type' => 'text',
                    'title' => __('Header Address', 'zen-admin'),
                    'default' => '129, Brod Way, Los Santos'
                ),
                array(
                    'id'=>'zen_header_tel',
                    'type' => 'text',
                    'title' => __('Header Telephone Number', 'zen-admin'),
                    'default' => '+45 558 597'
                ),
                array(
                    'id'=>'zen_header_search',
                    'type' => 'switch',
                    'title' => __('Search-box on header', 'zen-admin'),
                    "default" 		=> 1,
                ),
            ),
        );

        $sections[] = array(
            'title' => __('Footer', 'zen7-admin'),
            'icon' => 'el-icon-website',

            'fields' => array(
                array(
                    'id'=>'zen_footer_widget',
                    'type' => 'switch',
                    'title' => __('Footer Website Info Widget', 'zen-admin'),
                    "default" => 1,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),
                array(
                    'id'=>'zen_footer_widget_text',
                    'type' => 'editor',
                    'title' => __('Website Info Widget Text', 'zen-admin'),
                ),
                array(
                    'id'=>'zen_footer_copy',
                    'type' => 'editor',
                    'title' => __('Website Footer Copyright', 'zen-admin'),
                    'default' => '© Copyright Zen7 2013',
                ),
            ),
        );

        $sections[] = array(
            'title' => __('Portfolio', 'zen7-admin'),
            'icon' => 'el-icon-list-alt',

            'fields' => array(
                array(
                    'id'=>'zen_portfolio_page',
                    'type' => 'select',
                    'data' => 'pages',
                    'title' => __('Portfolio Main Page', 'zen-admin'),
                    'desc' => __('Select the portfolio page, where you display all portfolios.', 'zen-admin'),
                ),
            ),
        );

        $sections[] = array(
            'title' => __('Social Integration', 'zen7-admin'),
            'icon' => 'el-icon-check',

            'fields' => array(
                array(
                    'id'=>'zen_social_icons',
                    'type' => 'editor',
                    'title' => __('Add/Remove Social Icons', 'zen-admin'),
                    'default' => '<ul><li>[zen_header_icon type="facebook" name="Facebook" url="#" tooltip_position="top"]</li><li>[zen_header_icon type="twitter" name="Twitter" url="#" tooltip_position="top"]</li><li>[zen_header_icon type="g-plus" name="Google+" url="#" tooltip_position="top"]</li><li>[zen_header_icon type="pinterest" name="Pinterest" url="#" tooltip_position="top"]</li></ul>',
                ),
            ),
        );

        $sections[] = array(
            'icon' => 'el-icon-home',
            'title' => __('Contact Options', 'zen-admin'),
            'fields' => array(
                array(
                    'id'=>'contact-email',
                    'type' => 'text',
                    'title' => __('Contact Email', 'zen-admin'),
                    'subtitle' => __('This is the e-mail address that it will be used in the contact page. ', 'zen-admin'),
                    'desc' => __('', 'zen-admin'),
                    'validate' => 'email',
                    'msg' => 'This is not an email address.',
                    'default' => 'youremail@yourdomain.com'
                ),

                array(
                    'id'=>'contact-address',
                    'type' => 'text',
                    'title' => __('Contact Address', 'zen-admin'),
                    'subtitle' => __('This is the address that it will be used in the contact page. ', 'zen-admin'),
                    'desc' => __('', 'zen-admin'),
                    'msg' => 'This is not an email address.',
                )

            )
        );

    // THE END
			
			

	if (function_exists('wp_get_theme')){
	$theme_data = wp_get_theme();
	$theme_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$version = $theme_data->get('Version');
	$tags = $theme_data->get('Tags');
	}else{
	$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
	$theme_uri = $theme_data['URI'];
	$description = $theme_data['Description'];
	$author = $theme_data['Author'];
	$version = $theme_data['Version'];
	$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="redux-framework-section-desc">';
	$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'redux-framework-demo').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'redux-framework-demo').$author.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'redux-framework-demo').$version.'</p>';
	$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$description.'</p>';
	if ( !empty( $tags ) ) {
		$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'redux-framework-demo').implode(', ', $tags).'</p>';	
	}
	$theme_info .= '</div>';

	if(file_exists(dirname(__FILE__).'/README.md')){
	$sections['theme_docs'] = array(
				'icon' => ReduxFramework::$_url.'assets/img/glyphicons/glyphicons_071_book.png',
				'title' => __('Documentation', 'redux-framework-demo'),
				'fields' => array(
					array(
						'id'=>'17',
						'type' => 'raw',
						'content' => file_get_contents(dirname(__FILE__).'/README.md')
						),				
				),
				
				);
	}//if

	$sections[] = array(
		'type' => 'divide',
	);

	$sections[] = array(
		'icon' => 'el-icon-info-sign',
		'title' => __('Theme Information', 'redux-framework-demo'),
		'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
		'fields' => array(
			array(
				'id'=>'raw_new_info',
				'type' => 'raw',
				'content' => $item_info,
				)
			),   
		);


	if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
	    $tabs['docs'] = array(
			'icon' => 'el-icon-book',
			    'title' => __('Documentation', 'redux-framework-demo'),
	        'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
	    );
	}

	global $ReduxFramework;
	$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

	// END Sample Config
	}
	add_action('init', 'redux_init');
endif;

/**
 
 	Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 	Simply include this function in the child themes functions.php file.
 
 	NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 	so you must use get_template_directory_uri() if you want to use any of the built in icons
 
 **/
if ( !function_exists( 'redux_add_another_section' ) ):
	function redux_add_another_section($sections){
	    //$sections = array();
//	    $sections[] = array(
//	        'title' => __('Section via hook', 'redux-framework-demo'),
//	        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
//			'icon' => 'el-icon-paper-clip',
//			    // Leave this as a blank section, no options just some intro text set above.
//	        'fields' => array()
//	    );

	    return $sections;
	}
	add_filter('redux/options/zen7_data/sections', 'redux_add_another_section');
	// replace redux_demo with your opt_name
endif;
/**

	Filter hook for filtering the args array given by a theme, good for child themes to override or add to the args array.

**/
if ( !function_exists( 'redux_change_framework_args' ) ):
	function redux_change_framework_args($args){
	    //$args['dev_mode'] = true;
	    
	    return $args;
	}
	add_filter('redux/options/zen7_data/args', 'redux_change_framework_args');
	// replace redux_demo with your opt_name
endif;
/**

	Filter hook for filtering the default value of any given field. Very useful in development mode.

**/
if ( !function_exists( 'redux_change_option_defaults' ) ):
	function redux_change_option_defaults($defaults){
	    $defaults['str_replace'] = "Testing filter hook!";
	    
	    return $defaults;
	}
	add_filter('redux/options/zen7_data/defaults', 'redux_change_option_defaults');
	// replace redux_demo with your opt_name
endif;

/** 

	Custom function for the callback referenced above

 */
if ( !function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field($field, $value) {
	    print_r($field);
	    print_r($value);
	}
endif;

/**
 
	Custom function for the callback validation referenced above

**/
if ( !function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function($field, $value, $existing_value) {
	    $error = false;
	    $value =  'just testing';
	    /*
	    do your validation
	    
	    if(something) {
	        $value = $value;
	    } elseif(something else) {
	        $error = true;
	        $value = $existing_value;
	        $field['msg'] = 'your custom error message';
	    }
	    */
	    
	    $return['value'] = $value;
	    if($error == true) {
	        $return['error'] = $field;
	    }
	    return $return;
	}
endif;
/**

	This is a test function that will let you see when the compiler hook occurs. 
	It only runs if a field	set with compiler=>true is changed.

**/
if ( !function_exists( 'redux_test_compiler' ) ):
	function redux_test_compiler($options, $css) {
		echo "<h1>The compiler hook has run!";
		//print_r($options); //Option values
		print_r($css); //So you can compile the CSS within your own file to cache
	    $filename = dirname(__FILE__) . '/avada' . '.css';

			    global $wp_filesystem;
			    if( empty( $wp_filesystem ) ) {
			        require_once( ABSPATH .'/wp-admin/includes/file.php' );
			        WP_Filesystem();
			    }

			    if( $wp_filesystem ) {
			        $wp_filesystem->put_contents(
			            $filename,
			            $css,
			            FS_CHMOD_FILE // predefined mode settings for WP files
			        );
			    }

	}
	//add_filter('redux/options/redux_demo/compiler', 'redux_test_compiler', 10, 2);
	// replace redux_demo with your opt_name
endif;


/**

	Remove all things related to the Redux Demo mode.

**/
if ( !function_exists( 'redux_remove_demo_options' ) ):
	function redux_remove_demo_options() {
		
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
		}

		// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

	}
	//add_action( 'redux/plugin/hooks', 'redux_remove_demo_options' );	
endif;