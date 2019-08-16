<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Repubblika
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function repubblika_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'repubblika_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function repubblika_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'repubblika_pingback_header' );


/**
 * Add ACF Options Pages
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page([
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	]);
	/*acf_add_options_sub_page([
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	]);
	acf_add_options_sub_page([
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	]);
	acf_add_options_page([
		'page_title' 	=> 'News Ticker',
		'menu_title'	=> 'News Ticker',
		'menu_slug' 	=> 'news-ticker',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position'		=> 5.1,
		'icon_url'		=> 'dashicons-media-spreadsheet',
	]);*/
}

function ava_custom_color_picker_palette() { ?>
	<script>
		(function($) {
			acf.add_filter( 'color_picker_args', function( args, $field ) {
				args.palettes = [ '#dfd2c9', '#d3ac92', '#be9968', '#473122', '#375823', '#262626' ];
				return args;
			});
		})(jQuery);
	</script>
	<?php
} add_action('acf/input/admin_footer', 'ava_custom_color_picker_palette');


/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function ava_count_widgets( $sidebar_id ) {
	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) :
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	endif;

	$sidebars_widgets_count = $_wp_sidebars_widgets;

	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
		if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
			// Four widgets er row if there are exactly four or more than six
			$widget_classes .= ' col-12 col-sm-6 col-md-4 col-lg-12';
		elseif ( $widget_count >= 3 ) :
			// Three widgets per row if there's three or more widgets
			$widget_classes .= ' col-12 col-sm-6 col-md-4 col-lg-12';
		elseif ( 2 == $widget_count ) :
			// Otherwise show two widgets per row
			$widget_classes .= ' col-12 col-sm-6 col-lg-12';
		endif;
		return $widget_classes;
	endif;
}

/**
 * Add Start Date & End Date Columns
 */
function set_custom_start_end_post_columns( $columns ) {

	$columns['start_date']	= __( 'Start Date', 'your_text_domain' );
	$columns['end_date']	= __( 'End Date', 'your_text_domain' );
	return $columns;

}

/**
 * Populate Start Date & End Date Columns
 */
function custom_start_end_columns( $column, $post_id ) {
	switch ( $column ) {

		case 'start_date' :
		$startDate = get_field( 'start_date', $post_id );
		echo date( 'dS M, Y, g:ia', $startDate );
		break;

		case 'end_date' :
		$endDate = get_field( 'end_date', $post_id );
		echo date( 'dS M, Y, g:ia', $endDate );
		break;

	}
}

// ANNOUNCEMENTS - Start & End Date
add_filter( 'manage_announcement_posts_columns', 'set_custom_start_end_post_columns' );
add_action( 'manage_announcement_posts_custom_column' , 'custom_start_end_columns', 10, 2 );

// EVENTS - Start & End Date
add_filter( 'manage_event_posts_columns', 'set_custom_start_end_post_columns' );
add_action( 'manage_event_posts_custom_column' , 'custom_start_end_columns', 10, 2 );


/**
 * This filters out EXPIRED EVENTS in ANY related Event Taxonomy (taxonomy-event_type.php)
 * @param  [type] $query [description]
 * @return [type]        [description]
 */
function event_type_taxonomy_archive_filter($query) {
	if ( ! is_admin() && $query->is_main_query() ) {
		$now = date('Ymd');
		$nowEvent = date('Y-m-d H:i:s');
		$now = date('Y-m-d H:i:s');
		/*if ( is_post_type_archive( 'committee_members' ) && is_tax( 'news_type' ) && is_category() ) {
			return;
		}*/
		if ( is_post_type_archive( 'event' ) ) {//$query->is_archive ) {
			$query->set(
				'meta_query',
				[
					'relation'	=> 'OR',
					[
						'key'		=> 'start_date',
						'value'		=> $now,
						'compare'	=> '>',
						'type'		=> 'DATETIME',
					],
					[
						'key'		=> 'end_date',
						'value'		=> $now,
						'compare'	=> '>',
						'type'		=> 'DATETIME',
					],
					/*[
						'key'		=> 'expiration_date',
						'value'		=> $now,
						'compare'	=> '>=',
					],
					[
						'key'		=> 'end_date',
						'value'		=> $nowEvent,
						'compare'	=> '>=',
					],*/
				]
			);
		}
	}
} add_action( 'pre_get_posts', 'event_type_taxonomy_archive_filter' );


function repubblika_archive_titles( $title ) {

	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>';

	} elseif ( is_post_type_archive() ) {

		$title = post_type_archive_title( '', false );

	} elseif ( is_tax() ) {

		if ( get_taxonomy( 'video_type' ) ) {

			$title = pll__('Video Type') . ': ' . single_term_title( '', false );

		} elseif ( get_taxonomy( 'event_type' ) ) {

			$title = pll__('Event Type') . ': ' . single_term_title( '', false );

		} elseif ( get_taxonomy( 'news_type' ) ) {

			$title = pll__('News Type') . ': ' . single_term_title( '', false );

		}

	}

	return $title;

} add_filter( 'get_the_archive_title', 'repubblika_archive_titles' );

