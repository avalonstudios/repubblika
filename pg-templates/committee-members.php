<?php
/**
 * Template Name: Committee Members
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

$c				= Timber::get_context();

$c[ 'post' ]	= new TimberPost();
$c[ 'flds' ]	= get_fields();
$c[ 'options' ]	= get_fields( 'option' );

$c[ 'sidebar' ]	= Timber::get_sidebar( 'sidebar.php' );
Timber::render( 'pages/committee-members.twig', $c );

get_footer();