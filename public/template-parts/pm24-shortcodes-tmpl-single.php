<?php

/**
 * Die Datei beinhaltet das Template für die Singleansicht
 *
 *
 * @link projektmanagement24.de
 * @since 1.0.0
 *
 * @package pm24_shortcodes
 * @subpackage pm24_shortcodes/public/template-parts
 * @author Daniel Sänger <webmaster@daniel-saenger.de>
 *  * 
 * 
 * 
 */


global $pm24_post, $lead_magnet_id;

$post_type = 'pm24_produkte';
$post_id = $pm24_post->ID;
$product_related_packages = get_related_packages_string($post_id);
$lead_magnet_id = get_field('pm24_product_leadmagnet_id', $post_id);

//Taxonomie Dokumenttyp (Berücksichtigt KEINE mehrfach Zuordnung)
$doctype = wp_get_post_terms($post_id, 'pm24_doctype');
$doctype_name = (!empty($doctype)) ? $doctype[0]->name : '';
$doctype_label_color = (!empty($doctype)) ? get_field('pm24_doctype_labelcolor', $doctype[0]->taxonomy . '_' . $doctype[0]->term_id) : '';

//Taxonomie Wissensgebiet (Berücksichtigt KEINE mehrfach Zuordnung)
$subject = wp_get_post_terms($post_id, 'pm24_subject');
$subject_name = (!empty($subject)) ? 'Produkt aus: ' . $subject[0]->name : '';

//Taxonomie Phase
$phase = wp_get_post_terms($post_id, 'pm24_phase');
$phase_name = (!empty($phase)) ? ' | ' . $phase[0]->name : '';
$product_meta = (!empty($subject_name) || !empty($phase_name)) ? '<p class="pm24sc-article-meta">' . $subject_name . $phase_name . '</p>' : '';

//Taxonomie Dateiformat (Berücksichtigt mehrfach Zuordnung)
$fileformats = wp_get_post_terms($post_id, 'pm24_fileformat');
$fileformat_icons = array();
$fileformat_filter_tag = '';
//Baue das Datei-Icon-HTML für jedes Dateiformat
foreach ($fileformats as $fileformat) :
  $fileformat_slug = (!empty($fileformat->slug)) ? $fileformat->slug : '';
  $fileformat_desc = (!empty($fileformat->description)) ? $fileformat->description : '';
  $fileformat_img_url = (!empty($fileformat)) ? get_field('pm24_fileformat_icon', $fileformat->taxonomy . '_' . $fileformat->term_id) : '';
  $fileformat_icons[] = (!empty($fileformat) && !empty($fileformat_img_url)) ? '<span class="pm24sc-icon-button pm24sc-margin-small-right" pm24sc-tooltip="' . $fileformat_desc . '"><img src="' . $fileformat_img_url . '" class="pm24-shortcodes__fileformat_icon"></span>' : $fileformat_slug;
endforeach;

?>

