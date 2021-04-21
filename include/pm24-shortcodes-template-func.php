<?php

/**
 * 
 * Die Datei beinhaltet die Funktionen, die übergeordnet an mehrfach z. B. in den Template-Dateien gebraucht werden.
 * Um sich nicht zu wiederholen, werden diese hier zentral zur Verfügung gestellt.
 * 
 *  1. Nutzerzugriff auf Digi-Produkte auslesen
 *  2. Zuordnung PM24 Post mit Digi-Produkt auslesen
 *  3. Login Button-Ausgabe
 *  4. Download Button Quelldatei
 *  5. Download Button ZIP
 *  6. Freischalt Button
 *  7. Video Iframe-Ausgabe mit Attributen
 *  8. Video ID aus Video-Url ermitteln
 *
 *
 * @link projektmanagement24.de
 * @since 1.0.0
 * @version 1.0.1
 *
 * @package pm24_shortcodes
 * @subpackage pm24_shortcodes/includes
 * @author Daniel Sänger <webmaster@daniel-saenger.de>
 * 
 * 
 */


// Diese Datei kann nicht direkt aufgerufen werden!
if (!defined('WPINC')) {
  die;
}



/**
 * 
 * Auf welche Produkte hat der aktuelle User Zugriff?
 * @digimember API Funktion: digimember_listAccessableContent()-> gibt die Ids der bestellten Produkte/Inhalte
 * 
 * @since 1.0.0
 */

function current_user_has_products()
{

  $current_user_has_products_array = array();

  if (function_exists('digimember_listAccessableContent')) :
    $current_user_has_products = digimember_listAccessableContent('page', 'content');

    foreach ($current_user_has_products as $current_user_has_product) :
      $current_user_has_products_array[] = $current_user_has_product['product_id'];
    endforeach;
  endif;

  //gibt das Array mit allen Prdoukt-Ids zurück, auf die der User Zugriff hat
  return $current_user_has_products_array;
}


/**
 * 
 * Hole die Liste mit den Digi-Produkt-Bundles die dem "pm24_produkte"-Post zugeordnet sind, sowie die Leadmagnet Id.
 * ACF: pm24_product_has
 * 1. als String (1,2,3...) für den Einsatz in den Thrive Shortcodes
 * 
 * @since 1.0.0
 */
function get_related_packages_string($post_id)
{
  //holt das ACF Feld pm24_product_has, entfernt doppelte Leerzeichen und etwaige ungültige Zeichen
  $product_related_packages = (!empty(get_field('pm24_product_has', $post_id))) ? str_replace(' ', '', sanitize_text_field(get_field('pm24_product_has', $post_id))) : '0';

  //holt das ACF Feld pm24_product_leadmagnet_id, entfernt doppelte Leerzeichen und etwaige ungültige Zeichen, setzt ein Komma davor
  $product_related_leadmagnet_id = (!empty(get_field('pm24_product_leadmagnet_id', $post_id))) ? ',' . str_replace(' ', '', sanitize_text_field(get_field('pm24_product_leadmagnet_id', $post_id))) : '';

  //gibt alles aneinandergereiht zurück (1,2,3,4...)
  return $product_related_packages . $product_related_leadmagnet_id;
}


/**
 * 
 * Login Button
 * 
 * @since 1.0.0
 * @version 1.0.1
 * 
 */
//alte Version mit Thrive-Popup
// function the_pm24_button_login($popup_id = '16946')
// {
//   $buttons_login = '[thrive_2step id="' . $popup_id . '"]<button href="#" class="pm24sc-button pm24sc-button-primary ">Anmelden</button>[/thrive_2step]';
//   echo do_shortcode($buttons_login);
// }

//Neue Version mit eigenem Popup/Modal
function the_pm24_button_login()
{
  ob_start(); ?>

  <button href="#" class="pm24sc-button pm24sc-button-primary pm24sc-button__register" pm24sc-toggle="target: #pm24_RegisterModal">Anmelden</button>

<?php require_once(PM24SC_PATH_TEMPLATES . '/pm24-shortcodes-tmpl-register-modal.php');

  $button_unlock = ob_get_clean();

  echo do_shortcode($button_unlock);
}




/**
 * 
 * Donload Button Quelldatei
 * 
 * @since 1.0.0
 * @version 1.0.1
 */
function the_pm24_button_download_file($post_id, $product_related_packages)
{
  $buttons_download_file = (!empty(get_field('pm24_product_dl_link', $post_id) && !empty($product_related_packages))) ? '[ds_if has_product="' . $product_related_packages . '" logged_in=yes]<a href="' . get_field('pm24_product_dl_link', $post_id) . '" class="pm24sc-button pm24sc-button-success pm24sc-button__file">Download Quelldatei</a>[/ds_if]' : '';

  echo do_shortcode($buttons_download_file);
}

