<?php

/**
 * 
 * Diese Datei bindet WP-konform den Stylesheet (CSS) und die JS-Datei ein, damit sie beim Aufrufen der Seite verfügbar sind.
 * js/pm24-shortcodes-public.js
 * css/pm24-shortcodes-public.css
 *
 * @link       projektmanagement24.de
 * @since      1.0.1
 *
 * @package    pm24_shortcodes
 * @subpackage pm24_shortcodes/public
 */




// function pm24sc_enqueue_styles_and_scripts()
// {
// 	global $post;

// 	//wenn post oder page den shortcode enthalten
// 	if (is_a($post, 'WP_Post') && (strpos($post->post_content, '[pm24-list') || strpos($post->post_content, '[pm24-single'))) {

// 		//lade css
// 		wp_enqueue_style(pm24_shortcodes_NAME, plugin_dir_url(__FILE__) . 'css/pm24-shortcodes-public.css', array(), pm24_shortcodes_VERSION, 'all');
// 		//lade js
// 		wp_enqueue_script(pm24_shortcodes_NAME, plugin_dir_url(__FILE__) . 'js/pm24-shortcodes-public.js', array('jquery'), pm24_shortcodes_VERSION, false);
// 	}
// }
// add_action('wp_register_script', 'pm24sc_enqueue_styles_and_scripts', 9999);




/**
 * Lade den Stylesheet und JS Scripts für die Templateausgabe, wenn der Shortcode im Beitrag oder auf einer Seite vorkommt.
 *
 * @since    1.0.0
 */

function pm24sc_enqueue_styles_and_scripts()
{
	
		//lade css
		wp_enqueue_style(pm24_shortcodes_NAME, plugin_dir_url(__FILE__) . 'css/pm24-shortcodes-public.css', array(), pm24_shortcodes_VERSION, 'all');
		//lade js
		wp_enqueue_script(pm24_shortcodes_NAME, plugin_dir_url(__FILE__) . 'js/pm24-shortcodes-public.js', array('jquery'), pm24_shortcodes_VERSION, false);

}
add_action('wp_enqueue_scripts', 'pm24sc_enqueue_styles_and_scripts', 9999);