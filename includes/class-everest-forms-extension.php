<?php
/**
 * EverestForms Extension setup
 *
 * @package EverestForms_Extension
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main EverestForms Extension Class.
 *
 * @class EverestForms_Extension
 */
final class EverestForms_Extension {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin.
	 */
	private function __construct() {
		// Load plugin text domain.
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Checks with Everest Forms Pro is installed.
		if ( defined( 'EFP_VERSION' ) && version_compare( EFP_VERSION, '1.0', '>=' ) ) {
			$this->includes();

			// Hooks.
			add_action( 'everest_forms_loaded', array( $this, 'plugin_updater' ) );
		} else {
			add_action( 'admin_notices', array( $this, 'everest_forms_pro_missing_notice' ) );
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/everest-forms-extension/everest-forms-extension-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/everest-forms-extension-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'everest-forms-extension' );

		load_textdomain( 'everest-forms-extension', WP_LANG_DIR . '/everest-forms-extension/everest-forms-extension-' . $locale . '.mo' );
		load_plugin_textdomain( 'everest-forms-extension', false, plugin_basename( dirname( EVF_EXTENSION_PLUGIN_FILE ) ) . '/languages' );
	}

	/**
	 * Includes.
	 */
	private function includes() {}

	/**
	 * Plugin Updater.
	 */
	public function plugin_updater() {
		if ( function_exists( 'evf_addon_updater' ) ) {
			evf_addon_updater( EVF_EXTENSION_PLUGIN_FILE, 34, self::VERSION );
		}
	}

	/**
	 * Everest Forms Pro fallback notice.
	 */
	public function everest_forms_pro_missing_notice() {
		/* translators: %s: everest-forms-pro version */
		echo '<div class="error notice is-dismissible"><p>' . sprintf( esc_html__( 'Everest Forms Extension depends on the last version of %s or later to work!', 'everest-forms-extension' ), '<a href="https://wpeverest.com/wordpress-plugins/everest-forms/" target="_blank">' . esc_html__( 'Everest Forms Pro 1.0', 'everest-forms-extension' ) . '</a>' ) . '</p></div>';
	}
}