function the_pm24_button_download_zip($post_id, $product_related_packages)
{
  $buttons_download_zip = (!empty(get_field('pm24_product_dl_zip', $post_id) && !empty($product_related_packages))) ? '[ds_if has_product="' . $product_related_packages . '" logged_in=yes] <a href="' . get_field('pm24_product_dl_zip', $post_id) . '" class="pm24sc-button pm24sc-button-success pm24sc-button__zip">Download ZIP</a>[/ds_if]' : '';

  echo do_shortcode($buttons_download_zip);
}


/**
 * 
 * Freischalten Button
 * 
 * @since 1.0.0
 * @version 1.0.1
 */
function the_pm24_button_unlock($product_related_packages, $popup_id = '16966')
{
  $buttons_unlock = '[ds_if has_not_product="' . $product_related_packages . '" logged_in=yes][thrive_2step id="' . $popup_id . '"]<button href="#" class="pm24sc-button pm24sc-button-primary pm24sc-button__unlock">Freischalten</button>[/thrive_2step][/ds_if]';

  echo do_shortcode($buttons_unlock);
}



/**
 * 
 * VIDEO: Iframe mit Attributen
 * 
 * 
 * @since 1.0.0
 */

function get_video_iframe($video_url)
{

  $iframe = $video_url;
  // use preg_match to find iframe src
  preg_match('/src="(.+?)"/', $iframe, $matches);
  $src = $matches[1];
  $video = parse_video_uri($src);
  $video_id = $video['id'];

  // add extra params to iframe src
  $params = array(
    'autoplay' => 0,
    'fs' => 0,
    'showinfo' => 0,
    'rel' => 0,
    'vq' => 'hd1080',
    'controls'    => 1,
    'loop' => 0,
    'playlist' => $video_id
  );

  $new_src = add_query_arg($params, $src);
  $iframe = str_replace($src, $new_src, $iframe);

  // add extra attributes to iframe html
  $attributes = 'frameborder="0" scroll="no" autoplay="0" controls="1"  pm24sc-video="automute: false" allow="autoplay; fullscreen" allowfullscreen';
  $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

  $video_source = array();
  $video_source['iframe'] = $iframe;
  $video_source['id'] = $video_id;
  $video_source['type'] = $video['type'];
  $video_source['src'] = $src;

  return $video_source;
}



/**
 * 
 * VIDEO: Trenne die Video-ID von der Url. Wir brauchen aber nur die ID für die Funktion get_video_iframe($video_url)
 * um den Iframe mit Paramatern auszugeben.
 * 
 *  Url is http://www.youtube.com/watch?v=xxxx 
 *  oder http://www.youtube.com/watch?feature=player_embedded&v=xxx
 *  oder http://www.youtube.com/embed/xxxx
 * 
 * @since 1.0.0
 */


function parse_video_uri($url)
{
  // Parse Url 
  $parse = parse_url($url);

  //Variablen setzen
  $video_type = '';
  $video_id = '';
  $result = array();

  // Url ist http://youtu.be/xxxx
  if ($parse['host'] == 'youtu.be') {
    $video_type = 'youtube';
    $video_id = ltrim($parse['path'], '/');
  }

  // Url ist http://www.youtube.com/watch?v=xxxx 
  // oder http://www.youtube.com/watch?feature=player_embedded&v=xxx
  // oder http://www.youtube.com/embed/xxxx
  if (($parse['host'] == 'youtube.com') || ($parse['host'] == 'www.youtube.com')) {
    $video_type = 'youtube';
    parse_str($parse['query'], $result);

    if (!empty($result['feature'])) {
      $video_id = explode('v=', $parse['query']);
      $video_id = end($video_id);
    }

    if (strpos($parse['path'], 'embed') == 1) {
      $video_id = explode('/', $parse['path']);
      $video_id = end($video_id);
    }
  }

  // Url: http://www.vimeo.com oder player.vimeo.com
  if (($parse['host'] == 'vimeo.com') || ($parse['host'] == 'www.vimeo.com') || ($parse['host'] == 'player.vimeo.com')) {
    $video_type = 'vimeo';
    $video_id = ltrim($parse['path'], 'video/');
  }
  // $host_names = explode(".", $parse['host']);
  // $rebuild = (!empty($host_names[1]) ? $host_names[1] : '') . '.' . (!empty($host_names[2]) ? $host_names[2] : '');

  // Diese Funktion gibt ein Array mit Video Typ und Id zurück
  if (!empty($video_type)) {
    $video_array = array(
      'type' => $video_type,
      'id' => $video_id
    );
    return $video_array;
  } else {
    return false;
  }
}



// /**
//  * 
//  * VIDEO: Vimeo-Video-Thumbnail anhand Video ID
//  * 
//  * @since 1.0.0
//  */

// function get_vimeo_thumbnail_uri($clip_id)
// {
//   $vimeo_api_uri = 'http://vimeo.com/api/v2/video/' . $clip_id . '.php';
//   $vimeo_response = wp_remote_get($vimeo_api_uri);
//   if (is_wp_error($vimeo_response)) {
//     return $vimeo_response;
//   } else {
//     $vimeo_response = unserialize($vimeo_response['body']);
//     return $vimeo_response[0]['thumbnail_large'];
//   }
// }
