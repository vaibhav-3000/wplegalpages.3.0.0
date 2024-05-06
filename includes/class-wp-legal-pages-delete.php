<?php
/**
 * Fired during WPLegalPages deactivation
 *
 * @category   X
 * @package    WP_Legal_Pages
 * @subpackage WP_Legal_Pages/includes
 * @author     Display Name <username@example.com>
 * @copyright  2019    CyberChimps, Inc.
 * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * @link       http://wplegalpages.com/
 * @since      1.5.2
 */

/**
 * Fired during WPLegalPages deactivation.
 *
 * This class defines all code necessary to run during the WPLegalPages's deactivation.
 *
 * @package    WP_Legal_Pages
 * @subpackage WP_Legal_Pages/includes
 * @author     WPEka <support@wplegalpages.com>
 * @copyright  2019    CyberChimps, Inc.
 * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * @link       http://wplegalpages.com/
 * @since      1.5.2
 */
if (! class_exists('WP_Legal_Pages_Delete')) {
    /**
     * Fired during WPLegalPages deactivation.
     *
     * This class defines all code necessary to run during the WPLegalPages's deactivation.
     *
     * @category   X
     * @package    WP_Legal_Pages
     * @subpackage WP_Legal_Pages/includes
     * @author     WPEka <support@wplegalpages.com>
     * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
     * @link       http://wplegalpages.com/
     * @since      1.5.2
     */
    class WP_Legal_Pages_Delete
    {
        /**
         * Short Description. (use period)
         *
         * Long Description.
         *
         * @since 1.5.2
         * 
         * @return nothing
         */
        public static function delete() 
        {
            global $wpdb;
            include_once ABSPATH . 'wp-admin/includes/upgrade.php';
            if (is_multisite()) {
                // Get all blogs in the network and activate plugin on each one.
                $blog_ids = $wpdb->get_col('SELECT blog_id FROM ' . $wpdb->blogs); // db call ok; no-cache ok.
                foreach ($blog_ids as $blog_id) {
                    switch_to_blog($blog_id);
                    self::delete_db();
                    restore_current_blog();
                }
            } else {
                self::delete_db();
            }
        }

        /**
         * Delete database tables on plugin uninstall hook.
         * 
         * @return nothing
         */
        public static function delete_db() 
        {
            global $wpdb;
            include_once ABSPATH . 'wp-admin/includes/upgrade.php';
            $legal_pages = new WP_Legal_Pages();
            $drop_sql    = 'DROP TABLE IF EXISTS ' . $legal_pages->tablename;
            $wpdb->query($drop_sql); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery,WordPress.DB.DirectDatabaseQuery.NoCaching
            $drop_popup_sql = 'DROP TABLE IF EXISTS ' . $legal_pages->popuptable;
            $wpdb->query($drop_popup_sql); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared,WordPress.DB.DirectDatabaseQuery,WordPress.DB.DirectDatabaseQuery.NoCaching
            delete_option('_lp_db_updated');
            delete_option('lp_accept_terms');
            delete_option('lp_excludePage');
            delete_option('lp_general');
            delete_option('lp_accept_terms');
            delete_option('lp_eu_cookie_title');
            delete_option('lp_eu_cookie_message');
            delete_option('lp_eu_cookie_enable');
            delete_option('lp_eu_box_color');
            delete_option('lp_eu_button_color');
            delete_option('lp_eu_button_text_color');
            delete_option('lp_eu_text_color');
            delete_option('lp_eu_text_size');
            delete_option('lp_eu_link_color');
            delete_option('_lp_templates_updated');
        }

    }
}
