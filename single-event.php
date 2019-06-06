<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Repubblika
 */

get_header();

$show = Timber::get_context();
$show['post'] = new TimberPost();

Timber::render( 'pages/single-event.twig', $show );

get_footer();
