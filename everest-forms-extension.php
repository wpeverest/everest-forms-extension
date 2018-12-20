<?php
/**
 * Plugin Name: Everest Forms - Extension
 * Plugin URI: https://wpeverest.com/wordpress-plugins/everest-forms/extension/
 * Description: Everest Forms extension boilerplate.
 * Version: 1.0.0
 * Author: WPEverest
 * Author URI: https://wpeverest.com
 * Text Domain: everest-forms-extension
 * Domain Path: /languages/
 * EVF requires at least: 1.4.0
 * EVF tested up to: 1.4.0
 *
 * @package EverestForms_Extension
 */

defined( 'ABSPATH' ) || exit;

// Define EVF_EXTENSION_PLUGIN_FILE.
if ( ! defined( 'EVF_EXTENSION_PLUGIN_FILE' ) ) {
	define( 'EVF_EXTENSION_PLUGIN_FILE', __FILE__ );
}

// Include the main EverestForms_Extension class.
if ( ! class_exists( 'EverestForms_Extension' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-everest-forms-extension.php';
}

// Initialize the plugin.
add_action( 'plugins_loaded', array( 'EverestForms_Extension', 'get_instance' ) );
