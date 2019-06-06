<?php
/**
 * Template Name: Front Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

$fw = get_field( 'full_width' );

$c = Timber::get_context();
$c[ 'post' ] = new Timber\Post();

Timber::render( 'pages/front-page.twig', $c );

if ( ! fw ) {
	get_sidebar();
}
get_footer();
