<?php

function modify_login_form() {
	wp_enqueue_style( 'admin_form_css', get_stylesheet_directory_uri() . '/login.css', false, '1.0.0' );
} add_action( 'login_enqueue_scripts', 'modify_login_form', 10, 1 );