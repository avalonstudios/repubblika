<?php
$localLink = get_stylesheet_directory_uri() . '/mdb_pro';
$cloudflare = "//cdnjs.cloudflare.com/ajax/libs/";

// Google Fonts
$googleFonts = "//fonts.googleapis.com/css?family=";
$googleFonts .= "Allerta+Stencil|";
$googleFonts .= "Oswald:400,500,700|";
$googleFonts .= "PT+Serif:400,400i,700,700i";
$googleFonts .= "&display=swap&subset=latin-ext";
wp_enqueue_style( 'ava-googlefonts', $googleFonts );


// Bootstrap
//$link = "//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css";
$link = "{$cloudflare}twitter-bootstrap/4.3.1/css/bootstrap.min.css";
wp_enqueue_style( 'ava-bootstrap-css', $link, false, '4.3.1' );

// Calendar
$link = "http://addtocalendar.com/atc/1.5/atc-style-blue.css";
wp_enqueue_style( 'ava-calendar', $link, false, '1.5' );

// FontAwesome
//$link = "https://use.fontawesome.com/releases/v5.8.2/css/all.css";
$link = "{$cloudflare}font-awesome/5.8.2/css/all.min.css";
wp_enqueue_style( 'ava-fontawesome', $link, array(), 'v5.8.2' );

// JS
$fldr = "/js/";
$ext = ".js";
//$fldr = "/js/min/";
$ext = ".min.js";

$cacheBuster = "a";


// jQuery
$link = "{$cloudflare}jquery/3.4.1/jquery.slim.js";
wp_enqueue_script( 'ava-jquery341', $link, array(), '3.4.1', true );

// Popper
$link = "{$cloudflare}popper.js/1.15.0/umd/popper.min.js";
wp_enqueue_script( 'ava-popper', $link, array( 'ava-jquery341' ), '1.15.0', true );

// Bootstrap JS
$link = "{$cloudflare}twitter-bootstrap/4.3.1/js/bootstrap.min.js";
wp_enqueue_script( 'ava-bootstrap-js', $localLink . '/js/bootstrap.min.js', array( 'ava-jquery341' ), '4.3.1', true );

// Custom JS
wp_enqueue_script( 'ava-custom', get_stylesheet_directory_uri() . "{$fldr}custom{$ext}", array(), "0.0.1{$cacheBuster}", true );

// Google Maps
$link = "//maps.googleapis.com/maps/api/js?key=AIzaSyBJke8awiiax4MfVDhap0N1eW-4vG2gIoo";
wp_enqueue_script( 'ava-gmaps', $link, array( 'ava-jquery341' ), '0.0.1', true );

wp_enqueue_style( 'repubblika-style', get_stylesheet_uri(), array(), "1.0{$cacheBuster}" );