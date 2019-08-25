<?php
/**
 * Template Name: Application Form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

$obj = get_queried_object_id();
$url = get_permalink( $obj );
$url = $url . '?e_s=' . $_COOKIE[ 'rep_cookie' ];

if ( ! isset( $_GET[ 'e_s' ] ) || $_GET[ 'e_s' ] !== $_COOKIE[ 'rep_cookie' ] ) {
	wp_safe_redirect( $url );
}

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
$c[ 'flds' ]	= get_fields();
$c[ 'post' ]	= new TimberPost();
$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );
Timber::render( 'pages/must-be-logged-in.twig', $c );

get_footer();
