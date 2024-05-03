<?php

/**
 * Provide a Getting started area view for the WP Legal Pages plugin
 *
 * This file is used to markup the Getting started facing aspects of the WP Legal Pages plugin.
 *
 * @link       https://wplegalpages.com/
 * @since      2.10.0
 *
 * @package Wplegalpages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$baseurl = '';
if ( isset( $_SERVER['PHP_SELF'] ) ) {
	$baseurl = esc_url_raw( wp_unslash( $_SERVER['PHP_SELF'] ) );
}

if ( class_exists( 'WP_Legal_Pages_Admin' ) ) {

	WP_Legal_Pages_Admin::vue_getting_started();

}
