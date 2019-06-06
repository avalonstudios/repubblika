<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$opt = get_fields( 'options' );
$numOfPosts = $opt[ 'num_of_posts' ];

$c = Timber::get_context();
$c[ 'options' ] = get_fields( 'options' );


//$numOfStickies = count( get_option( 'sticky_posts' ) );
//$numOfPosts = 9 - $numOfStickies;
// WP_Query arguments
$args =	[
			'post_type'				=> array( 'post' ),
			'post_status'			=> array( 'publish' ),
			'ignore_sticky_posts'	=> 1,
			'posts_per_page'		=> $numOfPosts,
			'paged'					=> $paged,
		];


$c[ 'posts' ] = new Timber\PostQuery( $args );

$sticky_posts = get_option( 'sticky_posts' );

if ( $sticky_posts && $paged === 1 ) {
	$args =	[
				'post_type'				=> array( 'post' ),
				'post_status'			=> array( 'publish' ),
				'post__in'				=> $sticky_posts,
				'ignore_sticky_posts'	=> 1,
				'posts_per_page'		=> -1,
			];
	$c[ 'stickies' ] = new Timber\PostQuery( $args );
}


Timber::render( 'pages/home.twig', $c );

get_sidebar();
get_footer();
