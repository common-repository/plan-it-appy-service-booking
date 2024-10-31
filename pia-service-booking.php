<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://planitappy.com
 * @since             1.0.0
 * @package           Pia_Booking
 *
 * @wordpress-plugin
/*
Plugin Name: PlanItAppy Service Booking 
Plugin URI:  https://wordpress.org/plugins/plan-it-appy-service-booking/
Description: Take bookings for your Services direct from your Wordpress website.
Version:     1.2
Author:      PlanItAppy
Author URI:  https://planitappy.com
License:     GPL3
License URI: https://opensource.org/licenses/GPL-3.0
Text Domain: pia-service-booking
Domain Path: /languages

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
*/
 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pia-booking-activator.php
 */
function activate_pia_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pia-booking-activator.php';
	wp_register_style( 'namespace', '/public/css/pia-booking-public.css' );
	Pia_Booking_Activator::activate();
	wp_enqueue_style('namespace');
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pia-booking-deactivator.php
 */
function deactivate_pia_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pia-booking-deactivator.php';
	Pia_Booking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pia_booking' );
register_deactivation_hook( __FILE__, 'deactivate_pia_booking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pia-booking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function pia_run_pia_booking() {

	$plugin = new Pia_Booking();
	$plugin->run();

}
pia_run_pia_booking();



function pia_booking_display() { 

	$store_url = get_option("pia_store_url");
	$store_url = "https://" . $store_url . ".planitappy.com/classic/zBook";
	$store_url = esc_url($store_url);
	$echo_string =  '<div class="responsive_iframe"><iframe frameBorder="0" id="booking-iframe" style="width: 100%; height: 600px;" src="' . $store_url . '" ></iframe></div>';
	return $echo_string;

}

function pia_plugin_menu() {
	add_menu_page('PlanItAppy Booking Settings', 'PlanItAppy Booking Settings', 'administrator', 'pia-booking', 'pia_display_plugin_setup_page', 'dashicons-calendar-alt');
}


function pia_display_plugin_setup_page() {
	    include_once(plugin_dir_path( __FILE__ ) . 'admin/partials/pia-booking-admin-display.php' );
	}



/* Actions */




add_action('admin_menu', 'pia_plugin_menu');


/* Shortcodes */

add_shortcode('pia_booking_form', 'pia_booking_display');






