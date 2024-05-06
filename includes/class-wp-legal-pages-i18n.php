<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
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
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.5.2
 * @package    WP_Legal_Pages
 * @subpackage WP_Legal_Pages/includes
 * @author     WPEka <support@wplegalpages.com>
 */
if (! class_exists('WP_Legal_Pages_I18n')) {
    /**
     * Define the internationalization functionality.
     *
     * Loads and defines the internationalization files for this plugin
     * so that it is ready for translation.
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
    class WP_Legal_Pages_I18n 
    {
        /**
         * Load the plugin text domain for translation.
         *
         * @since 1.0.0
         * 
         * @return nothing
         */
        public function load_plugin_textdomain() 
        {
            load_plugin_textdomain(
                'wplegalpages',
                false,
                dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
            );

        }



    }
}
