<?php

/*
 * Title Functions
 */

function main_title($title) {

	if (is_home()){
		$title = 'Welcome to TAS';
	}
	else {
		switch (get_the_title()) {
			case 'Use Cases':
				$title = __( 'USE CASES', 'tas' );
				break;
			default :
				$title = '';
		}
	}

	return $title;

}

add_filter('page_main_title', 'main_title');

function sub_title($title) {

	if (is_home()){
		$title = __('Credit Assessment Services for the Real Estate Market', 'tas');
	}
	else {
		switch (get_the_title()) {
			case 'Use Cases':
				$title = '';
				break;
			default :
				$title = '';
		}
	}

	return $title;

}

add_filter('page_sub_title', 'sub_title');

function lower_title($title) {

	if (is_home()){
		$title = __('Comprehensive risk analytics report that enable clients to make informed decisions about tenants and borrowers', 'tas');
	}
	else {
		switch (get_the_title()) {
			case 'Use Cases':
				$title = '';
				break;
			default :
				$title = '';
		}
	}

	return $title;

}

add_filter('page_lower_title', 'lower_title');

function show_buttons() {

	return is_home();

}

add_filter('page_show_nav_buttons', 'show_buttons');