<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.streamweasels.com
 * @since      1.0.0
 *
 * @package    Streamweasels_Rail_Pro
 * @subpackage Streamweasels_Rail_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Streamweasels_Rail_Pro
 * @subpackage Streamweasels_Rail_Pro/admin
 * @author     StreamWeasels <admin@streamweasels.com>
 */
class Streamweasels_Rail_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->baseOptions = get_option( 'swti_options', array() );
		$this->options = swti_get_options_rail();
		$this->base = '';
		if (in_array('streamweasels-twitch-integration-pro/streamweasels.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
			$this->base = '/streamweasels-twitch-integration-pro';
		}
		if (in_array('streamweasels-twitch-integration/streamweasels.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
			$this->base = '/streamweasels-twitch-integration';
		}		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Streamweasels_Rail_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Streamweasels_Rail_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'dist/streamweasels-rail-pro-admin.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Streamweasels_Rail_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Streamweasels_Rail_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'dist/streamweasels-rail-pro-admin.min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the admin page.
	 *
	 * @since    1.0.0
	 */
	public function display_admin_page() {

		add_options_page(
			'Twitch TV Rail',
			'[StreamWeasels] Twitch Rail',
			'manage_options',
			'twitch-tv-rail',
			array($this, 'swti_showLegacyRailAdmin')
		);

		add_submenu_page(
			'streamweasels',
			'[Add-On] Rail',
			'[Add-On] Rail',
			'manage_options',
			'streamweasels-rail',
			array($this, 'swti_showAdmin')
		);		

		$tooltipArray = array(
			'Controls Background Colour'=> 'Controls Background Colour <span class="sw-shortcode-help tooltipped tooltipped-n" aria-label="rail-controls-bg-colour=\'\'"></span>',
			'Controls Arrow Colour'=> 'Controls Arrow Colour <span class="sw-shortcode-help tooltipped tooltipped-n" aria-label="rail-controls-arrow-colour=\'\'"></span>',
			'Rail Border Colour'=> 'Rail Border Colour <span class="sw-shortcode-help tooltipped tooltipped-n" aria-label="rail-border-colour=\'\'"></span>',
		);			

		register_setting( 'swti_options_rail', 'swti_options_rail', array($this, 'swti_options_validate'));	
		add_settings_section('swti_rail_shortcode_settings', 'Shortcode', false, 'swti_rail_shortcode_fields');		
		add_settings_section('swti_rail_settings', '[Add-On] Rail Settings', false, 'swti_rail_fields');
		add_settings_field('swti_rail_controls_bg_colour', $tooltipArray['Controls Background Colour'], array($this, 'swti_rail_controls_bg_colour_cb'), 'swti_rail_fields', 'swti_rail_settings');	
		add_settings_field('swti_rail_controls_arrow_colour', $tooltipArray['Controls Arrow Colour'], array($this, 'swti_rail_controls_arrow_colour_cb'), 'swti_rail_fields', 'swti_rail_settings');	
		add_settings_field('swti_rail_controls_border_colour', $tooltipArray['Rail Border Colour'], array($this, 'swti_rail_controls_border_colour_cb'), 'swti_rail_fields', 'swti_rail_settings');	
	}

	public function swti_showLegacyRailAdmin() {
		include ('partials/streamweasels-rail-pro-admin-display.php');
	}

	public function swti_showAdmin() {
		include (WP_PLUGIN_DIR.$this->base.'/admin/partials/streamweasels-admin-display.php');
	}		

	public function swti_rail_controls_bg_colour_cb() {
		$controlsBgColour = ( isset ( $this->options['swti_rail_controls_bg_colour'] ) ) ? $this->options['swti_rail_controls_bg_colour'] : '';
		?>
		
		<input type="text" id="sw-rail-controls-bg-colour" name="swti_options_rail[swti_rail_controls_bg_colour]" size='40' value="<?php echo esc_html($controlsBgColour); ?>" />

		<p>Choose the background colour of the [Add-On] Rail carousel controls.</p>

		<?php
	}

	public function swti_rail_controls_arrow_colour_cb() {
		$controlsArrowColour = ( isset ( $this->options['swti_rail_controls_arrow_colour'] ) ) ? $this->options['swti_rail_controls_arrow_colour'] : '';
		?>
		
		<input type="text" id="sw-rail-controls-arrow-colour" name="swti_options_rail[swti_rail_controls_arrow_colour]" size='40' value="<?php echo esc_html($controlsArrowColour); ?>" />

		<p>Choose the arrow colour of the [Add-On] Rail carousel controls.</p>

		<?php
	}
	
	public function swti_rail_controls_border_colour_cb() {
		$railBorderColour = ( isset ( $this->options['swti_rail_border_colour'] ) ) ? $this->options['swti_rail_border_colour'] : '';
		?>
		
		<input type="text" id="sw-rail-border-colour" name="swti_options_rail[swti_rail_border_colour]" size='40' value="<?php echo esc_html($railBorderColour); ?>" />

		<p>Choose the border colour of the [Add-On] Rail.</p>

		<?php
	}	

	public function swti_options_validate($input) {
		$new_input = [];
		$options = get_option('swti_options_rail');

		if( isset( $input['swti_rail_controls_bg_colour'] ) ) {
			$new_input['swti_rail_controls_bg_colour'] = sanitize_text_field( $input['swti_rail_controls_bg_colour'] );
		}
		
		if( isset( $input['swti_rail_controls_arrow_colour'] ) ) {
			$new_input['swti_rail_controls_arrow_colour'] = sanitize_text_field( $input['swti_rail_controls_arrow_colour'] );
		}
		
		if( isset( $input['swti_rail_border_colour'] ) ) {
			$new_input['swti_rail_border_colour'] = sanitize_text_field( $input['swti_rail_border_colour'] );
		}		

		return $new_input;
	}	


	public function swti_twitch_layout_options_pro( $options ) {
		$options['rail'] = 'Rail';
		return $options;
	}	
}

function swti_get_options_rail() {
	return get_option( 'swti_options_rail', array() );
}
