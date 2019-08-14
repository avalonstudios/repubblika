<?php
// Register Custom Post Type - LYRICS
function cpts_fn() {
	$labels = array(
		'name'					=> _x( 'Events', 'Post Type General Name', 'repubblika' ),
		'singular_name'			=> _x( 'Event', 'Post Type Singular Name', 'repubblika' ),
		'menu_name'				=> __( 'Events', 'repubblika' ),
		'name_admin_bar'		=> __( 'Event', 'repubblika' ),
		'archives'				=> __( 'Event Archives', 'repubblika' ),
		'attributes'			=> __( 'Event Attributes', 'repubblika' ),
		'parent_item_colon'		=> __( 'Parent Event:', 'repubblika' ),
		'all_items'				=> __( 'All Events', 'repubblika' ),
		'add_new_item'			=> __( 'Add New Event', 'repubblika' ),
		'add_new'				=> __( 'Add New', 'repubblika' ),
		'new_item'				=> __( 'New Event', 'repubblika' ),
		'edit_item'				=> __( 'Edit Event', 'repubblika' ),
		'update_item'			=> __( 'Update Event', 'repubblika' ),
		'view_item'				=> __( 'View Event', 'repubblika' ),
		'view_items'			=> __( 'View Events', 'repubblika' ),
		'search_items'			=> __( 'Search Event', 'repubblika' ),
		'not_found'				=> __( 'Not found', 'repubblika' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'repubblika' ),
		'featured_image'		=> __( 'Featured Image', 'repubblika' ),
		'set_featured_image'	=> __( 'Set featured image', 'repubblika' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'repubblika' ),
		'use_featured_image'	=> __( 'Use as featured image', 'repubblika' ),
		'insert_into_item'		=> __( 'Insert into item', 'repubblika' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this item', 'repubblika' ),
		'items_list'			=> __( 'Events list', 'repubblika' ),
		'items_list_navigation'	=> __( 'Events list navigation', 'repubblika' ),
		'filter_items_list'		=> __( 'Filter items list', 'repubblika' ),
	);
	$args = array(
		'label'					=> __( 'Event', 'repubblika' ),
		'description'			=> __( 'Repubblika Events', 'repubblika' ),
		'labels'				=> $labels,
		'supports'				=> array('title', 'editor'),
		'hierarchical'			=> false,
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> 'events_index',
		'menu_position'			=> 2,
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
	);
	register_post_type( 'event', $args );



	$labels = array(
		'name'					=> _x( 'Speakers', 'Post Type General Name', 'repubblika' ),
		'singular_name'			=> _x( 'Speaker', 'Post Type Singular Name', 'repubblika' ),
		'menu_name'				=> __( 'Speakers', 'repubblika' ),
		'name_admin_bar'		=> __( 'Speaker', 'repubblika' ),
		'archives'				=> __( 'Speaker Archives', 'repubblika' ),
		'attributes'			=> __( 'Speaker Attributes', 'repubblika' ),
		'parent_item_colon'		=> __( 'Parent Speaker:', 'repubblika' ),
		'all_items'				=> __( 'All Speakers', 'repubblika' ),
		'add_new_item'			=> __( 'Add New Speaker', 'repubblika' ),
		'add_new'				=> __( 'Add New', 'repubblika' ),
		'new_item'				=> __( 'New Speaker', 'repubblika' ),
		'edit_item'				=> __( 'Edit Speaker', 'repubblika' ),
		'update_item'			=> __( 'Update Speaker', 'repubblika' ),
		'view_item'				=> __( 'View Speaker', 'repubblika' ),
		'view_items'			=> __( 'View Speakers', 'repubblika' ),
		'search_items'			=> __( 'Search Speaker', 'repubblika' ),
		'not_found'				=> __( 'Not found', 'repubblika' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'repubblika' ),
		'featured_image'		=> __( 'Featured Image', 'repubblika' ),
		'set_featured_image'	=> __( 'Set featured image', 'repubblika' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'repubblika' ),
		'use_featured_image'	=> __( 'Use as featured image', 'repubblika' ),
		'insert_into_item'		=> __( 'Insert into item', 'repubblika' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this item', 'repubblika' ),
		'items_list'			=> __( 'Speakers list', 'repubblika' ),
		'items_list_navigation'	=> __( 'Speakers list navigation', 'repubblika' ),
		'filter_items_list'		=> __( 'Filter items list', 'repubblika' ),
	);
	$args = array(
		'label'					=> __( 'Speaker', 'repubblika' ),
		'description'			=> __( 'Repubblika events speakers', 'repubblika' ),
		'labels'				=> $labels,
		'supports'				=> array('title'),
		'hierarchical'			=> false,
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> 'events_index',
		'menu_position'			=> 5,
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
	);
	register_post_type( 'speaker', $args );




	$labels = array(
		'name'					=> _x( 'Venues', 'Post Type General Name', 'repubblika' ),
		'singular_name'			=> _x( 'Venue', 'Post Type Singular Name', 'repubblika' ),
		'menu_name'				=> __( 'Venues', 'repubblika' ),
		'name_admin_bar'		=> __( 'Venue', 'repubblika' ),
		'archives'				=> __( 'Venue Archives', 'repubblika' ),
		'attributes'			=> __( 'Venue Attributes', 'repubblika' ),
		'parent_item_colon'		=> __( 'Parent Venue:', 'repubblika' ),
		'all_items'				=> __( 'All Venues', 'repubblika' ),
		'add_new_item'			=> __( 'Add New Venue', 'repubblika' ),
		'add_new'				=> __( 'Add New', 'repubblika' ),
		'new_item'				=> __( 'New Venue', 'repubblika' ),
		'edit_item'				=> __( 'Edit Venue', 'repubblika' ),
		'update_item'			=> __( 'Update Venue', 'repubblika' ),
		'view_item'				=> __( 'View Venue', 'repubblika' ),
		'view_items'			=> __( 'View Venues', 'repubblika' ),
		'search_items'			=> __( 'Search Venue', 'repubblika' ),
		'not_found'				=> __( 'Not found', 'repubblika' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'repubblika' ),
		'featured_image'		=> __( 'Featured Image', 'repubblika' ),
		'set_featured_image'	=> __( 'Set featured image', 'repubblika' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'repubblika' ),
		'use_featured_image'	=> __( 'Use as featured image', 'repubblika' ),
		'insert_into_item'		=> __( 'Insert into item', 'repubblika' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this item', 'repubblika' ),
		'items_list'			=> __( 'Venues list', 'repubblika' ),
		'items_list_navigation'	=> __( 'Venues list navigation', 'repubblika' ),
		'filter_items_list'		=> __( 'Filter items list', 'repubblika' ),
	);
	$args = array(
		'label'					=> __( 'Venue', 'repubblika' ),
		'description'			=> __( 'Repubblika events venues', 'repubblika' ),
		'labels'				=> $labels,
		'supports'				=> array('title'),
		'hierarchical'			=> false,
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> 'events_index',
		'menu_position'			=> 5,
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
	);
	register_post_type( 'venue', $args );



	// Register Custom Post Type Announcement
	$labels = array(
		'name'					=> _x( 'Announcements', 'Post Type General Name', 'repubblika' ),
		'singular_name'			=> _x( 'Announcement', 'Post Type Singular Name', 'repubblika' ),
		'menu_name'				=> _x( 'Announcements', 'Admin Menu text', 'repubblika' ),
		'name_admin_bar'		=> _x( 'Announcement', 'Add New on Toolbar', 'repubblika' ),
		'archives'				=> __( 'Announcement Archives', 'repubblika' ),
		'attributes'			=> __( 'Announcement Attributes', 'repubblika' ),
		'parent_item_colon'		=> __( 'Parent Announcement:', 'repubblika' ),
		'all_items'				=> __( 'All Announcements', 'repubblika' ),
		'add_new_item'			=> __( 'Add New Announcement', 'repubblika' ),
		'add_new'				=> __( 'Add New', 'repubblika' ),
		'new_item'				=> __( 'New Announcement', 'repubblika' ),
		'edit_item'				=> __( 'Edit Announcement', 'repubblika' ),
		'update_item'			=> __( 'Update Announcement', 'repubblika' ),
		'view_item'				=> __( 'View Announcement', 'repubblika' ),
		'view_items'			=> __( 'View Announcements', 'repubblika' ),
		'search_items'			=> __( 'Search Announcement', 'repubblika' ),
		'not_found'				=> __( 'Not found', 'repubblika' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'repubblika' ),
		'featured_image'		=> __( 'Featured Image', 'repubblika' ),
		'set_featured_image'	=> __( 'Set featured image', 'repubblika' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'repubblika' ),
		'use_featured_image'	=> __( 'Use as featured image', 'repubblika' ),
		'insert_into_item'		=> __( 'Insert into Announcement', 'repubblika' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this Announcement', 'repubblika' ),
		'items_list'			=> __( 'Announcements list', 'repubblika' ),
		'items_list_navigation'	=> __( 'Announcements list navigation', 'repubblika' ),
		'filter_items_list'		=> __( 'Filter Announcements list', 'repubblika' ),
	);
	$args = array(
		'label'					=> __( 'Announcement', 'repubblika' ),
		'description'			=> __( '', 'repubblika' ),
		'labels'				=> $labels,
		'menu_icon'				=> 'dashicons-megaphone',
		'supports'				=> array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
		'taxonomies'			=> array(),
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> 'repubblika_index',
		'menu_position'			=> 5,
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'hierarchical'			=> false,
		'exclude_from_search'	=> false,
		'show_in_rest'			=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
	);
	register_post_type( 'announcement', $args );


	// Register Custom Post Type Video
	$labels = array(
		'name'					=> _x( 'Videos', 'Post Type General Name', 'repubblika' ),
		'singular_name'			=> _x( 'Video', 'Post Type Singular Name', 'repubblika' ),
		'menu_name'				=> _x( 'Videos', 'Admin Menu text', 'repubblika' ),
		'name_admin_bar'		=> _x( 'Video', 'Add New on Toolbar', 'repubblika' ),
		'archives'				=> __( 'Video Archives', 'repubblika' ),
		'attributes'			=> __( 'Video Attributes', 'repubblika' ),
		'parent_item_colon'		=> __( 'Parent Video:', 'repubblika' ),
		'all_items'				=> __( 'All Videos', 'repubblika' ),
		'add_new_item'			=> __( 'Add New Video', 'repubblika' ),
		'add_new'				=> __( 'Add New', 'repubblika' ),
		'new_item'				=> __( 'New Video', 'repubblika' ),
		'edit_item'				=> __( 'Edit Video', 'repubblika' ),
		'update_item'			=> __( 'Update Video', 'repubblika' ),
		'view_item'				=> __( 'View Video', 'repubblika' ),
		'view_items'			=> __( 'View Videos', 'repubblika' ),
		'search_items'			=> __( 'Search Video', 'repubblika' ),
		'not_found'				=> __( 'Not found', 'repubblika' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'repubblika' ),
		'featured_image'		=> __( 'Featured Image', 'repubblika' ),
		'set_featured_image'	=> __( 'Set featured image', 'repubblika' ),
		'remove_featured_image'	=> __( 'Remove featured image', 'repubblika' ),
		'use_featured_image'	=> __( 'Use as featured image', 'repubblika' ),
		'insert_into_item'		=> __( 'Insert into Video', 'repubblika' ),
		'uploaded_to_this_item'	=> __( 'Uploaded to this Video', 'repubblika' ),
		'items_list'			=> __( 'Videos list', 'repubblika' ),
		'items_list_navigation'	=> __( 'Videos list navigation', 'repubblika' ),
		'filter_items_list'		=> __( 'Filter Videos list', 'repubblika' ),
	);
	$args = array(
		'label'					=> __( 'Video', 'repubblika' ),
		'description'			=> __( '', 'repubblika' ),
		'labels'				=> $labels,
		'menu_icon'				=> 'dashicons-megaphone',
		'supports'				=> array('title', 'thumbnail', 'revisions'),
		'taxonomies'			=> array(),
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> 'repubblika_index',
		'menu_position'			=> 5,
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'hierarchical'			=> false,
		'exclude_from_search'	=> false,
		'show_in_rest'			=> true,
		'publicly_queryable'	=> true,
		'capability_type'		=> 'post',
	);
	register_post_type( 'video', $args );
}
// Hook into the 'init' action
add_action( 'init', 'cpts_fn', 0 );

function prefix_disable_gutenberg($current_status, $post_type) {
	// Use your post type key instead of 'product'
	if ($post_type === 'venue') return false;
	return $current_status;
} add_filter('gutenberg_can_edit_post_type', 'prefix_disable_gutenberg');






add_action( 'init', function() {
	/**
	 * Add Event Categories to "event" CPT
	 * e.g. Seminars, Video, Film Night, etc...
	 */
	register_extended_taxonomy( 'event_type', 'event',	[
															# Use radio buttons in the meta box in Admin area
															'meta_box'			=> 'radio',
															'hierarchical'		=> false,
														],
														[
															'slug'				=> 'event-categories'
														],
	);
	/**
	 * Add Committee Members Post Type
	 */
	register_extended_post_type( 'committee_members', array(

		# Add the post type to the site's main RSS feed:
		'show_in_feed' => true,

		# Show under Repubblika custom admin menu
		'show_in_menu'	=> 'repubblika_index',

		'public'				=> true,
		'show_ui'				=> true,
		'menu_position'			=> 5,
		'show_in_admin_bar'		=> true,
		'show_in_nav_menus'		=> true,
		'can_export'			=> true,
		'has_archive'			=> true,
		'hierarchical'			=> false,
		'exclude_from_search'	=> false,
		'show_in_rest'			=> true,
		'publicly_queryable'	=> true,

		# Show all posts on the post type archive:
		/*'archive' => array(
			'nopaging' => true
		),*/

		# Add some custom columns to the admin screen:
		'admin_cols' => array(
			'designation' => array(
				'title'				=> 'Designation',
				'meta_key'			=> 'designation',
			),
			'featured_image' => array(
				'title'				=> 'Photo',
				'featured_image'	=> 'thumbnail'
			),
		),
	), array(
		# Override the base names used for labels:
		'singular'					=> 'Committee Member',
		'plural'					=> 'Committee Members',
		'slug'						=> 'committee-members'
	) );
} );

/**
 * Register Repubblika custom menu page.
 */
function ava_repubblika_menu(){
	add_menu_page(
		'Repubblika',
		'Repubblika',
		'edit_posts',
		'repubblika_index',
		'',
		'',
		6
	);
} add_action( 'admin_menu', 'ava_repubblika_menu' );

/**
 * Register Events custom menu page.
 */
function ava_events_menu(){
	add_menu_page(
		'Events',
		'Events',
		'edit_posts',
		'events_index',
		'',
		'',
		7
	);
} add_action( 'admin_menu', 'ava_events_menu' );

//http://repubblika.test/wp-admin/edit-tags.php?taxonomy=event_type&post_type=event

function custom_link_events_menu() {
    add_submenu_page(
    	'events_index',
    	'Event Types',
    	'Event Types',
    	'edit_posts',
    	'edit-tags.php?taxonomy=event_type&post_type=event'
    );
 } add_action( 'admin_menu', 'custom_link_events_menu' );