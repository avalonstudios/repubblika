<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Repubblika
 */

get_header();

$c = Timber::get_context();
$c['post'] = new TimberPost();

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/single-event.twig', $c );

get_footer();
