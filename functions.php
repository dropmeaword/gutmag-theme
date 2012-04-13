<?php  

define('THEME_ROOT',				get_bloginfo('stylesheet_directory'));


/**
 * Get other posts by same author excluding the current post
 */
function get_other_posts_by_author($authorId, $postId) {
	$retval = array();

	$authors_posts = get_posts( array( 'author' => $authorId, 'post__not_in' => array( $postId ) ) );

	foreach ( $authors_posts as $authors_post ) {
		$title = apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID );
		$plink = get_permalink( $authors_post->ID );
		array_push($retval, array('title' => $title, 'permalink' => $plink ) );
	}

	return $retval;
}

/* http://codex.wordpress.org/Function_Reference/get_post_format */
function get_custom_post_format($post_id) {
	$retval = get_post_format( $post_id );
	if ( false === $retval )
		$retval = 'standard';

	return $retval;
}

/* @lfernandez BEGIN attached media */
/**
 * Get a list of all images attached to a post
 */
function get_all_gallery_images($post_id) {
	$retval = array();
	
	$images = get_children(array(
		'post_parent'    => $post_id,
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
	));

	if( $images && !empty($images) ) {
		foreach($images as $image) {
			$imgtag  = wp_get_attachment_image($image->ID, 'img-caroussel');
			$caption = $image->post_excerpt;
			array_push($retval, array('imgtag' => $imgtag, 'caption' => $caption) );
		}
	}
	
	return $retval;
}

/* 
@note to get image title and description see this post:
http://wordpress.org/support/topic/post-image-4
*/

/* @lfernandez END attached media */

/* @lfernandez BEGIN calendar functions */
function get_query_delimited_calendar($now, $then, $which) {
	if( is_admin() ) {
		$condStatus = "AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private')";
	} else {
		$condStatus = "AND (wp_posts.post_status = 'publish')";
	}
	
	return <<<SQL
SELECT SQL_CALC_FOUND_ROWS wp_posts.*,
starts.meta_value AS agenda_begins,
ends.meta_value AS agenda_ends,
which.meta_value AS agenda_which_agenda
FROM wp_posts 
INNER JOIN wp_postmeta AS starts ON (wp_posts.ID = starts.post_id AND starts.meta_key = 'agenda_begins') 
INNER JOIN wp_postmeta AS ends ON (wp_posts.ID = ends.post_id AND ends.meta_key = 'agenda_ends') 
INNER JOIN wp_postmeta AS which ON (wp_posts.ID = which.post_id AND which.meta_key = 'agenda_which_agenda') 
WHERE 1=1 
AND wp_posts.post_type = 'event' 
{$condStatus}
AND ( (CAST(starts.meta_value AS DATE) BETWEEN '{$now}' AND '{$then}') 
		OR (CAST(ends.meta_value AS DATE)  BETWEEN '{$now}' AND '{$then}') 
	) 
AND (CAST(which.meta_value AS CHAR) LIKE '%{$which}%') 
GROUP BY wp_posts.ID ORDER BY starts.meta_value DESC
SQL;
}

function get_query_current_calendar_NL() {
	$now = date("Y-m-d"); // current
	$oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));
	return get_query_delimited_calendar($now, $oneMonthFromNow, 'NL Agenda');
}

function get_query_current_calendar_UK() {
	$now = date("Y-m-d"); // current
	$oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));
	return get_query_delimited_calendar($now, $oneMonthFromNow, 'UK Agenda');
}
/* @lfernandez END calendar functions */


/* @lfernandez this is the way you define the maximum length of the excerpt for your theme */
add_filter('excerpt_length','custom_excerpt_length');
function custom_excerpt_length($length) {
	return 120;
}

/* @lfernandez: add support for post formats */
add_theme_support( 'post-formats', array( 'gallery', 'standard' ) );

// Shortcode to add wide margins to a post page - works as is, but is applied in post lists
function wide_margins_shortcode ($atts, $content = null) {
	return '<div class="widemargins">' . do_shortcode($content) . '</div>';
}
add_shortcode("margin", "wide_margins_shortcode");

// Importing extra objects

// Path constants
define('THEMELIB', get_template_directory() . '/library');

//////////////
// SIDEBARS //
//////////////

/* This section registers the various widget areas for WPFolio */
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
	'name'=>'Right pane search'
	));
}

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
	'name'=>'Right pane menu'
	));
}

if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
		'name'=>'Issues',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	'name' => 'Related content',
	'id' => 'related_content',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '',
	'after_title' => '',
	));
}

/* END Sidebars */


////////////
// IMAGES //
////////////

// This sets the Large image size to 900px

if ( ! isset( $content_width ) ) 
	$content_width = 900;

// Remove inline styles on gallery shortcode

function wpfolio_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}
add_filter( 'gallery_style', 'wpfolio_remove_gallery_css' );

// END - Remove inline styles on gallery shortcode


// Thumbnail Function - this creates a default thumbnail if one is specified
function get_thumb ($post_ID){
    $thumbargs = array(
    'post_type' => 'attachment',
    'numberposts' => 1,
    'post_status' => null,
    'post_parent' => $post_ID
    );
    $thumb = get_posts($thumbargs);
    if ($thumb) {
        return wp_get_attachment_image($thumb[0]->ID);
    }
} 

