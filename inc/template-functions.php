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