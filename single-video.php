<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Repubblika
 */

get_header();

$c					= Timber::get_context();
$c[ 'post' ]		= new TimberPost();

$args = [
	'taxonomy'		=> 'event_type'
];

$c[ 'event_cats' ]	= wp_get_post_terms( $post->ID, 'event_type' );

$c[ 'sidebar' ]		= Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/single-video.twig', $c );
get_footer();