// Mh: Set the default Post Thumnail size by resizing the image proportionally (that is, without distorting it):

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 575, 431, true );
add_image_size( 'full-gallery-size', 960, 720, false );

/* @lfernandez begin adding image size for gallery */
add_image_size( 'img-caroussel', 880, 660, false );
/* @lfernandez end adding image size for gallery */




/////////////////////
// ADDING FEATURES //
/////////////////////


// Adding some WP 3.0 features

// This theme uses wp_nav_menu()
add_theme_support( 'menus' );

register_nav_menus( array(
	'navbar' => __( 'Top Navigation Bar', 'navbar' ),
) );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// This theme allows users to set a custom background
add_custom_background();

// END wp 3.0 features


// enqueue jQuery
//if you have a script that need jquery ... you don't need to call'it. You just have to put it in your dependancies.

if( !is_admin() ){
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false, '1.7.1');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-cookie', get_template_directory_uri().'/js/jquery.cookie.js',array('jquery'));
	wp_enqueue_script('coda-slider', get_template_directory_uri().'/js/jquery.coda-slider-2.0.js'); /*,array('jquery', 'jquery-easing'));*/
	wp_enqueue_script('init-slider', get_template_directory_uri().'/js/init-slider.js',array('coda-slider'));
	wp_enqueue_script('coolclock', get_template_directory_uri().'/js/coolclock/coolclock.js'); /*,array('jquery'));*/
	wp_enqueue_script('coolclock-skins', get_template_directory_uri().'/js/coolclock/moreskins.js'); /*,array('jquery', 'coolclock'));*/
}

/*wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');*/
/*wp_enqueue_script('jquery');*/
wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/hoverIntent.js'); /*,array('jquery'));*/
wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js',array('hoverIntent'));
wp_enqueue_script('supersubs', get_template_directory_uri().'/js/supersubs.js',array('superfish'));
wp_enqueue_script('wpfolio', get_template_directory_uri().'/js/wpfolio.js',array('supersubs'));
wp_enqueue_script('jquery-easing', get_template_directory_uri().'/js/jquery.easing.1.3.js'); /*,array('jquery'));*/




// enable threaded comments

function wpfolio_enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script('comment-reply');
		}
}
add_action('get_header', 'wpfolio_enable_threaded_comments');


///////////////////////
// ADDING A TAXONOMY //
///////////////////////

// We don't use this to it's full extent yet, but we could (will?)

// enabling a taxonomy for Medium
/*
function wpfolio_create_taxonomies() {
register_taxonomy('medium', 'post', array( 
	'label' => 'Medium',
	'hierarchical' => false,  
	'query_var' => true, 
	'rewrite' => true,
	'public' => true,
	'show_ui' => true,
	'show_tagcloud' => true,
	'show_in_nav_menus' => true,));
} add_action('init', 'wpfolio_create_taxonomies', 0);
*/	
	
	
	
	
/////////////////////////////////////
// ADMIN & THEME OPTIONS INTERFACE //
/////////////////////////////////////

// customize admin footer text to add wpfolio to links
function wpfolio_admin_footer() {
	echo 'Thank you for creating with <a href="http://wordpress.org/" target="_blank">WordPress</a>. | <a href="http://codex.wordpress.org/" target="_blank">Documentation</a> | <a href="http://wordpress.org/support/forum/4" target="_blank">Feedback</a> | <a href="http://wpfolio.visitsteve.com/">Theme by WPFolio</a>';
} 
add_filter('admin_footer_text', 'wpfolio_admin_footer');
	
// Testing to see if the PHP version is up to date. If it is, add a WPFolio RSS feed widget, and if it's not, add a widget prompting an upgrade.
if (version_compare(PHP_VERSION, '5.2.4', '>=')) {

	// Add WPFolio Wiki site as a Dashboard Feed 
	// Thanks to bavotasan.com: http://bavotasan.com/tutorials/display-rss-feed-with-php/ 
	
	function custom_dashboard_widget() {
		$rss = new DOMDocument();
		$rss->load('http://wpfolio.visitsteve.com/wiki/feed');
		$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {
			$item = array ( 
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				// 'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
				);
			array_push($feed, $item);
		}
		$limit = 5; // change how many posts to display here
		echo '<ul>'; // wrap in a ul
		for($x=0;$x<$limit;$x++) {
			$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
			$link = $feed[$x]['link'];
			// $description = $feed[$x]['desc'];
			$date = date('l F d, Y', strtotime($feed[$x]['date']));
			echo '<li><p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong>';
			echo ' - '.$date.'</p></li>';
			// echo '<p>'.$description.'</p>';
		}
		echo '</ul>';
		echo '<p class="textright"><a href="http://wpfolio.visitsteve.com/wiki/category/news" class="button">View all</a></p>'; // link to site	
	}
	
	function add_custom_dashboard_widget() {
		wp_add_dashboard_widget('custom_dashboard_widget', 'WPFolio News', 'custom_dashboard_widget');
	}
	add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

} else {

	function print_php_error() {
	$error = "<p style='color:red; font-size: 1.5em;'>You are using an outdated version of PHP.  WordPress doesn't support it and neither does WPFolio!  Upgrade to the latest version of PHP.</p>";
		echo $error;
	}
	
	function add_error_widget() {
		wp_add_dashboard_widget('error_widget', 'IMPORTANT!', 'print_php_error');	
	} 
	
	add_action('wp_dashboard_setup', 'add_error_widget' );
}

?>