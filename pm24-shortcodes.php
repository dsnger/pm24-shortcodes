<?php

/**
 * Das pm24-shortcodes-Plugin
 *
 * Diese Datei wird von WordPress gelesen, um das Plugin zu initialisieren und zu laden. Damit stehen alle Plugin-Funktionen in WP uzur * Verfügung. Diese Datei enthält auch alle vom Plugin verwendeten Abhängigkeiten und definiert die Funktion, die das Plugin startet.
 *
 * @link              projektmanagement24.de
 * @since             1.1.1
 * @package           pm24_shortcodes_dev
 *
 * @wordpress-plugin
 * Plugin Name:       Projektmanagement24 Shortcodes Dev
 * Plugin URI:        projektmanagement24.de
 * Description:       Plugin for Projektmanagement24.de PM24-Produkte Shortcodes zur Ausgabe in verschiedenen Listen- und Single-Templates
 * Version:           1.1.1
 * Author:            Daniel Sänger
 * Author URI:        projektmanagement24.de
 * Text Domain:       pm24_shortcodes
 * Domain Path:       /languages
 */

// SICHERHEIT: Diese Datei kann nicht direkt aufgerufen werden!
if (!defined('WPINC')) {
	die;
}


/**
 * Plugin Version.
 */
define('pm24_shortcodes_VERSION', '1.0.2');
define('pm24_shortcodes_NAME', 'pm24-shortcodes');

/**
 * 
 * PFADE DEFINIEREN: Definierte Konstanten für wichtige Pfade innerhalb des Plugins
 * 
 * PM24SC_PLUGIN_PATH
 * PM24SC_PATH_PUBLIC
 * PM24SC_PATH_TEMPLATES
 * PM24SC_PATH_IMG
 * PM24SC_PATH_ICONS
 * 
 * @since    1.0.0
 */

//Basispfad des Plugins
define('PM24SC_PLUGIN_PATH', plugin_dir_path(__FILE__) );

//Pfad zum Public-Ordner - Alles für die Ausgabe im Frontend, z. B. CSS, JS und Templates
define('PM24SC_PATH_PUBLIC', PM24SC_PLUGIN_PATH . 'public');

//um diese Datei übersichtlich zu halten, werden Funktionen in andere Dateien im /include Ordner ausgelagert
define('PM24SC_PATH_INC', PM24SC_PLUGIN_PATH . 'include');

//Pfad zu den Template-Teilen
define('PM24SC_PATH_TEMPLATES', PM24SC_PATH_PUBLIC . '/template-parts');

//Pfade zu Bildern und Icons
define('PM24SC_PATH_IMG', plugin_dir_url( __FILE__ ) . 'assets/img');
define('PM24SC_PATH_ICONS', plugin_dir_url(__FILE__) . 'assets/icons');



/**
 * 
 * ABHÄNGIGE DATEIEN: 
 * - Inkludiere alle Funktionsdateien aus dem /include Ordner 
 * - und die Funktionsdatei für die Ausgabe aus den /public Ordner 
 * 
 * @since    1.0.0
 */
require_once(PM24SC_PATH_INC.'/pm24-shortcodes-shortcodes.php');
require_once(PM24SC_PATH_INC . '/pm24-shortcodes-template-func.php');
require_once(PM24SC_PATH_PUBLIC . '/pm24-shortcodes-public.php');


/**
 * 
 * WICHTIG: ACF VORHANDEN?:
 * Dieses Plugin braucht das Plugin ACF PRO (https://www.advancedcustomfields.com/)
 * Es kann nur aktiviert werden, wenn ACF ebenfalls vorhanden ist. Das wird direkt beim initieren des Adminbereiches gecheckt.
 * 
 * @since    1.0.0
 */

add_action('admin_init', 'pm24sc_acf_digimember_plugin_not_exists');
function pm24sc_acf_digimember_plugin_not_exists()
{
	//Wenn User Admin ist und Plugins managen darf, aber ACF ist NICHT aktiv/vorhanden...
	if (is_admin() && current_user_can('activate_plugins') && (!is_plugin_active('advanced-custom-fields-pro/acf.php') || !is_plugin_active('digimember/digimember.php'))) {
		//gib die Fehlermeldung aus (s. unten) und...
		add_action('admin_notices', 'pm24sc_acf_digimember_plugin_required_notice');
		
		//..deaktiviere das Plugin hier
		deactivate_plugins(plugin_basename(__FILE__));
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}
	}
}


/**
 * Falls ACF NICHT VORHANDEN?
 * Fehlermeldung zur Funktion oben. Ausgabe wenn ACF nicht vorhanden ist.
 * @since    1.0.0
 * @used by pm24sc_acf_plugin_not_exists()
 */

function pm24sc_acf_digimember_plugin_required_notice()
{
	echo '<div class="error"><p>';
	printf(
		'Sorry, aber %1$s benötigt das ACF PRO-Plugin (<a href="https://www.advancedcustomfields.com/" target="_blank">https://www.advancedcustomfields.com/</a>) und das Digimember-Plugin (<a href="https://digimember.de/" target="_blank">https://digimember.de/</a>) um installiert bzw. aktiviert werden zu können.',
		'Projektmanagement24 Shortcodes-Plugin'
	);
	echo '</p></div>';
}



