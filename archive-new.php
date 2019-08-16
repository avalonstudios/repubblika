<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();


$now = date('Y-m-d H:i:s');
$startDate = get_field('start_date');

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$args = [
	'post_type'		=>	'new',
	'paged'			=>	$paged,
];

$c				= Timber::get_context();
$c[ 'posts' ]	= new Timber\PostQuery();

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/archives/news-custom-archive.twig', $c );

get_footer();