<section class="pm24-shortcodes pm24sc-section pm24sc-section-small pm24-shortcodes__single">
  <div class="pm24sc-grid-medium pm24sc-child-width-1-2@m" pm24sc-grid>
    <div>
      <article class="pm24sc-article">
        <?php if (!empty($doctype_name)) : ?>
          <!-- label -->
          <span class=""><?= $doctype_name ?>
          </span>
          <!-- /label -->
        <?php endif; ?>

        <h1 class="pm24sc-article-title pm24sc-text-bold"><?= $pm24_post->post_title ?></h1>
        <?= $product_meta ?>

        <?php
        //Dateiformat Icons (s.o.) ausgeben, wenn vorhanden
        if (!empty($fileformat_icons)) : ?>
          <div class="pm24-shortcodes__icons pm24sc-margin-medium-bottom">
            <?php
            foreach ($fileformat_icons as $icon) :
              echo $icon;
            endforeach;
            ?>
          </div>
        <?php endif;

        //Lead Text ausgeben, wenn vorhanden
        if (!empty(get_field('pm24_product_leadtext', $post_id))) : ?>
          <p class="pm24sc-text-lead pm24sc-margin-medium-top ">
            <?php the_field('pm24_product_leadtext', $post_id) ?>
          </p>
        <?php endif;

        //Preis ausgeben, wenn angegeben
        if (!empty(get_field('pm24_product_price', $post_id))) : ?>
          <?php echo do_shortcode('[ds_if has_not_product="' . $product_related_packages . '"]<p class="pm24sc-text-lead pm24sc-margin-medium-bottom pm24sc-text-bold"> Preis: ' . get_field('pm24_product_price', $post_id) . ' €</p>[/ds_if]'); ?>
        <?php endif; ?>

        <div class="pm24sc-margin-top">
          <?php
          //Ist der Nutzer nicht eingeloggt?(Standard WP-Funktion)
          if (!is_user_logged_in()) :

            //Button Freischalten ausgeben. Funktion aus /include/pm24-shortcodes-template-func.php
            the_pm24_button_login();

          else : //oder ist der Nutzer eingeloggt dann..

            //Button Funktionen aus /include/pm24-shortcodes-template-func.php
            //Freischalten Button
            the_pm24_button_unlock($product_related_packages);
            //Download Quelldatei
            the_pm24_button_download_file($post_id, $product_related_packages);
            //Download ZIP
            the_pm24_button_download_zip($post_id, $product_related_packages);

          endif; ?>
        </div>
      </article>
    </div>
    <div class="pm24sc-text-center">

      <div class="pm24-shortcodes-media-container">

        <?php

        //wenn Nutzer nicht eingeloggt ist
        if (!is_user_logged_in()) :

          $video_url = '';
          $video_oembed = '';
          $video_source = '';

          //Zeige Video für nicht eingeloggt, wenn vorhanden
          if (!empty(get_field('pm24_product_video_nologin', $post_id))) :
            //Video Code (Iframe) über die Funktion get_video_iframe()
            $video_url = get_field('pm24_product_video_nologin', $post_id, false, false); // URL
            $video_oembed = get_field('pm24_product_video_nologin', $post_id); //ACF embed
            $video_source = get_video_iframe($video_oembed);
            echo $video_source['iframe'];

          endif;

        else : //Nutzer ist eingeloggt

          if (!empty(get_field('pm24_product_video_nobuy', $post_id)) || !empty(get_field('pm24_product_video_buy', $post_id))) :

            //Zeige Video falls noch nicht gekauft
            if (!empty(get_field('pm24_product_video_nobuy', $post_id))) :
              //Video Code (Iframe) über die Funktion get_video_iframe()
              $video_url = get_field('pm24_product_video_nobuy', $post_id, false, false); // URL
              $video_oembed = get_field('pm24_product_video_nobuy', $post_id); //ACF embed
              $video_source = get_video_iframe($video_oembed);
              echo do_shortcode('[ds_if has_not_product="' . $product_related_packages . '" logged_in=yes]' . $video_source['iframe'] . '[/ds_if]');
            endif;

            //oder zeige Video falls gekauft
            if (!empty(get_field('pm24_product_video_buy', $post_id))) :
              //Video Code (Iframe) über die Funktion get_video_iframe()
              $video_url = get_field('pm24_product_video_buy', $post_id, false, false); // URL
              $video_oembed = get_field('pm24_product_video_buy', $post_id); //ACF embed
              $video_source = get_video_iframe($video_oembed);
              echo do_shortcode('[ds_if has_product="' . $product_related_packages . '" logged_in=yes]' . $video_source['iframe'] . '[/ds_if]');
            endif;

          endif;

        endif; ?>

        <?php

        //Wenn Video vorhanden zeige den Lightbox Button, sonst zeige das Produktbild
        if (!empty(get_field('pm24_product_video_nologin', $post_id)) || !empty(get_field('pm24_product_video_nobuy', $post_id)) || !empty(get_field('pm24_product_video_buy', $post_id))) : ?>

          <!-- Button Video in Lightbox -->
          <div class="pm24sc-margin-top pm24sc-text-center" pm24sc-lightbox>
            <a class="pm24sc-button pm24sc-button-primary" href="<?= $video_url ?>" data-caption="" data-attrs="width: 1920; height: 1080;"><span class=" mdi mdi-open-in-new pm24sc-margin-small-right pm24sc-icon"></span>Video Großansicht</a>
          </div>
          <!-- /Button Video in Lightbox -->

        <?php else :
          //Wenn kein Video, dann zeige Bild
          if (get_field('pm24_product_img', $post_id)) :
            $image_id = get_field('pm24_product_img', $post_id);
            echo wp_get_attachment_image($image_id, array(740, 560), '', array('class' => 'pm24sc-img', 'pm24sc-image' => ''));
          else :
            echo get_the_post_thumbnail($post_id, array(740, 560), array('class' => 'pm24sc-img', 'pm24sc-image' => ''));
          endif;

        endif;
        ?>

      </div>
    </div>
  </div>
  <?php edit_post_link('Bearbeiten', '', '', $post_id, 'pm24sc-button'); ?>
</section>