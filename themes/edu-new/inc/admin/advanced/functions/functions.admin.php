<?php

/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */


/**
 * Head Hook
 *
 * @since 1.0.0
 */
function of_head()
{
	do_action('of_head');
}

/**
 * Add default options upon activation else DB does not exist
 *
 * DEPRECATED, Class_options_machine now does this on load to ensure all values are set
 *
 * @since 1.0.0
 */
function of_option_setup()
{
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);

	if (!of_get_options()) {
		of_save_options($options_machine->Defaults);
	}
}

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function of_get_header_classes_array()
{
	global $of_options;

	foreach ($of_options as $value) {
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ', '', strtolower($value['name']));
	}

	return $hooks;
}

/**
 * Get options from the database and process them with the load filter hook.
 *
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @return array
 */
function of_get_options($key = null, $data = null)
{
	global $smof_data;

	do_action('of_get_options_before', array(
		'key' => $key, 'data' => $data
	));
	if ($key != null) { // Get one specific value
		$data = get_theme_mod($key, $data);
	} else { // Get all values
		$data = get_theme_mods();
	}
	$data = apply_filters('of_options_after_load', $data);
	if ($key == null) {
		$smof_data = $data;
	} else {
		$smof_data[$key] = $data;
	}
	do_action('of_option_setup_before', array(
		'key' => $key, 'data' => $data
	));
	return $data;
}

/**
 * Save options to the database after processing them
 *
 * @param $data Options array to save
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @uses update_option()
 * @return void
 */

function of_save_options($data, $key = null)
{
	global $smof_data;
	if (empty($data))
		return;
	do_action('of_save_options_before', array(
		'key' => $key, 'data' => $data
	));
	$data = apply_filters('of_options_before_save', $data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($data['smof_init']); // Don't want to change this.
		}
		set_theme_mod($key, $data);
	} else { // Update all values in $data
		foreach ($data as $k => $v) {
			if (!isset($smof_data[$k]) || $smof_data[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key => $val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
		}
	}


	do_action('of_save_options_after', array(
		'key' => $key, 'data' => $data
	));
}

/**
 * For use in themes
 *
 * @since forever
 */
$data = of_get_options();
if (!isset($smof_details)) {
	$smof_details = array();
}

// enqueue script on the user-edit.php only
function enqueue_user_edit($hook)
{
	$theme   = wp_get_theme(get_template());
	$version = $theme->get('Version');

	if ('user-edit.php' !== $hook) {
		return;
	}
	wp_enqueue_script('user-edit', ADMIN_DIR . 'assets/js/user-edit.js', array('jquery'), $version, true);
}
add_action('admin_enqueue_scripts', 'enqueue_user_edit');

function landvn_no_admin_access()
{
	if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
		wp_safe_redirect(home_url());
		exit;
	}
}
// add_action( 'admin_init', 'landvn_no_admin_access' );


/**
 * Register Google Map API for ACF
 *
 * @param $api Google Map API
 */
function my_acf_google_map_api($api)
{
	$api['key'] = 'AIzaSyAmaslg9P1CTxK8xnDOlOZ1YDJI0Le02XU';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function my_acf_init()
{
	acf_update_setting('google_api_key', 'AIzaSyAmaslg9P1CTxK8xnDOlOZ1YDJI0Le02XU');
}
add_action('acf/init', 'my_acf_init');
