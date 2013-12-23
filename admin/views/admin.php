<?php
/**
 * Plugin Name.
 *
 * @package   Wp_Mcs_Admin
 * @author    Aaron Lee <aaron.lee@buooy.com>
 * @license   GPL-2.0+
 * @link      http://buooy.com
 * @copyright 2013 Buooy
 */

/**
 *
 * @package Wp_Mcs_Admin
 * @author    Aaron Lee <aaron.lee@buooy.com>
 */
?>


<?php
Class Wp_Mcs_Admin_View{

	private $tabs 		= array(
								"General",
								"Add Ons"
							);
	private $tabs_key	= array();

	private $general_settings_key = 'my_general_settings';
	private $advanced_settings_key = 'my_advanced_settings';

	private $plugin_options_key = 'my_plugin_options';
	private $plugin_settings_tabs = array();


	public function __construct(){
		
		foreach( $this->tabs as $tab ){
			$this->tabs_key[ $this->clti( $tab ) ] = $tab;
		}

		add_action( 'admin_init', array( $this, 'register_settings_general' ) );

	}

	private function clti( $string ){
		return preg_replace('/[^\da-z]/i', '_', $string);
	}

	// --------------------------------------------------------------------
	// Displays the page
	// --------------------------------------------------------------------
	public function display_page(){

		$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $this->tabs[0];
	    ?>
	    <div class="wrap">
	        <?php $this->display_tabs(); ?>
	        <form method="post" action="options.php">
	            <?php wp_nonce_field( 'update-options' ); ?>
	            <?php settings_fields( $tab ); ?>
	            <?php do_settings_sections( $tab ); ?>
	            <?php submit_button(); ?>
	        </form>
	    </div>
	    <?php
	}

	// --------------------------------------------------------------------
	// Displays the different tabs
	// --------------------------------------------------------------------
	public function display_tabs(){
		$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $this->tabs[0];

	    screen_icon();
	    echo '<h2 class="nav-tab-wrapper">';
	    foreach ( $this->tabs_key as $tab_key => $tab_caption ) {
	        $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
	        echo '<a class="nav-tab ' . $active . '" href="?page=' . 'wp-mcs' . '&tab=' . $tab_key . '">' . $tab_caption . '</a>';
	    }
	    echo '</h2>';
	}


	// --------------------------------------------------------------------
	// Registers The General Settings Tabs
	// --------------------------------------------------------------------
	public function register_settings_general(){
	
		$settings_key 		= 	'General';
		$section_key		=	'section_general';
		$section_heading	=	'General Plugin Settings';


		register_setting( $settings_key, $settings_key );
	    add_settings_section( $section_key, $section_heading, array( $this, 'section_general_callback' ), $settings_key );

	    // Adds the settings field
	    add_settings_field( 'general_option_logo', 'Add a Logo', array( $this, 'field_general_option_logo' ), $settings_key, $section_key );
		
	}
	public function section_general_callback(){
		echo "";
	}
	public function field_general_option_logo(){
		$wp_mcs_options = get_option( 'wp-mcs-logo' );  
	    ?>  
	        <input type="text" id="logo_url" name="wp_mcs_options[logo]" value="<?php echo esc_url( $wp_mcs_options['logo'] ); ?>" />  
	        <input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload', 'wp_mcs' ); ?>" />  
	        <span class="description"><?php _e('Upload an image for the logo', 'wp_mcs_options' ); ?></span>  
	    <?php
	} 
}
?>