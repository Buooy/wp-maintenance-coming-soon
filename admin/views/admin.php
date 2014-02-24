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

Class Wp_Mcs_Admin_View{

	private $plugin_url;
	private $plugin_dir;
	private $mcs_themes;

	public function __construct(){
		
		$this->plugin_url = plugins_url('', dirname( dirname( __FILE__ ) ));
		$this->plugin_dir = dirname( dirname( dirname(__FILE__) ) );
		$this->mcs_themes = array();

		// Build the themes info
		$this->build_themes_info();
	}

	// --------------------------------------------------------------------
	// Builds the themes information
	// --------------------------------------------------------------------
	private function build_themes_info(){

		$directories = glob($this->plugin_dir . '/themes/*' , GLOB_ONLYDIR);
		foreach($directories as $directory){

			// Get the folder name
			$array 			= explode('/',$directory);
			$folder_name 	= $array[count($array)-1];

			$theme_info = array();

			// Read the readme file
			$theme_info_lines = file($directory.'/readme.txt', FILE_IGNORE_NEW_LINES);

			foreach( $theme_info_lines as $theme_info_line ){
				$theme_info_array = array();
				$theme_info_array = explode(':', $theme_info_line);
				$theme_info_array[0] = ltrim($theme_info_array[0]);
				$theme_info_array[1] = ltrim($theme_info_array[1]);

				if($theme_info_array[0] == 'Theme Screen'){
					$theme_info[$theme_info_array[0]] = $this->plugin_url.'/themes'.'/'.$folder_name.'/'.$theme_info_array[1];
				}
				else{
					$theme_info[$theme_info_array[0]] = $theme_info_array[1];
				}
			}
			$theme_info['Theme ID'] = $folder_name;

			array_push($this->mcs_themes, $theme_info);
		}

	}

	private function clti( $string ){
		return preg_replace('/[^\da-z]/i', '_', $string);
	}

	// --------------------------------------------------------------------
	// Displays the page
	// --------------------------------------------------------------------
	public function display_page(){

		// variable names
		$mode_types = array(
						'deactivated'	=>	'Deactivated',
						'maintenance'	=>	'Maintenance',
						'comingsoon'	=>	'Coming Soon',
						'redirect'		=>	'URL Redirect'
						);
		$wp_mcs_mode = 'wp_mcs_mode';
		$wp_mcs_theme = 'wp_mcs_theme';
		$wp_mcs_redirect = 'wp_mcs_redirect';
		$wp_mcs_deadline = 'wp_mcs_deadline';
		$wp_mcs_access_code = 'wp_mcs_access_code';

		// options
		$option_mode = get_option($wp_mcs_mode);
		$option_theme = get_option($wp_mcs_theme);
		$option_redirect = get_option($wp_mcs_redirect);
		$option_deadline = get_option($wp_mcs_deadline);
		$option_access_code	 = get_option($wp_mcs_access_code);

		// Create Admin
		echo "<div class='wrap'>";

			echo "<div class='row'>";
			echo "<div class='col-md-12'><h2>Maintenance & Coming Soon</h2></div>";
			echo "</div>"; // ROW

			echo "<form id='update-wp-mcs' class='form-horizontal' role='form' action='' method='POST'>";

				echo "<div class='row'>";
				echo '
					<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#mode" data-toggle="tab">Mode</a></li>
						<li class=""><a href="#main_settings" data-toggle="tab">Settings</a></li>
					</ul>
					</div>
				';
				echo "</div>";

				echo "<div class='row'><div class='col-md-12'>&nbsp;</div>";

				wp_nonce_field( 'update-wp-mcs' );
				echo "<input type='hidden' name='action' value='wp_mcs'>";

				echo '<div class="tab-content col-md-12">';
					//	=============================================================
					//	MODE
					//	=============================================================
					echo '<div class="tab-pane active" id="mode">';
						echo "<div class='col-md-3' id='settings-mode'>";
							
							foreach($mode_types as $key=>$value){

								if( ($option_mode == $key) || ( ($key=='deactivated') && (!in_array($option_mode, $mode_types, TRUE) ) ) ){
									$selected = 'checked';
								}

								echo "<div class='mode'><input type='radio' name='wp-mcs-type' ".$selected." value='".$key."'> ".$value."</div>";

								$selected = '';
							}
							
						echo "</div>";


						//	=============================================================
						//	Settings
						//	=============================================================
						echo "<div class='col-md-9' id='settings-option'>";
							
							// Redirect
							echo "<div id='settings-option-redirect'>";
								echo "<h3>URL to be redirected to:&nbsp;&nbsp;&nbsp;<input type='text' id='wp-mcs-redirect' name='wp-mcs-redirect' value='".$option_redirect."'/></h3>";
								echo "<p>Enter the url of the website that you want to redirect visitors to. e.g. http://example.com</p>";
							echo "</div>";

							// Change the Theme
							echo "<div id='settings-option-theme'>";

								echo "<h3>Choose a Theme:</h3>";
								echo "<select id='wp-mcs-theme' name='wp-mcs-theme'>";

									foreach($this->mcs_themes as $mcs_theme){
										
										if( $mcs_theme['Theme ID'] == $option_theme ){
											$selected = 'selected';
										}


										echo "<option ".$selected;
										echo " value='".$mcs_theme['Theme ID']."'";
										echo " data-name='".$mcs_theme['Theme Name']."'";
										echo " data-description='".$mcs_theme['Theme Description']."'";
										echo " data-screen='".$mcs_theme['Theme Screen']."'";
										echo ">";

										echo $mcs_theme['Theme Name'];
										echo "</option>";

										$selected = '';
									}
								echo "</select>";

								echo "<hr>";

								echo "<div id='theme_container'>";
									echo "<h3 id='theme_name'></h3>";
									echo "<p id='theme_description'></p>";
									echo "<br>";
									echo "<div><img id='theme_screen' src=''></div>";
								echo "</div>";
							echo "</div>";

						echo "</div>";

					echo '</div>';	// tab-pane: MODE

					//	=============================================================
					//	MAIN SETTINGS
					//	=============================================================
					echo '<div class="tab-pane" id="main_settings">';
						echo "<div class='col-md-6' id=''>";

							echo "<h3>Deadline: </h3>";
							echo "<input type='text' id='datepicker' name='wp-mcs-deadline' value='".$option_deadline."'>";

							echo "<hr>";

						echo "</div>";

						echo "<div class='col-md-6' id=''>";

							echo "<h3>Access Code: </h3>";
							echo "<input type='text' id='access_code' name='wp-mcs-access-code' value='".$option_access_code."'>";

							echo "<hr>";

						echo "</div>";
					echo '</div>'; 	// tab-pane: Main Settings


				echo "</div>"; 	// TAB CONTENT
				
				echo "</div>";	// ROW


				//	=============================================================
				//	Save Changes
				//	=============================================================
				echo "<div class='row'>";
					echo "<div class='col-md-12'>";
						submit_button('Save Changes');
					echo "</div>";
				echo "</div>";

			echo "</form>";

		echo "</div><!-- wrap -->";

	}
}
?>