<?php
/**
 * Template Name: News Custom Archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

$c				= Timber::get_context();
$news			= get_field( 'news_category' );

$c[ 'options' ]	= get_fields( 'option' );

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$args =	[
			'post_type'		=>	'new',
			'paged'			=>	$paged,
			'tax_query'		=>	[
									[
										'taxonomy'	=> 'news_type',
										'field'		=> 'term_id',
										'terms'		=> $news,
									]
								]
		];


$c[ 'posts' ]	= new Timber\PostQuery( $args );

$c[ 'sidebar' ]	= Timber::get_sidebar( 'sidebar.php' );
Timber::render( 'pages/archives/news-custom-archive.twig', $c );

get_footer();