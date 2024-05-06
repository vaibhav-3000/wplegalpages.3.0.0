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
 * @since      1.5.2
 * @package    WP_Legal_Pages
 * @subpackage WP_Legal_Pages/includes
 * @author     WPEka <support@wplegalpages.com>
 */
if (! class_exists('WP_Legal_Pages_Deactivator')) {
    /**
     * Fired during WPLegalPages deactivation.
     *
     * This class defines all code necessary to run during the WPLegalPages's deactivation.
     *
     * @category   X
     * @package    WP_Legal_Pages
     * @subpackage WP_Legal_Pages/includes
     * @author     WPEka <support@wplegalpages.com>
     * @copyright  2019    CyberChimps, Inc.
     * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
     * @link       http://wplegalpages.com/
     * @since      1.5.2
     */
    class WP_Legal_Pages_Deactivator 
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
        public static function deactivate() 
        {
            global $wpdb;
            include_once ABSPATH . 'wp-admin/includes/upgrade.php';
            if (is_multisite()) {
                // Get all blogs in the network and activate plugin on each one.
                $blog_ids = $wpdb->get_col('SELECT blog_id FROM ' . $wpdb->blogs); // db call ok; no-cache ok.
                foreach ($blog_ids as $blog_id) {
                    switch_to_blog($blog_id);
                    delete_option('_lp_db_updated');
                    delete_option('_lp_terms_updated');
                    delete_option('_lp_terms_fr_de_updated');
                    delete_option('lp_accept_terms');
                    restore_current_blog();
                }
            } else {
                delete_option('_lp_db_updated');
                delete_option('_lp_terms_updated');
                delete_option('_lp_terms_fr_de_updated');
                delete_option('lp_accept_terms');
            }
        }

    }
}
