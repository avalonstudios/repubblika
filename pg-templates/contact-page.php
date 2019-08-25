<?php
/**
 * Template Name: Contact
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
	wpcf7_enqueue_scripts();
}

if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
	wpcf7_enqueue_styles();
}

get_header();

$contact = Timber::get_context();
$contact['post'] = new TimberPost();
$contact['options'] = get_fields( 'option' );
Timber::render( 'pages/contact.twig', $contact );

get_footer();