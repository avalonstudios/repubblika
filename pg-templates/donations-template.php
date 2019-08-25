<?php
/**
 * Template Name: Donations Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

// Timber support for Multipage
global $post, $page, $pages, $multipage;
setup_postdata( $post );

$c = Timber::get_context();
$c['post'] = new TimberPost();

// Overwrite whole post with paginated piece, if viewing a
// paginated page of the overall post
if ( $multipage ) {
	$c['post']->post_content = $pages[ $page - 1 ];
}

if ( post_password_required() ) {
	$c['password'] = true;
}

$c				= Timber::get_context();
$c[ 'options' ]	= get_fields( 'options' );
$c[ 'post' ]	= new TimberPost();
$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );
Timber::render( 'pages/donations.twig', $c );

get_footer();
