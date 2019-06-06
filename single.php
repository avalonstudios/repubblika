<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Repubblika
 */

get_header();

// Timber support for Multipage
global $post, $page, $pages, $multipage;
setup_postdata( $post );

$single = Timber::get_context();
$single['post'] = new TimberPost();

// Overwrite whole post with paginated piece, if viewing a
// paginated page of the overall post
if ( $multipage ) {
	$single['post']->post_content = $pages[ $page - 1 ];
}

if ( post_password_required() ) {
	$single['password'] = true;
}

Timber::render( 'pages/single.twig', $single );

get_sidebar();
get_footer();
