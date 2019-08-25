<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

$tax = get_queried_object_id();

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$args = [
	'post_type'		=>	'video',
	'paged'			=>	$paged,
	'tax_query'		=>	[
							[
								'taxonomy'	=> 'video_type',
								'field'		=> 'term_id',
								'terms'		=>	$tax,
							],
						],
];

$c				= Timber::get_context();
$c[ 'posts' ]	= new Timber\PostQuery( $args );

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/archives/videos-custom-archive.twig', $c );

get_footer();
