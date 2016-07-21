<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function ifc_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function ifc_nav2()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'sidebar-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => ' <span>|</span>',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function ifc_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.6.2'); // Waypoints
        wp_enqueue_script('waypoints'); // Enqueue it!

        //wp_register_script('parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), '1.3.1'); // Parallax
        //wp_enqueue_script('parallax'); // Enqueue it!
        
        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function ifc_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function ifc_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'ifc_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'ifc_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'ifc_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_support'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_support()
{
    register_taxonomy_for_object_type('category', 'support-tabs'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'support-tabs');
    register_post_type('support-tabs', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Support Tabs', 'html5blank'), // Rename these to suit
            'singular_name' => __('Support Tab', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Support Tab', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Support Tab', 'html5blank'),
            'new_item' => __('New Support Tab', 'html5blank'),
            'view' => __('View Support Tab', 'html5blank'),
            'view_item' => __('View Support Tab', 'html5blank'),
            'search_items' => __('Search Support Tabs', 'html5blank'),
            'not_found' => __('No Support Tabs found', 'html5blank'),
            'not_found_in_trash' => __('No Support Tabs found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}


// Theme Options settings
//add_menu_page( 'Touchpoint Theme Options', 'Theme Options', 'manage_options', 'tp_theme_options.php', 'tp_theme_page');

/**
 * Theme Option Page Example
 */
function tp_theme_menu()
{
  add_menu_page( 'iTee Theme Option', 'Theme Options', 'manage_options', 'tp_theme_options.php', 'tp_theme_page');  
}
add_action('admin_menu', 'tp_theme_menu');

/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */ 
function tp_theme_page()
{
?>
    <div class="section panel">
      <h1>iTee Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php 
          settings_fields('tp_theme_options'); 
        
          do_settings_sections('tp_theme_options.php');
        ?>
            <p class="submit">  
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
            </p>  
            
      </form>
      
      <p>Created by <a href="http://www.ianfarrellcreative.com" target="_blank">Ian Farrell Creative</a>.</p>
    </div>
    <?php
}

/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'tp_register_settings' );

/**
 * Function to register the settings
 */
function tp_register_settings()
{
    // Register the settings with Validation callback
    register_setting( 'tp_theme_options', 'tp_theme_options', 'tp_validate_settings' );

	// Add settings section
    add_settings_section( 'tp_settings_section', 'General Site Settings', 'tp_display_section', 'tp_theme_options.php' );

    // Create textbox field
    $settings_args1 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_phoneNumber',
      'name'      => 'tp_textbox_phoneNumber',
      'desc'      => 'Enter phone number',
      'std'       => '',
      'label_for' => 'tp_textbox_phoneNumber',
      'class'     => 'css_class'
    );
    
    $settings_args2 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_mapIframe',
      'name'      => 'tp_textbox_mapIframe',
      'desc'      => 'Enter google map iframe code',
      'std'       => '',
      'label_for' => 'tp_textbox_mapIframe',
      'class'     => 'css_class'
    );
    
    $settings_args3 = array(
      'type'      => 'text',
      'id'        => 'tp_generic_image',
      'name'      => 'tp_generic_image',
      'desc'      => 'Grab the URL of the generic site header from the media library and paste it in here.',
      'std'       => '',
      'label_for' => 'tp_generic_image',
      'class'     => 'css_class'
    );

    add_settings_field( 'settings_videoTitle_textbox', 'Message & phone number:', 'tp_display_setting', 'tp_theme_options.php', 'tp_settings_section', $settings_args1 );
    add_settings_field( 'settings_mapIframe_textbox', 'Map iframe embed code:', 'tp_display_setting', 'tp_theme_options.php', 'tp_settings_section', $settings_args2 );
     add_settings_field( 'settings_generic_header', 'Generic Page Header:', 'tp_display_setting', 'tp_theme_options.php', 'tp_settings_section', $settings_args3 );
    
    
    




    // Add settings section
    add_settings_section( 'tp_team_section', 'Home Page', 'tp_display_section', 'tp_theme_options.php' );

    // Create textbox field
    $team_args1 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_topTitle',
      'name'      => 'tp_textbox_topTitle',
      'desc'      => 'Enter the title for the top of the home page',
      'std'       => '',
      'label_for' => 'tp_textbox_topTitle',
      'class'     => 'css_class'
    );
    
    $team_args2 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_topCopy',
      'name'      => 'tp_textbox_topCopy',
      'desc'      => 'Enter first line copy for top section',
      'std'       => '',
      'label_for' => 'tp_textbox_topCopy',
      'class'     => 'css_class'
    );
    
    $team_args4 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_topCopy2',
      'name'      => 'tp_textbox_topCopy2',
      'desc'      => 'Enter second line copy for top section',
      'std'       => '',
      'label_for' => 'tp_textbox_topCopy2',
      'class'     => 'css_class'
    );
    
    $team_args3 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_topImage',
      'name'      => 'tp_textbox_topImage',
      'desc'      => 'Upload an image to the Media Library and paste the URL here. Optimum size, 680px wide by 510px.',
      'std'       => '',
      'label_for' => 'tp_textbox_topImage',
      'class'     => 'css_class'
    );

    add_settings_field( 'topTitle_copy_textbox', 'Title', 'tp_display_setting', 'tp_theme_options.php', 'tp_team_section', $team_args1 );
    add_settings_field( 'topCopy_copy_textbox', 'Line 1 Copy', 'tp_display_setting', 'tp_theme_options.php', 'tp_team_section', $team_args2 );
    add_settings_field( 'topCopy2_copy_textbox', 'Line 2 Copy', 'tp_display_setting', 'tp_theme_options.php', 'tp_team_section', $team_args4 );
    add_settings_field( 'topImage_image_textbox', 'Image', 'tp_display_setting', 'tp_theme_options.php', 'tp_team_section', $team_args3 );

	
    // Add settings section
    //add_settings_section( 'tp_getintouch_section', 'Get in Touch Section', 'tp_display_section', 'tp_theme_options.php' );
	
	/*
// Create textbox field
    $git_args1 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_gitTitle',
      'name'      => 'tp_textbox_gitTitle',
      'desc'      => 'Enter the title for the contact area.',
      'std'       => '',
      'label_for' => 'tp_textbox_gitTitle',
      'class'     => 'css_class'
    );
    $git_args2 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_gitPhone',
      'name'      => 'tp_textbox_gitPhone',
      'desc'      => 'Enter the phone number.',
      'std'       => '',
      'label_for' => 'tp_textbox_gitPhone',
      'class'     => 'css_class'
    );
    $git_args3 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_gitEmail',
      'name'      => 'tp_textbox_gitEmail',
      'desc'      => 'Enter the full email address.',
      'std'       => '',
      'label_for' => 'tp_textbox_gitEmail',
      'class'     => 'css_class'
    );
    $git_args4 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_gitAddress',
      'name'      => 'tp_textbox_gitAddress',
      'desc'      => 'Enter the address as one long line.',
      'std'       => '',
      'label_for' => 'tp_textbox_gitAddress',
      'class'     => 'css_class'
    );
   
    add_settings_field( 'git_title_textbox', 'Title', 'tp_display_setting', 'tp_theme_options.php', 'tp_getintouch_section', $git_args1 );
    add_settings_field( 'git_phone_textbox', 'Phone Number', 'tp_display_setting', 'tp_theme_options.php', 'tp_getintouch_section', $git_args2 );
    add_settings_field( 'git_email_textbox', 'Email', 'tp_display_setting', 'tp_theme_options.php', 'tp_getintouch_section', $git_args3 );
    add_settings_field( 'git_address_textbox', 'Address', 'tp_display_setting', 'tp_theme_options.php', 'tp_getintouch_section', $git_args4 );
*/
    
    
    // Add settings section
    add_settings_section( 'tp_social_links', 'Social Links', 'tp_display_section', 'tp_theme_options.php' );
    // Create textbox field
    $soc_args1 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_socFacebook',
      'name'      => 'tp_textbox_socFacebook',
      'desc'      => 'Enter your Facebook profile page URL (full URL with http://).',
      'std'       => '',
      'label_for' => 'tp_textbox_socFacebook',
      'class'     => 'css_class'
    );
    
    $soc_args2 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_socTwitter',
      'name'      => 'tp_textbox_socTwitter',
      'desc'      => 'Enter your Twitter profile page URL (full URL with http://).',
      'std'       => '',
      'label_for' => 'tp_textbox_socTwitter',
      'class'     => 'css_class'
    );
    
    $soc_args3 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_socGoogle',
      'name'      => 'tp_textbox_socGoogle',
      'desc'      => 'Enter your Google+ profile page URL (full URL with http://).',
      'std'       => '',
      'label_for' => 'tp_textbox_socGoogle',
      'class'     => 'css_class'
    );
    
    $soc_args4 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_socLinkedin',
      'name'      => 'tp_textbox_socLinkedin',
      'desc'      => 'Enter your Linkedin profile page URL (full URL with http://).',
      'std'       => '',
      'label_for' => 'tp_textbox_socLinkedin',
      'class'     => 'css_class'
    );
    
    $soc_args5 = array(
      'type'      => 'text',
      'id'        => 'tp_textbox_socInstagram',
      'name'      => 'tp_textbox_socInstagram',
      'desc'      => 'Enter your Instagram profile page URL (full URL with http://).',
      'std'       => '',
      'label_for' => 'tp_textbox_socInstagram',
      'class'     => 'css_class'
    );
    
   // add_settings_field( 'soc_facebook_textbox', 'Facebook', 'tp_display_setting', 'tp_theme_options.php', 'tp_social_links', $soc_args1 );
    add_settings_field( 'soc_twitter_textbox', 'Twitter', 'tp_display_setting', 'tp_theme_options.php', 'tp_social_links', $soc_args2 );
    //add_settings_field( 'soc_google_textbox', 'Google+', 'tp_display_setting', 'tp_theme_options.php', 'tp_social_links', $soc_args3 );
    add_settings_field( 'soc_linkedin_textbox', 'Linkedin', 'tp_display_setting', 'tp_theme_options.php', 'tp_social_links', $soc_args4 );
    add_settings_field( 'soc_instagram_textbox', 'Instagram', 'tp_display_setting', 'tp_theme_options.php', 'tp_social_links', $soc_args5 );
}

/**
 * Function to add extra text to display on each section
 */
function tp_display_section($section){ 

}

/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function tp_display_setting($args)
{
    extract( $args );

    $option_name = 'tp_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {  
          case 'text':  
              $options[$id] = stripslashes($options[$id]);  
              $options[$id] = esc_attr( $options[$id]);  
              echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";  
              echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
          break;  
    }
}

/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function tp_validate_settings($input)
{
  foreach($input as $k => $v)
  {
    $newinput[$k] = trim($v);
    
    // Check the input is a letter or a number
    /*
if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
      $newinput[$k] = '';
    }
*/
  }

  return $newinput;
}





?>
