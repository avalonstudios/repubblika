<?php
/**
 * The template for displaying archive pages
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
/*
$args = [
	'post_type'		=>	'event',
	'paged'			=>	$paged,
	'order'			=>	'ASC',
	'orderby'		=>	'meta_value',
	'meta_key'		=>	'start_date',
	'meta_type'		=>	'DATE',
	'meta_query'	=>	[
							'relation'	=> 'OR',
							[
								'key'		=> 'start_date',
								'value'		=> $now,
								'compare'	=> '>',
								'type'		=> 'DATETIME',
							],
							[
								'key'		=> 'end_date',
								'value'		=> $now,
								'compare'	=> '>',
								'type'		=> 'DATETIME',
							]
						],
];
*/
$c				= Timber::get_context();
$c[ 'posts' ]	= new Timber\PostQuery();

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/archives/archive-committee_members.twig', $c );

get_footer();
