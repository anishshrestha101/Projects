<?php
   /*
    *  Author: KM
    */
   
   // Load any external files you have here
   require 'custom-admin-url.php';
   require 'send_voucher.php';
   require 'km_options.php';
   
   /*------------------------------------*\
   	Theme Support
   \*------------------------------------*/
   
function maryborough_scripts() {
	wp_enqueue_style( 'maryborough-style', get_stylesheet_uri() );
	
}
add_action( 'wp_enqueue_scripts', 'maryborough_scripts' );

   if (!isset($content_width))
   {
       $content_width = 1170;
   }

   function km_logo_setup() {
       $defaults = array(
           'height'      => 100,
           'width'       => 400,
           'flex-height' => true,
           'flex-width'  => true,
           'header-text' => array( 'site-title', 'site-description' ),
       );
       add_theme_support( 'custom-logo', $defaults );
   }
   
   if (function_exists('add_theme_support'))
   {
       // Add Menu Support
       add_theme_support('menus');
   
       // Add Thumbnail Theme Support
       add_theme_support('post-thumbnails');
       add_image_size('large', 1070, 755, true); // Large Thumbnail
       add_image_size('thumb', 370, 260, true); // Medium Thumbnail
       add_action( 'after_setup_theme', 'km_logo_setup' );
   
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
       load_theme_textdomain('km', get_template_directory() . '/languages');
   }
   
   /*------------------------------------*\
   	Functions
   \*------------------------------------*/
   
   // KM navigation
   function km_nav()
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
   		'items_wrap'      => '<ul class="navbar-nav">%3$s</ul>',
   		'depth'           => 0,
   		'walker'          => ''
   		)
   	);
   }
   
   function top_menu(){
         $defaults = array(
   				'theme_location'  => 'extra-menu',
   				'menu'            => '',
   				'container'       => 'ul',
   				'container_class'=> '',
   				'container_id'    => '',
   				'menu_class'      => 'nav navbar-nav',
   				'menu_id'         => '',
   				'echo'            => true,
   				'fallback_cb'     => 'wp_page_menu',
   				'before'          => '',
   				'after'           => '',
   				'link_before'     => '',
   				'link_after'      => '',
   				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
   				'depth'           => 0,
   				'walker'          => ''
   			);
    
               wp_nav_menu( $defaults );
   }
   
   // Load KM scripts (header.php)
   function km_header_scripts()
   {
       if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
   
       	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
           wp_enqueue_script('conditionizr'); // Enqueue it!
   
           wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
           wp_enqueue_script('modernizr'); // Enqueue it!
   
           wp_register_script('kmscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
           wp_enqueue_script('kmscripts'); // Enqueue it!
   		
   		wp_register_script('bootstrap.bundle', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '1.0.0'); // Custom scripts
           wp_enqueue_script('bootstrap.bundle'); // Enqueue it!
   		
   		wp_register_script('jquerymin', get_template_directory_uri() . '/vendor/jquery/jquery.min.js', array('jquery'), '1.0.0'); // Custom scripts
           wp_enqueue_script('jquerymin'); // Enqueue it!
       }
   }
   
   // Load KM conditional scripts
   function km_conditional_scripts()
   {
       if (is_page('pagenamehere')) {
           wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
           wp_enqueue_script('scriptname'); // Enqueue it!
       }
   }
   
   // Load KM styles
   function km_styles()
   {
       wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
       wp_enqueue_style('normalize'); // Enqueue it!
   
       wp_register_style('km', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
       wp_enqueue_style('km'); // Enqueue it!
   	
   	wp_register_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', array(), '1.0', 'all');
       wp_enqueue_style('bootstrap'); // Enqueue it!
     
     wp_register_style('fontawesome', get_template_directory_uri() . '/fontawesome/css/all.css', array(), '1.0', 'all');
       wp_enqueue_style('fontawesome'); // Enqueue it!
   	
   	
   }
   
   // Register KM Navigation
   function register_km_menu()
   {
       register_nav_menus(array( // Using array to specify more menus if needed
           'header-menu' => __('Header Menu', 'km'), // Main Navigation
           'sidebar-menu' => __('Sidebar Menu', 'km'), // Sidebar Navigation
           'extra-menu' => __('Extra Menu', 'km') // Extra Navigation if needed (duplicate as many as you need!)
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

function km_header_script() {
   
    echo KM_Theme_Options::get_theme_option( 'header_script');
}
add_action('wp_head', 'km_header_script');
   
   // If Dynamic Sidebar Exists
   if (function_exists('register_sidebar'))
   {
     
      // Define Sidebar Widget Area event
       register_sidebar(array(
           'name' => __('Event Sidebar', 'km'),
           'description' => __('Description for this widget-area...', 'km'),
           'id' => 'event-sidebar',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h3>',
           'after_title' => '</h3>'
       ));
     
     register_sidebar( array (
   'name' => __( 'Clinic Hour', 'km' ),
   'id' => 'widget-clinic-hr',
   'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
   'after_widget' => "</div>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );  
       // Define Sidebar Widget Area 1
       register_sidebar(array(
           'name' => __('Widget Area 1', 'km'),
           'description' => __('Description for this widget-area...', 'km'),
           'id' => 'widget-area-1',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h3>',
           'after_title' => '</h3>'
       ));
   
       // Define Sidebar Widget Area 2
       register_sidebar(array(
           'name' => __('Widget Area 2', 'km'),
           'description' => __('Description for this widget-area...', 'km'),
           'id' => 'widget-area-2',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h3>',
           'after_title' => '</h3>'
       ));
    
       register_sidebar(array(
           'name' => __('Footer Area 1', 'mbs'),
           'description' => __('Description for this widget-area...', 'km'),
           'id' => 'footer-area-1',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h5>',
           'after_title' => '</h5>'
       ));
     
      // Define Sidebar Widget Area 2
       register_sidebar(array(
           'name' => __('Footer Area 2', 'mbs'),
           'description' => __('Description for this widget-area...', 'km'),
           'id' => 'footer-area-2',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h5>',
           'after_title' => '</h5>'
       ));
     
      // Define Sidebar Widget Area 3
       register_sidebar(array(
           'name' => __('Footer Area 3', 'mbs'),
           'description' => __('Description for this widget-area...', 'km'),
           'id' => 'footer-area-3',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h5>',
           'after_title' => '</h5>'
       ));
   	
   	
   	 // Define Sidebar Widget Area 4
       register_sidebar(array(
           'name' => __('Footer Area 4', 'km'),
           'description' => __('Description for this widget-area...', 'mbs'),
           'id' => 'footer-area-4',
           'before_widget' => '<div id="%1$s" class="%2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h5>',
           'after_title' => '</h5>'
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
   function kmwp_pagination()
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
   function kmwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using kmwp_excerpt('kmwp_index');
   {
       return 20;
   }
   
   // Create 40 Word Callback for Custom Post Excerpts, call using kmwp_excerpt('kmwp_custom_post');
   function kmwp_custom_post($length)
   {
       return 40;
   }
   
   // Create the Custom Excerpts callback
   function kmwp_excerpt($length_callback = '', $more_callback = '')
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
   function km_blank_view_article($more)
   {
       global $post;
       return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'km') . '</a>';
   }
   
   // Remove Admin bar
   function remove_admin_bar()
   {
       return false;
   }
   
   // Remove 'text/css' from our enqueued stylesheet
   function km_style_remove($tag)
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
   function kmgravatar ($avatar_defaults)
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
   function kmcomments($comment, $args, $depth)
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
   add_action('init', 'km_header_scripts'); // Add Custom Scripts to wp_head
   add_action('wp_print_scripts', 'km_conditional_scripts'); // Add Conditional Page Scripts
   add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
   add_action('wp_enqueue_scripts', 'km_styles'); // Add Theme Stylesheet
   add_action('init', 'register_km_menu'); // Add KM Menu
   //add_action('init', 'create_post_type_km'); // Add our KM Custom Post Type
   add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
   add_action('init', 'kmwp_pagination'); // Add our km Pagination
   
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
   add_filter('avatar_defaults', 'kmgravatar'); // Custom Gravatar in Settings > Discussion
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
   add_filter('excerpt_more', 'km_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
   //add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
   add_filter('style_loader_tag', 'km_style_remove'); // Remove 'text/css' from enqueued stylesheet
   add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
   add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
   
   // Remove Filters
   remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
   
   // Shortcodes
   add_shortcode('km_shortcode_demo', 'km_shortcode_demo'); // You can place [km_shortcode_demo] in Pages, Posts now.
   add_shortcode('km_shortcode_demo_2', 'km_shortcode_demo_2'); // Place [km_shortcode_demo_2] in Pages, Posts now.
   
   // Shortcodes above would be nested like this -
   // [km_shortcode_demo] [km_shortcode_demo_2] Here's the page title! [/km_shortcode_demo_2] [/km_shortcode_demo]
   
   /*------------------------------------*\
   	Custom Post Types
   \*------------------------------------*/
   
   // Create 1 Custom Post type for a Demo, called km-Blank
   function create_post_type_km()
   {
       register_taxonomy_for_object_type('category', 'km-blank'); // Register Taxonomies for Category
       register_taxonomy_for_object_type('post_tag', 'km-blank');
       register_post_type('km-blank', // Register Custom Post Type
           array(
           'labels' => array(
               'name' => __('KM Custom Post', 'km'), // Rename these to suit
               'singular_name' => __('KM Custom Post', 'km'),
               'add_new' => __('Add New', 'km'),
               'add_new_item' => __('Add New KM Custom Post', 'km'),
               'edit' => __('Edit', 'km'),
               'edit_item' => __('Edit KM Custom Post', 'km'),
               'new_item' => __('New KM Custom Post', 'km'),
               'view' => __('View KM Custom Post', 'km'),
               'view_item' => __('View KM Custom Post', 'km'),
               'search_items' => __('Search KM Custom Post', 'km'),
               'not_found' => __('No KM Custom Posts found', 'km'),
               'not_found_in_trash' => __('No KM Custom Posts found in Trash', 'km')
           ),
           'public' => true,
           'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
           'has_archive' => true,
           'supports' => array(
               'title',
               'editor',
               'excerpt',
               'thumbnail'
           ), // Go to Dashboard Custom KM post for supports
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
   function km_shortcode_demo($atts, $content = null)
   {
       return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
   }
   
   // Shortcode Demo with simple <h2> tag
   function km_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
   {
       return '<h2>' . $content . '</h2>';
   }
   
   function get_recent_posts( $atts ) {
     ob_start();
   	?>
<div class="recent_posts">
   <?php
      // [GetProducts cat="Read eBook"]	
         $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $args = array(
      	'paged' => $paged,
      	'posts_per_page' => $atts[ 'count' ],
      	'category_name' => $atts[ 'cat' ],
      	'orderby' => 'date',
      	'order' => 'DESC',
      	'post_type' => 'post',
      	'exclude'   => Get_the_ID(),
      );
         $the_query = new WP_Query( $args ); 
      $posts_array = get_posts( $args );
      foreach ( $posts_array as $post ):
      	setup_postdata( $post );
      
      ?>
   <div class="col-md-4 col-sm-4">
      <div class="recent_blog">
         <div class="post-img">
            <img class="img-responsive" src="<?php echo  get_the_post_thumbnail_url($post->ID, 'thumb') ?>">
         </div>
         <div class="blog-content">
            <div class="post-date">
               <i aria-hidden="true" class="far fa-calendar-alt"></i> <?php echo get_the_date($format, $post->ID); ?>
            </div>
            <h3><a href="<?php the_permalink($post->ID) ?>"> <?php echo $post->post_title; ?></a></h3>
            <p><?php echo get_the_excerpt($post->ID); //echo $post->post_excerpt;?></p>
         </div>
      </div>
   </div>
   <?php endforeach; ?>
</div>
<div class="pagination">
   <?php
      $big = 999999999; // need an unlikely integer
      
      
      echo paginate_links( array(
      	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      	'format' => '?paged=%#%',
      	'current' => max( 1, get_query_var( 'paged' ) ),
      	'total' => $the_query->max_num_pages,
      	'before_page_number' => '<span class="screen-reader-text"> </span>'
      ) );
      ?>
</div>
<?php
   return ob_get_clean();	
   }
   add_shortcode( 'GetPost', 'get_recent_posts' );
   
   function get_events( $atts ) {
   ?>
<div class="container recent_posts">
   <?php
      // [GetProducts cat="Read eBook"]		
      $args = array(
      	'posts_per_page' => 10,
      	'orderby' => 'date',
      	'order' => 'DESC',
      	'post_type' => 'events',
      
      );
      $posts_array = get_posts( $args );
      foreach ( $posts_array as $post ):
      	setup_postdata( $post );
      
      ?>
   <div class="row events-block">
      <h2><a href="<?php the_permalink($post->ID) ?>"> <?php echo $post->post_title; ?></a></h2>
      <div class="post-img col-md-7">
         <img class="img-responsive" src="<?php echo  get_the_post_thumbnail_url($post->ID, 'full') ?>">
      </div>
      <div class="col-md-5 event-desc">
         <p class="event_location">***
            <?php echo get_post_meta($post->ID,'location', true);?>***
         </p>
         <p class="event_date">
            <?php echo date("l j F Y", strtotime(get_post_meta($post->ID,'event_date', true)));?>
         </p>
         <?php
            $date1=date("Y-m-d", strtotime(get_post_meta($post->ID,'event_date', true)));
            $date2=date('Y-m-d');
            if ($date1 > $date2) {
            	echo '<a class="booknow_btn" href="'.get_permalink($post->ID).'" target="_blank">Book Now</a>';
            }
            else{	
            echo '<a class="booknow_btn" href="#" target="_blank">Sold Out</a>';	
            }
                  ?>
      </div>
   </div>
   <?php endforeach; ?>
</div>
<?php
   }
   add_shortcode( 'GetEvents', 'get_events' );
   
   function booknow_bottom( ) {
     ob_start();
   ?>
<form action="" method="post">
   <input type="hidden" name="event" value="<?php echo get_the_ID();?>">
   <input type="submit" class="booknow_btn" value="Book Now">
</form>
<?php
   return ob_get_clean();	
   }
   
   add_shortcode( 'Booknow', 'booknow_bottom' );
   
   
   
   /*add_filter( 'wpcf7_skip_mail', function( $skip_mail, $contact_form ) {
       return  true;
   });*/
   
   add_action("wpcf7_before_send_mail", "wpcf7_do_something_else");  
   function wpcf7_do_something_else($cf7) {
       // get the contact form object
       $wpcf = WPCF7_ContactForm::get_current();
   	$submission = WPCF7_Submission::get_instance();
   	$name = $submission->get_posted_data('your-message');
   	
   	if ( strstr( $name, 'http' ) ) {
     $found= "Text found";
   		 $wpcf->skip_mail = true;   
   } else {
     $found= "Text not found";
   		 $wpcf->skip_mail = false;   
   }
   	wp_mail('man_ketan@yahoo.com', 'Email Test',$name.'----/n'.$found);
        $wpcf->skip_mail = true;   
       // if you wanna check the ID of the Form $wpcf->id
   
      
   
       return $wpcf;
   }
   
   
   function defer_parsing_of_js( $url ) {
       if ( is_user_logged_in() ) return $url; //don't break WP Admin
       if ( FALSE === strpos( $url, '.js' ) ) return $url;
       if ( strpos( $url, 'jquery.js' ) ) return $url;
       return str_replace( ' src', ' defer src', $url );
   }
   add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );
   
   function hook_javascript() {
     global $post;
   	$page_slug = $post->post_name;
    ?>
        <script>
    
     $(document).ready(function(){
       $('form').attr('id', 'form-<?php echo $page_slug ?>');
  });
      <!-- Google Tag Manager -->
     (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','GTM-N4DDXK8');
    
      <!-- End Google Tag Manager -->
        </script>
    <?php
}
add_action('wp_head', 'hook_javascript');

function cptui_register_my_cpts() {

	/**
	 * Post Type: Gift Vouchers.
	 */

	$labels = [
		"name" => __( "Gift Vouchers", "custom-post-type-ui" ),
		"singular_name" => __( "Gift Voucher", "custom-post-type-ui" ),
		"menu_name" => __( "Gift Voucher", "custom-post-type-ui" ),
		"all_items" => __( "ALL Gift Vouchers", "custom-post-type-ui" ),
		"add_new" => __( "Add Gift Vouchers", "custom-post-type-ui" ),
		"add_new_item" => __( "Add Gift Voucher", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Gift Voucher", "custom-post-type-ui" ),
		"new_item" => __( "New Gift Voucher", "custom-post-type-ui" ),
		"view_item" => __( "View Gift Voucher", "custom-post-type-ui" ),
		"view_items" => __( "view Gift Vouchers", "custom-post-type-ui" ),
		"search_items" => __( "Search Gift Voucher", "custom-post-type-ui" ),
		"not_found" => __( "No Gift Vouchers Found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Gift Vouchers found in Trash", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Gift Vouchers", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "voucher", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "voucher", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


   ?>