<?php

/**
 * Die Datei beinhaltet die Shortcode-Funktionen. 
 *
 *
 * @link projektmanagement24.de
 * @since 1.0.0
 *
 * @package pm24_shortcodes
 * @subpackage pm24_shortcodes/includes
 * @author Daniel Sänger <webmaster@daniel-saenger.de>
 * 
 * 1. Shortcode: Listensansicht
 * 2. Shortcode: Single Widget
 * 
 * 
 * 
 */
 

// Diese Datei kann nicht direkt aufgerufen werden!
if (!defined('WPINC')) {
  die;
}





/**
 * 1. Shortcode for post listing with parameter
 *
 * Shortcode: [pm24-list order="ASC" oderby="title" posts="-1" taxonomy="xy" term="yz"]
 * 
 * @since    1.0.0
 * 
 */

add_shortcode('pm24-list', 'pm24sc_post_listing_shortcode');
function pm24sc_post_listing_shortcode($atts)
{

  global $query, $filter, $random_id, $query_taxonomy;

  //Random ID generieren. Wird an alle CSS-Ids angehängt, um mehrere Filter je Seite zu erstellen.
  $random_id = random_bytes(5);
  $random_id = bin2hex($random_id);

  //Hier startet der Ausgabespeicher
  ob_start();

  //Attribute des Shortcodes werden als Variablen gespeichert und mit Standardwerten versehen, falls keine Wert vorhanden sind
  extract(shortcode_atts(array(
    'order' => 'ASC',
    'posts' => -1,
    'meta_key'      => 'pm24_product_sortid',
    'orderby'      => 'meta_value',
    'taxonomy' => '',
    'term' => '',
    'filter' => 'false'
  ), $atts));

  
  //Argumente für die Post-Abfrage von Wordpress mit den Werten aus den Shortcode-Attributen
  $args = array(
    'post_type' => 'pm24_produkte', //ist hier festgelegt
    'post_status' => 'publish', //ist hier festgelegt
    'order' => $order, 
    'orderby' => $orderby, 
    'posts_per_page' => $posts,
    'taxonomy' => $taxonomy, 
    'term' => $term,
    'meta_key' => $meta_key
  );

  //speichere Taxonomy in globaler Variable, beim Filter den entsprechenden Taxonomy-Filter nicht anzuzeigen, wenn die Taxonomy festgelegt ist
  $query_taxonomy = $taxonomy;

  //Starte mit den Argumenten eine Abfrage
  $query = new WP_Query($args);

  //Wenn die Abfrage Posts enthält dann...
  if ($query->have_posts()) {

    //hole das Templates für die PM24 Produkte Listenansicht
    include(PM24SC_PATH_TEMPLATES . '/pm24-shortcodes-tmpl-post-list.php');

    //den Ausgabespeicherinhalt übergeben und löschen
    $post_list = ob_get_clean();

    //Abfrage wieder zurücksetzen
    wp_reset_postdata();

  //Andernfalls wenn die Abfrage KEINE Posts enthält dann schreibe...  
  } else {

    //hole das Templates für den Hinweis: Keine Beiträge vorhanden
    include(PM24SC_PATH_TEMPLATES . '/pm24-shortcodes-tmpl-noposts.php');

    //den Ausgabespeicherinhalt übergeben und löschen
    $post_list = ob_get_clean();
  
  }
  //Die Ausgabe zurückgeben, wenn diese Funktion aufgerufen wird, bzw. der Shortcode genutzt wird.
  return $post_list;
}




/**
 * 2. Shortcode für Single Post Widget
 *
 * Shortcode: [pm24-single id="1234"]
 * 
 * @since    1.0.0
 * 
 */

add_shortcode('pm24-single', 'pm24sc_post_single_shortcode');
function pm24sc_post_single_shortcode($atts)
{

  global $pm24_post;

  //Hier startet der Ausgabespeicher
  ob_start();

  //Attribute des Shortcodes werden als Variablen gespeichert und mit Standardwerten versehen, falls keine Wert vorhanden sind
  extract(shortcode_atts(array(
    'id' => '',
  ), $atts));


  //Abfrage nach Post mit best. Id
  $pm24_post = get_post($id);


  //Check ob post mit der ID tatsächlich ein PM24_produkte Post Type ist
  $pm24_post = ($pm24_post->post_type == 'pm24_produkte') ? $pm24_post : '';


  //Wenn die Abfrage einen Post enthält dann...
  if ($pm24_post) {
    //hole das Templates für die Singleansicht
    include(PM24SC_PATH_TEMPLATES . '/pm24-shortcodes-tmpl-single.php');

    //den Ausgabespeicherinhalt übergeben und löschen
    $output = ob_get_clean();

    //Abfrage wieder zurücksetzen
    wp_reset_postdata();

    //Die Ausgabe zurückgeben, wenn diese Funktion aufgerufen wird, bzw. der Shortcode genutzt wird.
    return $output;

    //Andernfalls wenn die Abfrage KEINE Posts enthält dann schreibe...  
  } else {

    echo "<p>Leider kein Beitrag vorhanden!</p>";
  }
}