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

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

$postType = get_post_type();

switch ( $postType ) {
	case 'committee_members':
		Timber::render( 'pages/single-committee_members.twig', $c );
		break;

	default:
		Timber::render( 'pages/single.twig', $c );
		break;
}




get_footer();
