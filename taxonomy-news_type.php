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
	'post_type'		=>	'new',
	'paged'			=>	$paged,
	'tax_query'		=>	[
							[
								'taxonomy'	=> 'news_type',
								'field'		=> 'term_id',
								'terms'		=> $tax,
							],
						],
];


$c				= Timber::get_context();
$c[ 'posts' ]	= new Timber\PostQuery( $args );

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/archives/news-custom-archive.twig', $c );

get_footer();
