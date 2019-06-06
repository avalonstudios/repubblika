<?php

//Gutenberg
//add_theme_support('editor-styles');
function custom_gutenberg_styles() {
	wp_enqueue_style('custom-gutenberg', get_theme_file_uri( '/acf-blocks.css' ), false, '1.0', 'all');
}
add_action('enqueue_block_editor_assets', 'custom_gutenberg_styles');





add_action( 'enqueue_block_assets', 'ava_acf_blocks_scripts', 10, 0 );
function ava_acf_blocks_scripts() {
	$link		= get_template_directory_uri() . '/acf-blocks.css';
	$localLink	= get_template_directory_uri() . '/mdb_pro';
	wp_enqueue_style( 'ava-acf-blocks', $link, array(), "0.0.1", 'all' );
	// Bootstrap
	wp_enqueue_style( 'ava-bootstrap-css', $localLink . '/css/bootstrap.min.css', array(), '4.3.1' );
	// MDB
	//wp_enqueue_style( 'ava-mdb', $localLink . '/css/mdb.min.css' );
	// Bootstrap JS
	wp_enqueue_script( 'ava-bootstrap-js', $localLink . '/js/bootstrap.min.js', array( 'ava-jquery341' ), '4.3.1', true );
}


add_action('acf/init', 'my_register_blocks');
function my_register_blocks() {

	// check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {
		$settings = [
						'name'				=> 'custom_category_archives',
						'title'				=> __('Custom Category Archives'),
						'description'		=> __('A custom "display category" block.'),
						'render_callback'	=> 'custom_category_archives_block',
						'category'			=> 'widgets',
						'html'				=> true,
						'align'				=> 'full',
						'supports'			=>	[
													'align' => false,
												],
					];

		// register a testimonial block.
		acf_register_block_type( $settings );

		$settings = [
						'name'				=> 'custom_tag_archives',
						'title'				=> __('Custom Tag Archives'),
						'description'		=> __('A custom "display tag" block.'),
						'render_callback'	=> 'custom_tag_archives_block',
						'category'			=> 'widgets',
						'html'				=> true,
						'align'				=> 'full',
						'supports'			=>	[
													'align' => false,
												],
					];

		// register a testimonial block.
		acf_register_block_type( $settings );

		$settings = [
						'name'				=> 'add_event_in_post',
						'title'				=> __('Show Event in Post'),
						'description'		=> __('Add a Show Event block.'),
						'render_callback'	=> 'add_event_in_post_block',
						'category'			=> 'widgets',
						'html'				=> true,
						'align'				=> 'full',
						'supports'			=>	[
													'align' => false,
												],
					];

		// register a testimonial block.
		acf_register_block_type( $settings );
	}
}

/**
 * Testimonial Block Callback Function.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
function custom_category_archives_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	$c = Timber::get_context();

	// Create id attribute allowing for custom "anchor" value.
	$c[ 'id' ] = $block[ 'id' ];
	if ( !empty( $block[ 'anchor' ] ) ) {
		$c[ 'id' ] = $block[ 'anchor' ];
	}

	// Create class attribute allowing for custom "class_name" and "align" values.
	$c[ 'class_name' ] = 'custom-category-archives';
	if ( !empty( $block[ 'class_name' ] ) ) {
		$c[ 'class_name' ] .= ' ' . $block[ 'class_name' ];
	}
	if ( !empty( $block[ 'align' ] ) ) {
		$c[ 'class_name' ] .= ' align' . $block[ 'align' ];
	}


	// Get ACF fields
	$cats			= get_field( 'custom_category_archive' );
	$numOfPosts		= get_field( 'num_of_posts' );

	$c[ 'title' ]	= get_field( 'title' );
	$c[ 'width' ]	= get_field( 'width' );

	$args =	[
				'category__in'		=> $cats,
				'posts_per_page'	=> $numOfPosts,
			];

	$c[ 'cats' ]	= $cats;
	$c[ 'post' ]	= new TimberPost();
	$c[ 'posts' ]	= new Timber\PostQuery( $args );

	Timber::render( 'acf-blocks/custom-category-archives.twig', $c );
}

function custom_tag_archives_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	$c = Timber::get_context();

	// Create id attribute allowing for custom "anchor" value.
	$c[ 'id' ] = $block[ 'id' ];
	if ( !empty( $block[ 'anchor' ] ) ) {
		$c[ 'id' ] = $block[ 'anchor' ];
	}

	// Create class attribute allowing for custom "class_name" and "align" values.
	$c[ 'class_name' ] = 'custom-tag-archives';
	if ( !empty( $block[ 'class_name' ] ) ) {
		$c[ 'class_name' ] .= ' ' . $block[ 'class_name' ];
	}
	if ( !empty( $block[ 'align' ] ) ) {
		$c[ 'class_name' ] .= ' align' . $block[ 'align' ];
	}

	// Get ACF fields
	$cats			= get_field( 'custom_tag_archive' );
	$numOfPosts		= get_field( 'num_of_posts' );

	$c[ 'title' ]	= get_field( 'title' );
	$c[ 'width' ]	= get_field( 'width' );

	$args =	[
				'tag__in'		=> $cats,
				'posts_per_page'	=> $numOfPosts,
			];

	$c[ 'cats' ]	= $cats;
	$c[ 'post' ]	= new TimberPost();
	$c[ 'posts' ]	= new Timber\PostQuery( $args );

	Timber::render( 'acf-blocks/custom-category-archives.twig', $c );
}

function add_event_in_post_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	$c = Timber::get_context();

	// Create id attribute allowing for custom "anchor" value.
	$c[ 'id' ] = $block[ 'id' ];
	if ( !empty( $block[ 'anchor' ] ) ) {
		$c[ 'id' ] = $block[ 'anchor' ];
	}

	// Create class attribute allowing for custom "class_name" and "align" values.
	$c[ 'class_name' ] = 'custom-tag-archives';
	if ( !empty( $block[ 'class_name' ] ) ) {
		$c[ 'class_name' ] .= ' ' . $block[ 'class_name' ];
	}
	if ( !empty( $block[ 'align' ] ) ) {
		$c[ 'class_name' ] .= ' align' . $block[ 'align' ];
	}

	// Get ACF fields
	$c[ 'fields' ] = get_fields();
	$c[ 'post' ]	= new TimberPost();

	Timber::render( 'acf-blocks/add_event_in_post.twig', $c );
}