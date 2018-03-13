<?php
/**
 * Plugin Name: Everest Forms Extension
 * Plugin URI: https://gitlab.com/wpeverest/everest-forms-extension
 * Description: Everest Forms extension boilerplate.
 * Version: 1.0.0
 * Author: WPEverest
 * Author URI: https://wpeverest.com
 * Text Domain: everest-forms-extension
 * Domain Path: /languages/
 *
 * @package EverestForms_Extension
 */

defined( 'ABSPATH' ) || exit;

// Define EFP_PLUGIN_FILE.
if ( ! defined( 'EVF_EXTENSION_PLUGIN_FILE' ) ) {
	define( 'EVF_EXTENSION_PLUGIN_FILE', __FILE__ );
}

// Include the main EverestForms_Extension class.
if ( ! class_exists( 'EverestForms_Extension' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-everestforms-extension.php';
}

// Initialize the plugin.
add_action( 'plugins_loaded', array( 'EverestForms_Extension', 'get_instance' ) );
