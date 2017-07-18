<?php
/*
Plugin Name: WP Sales Notifier
Plugin URI: http://www.mrwebsolution.in/
Description: It's a very simple plugin for publish resent order notification on your site. "WP Protect Content" plugin will disable copy content.
Author: MR Web Solution
Author URI: http://raghunathgurjar.wordpress.com
Version: 1.0
*/
/**
License GPL2
Copyright 2016  MR Web Solution  (email  raghunath.0087@gmail.com)

This program is free software; you can redistribute it andor modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!class_exists('WP_Sales_Notifier'))
{
    class WP_Sales_Notifier
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
			// allow shortcode for text widget 
			add_filter('widget_text','do_shortcode');
            // register actions
			add_action('admin_init', array(&$this, 'wsn_admin_init'));
			add_action('admin_menu', array(&$this, 'wsn_add_menu'));
			add_action('init', array(&$this, 'init_wp_sales_notifier'));
			add_shortcode('wpsalesnotifier',array(&$this,'wp_sales_notifier_func'));
        } // END public function __construct
		
		/**
		* remove wp version param from any enqueued scripts
		*/
		function init_wp_sales_notifier()
		{
			if(!is_admin()){
				$wsn_enable = get_option('wsn_enable');
				if($wsn_enable){
				//add_action('wp_footer',array(&$this,'wp_sales_notifier_func'));
				add_action( 'wp_enqueue_scripts',array(&$this, 'wsn_enqueue_styles' ));
			   }
			}
		}
		
		
		/**
		 * hook into WP's admin_init action hook
		 */
		public function wsn_admin_init()
		{
			// Set up the settings for this plugin
			$this->wsn_init_settings();
			// Possibly do additional admin_init tasks
		} // END public static function activate
		/**
		 * Initialize some custom settings
		 */     
		public function wsn_init_settings()
		{
			// register the settings for this plugin
			register_setting('wsn-group', 'wsn_enable');
			register_setting('wsn-group', 'wsn_display_date');
			register_setting('wsn-group', 'wsn_delay_time');
		} // END public function init_custom_settings()
		/**
		 * add a menu
		 */     
		public function wsn_add_menu()
		{
			add_options_page('WP Sales Notifier Settings', 'WP Sales Notifier', 'manage_options', 'wp_sales_notifier', array(&$this, 'wsn_settings_page'));
		} // END public function add_menu()

		/**
		 * Menu Callback
		 */     
		public function wsn_settings_page()
		{
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}

			// Render the settings template
			include(sprintf("%s/lib/settings.php", dirname(__FILE__)));
			//include(sprintf("%s/css/admin.css", dirname(__FILE__)));
			// Style Files
			wp_register_style( 'wsn_admin_style', plugins_url( 'css/wsn-admin.css',__FILE__ ) );
			wp_enqueue_style( 'wsn_admin_style' );
			// JS files
			wp_register_script('wsn_admin_script', plugins_url('/js/wsn-admin.js',__FILE__ ), array('jquery'));
            wp_enqueue_script('wsn_admin_script');
		} // END public function plugin_settings_page()
        /**
         * Activate the plugin
         */
        public static function wsn_activate()
        {
            // Do nothing
        } // END public static function activate
    
        /**
         * Deactivate the plugin
         */     
        public static function wsn_deactivate()
        {
            // Do nothing
        } // END public static function deactivate
        
       public static function wp_sales_notifier_func($attr)
	   {
		$wsn_delay_time = get_option('wsn_delay_time') ? get_option('wsn_delay_time') : '5000';
		$wsn_display_date = get_option('wsn_display_date') ? get_option('wsn_display_date') : '';

		
		
		$html= '<div id="wpsn-slideshow">';
		$filters = array(
		'post_status' => array( 'wc-pending', 'wc-processing', 'wc-completed' ),
		'post_type' => 'shop_order',
		'posts_per_page' => 10,
		'paged' => 1,
		'orderby' => 'ID',
		'order' => 'DESC' 
		);

		$orderloop = new WP_Query($filters);
        //echo $orderloop->request; exit;
		while ($orderloop->have_posts()) {
		$orderloop->the_post();
		$order = new WC_Order($orderloop->post->ID);
		
		if(count($order->get_items()) > 0)
		{
        foreach ($order->get_items() as $key => $lineItem) {
			$html.=' <div class="wpsn-inner">';
            if(has_post_thumbnail($lineItem['product_id'])){
            $html.='<div class="wsn-image">'.get_the_post_thumbnail($lineItem['product_id'], 'thumbnail').'</div>';
		   }
            $html.='<div class="wsn-content">
                              <span class="wsn-title"><a href="'.get_the_permalink($lineItem['product_id']).'">'.$lineItem['name'].'</a></span>
                              <span class="wsn-buyer">
                                 <span>Bought by</span>
                                 '.get_post_meta($orderloop->post->ID,'_billing_first_name',true).' 
                                 from '.get_post_meta($orderloop->post->ID,'_billing_city',true).' 
                              </span>';
                              
                              if(get_option('wsn_display_date'))
                              {
                              $html.='<span class="wsn-time">
                                 <span style="font-size:80%;">'.human_time_diff(get_post_time('U',false,$lineItem['product_id']), current_time('timestamp')) . " " . __('ago').'</span>
                              </span>';
						      }   
              $html.='</div><div class="clear"></div></div>';
	
        //uncomment the following to see the full data
        //        echo '<pre>';
        //        print_r($lineItem);
        //        echo '</pre>';
        //echo '<br>' . 'Product Name : ' . $lineItem['name'] . '<br>';
       // echo 'Product ID : ' . $lineItem['product_id'] . '<br>';
        /*if ($lineItem['variation_id']) {
            echo 'Product Type : Variable Product' . '<br>';
        } else {
            echo 'Product Type : Simple Product' . '<br>';
        }*/
       }
   }
}
      
              $html.='<script tyle="javascript/text">
				 jQuery("#wpsn-slideshow > div:gt(0)").hide();
					setInterval(function() { 
					  jQuery("#wpsn-slideshow > div:first")
						.hide()
						.next()
						.show()
						.end()
						.appendTo("#wpsn-slideshow");
						/*jQuery("#wpsn-slideshow > div:first")
						.hide(500)
						.next()
						.show(500)
						.end()
						.appendTo("#wpsn-slideshow");*/
					},  '.$wsn_delay_time.');
               </script>';
               
		return $html;
		}
		
	/*-------------------------------------------------
	Start Social Share Buttons Style
	------------------------------------------------- */
	function wsn_enqueue_styles() {
	global $wp_styles;
	wp_register_style( 'wsn_style', plugins_url( 'css/wsn-style.css',__FILE__ ) );
	wp_enqueue_style( 'wsn_style' );  	
	}
	/*-------------------------------------------------
	End Social Share Buttons Style
	------------------------------------------------- */
		
		
    } // END class WP_Sales_Notifier
} // END if(!class_exists('WP_Sales_Notifier'))

if(class_exists('WP_Sales_Notifier'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('WP_Sales_Notifier', 'wsn_activate'));
    register_deactivation_hook(__FILE__, array('WP_Sales_Notifier', 'wsn_deactivate'));
    // instantiate the plugin class
    $wsn_plugin_template = new WP_Sales_Notifier();
	// Add a link to the settings page onto the plugin page
	if(isset($wsn_plugin_template))
	{
		// Add the settings link to the plugins page
		function wsn_settings_link($links)
		{ 
			$settings_link = '<a href="options-general.php?page=wp_sales_notifier">Settings</a>'; 
			array_unshift($links, $settings_link); 
			return $links; 
		}

		$plugin = plugin_basename(__FILE__); 
		add_filter("plugin_action_links_$plugin", 'wsn_settings_link');
	}
	
	/**
	* Enqueue jquery
	*
	* Tha callback is hooked to 'wp_enqueue_script' to ensure the script is only enqueued on the front-end.
	*/
	function wsn_scripts_method() {
	wp_enqueue_script( 'jquery' );
	}
	add_action( 'wp_enqueue_scripts', 'wsn_scripts_method' );
	
	
}
