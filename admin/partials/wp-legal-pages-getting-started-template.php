<?php

/**
 * Provide a Getting started area view for the WP Legal Pages plugin
 *
 * This file is used to markup the Getting started facing aspects of the WP Legal Pages plugin.
 *
 * @category X
 * @package  Wplegalpages
 * @author   Display Name <username@example.com>
 * @license  username@example.com X
 * @link     https://wplegalpages.com/
 * @since    2.10.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$baseurl = '';
if (isset($_SERVER['PHP_SELF'])) {
    $baseurl = esc_url_raw(wp_unslash($_SERVER['PHP_SELF']));
}

if (class_exists('WP_Legal_Pages_Admin')) {

    WP_Legal_Pages_Admin::vue_getting_started();

}
