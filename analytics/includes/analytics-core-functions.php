<?php
/**
 * Analytics Core functions.
 *
 * @category  X
 * @package   Analytics
 * @author    Display Name <username@example.com>
 * @copyright 2019    CyberChimps, Inc.
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * @link      https://wplegalpages.com/
 * @since     1.0.0
 */

if (! defined('ABSPATH')) {
    exit;
}

/*
Templates / Views.
--------------------------------------------------------------------------------------------
*/
if (! function_exists('as_get_template_path')) {
    /**
     * Get analytics template path
     *
     * @param string $path template path.
     * 
     * @return string
     */
    function asGetTemplatePath($path) 
    {
        return WP_STAT__DIR_TEMPLATES . '/' . trim($path, '/');
    }

    /**
     * Include template.
     *
     * @param string $path   Path.
     * @param null   $params Parameters.
     * 
     * @return nothing
     */
    function asIncludeTemplate($path, &$params = null) 
    {
        $VARS = &$params;
        include as_get_template_path($path);
    }

    /**
     * Include once.
     *
     * @param string $path   Path.
     * @param null   $params Parameters.
     * 
     * @return nothing
     */
    function asIncludeOnceTemplate($path, &$params = null) 
    {
        $VARS = &$params;
        include_once as_get_template_path($path);
    }

    /**
     * Require template.
     *
     * @param string $path   Path.
     * @param array  $params Parameters.
     * 
     * @return nothing
     */
    function asRequireTemplate($path, &$params = null) 
    {
        $VARS = &$params;
        include as_get_template_path($path);
    }

    /**
     * Require once.
     *
     * @param string $path   Path.
     * @param array  $params Parameters.
     * 
     * @return nothing
     */
    function asRequireOnceTemplate($path, &$params = null) 
    {
        $VARS = &$params;
        include_once as_get_template_path($path);
    }

    /**
     * Get Template.
     *
     * @param string $path   Path.
     * @param array  $params Parameters.
     * 
     * @return string
     */
    function asGetTemplate($path, &$params = null) 
    {
        ob_start();

        $VARS = &$params;
        include as_get_template_path($path);

        return ob_get_clean();
    }
}

if (! function_exists('as_request_get')) {
    /**
     * A helper method to fetch GET/POST user input.
     *
     * @param string      $key  Key.
     * @param mixed       $def  Defined.
     * @param string|bool $type Type.
     *
     * @author CyberChimps
     * 
     * @return mixed
     */
    function asRequestGet($key, $def = false, $type = false) 
    {
        if (is_string($type)) {
            $type = strtolower($type);
        }

        /**
         *  Helper method to fetch GET/POST user input.
         */
        switch ($type) {
        case 'post':
            $value = isset($_POST[ $key ]) ? sanitize_text_field(wp_unslash($_POST[ $key ])) : $def;
            break;
        case 'get':
            $value = isset($_GET[ $key ]) ? sanitize_text_field(wp_unslash($_GET[ $key ])) : $def;
            break;
        default:
            $value = isset($_REQUEST[ $key ]) ? sanitize_text_field(wp_unslash($_REQUEST[ $key ])) : $def;
            break;
        }

        return $value;
    }
}

if (! function_exists('as_request_get_bool')) {
    /**
     * Fetch GET/POST user boolean input
     *
     * @param string $key Key.
     * @param bool   $def Defined.
     * 
     * @author CyberChimps
     *
     * @return bool|mixed
     */
    function asRequestGetBool($key, $def = false) 
    {
        $val = as_request_get($key, null);

        if (is_null($val)) {
            return $def;
        }

        if (is_bool($val)) {
            return $val;
        } elseif (is_numeric($val)) {
            if (1 === $val) {
                return true;
            } elseif (0 === $val) {
                return false;
            }
        } elseif (is_string($val)) {
            $val = strtolower($val);

            if ('true' === $val) {
                return true;
            } elseif ('false' === $val) {
                return false;
            }
        }

        return $def;
    }
}

if (! function_exists('as_get_raw_referer')) {
    /**
     * Retrieves unvalidated referer from '_wp_http_referer'
     *
     * @since 1.0.0
     *
     * @return string|false Referer URL on success, false on failure.
     */
    function asGetRawReferer() 
    {
        if (function_exists('wp_get_raw_referer')) {
            return wp_get_raw_referer();
        }
        if (! empty($_REQUEST['_wp_http_referer'])) {
            return wp_unslash($_REQUEST['_wp_http_referer']);
        } elseif (! empty($_SERVER['HTTP_REFERER'])) {
            return wp_unslash($_SERVER['HTTP_REFERER']);
        }

        return false;
    }
}

