<?php

/**
 * Die Datei beinhaltet das Template für die Listenansicht
 *
 *
 * @link projektmanagement24.de
 * @since 1.0.0
 * @version 1.0.1
 *
 * @package pm24_shortcodes
 * @subpackage pm24_shortcodes/public/template-parts
 * @author Daniel Sänger <webmaster@daniel-saenger.de>
 * 
 * 
 * 
 */

echo 'Produktlisten Template:';

global $query, $filter, $random_id, $query_taxonomy, $lead_magnet_id;

//definiere wiederkehrende variablen, um sie ggf. nur an dieser Stelle anpassen zu müssen
$post_type = 'pm24_produkte';

//User hat Zugriff auf Produkte (ids)
$current_user_has_products_array = current_user_has_products();


?>

<section class="pm24-shortcodes pm24sc-section pm24sc-section-small pm24-shortcodes__postlist">
  <div class="" pm24sc-filter="target: .js-filter-<?= $random_id ?>">

    <?php
    //Listenfilter wenn Attribut "filter="true" im Shortcode. Filter kann nur einmal auf einer Seite ausgegeben werden!
    if ($filter == 'true') :
      include(PM24SC_PATH_TEMPLATES . '/pm24-shortcodes-tmpl-filter.php');
    endif;
    ?>

    <!-- list container -->
    <div class="js-filter-<?= $random_id ?> pm24sc-grid-medium pm24sc-child-width-1-1@s pm24sc-child-width-1-2@m pm24sc-child-width-1-3@l pm24sc-child-width-1-4@xl" pm24sc-grid pm24sc-height-match="target: > div > .pm24sc-card > .pm24sc-card-body" pm24sc-grid>
      <?php while ($query->have_posts()) : $query->the_post(); ?>

        <?php

        //Hole die Id für diesen Post. Wird im folgenden für Funktionen benötigt.
        $post_id = get_the_ID();
        //Hole die Digiprodukt-Id (aus dem entsprechenden ACF-Feld)
        $lead_magnet_id = get_field('pm24_product_leadmagnet_id', $post_id);

        /**
         * 
         * Taxonomien des Produkts
         * 
         */
        //Produktrechte
        $product_related_packages = get_related_packages_string($post_id);
        $product_related_packages_array = explode(',', $product_related_packages);
        //$doctype_filter_tag = 'tag-pm24_product_has' . '-' . $doctype_slug;

        //Produkttyp (Berücksichtigt KEINE mehrfach Zuordnung)
        $doctype = wp_get_post_terms(get_the_ID(), 'pm24_doctype');
        $doctype_slug = (!empty($doctype)) ? $doctype[0]->slug : '';
        $doctype_label_color = (!empty($doctype)) ? get_field('pm24_doctype_labelcolor', $doctype[0]->taxonomy . '_' . $doctype[0]->term_id) : '';
        $doctype_filter_tag = (!empty($doctype_slug)) ? 'tag-pm24_doctype' . '-' . $doctype_slug : '';

        //Phase (Berücksichtigt KEINE mehrfach Zuordnung)
        $phase = wp_get_post_terms(get_the_ID(), 'pm24_phase');
        $phase_slug = (!empty($phase)) ? $phase[0]->slug : '';
        $phase_filter_tag = (!empty($phase[0]->slug)) ? 'tag-pm24_phase' . '-' . $phase[0]->slug : '';

        //Wissensgebiete (Berücksichtigt KEINE mehrfach Zuordnung)
        $subject = wp_get_post_terms(get_the_ID(), 'pm24_subject');
        $subject_name = (!empty($subject)) ? $subject[0]->name : '';
        $subject_filter_tag = (!empty($subject[0]->slug)) ? 'tag-pm24_subject' . '-' . $subject[0]->slug : '';

        //Dateiformat (Berücksichtigt mehrfach Zuordnung)
        $fileformats = wp_get_post_terms(get_the_ID(), 'pm24_fileformat');
        $fileformat_icons = array();
        $fileformat_filter_tag = '';
        foreach ($fileformats as $fileformat) :
          $fileformat_slug = (!empty($fileformat->slug)) ? $fileformat->slug : '';
          $fileformat_desc = (!empty($fileformat->description)) ? $fileformat->description : '';
          $fileformat_img_url = (!empty($fileformat)) ? get_field('pm24_fileformat_icon', $fileformat->taxonomy . '_' . $fileformat->term_id) : '';
          $fileformat_icons[] = (!empty($fileformat) && !empty($fileformat_img_url)) ? '<span class="pm24sc-icon-button pm24sc-margin-small-right" pm24sc-tooltip="' . $fileformat_desc . '"><img src="' . $fileformat_img_url . '" class="pm24-shortcodes__fileformat_icon"></span>' : $fileformat_slug;
          $fileformat_filter_tag .= (!empty($fileformat_slug)) ? 'tag-pm24_fileformat' . '-' . $fileformat_slug . ' ' : '';
        endforeach;

        //Gibt es Überschneidung von freigeschalteten Nutzerprodukten mit diesem Produkt zugeordneten Ids? 
        $product_user_matching_ids = array_intersect($product_related_packages_array, $current_user_has_products_array);
        $unlock_filter_tag = (!empty($product_user_matching_ids)) ? 'tag-unlock-true' : 'tag-unlock-false';

        //Für die Filterung wird hier eine Klasse zusammengestellt, die oben von jedem der Taxonomien kommt
        $filter_tags = array($doctype_filter_tag, $phase_filter_tag, $subject_filter_tag, $fileformat_filter_tag, $unlock_filter_tag);
        $filter_tag_class = implode(' ', $filter_tags);
        ?>

        <div class="<?= $filter_tag_class ?>">
          <!-- card -->
          <article class="pm24sc-card pm24sc-card-default">

            <?php if (!empty($doctype_slug)) : ?>
              <!-- label -->
              <div class="pm24sc-card-badge pm24sc-label" <?= (!empty($doctype_label_color)) ? 'style = "background-color:' . $doctype_label_color . '"' : '' ?>><?= $doctype_slug ?>
              </div>
              <!-- /label -->
            <?php endif; ?>
            <div class="pm24sc-card-media-top" pm24sc-lightbox>
              
              <?php if (has_post_thumbnail(get_the_ID())) : ?>

                <a class="pm24-shortcodes__medialink pm24sc-inline" href="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" data-alt="">
                  <?php echo get_the_post_thumbnail(get_the_ID(), array(720, 540), array('class' => 'pm24-shortcodes__postimage pm24sc-image', 'pm24sc-image' => '')) ?>
                </a>

              <?php else : ?>
                
                <img src="<?php echo plugin_dir_url(__FILE__) ?>../../assets/icons/placeholder-image-icon.png" class="pm24-shortcodes__postimage pm24sc-image" alt="Platzhalterbild" uk-img>
              <?php endif; ?>
            
            </div>

            <div class="pm24sc-card-body pm24sc-padding-small pm24sc-padding-remove-bottom">
              <?php if (!empty($subject_name)) : ?>
                <p class="pm24sc-article-meta pm24sc-text-small pm24sc-text-primary pm24sc-text-center">
                  <?= $subject_name ?>
                </p>
              <?php endif; ?>
              <h3 class="pm24sc-card-title pm24sc-text-bold pm24sc-text-center"><?php the_title() ?></h3>
              <?php if (!empty(get_field('pm24_product_sortid'))) : ?>
                <p class="pm24sc-article-meta pm24sc-text-muted pm24sc-text-center">#<?php the_field('pm24_product_sortid'); ?></p>
              <?php endif; ?>
            </div>

            <div class="pm24sc-card-footer pm24sc-padding-small">

              <?php if (!empty($fileformat_icons)) : ?>
                <div class="pm24-shortcodes__icons pm24sc-small-margin-top pm24sc-small-margin-bottom pm24sc-text-center">
                  <?php
                  foreach ($fileformat_icons as $icon) :
                    echo $icon;
                  endforeach;
                  ?>
                  <?php if (!empty(get_field('pm24_product_video_buy'))) : ?>
                    <span href="" class="pm24sc-icon-button pm24sc-margin-small-right" pm24sc-tooltip="inkl. Video"><img src="<?= PM24SC_PATH_ICONS . '/icon-video.svg' ?>" class="info-icon"></span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if (get_field('pm24_product_morelink')) : ?>
                <a class="pm24sc-button pm24sc-button-link pm24sc-button__morelink pm24sc-width-1-1 pm24sc-margin-small" href="<?php the_field('pm24_product_morelink') ?>"><span pm24sc-icon="search" class="pm24sc-margin-small-right pm24sc-display-inline-block"></span>Details</a>
              <?php endif; ?>
              <?php

              //check if user is not logged in
              if (!is_user_logged_in()) :
                // echo do_shortcode($buttons_login);
                the_pm24_button_login();
              else : //if user is logged in 
                the_pm24_button_unlock($product_related_packages);
                the_pm24_button_download_file($post_id, $product_related_packages);
                the_pm24_button_download_zip($post_id, $product_related_packages);
              endif; ?>

            </div>
            <?php edit_post_link('Bearbeiten', '', '', get_the_ID(), 'pm24sc-button'); ?>
          </article>
          <!-- /card -->

        </div>
      <?php endwhile; ?>

    </div>
    <!-- /list container -->
  </div>
</section>