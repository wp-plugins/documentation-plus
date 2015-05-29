<?php
/*
Plugin Name: Documentation Plus
Plugin URI: http://paratheme.com/items/documentation_plus-html-css3-responsive-accordion-grid-for-wordpress/
Description: Fully responsive and mobile ready accordion grid for wordpress.
Version: 2.0.1
Author: paratheme
Author URI: http://paratheme.com
License: Custom support@paratheme.com
License URI: http://paratheme.com/copyright/
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

define('documentation_plus_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('documentation_plus_plugin_dir', plugin_dir_path( __FILE__ ) );
define('documentation_plus_wp_url', 'https://wordpress.org/plugins/documentation-plus/' );
define('documentation_plus_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/documentation-plus' );
define('documentation_plus_pro_url','http://paratheme.com/' );
define('documentation_plus_demo_url', 'http://paratheme.com' );
define('documentation_plus_conatct_url', 'http://paratheme.com/contact' );
define('documentation_plus_qa_url', 'http://paratheme.com/qa/' );
define('documentation_plus_plugin_name', 'Documentation Plus' );
define('documentation_plus_share_url', 'https://wordpress.org/plugins/documentation-plus/' );
define('documentation_plus_tutorial_video_url', '//www.youtube.com/embed/h2wNFJaaY8s?rel=0' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');






function documentation_plus_paratheme_init_scripts()
	{
		
		
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script('jquery-ui-accordion');		
		wp_enqueue_script('documentation_plus_js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('documentation_plus_js', 'documentation_plus_ajax', array( 'documentation_plus_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_script('jquery.tablednd.js', plugins_url( '/js/jquery.tablednd.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('jquery-ui', documentation_plus_plugin_url.'css/jquery-ui.css');	
		wp_enqueue_style('documentation_plus_style', documentation_plus_plugin_url.'css/style.css');		
		wp_enqueue_style('font-awesome', documentation_plus_plugin_url.'css/font-awesome.css');
			
		

		if(!is_admin())
			{
			wp_enqueue_style('bootstrap.min', documentation_plus_plugin_url.'css/bootstrap.min.css');
			}
		
		
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'documentation_plus_color_picker', plugins_url('/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );



		//ParaAdmin
		wp_enqueue_style('ParaAdmin', documentation_plus_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		//wp_enqueue_style('ParaIcons', documentation_plus_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));


	}
add_action("init","documentation_plus_paratheme_init_scripts");


register_activation_hook(__FILE__, 'documentation_plus_paratheme_activation');


function documentation_plus_paratheme_activation()
	{
		$documentation_plus_version= "1.0";
		update_option('documentation_plus_version', $documentation_plus_version); //update plugin version.
		
		$documentation_plus_customer_type= "free"; //customer_type "pro"
		update_option('documentation_plus_customer_type', $documentation_plus_customer_type); //update plugin version.
		

		
		
		
		
	}


function documentation_plus_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",

				), $atts);


			$post_id = $atts['id'];


			$html = '';

			$html.= documentation_plus_html($post_id);

			return $html;


}

add_shortcode('documentation_plus', 'documentation_plus_display');









add_action('admin_menu', 'documentation_plus_paratheme_menu_init');


	
function documentation_plus_paratheme_menu_help(){
	include('documentation-plus-help.php');	
}


function documentation_plus_paratheme_menu_init()
	{
			
		add_submenu_page('edit.php?post_type=documentation', __('Help & Contact','documentation_plus'), __('Help & Contact','documentation_plus'), 'manage_options', 'documentation_plus_paratheme_menu_help', 'documentation_plus_paratheme_menu_help');
	
		

	}





?>