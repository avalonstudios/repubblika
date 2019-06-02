<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Repubblika
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'white-skin' ); ?>>

<?php

$args = [
	'depth'	=> 3,
];

$logo			= get_theme_mod( 'custom_logo' );
$c				= Timber::get_context();
$c['logo']		= $logo;
$c['post']		= new TimberPost();
$c['options']	= get_fields('option');
$c['menu']		= new Timber\Menu( 'menu-1', $args );

Timber::render( 'sections/header/header.twig', $c );