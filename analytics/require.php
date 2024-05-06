<?php
/**
 * Require
 * 
 * @category  X
 * @package   Analytics
 * @author    Display Name <username@example.com>
 * @copyright 2019    CyberChimps, Inc.
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * @link      https://wplegalpages.com/
 * @since     1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Configuration should be loaded first.
require_once dirname(__FILE__).'/config.php';
require_once WP_STAT__DIR_INCLUDES . '/analytics-core-functions.php';
require_once WP_STAT__DIR_INCLUDES . '/tracking/class-analytics-tracking.php';
require_once WP_STAT__DIR_INCLUDES . '/sdk/Exceptions/Exception.php';
require_once WP_STAT__DIR_INCLUDES . '/class-analytics.php';