if (! function_exists('as_asset_url')) {
    /**
     * Generates an absolute URL to the given path. This function ensures that the URL will be correct whether the asset
     * is inside a plugin's folder or a theme's folder.
     *
     * @param string $asset_abs_path Asset's absolute path.
     * 
     * @author CyberChimps
     * @since  1.0.0
     *
     * @return string Asset's URL.
     */
    function asAssetUrl($asset_abs_path) 
    {
        $wp_content_dir = as_normalize_path(WP_CONTENT_DIR);
        $asset_abs_path = as_normalize_path($asset_abs_path);

        if (0 === strpos($asset_abs_path, $wp_content_dir)) {
            // Handle both theme and plugin assets located in the standard directories.
            $asset_rel_path = str_replace($wp_content_dir, '', $asset_abs_path);
            $asset_url      = content_url(as_normalize_path($asset_rel_path));
        } else {
            $wp_plugins_dir = as_normalize_path(WP_PLUGIN_DIR);
            if (0 === strpos($asset_abs_path, $wp_plugins_dir)) {
                // Try to handle plugin assets that may be located in a non-standard plugins directory.
                $asset_rel_path = str_replace($wp_plugins_dir, '', $asset_abs_path);
                $asset_url      = plugins_url(as_normalize_path($asset_rel_path));
            } else {
                // Try to handle theme assets that may be located in a non-standard themes directory.
                $active_theme_stylesheet = get_stylesheet();
                $wp_themes_dir           = as_normalize_path(trailingslashit(get_theme_root($active_theme_stylesheet)));
                $asset_rel_path          = str_replace($wp_themes_dir, '', as_normalize_path($asset_abs_path));
                $asset_url               = trailingslashit(get_theme_root_uri($active_theme_stylesheet)) . as_normalize_path($asset_rel_path);
            }
        }

        return $asset_url;
    }
}

if (! function_exists('as_enqueue_local_style')) {
    /**
     * Enqueue Local style.
     *
     * @param string $handle Handle.
     * @param string $path   Path.
     * @param array  $deps   Dependencies.
     * @param bool   $ver    Version.
     * @param string $media  Media.
     * 
     * @return nothing
     */
    function asEnqueueLocalStyle($handle, $path, $deps = array(), $ver = false, $media = 'all') 
    {
        wp_enqueue_style($handle, as_asset_url(WP_STAT__DIR_CSS . '/' . trim($path, '/')), $deps, '1.2.2', $media);
    }
}

if (! function_exists('_as_text_inline')) {
    /**
     * Retrieve an inline translated text by key.
     *
     * @param string $text Translatable string.
     * @param string $key  String key for overrides.
     * @param string $slug Module slug for overrides.
     *
     * @author CyberChimps
     * @since  1.0.1
     * @return string
     *
     * @global $fs_text_overrides
     */
    function _asTextInline($text, $key = '', $slug = 'analytics') 
    {
        list($text, $text_domain) = as_text_and_domain($text, $key, $slug);

        // Avoid misleading Theme Check warning.
        $fn = 'translate';

        return $fn($text, $text_domain);
    }
}

if (! function_exists('as_text_and_domain')) {
    /**
     * Get a translatable text and its text domain.
     *
     * @param string $text Translatable string.
     * @param string $key  String key for overrides.
     * @param string $slug Module slug for overrides.
     *
     * @author CyberChimps
     * @since  1.0.1
     * @return string[]
     */
    function asTextAndDomain($text, $key, $slug) 
    {
        $override = as_text_override($text, $key, $slug);

        if (false === $override) {
            // No override, use FS text domain.
            $text_domain = 'analytics';
        } else {
            // Found an override.
            $text = $override;
            // Use the module's text domain.
            $text_domain = $slug;
        }

        return array($text, $text_domain);
    }
}
if (! function_exists('as_text_override')) {
    /**
     * Get a translatable text override if exists, or `false`.
     *
     * @param string $text Translatable string.
     * @param string $key  String key for overrides.
     * @param string $slug Module slug for overrides.
     * 
     * @author CyberChimps
     * @since  1.0.1
     * @return string|false
     */
    function asTextOverride($text, $key, $slug) 
    {
        global $as_text_overrides;

        /**
         * Check if string is overridden.
         */
        if (! isset($as_text_overrides[ $slug ])) {
            return false;
        }

        if (empty($key)) {
            $key = strtolower(str_replace(' ', '-', $text));
        }

        if (isset($as_text_overrides[ $slug ][ $key ])) {
            return $as_text_overrides[ $slug ][ $key ];
        }

        $lower_key = strtolower($key);
        if (isset($as_text_overrides[ $slug ][ $lower_key ])) {
            return $as_text_overrides[ $slug ][ $lower_key ];
        }

        return false;
    }
}
if (! function_exists('as_enqueue_local_script')) {
    /**
     * Get a translatable text override if exists, or `false`.
     *
     * @param string $handle    handle
     * @param string $path      path
     * @param array  $deps      deps
     * @param bool   $ver       ver
     * @param string $in_footer in footer
     * 
     * @author CyberChimps
     * @since  1.0.1
     * @return string|false
     */
    function asEnqueueLocalScript($handle, $path, $deps = array(), $ver = false, $in_footer = 'all')
    {
        wp_enqueue_script($handle, as_asset_url(WP_STAT__DIR_JS . '/' . trim($path, '/')), $deps, $ver, $in_footer);
    }
}