/**
 * 
 * SONDERFUNKTION ACF BILD ALS FEATURED IMAGE
 * Wenn ein Produktbild in pm24_produkte-Post hochgeladen wird, kann es gleichzeitig als Featured Image gespeichert werden
 * @since    1.0.0
 * 
 */

function pm24sc_post_set_acf_featured_image($value, $post_id)
{

	$has_thumbnail = get_the_post_thumbnail($post_id);

	//Erstelle Post Featured Image von ACF Feld.
	if (!empty(get_field('pm24_product_featured_img', $post_id))) {

		//acf img field must return the id
		$image_id = get_field('pm24_product_img', $post_id);

		if ($image_id) {
			// delete_post_meta($post_id, '_thumbnail_id');
			set_post_thumbnail($post_id, $image_id);
		}
	} else {
		//reset checkbox
		update_field('pm24_product_featured_img', 0, $post_id);
	}
}
//set featured image from acf field
add_action('save_post', 'pm24sc_post_set_acf_featured_image', 99, 3);




/**
 * 
 * CUSTOM POST TYPE?
 * Plugin braucht den "pm24_produkte" Custom Post Type
 * Es kann nur aktiviert werden, wenn dieser ebenfalls vorhanden ist. Das wird direkt beim initieren des Adminbereiches gecheckt.
 * 
 * @since    1.0.0
 */
add_action('admin_init', 'pm24sc_pm24_produkte_post_type_not_exists');
function pm24sc_pm24_produkte_post_type_not_exists()
{
	//wenn user admin ist und plugins managen darf, aber ACF ist nicht aktiv...
	if (is_admin() && current_user_can('activate_plugins') &&  !post_type_exists('pm24_produkte')) {
		//gib die Fehlermeldung aus (s. unten) und deaktiviere das Plugin hier
		add_action('admin_notices', 'pm24sc_pm24_produkte_post_type_required_notice');
		deactivate_plugins(plugin_basename(__FILE__));

		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}
	}
}


/**
 * 
 * CUSTOM POST TYPE NICHT VORHANDEN?
 * Fehlermeldung zur Funktion oben. Ausgabe wenn PM24_produkte nicht vorhanden ist.
 * @since    1.0.0
 * @used by pm24sc_pm24_produkte_post_type_not_exists()
 * 
 */

function pm24sc_pm24_produkte_post_type_required_notice()
{
	echo '<div class="error"><p>';
	printf(
		'Sorry, aber %1$s benötigt den Custom Post Type "pm24_produkte" um installiert bzw. aktiviert werden zu können. Erstelle einen Post Type z. B. mit dem Plugin CPT UI.',
		'Projektmanagement24 Shortcode-Plugin'
	);
	echo '</p></div>';
}



/**
 * 
 * WARNHINWEIS BEI DEAKTIVIERUNG!
 * 
 * @since    1.0.0
 * 
 */

function pm24sc_plugin_deactivate()
{
	echo '<div class="warning"><p>';
	printf(
		'Achtung, alle PM24-Shortcodes funktionieren nicht mehr, wenn dieses Plugin PM24-Shortcodes deaktiviert ist.',
		'Projektmanagement24 Shortcode-Plugin'
	);
	echo '</p></div>';
}
register_deactivation_hook(__FILE__, 'pm24sc_plugin_deactivate');



/**
 * 
 * Definiere eigene Wordpress-Bildgrößen, die dann für die Listen und Detailansicht genutzt werden
 * 
 * @since    1.0.0
 */
function pm24sc_post_thumbnail_support() {
	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		// additional image sizes
		add_image_size('pm24sc_thumb', 200, 200);
		add_image_size('pm24sc_list', 740, 540); // 300 pixels wide (and unlimited height)
	}
}



/**
 * Es wird ein Menupunkt im Backend für die Beschreibung & Hilfe-Seite angelegt. Dieser wird dem Menupunkt zum Pot Type PM24 Produkte untergeordnet
 *
 * @since    1.0.0
 */
function pm24_shortcode_admin_description_menu() {

	add_submenu_page('edit.php?post_type=pm24_produkte', 'Beschreibung & Hilfe', 'Beschreibung & Hilfe', 'manage_options', 'pm24-shortcodes-description', 'pm24_shortcode_admin_description_page');

}
add_action('admin_menu', 'pm24_shortcode_admin_description_menu');



/**
 * Für den Menupunkt "Beschreibung & Hilfe" wird der Inhalt aus Datei pm24-shortcodes-admin-description.php geladen
 *
 * @since    1.0.0
 */
function pm24_shortcode_admin_description_page()
{
	require_once('pm24-shortcodes-admin-description.php');
	
}


/**
 * Der Menupunkt "Beschreibung & Hilfe" wird ebenfalls als Link in der Pluginseite bei diesem Plugin verlinkt
 *
 * @since    1.0.0
 */

function pm24_shortcodes_add_plugin_links($links)
{
	if (is_array($links) && isset($links['delete'])) {
		unset($links['delete']);
	}
	// Add our custom links to the returned array value.
	return array_merge([
		'<a href="' . admin_url('admin.php?page=pm24-shortcodes-description') . '">Beschreibung & Hilfe</a>',
	], $links);
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'pm24_shortcodes_add_plugin_links');



/**
 * 
 * STARTE PLUGIN und führe alle Funktionen aus.
 *
 * @since    1.0.0
 */

function run_pm24_products()
{
	pm24sc_post_thumbnail_support();

}

run_pm24_products();
