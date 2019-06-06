<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Repubblika
 */

$footer = Timber::get_context();
$footer['post'] = new TimberPost();
$footer['options'] = get_fields('option');

Timber::render( 'sections/footer/footer.twig', $footer );