if (! function_exists('as_text_inline')) {
    /**
     * Retrieve an inline translated text by key.
     *
     * @param string $text Translatable string.
     * @param string $key  String key for overrides.
     * @param string $slug Module slug for overrides.
     *
     * @author CyberChimps
     * @since  1.0.1
     * @return string
     *
     * @global $fs_text_overrides
     */
    function asTextInline($text, $key = '', $slug = 'analytics') 
    {
        return _as_text_inline($text, $key, $slug);
    }
}

/**
 * Retrieve an inline translated text by key with a context.
 *
 * @param string $text    Translatable string.
 * @param string $context Context information for the translators.
 * @param string $key     String key for overrides.
 * @param string $slug    Module slug for overrides.
 * 
 * @author CyberChimps
 * @since  1.0.1
 *
 * @return string
 *
 * @global $fs_text_overrides
 */
function _asTextXInline($text, $context, $key = '', $slug = 'analytics') 
{
    list($text, $text_domain) = as_text_and_domain($text, $key, $slug);

    // Avoid misleading Theme Check warning.
    $fn = 'translate_with_gettext_context';

    return $fn($text, $context, $text_domain);
}

/**
 * Retrieve an inline translated text by key with a context.
 *
 * @param string $text    Translatable string.
 * @param string $context Context information for the translators.
 * @param string $key     String key for overrides.
 * @param string $slug    Module slug for overrides.
 *
 * @author CyberChimps
 * @since  1.0.1
 * @return string
 *
 * @global $fs_text_overrides
 */
function asTextXInline($text, $context, $key = '', $slug = 'analytics') 
{
    return _as_text_x_inline($text, $context, $key, $slug);
}

if (! function_exists('as_esc_html_echo_x_inline')) {
    /**
     * If function does not exist
     * 
     * @param string $text    Translatable string.
     * @param string $context Context information for the translators.
     * @param string $key     String key for overrides.
     * @param string $slug    Module slug for overrides.
     * 
     * @author CyberChimps
     * @since  1.0.1
     * 
     * @return nothing
     */
    function asEscHtmlEchoXInline($text, $context, $key = '', $slug = 'analytics') 
    {
        echo esc_html(_as_text_x_inline($text, $context, $key, $slug));
    }
}

if (! function_exists('as_sort_by_priority')) {
    /**
     * Sorts an array by the value of the priority key.
     * 
     * @param array $a array
     * @param array $b array
     *
     * @author CyberChimps
     * @since  1.0.1
     * 
     * @return int
     */
    function asSortByPriority($a, $b) 
    {

        // If b has a priority and a does not, b wins.
        if (! isset($a['priority']) && isset($b['priority'])) {
            return 1;
        } elseif (isset($a['priority']) && ! isset($b['priority'])) { // If b has a priority and a does not, b wins.
            return - 1;
        } elseif ((! isset($a['priority']) && ! isset($b['priority'])) || $a['priority'] === $b['priority']) { // If neither has a priority or both priorities are equal its a tie.
            return 0;
        }

        // If both have priority return the winner.
        return ($a['priority'] < $b['priority']) ? - 1 : 1;
    }
}
if (! function_exists('as_esc_html_echo_inline')) {
    /**
     * If function does not exist
     * 
     * @param string $text Translatable string.
     * @param string $key  String key for overrides.
     * @param string $slug Module slug for overrides.
     * 
     * @author CyberChimps
     * @since  1.0.1
     * 
     * @return nothing
     */
    function asEscHtmlEchoInline($text, $key = '', $slug = 'analytics') 
    {
        echo esc_html(_as_text_inline($text, $key, $slug));
    }
}

/**
 * Output an inline translated text.
 *
 * @param string $text Translatable string.
 * @param string $key  String key for overrides.
 * @param string $slug Module slug for overrides.
 * 
 * @author CyberChimps
 * @since  1.0.1
 * 
 * @return nothing
 */
function asEchoInline($text, $key = '', $slug = 'analytics') 
{
    echo _as_text_inline($text, $key, $slug);
}

if (! function_exists('as_apply_filter')) {
    /**
     * Apply filter for specific plugin.
     *
     * @param string $module_unique_affix Module's unique affix.
     * @param string $tag                 The name of the filter hook.
     * @param mixed  $value               The value on which the filters hooked to `$tag` are applied on.
     *
     * @author CyberChimps
     * @since  1.0.1
     * 
     * @return mixed The filtered value after all hooked functions are applied to it.
     *
     * @uses apply_filters()
     */
    function asApplyFilter($module_unique_affix, $tag, $value) 
    {
        $args = func_get_args();

        return call_user_func_array(
            'apply_filters',
            array_merge(
                array("as_{$tag}_{$module_unique_affix}"),
                array_slice($args, 2)
            )
        );
    }
}
