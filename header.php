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


$gmtOffset = get_option('gmt_offset');

$now = date( 'Y-m-d H:i:s' );
$now = date_create( $now );
date_add( $now, date_interval_create_from_date_string( $gmtOffset . ' hours' ) );
$now = date_format( $now, 'Y-m-d H:i:s' );

$timeNow = strtotime( $now );

$startDate = get_field('start_date');

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$args = [
	'post_type'		=>	'announcement',
	'paged'			=>	$paged,
	'order'			=>	'ASC',
	'orderby'		=>	'meta_value',
	'meta_key'		=>	'start_date',
	'meta_type'		=>	'DATE',
	'meta_query'	=>	[
							'relation'	=> 'AND',
							[
								'key'		=> 'start_date',
								'value'		=> $now,
								'compare'	=> '<=',
								'type'		=> 'DATETIME',
							],
							[
								'key'		=> 'end_date',
								'value'		=> $now,
								'compare'	=> '>=',
								'type'		=> 'DATETIME',
							]
						],
];

$c[ 'time_now' ] = $now;
$c[ 'announcements' ] = new Timber\PostQuery( $args );

Timber::render( 'sections/header/header.twig', $c );