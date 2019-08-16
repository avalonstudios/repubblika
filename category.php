<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$opt = get_fields( 'options' );
$numOfPosts = $opt[ 'num_of_posts' ];

$c = Timber::get_context();
$c[ 'options' ] = get_fields( 'options' );


$c[ 'posts' ] = new Timber\PostQuery();

$c[ '' ] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/home.twig', $c );

get_footer();
