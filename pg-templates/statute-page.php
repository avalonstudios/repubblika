<?php
/**
 * Template Name: Statute
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

$c = Timber::get_context();
$c['post'] = new TimberPost();
$c['sidebar'] = Timber::get_sidebar( 'sidebar.php' );

Timber::render( 'pages/statute-page.twig', $c );


get_footer();
