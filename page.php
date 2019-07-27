<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
$c[ 'post' ]	= new TimberPost();
$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );
Timber::render( 'pages/page.twig', $c );

get_footer();
