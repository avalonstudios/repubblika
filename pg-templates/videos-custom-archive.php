<?php
/**
 * Template Name: Videos Custom Archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

$c				= Timber::get_context();
$news			= get_field( 'videos_category' );
$c[ 'options' ]	= get_fields( 'option' );

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$args =	[
			'post_type'		=>	'video',
			'paged'			=>	$paged,
			'tax_query'		=>	[
									[
										'taxonomy'	=> 'video_type',
										'field'		=> 'term_id',
										'terms'		=> $news,
									]
								]
		];


$c[ 'post' ]	= new TimberPost();
$c[ 'posts' ]	= new Timber\PostQuery( $args );

$c[ 'sidebar' ]	= Timber::get_sidebar( 'sidebar.php' );
Timber::render( 'pages/archives/videos-custom-archive.twig', $c );

get_footer();