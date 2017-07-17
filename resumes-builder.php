<?php
/*
Plugin Name: Resume's Builder
Plugin URI: http://paratheme.com
Description: Awesome Resume Builder.
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('resumes_builder_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('resumes_builder_plugin_dir', plugin_dir_path( __FILE__ ) );
define('resumes_builder_wp_url', 'https://wordpress.org/plugins/resumes-builder/' );
define('resumes_builder_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/resumes-builder' );
define('resumes_builder_pro_url','http://paratheme.com/' );
define('resumes_builder_demo_url', 'http://paratheme.com/demo/resumes-builder/' );
define('resumes_builder_conatct_url', 'http://paratheme.com/contact/' );
define('resumes_builder_qa_url', 'http://paratheme.com/qa/' );
define('resumes_builder_plugin_name', 'Resume\'s Builder' );
define('resumes_builder_share_url', 'https://wordpress.org/plugins/resumes-builder/' );
define('resumes_builder_tutorial_video_url', '//www.youtube.com/embed/B0sOggSp3h9fE?rel=0' );



require_once( plugin_dir_path( __FILE__ ) . 'includes/meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/ResumesBuilderClass.php');

//Themes php files

require_once( plugin_dir_path( __FILE__ ) . 'themes/flat/index.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes/blue/index.php');



function resumes_builder_init_scripts()
	{
		wp_enqueue_script('jquery');

		wp_enqueue_style('resumes_builder_style', resumes_builder_plugin_url.'css/style.css');
		wp_enqueue_script('masonry.pkgd.min', plugins_url( '/js/masonry.pkgd.min.js' , __FILE__ ) , array( 'jquery' ));
		
		wp_enqueue_style('font-awesome', resumes_builder_plugin_url.'css/font-awesome.css');
		
		//ParaAdmin
		wp_enqueue_style('ParaAdmin', resumes_builder_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		// Style for themes
		wp_enqueue_style('resumes-builder-style-flat', resumes_builder_plugin_url.'themes/flat/style.css');	
		wp_enqueue_style('resumes-builder-style-blue', resumes_builder_plugin_url.'themes/blue/style.css');				
			
		
	}
add_action("init","resumes_builder_init_scripts");



function resumes_builder_admin_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');

						
		wp_enqueue_script('resumes_builder_admin_js', plugins_url( '/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'resumes_builder_admin_js', 'resumes_builder_ajax', array( 'resumes_builder_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		
		wp_enqueue_style('resumes_builder_admin_style', resumes_builder_plugin_url.'admin/css/style.css');

		//ParaAdmin
		wp_enqueue_style('ParaAdmin', resumes_builder_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		//wp_enqueue_style('ParaIcons', resumes_builder_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
	
	
	
	}



add_action( 'admin_enqueue_scripts', 'resumes_builder_admin_scripts' );





// to work upload button on user profile
add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); 




register_activation_hook(__FILE__, 'resumes_builder_activation');


function resumes_builder_activation()
	{
		$resumes_builder_version= "1.0";
		update_option('resumes_builder_version', $resumes_builder_version); //update plugin version.
		
		$resumes_builder_customer_type= "free"; //customer_type "free"
		update_option('resumes_builder_customer_type', $resumes_builder_customer_type); //update plugin version.

	}


function resumes_builder_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'sections' => '',				

				), $atts);


			$post_id = $atts['id'];
			$sections = $atts['sections'];		

			
			$resumes_builder_theme = get_post_meta( $post_id, 'resumes_builder_theme', true );
			
			
			$html = '';
			
			
			if($resumes_builder_theme == "flat")
				{
					$html.= resumes_builder_themes_flat($post_id);
				}
			else if($resumes_builder_theme == "blue")
				{
					$html.= resumes_builder_themes_blue($post_id);
				}				
									
			else
				{
					$html.= resumes_builder_themes_flat($post_id);
				}					
							

			return $html;





}

add_shortcode('resumes_builder', 'resumes_builder_display');




add_action('admin_menu', 'resumes_builder_menu_init');

function resumes_builder_menu_help(){
	include('resumes-builder-help.php');	
}

function resumes_builder_menu_settings(){
	include('resumes-builder-settings.php');	
}



function resumes_builder_menu_init() {
	
	
	//add_submenu_page('edit.php?post_type=resumes', __('Settings','resumes_builder'), __('Settings','resumes_builder'), 'manage_options', 'resumes_builder_menu_settings', 'resumes_builder_menu_settings');
	
		
	add_submenu_page('edit.php?post_type=resumes', __('Help','resumes_builder'), __('Help','resumes_builder'), 'manage_options', 'resumes_builder_menu_help', 'resumes_builder_menu_help');

	
		

}






?>