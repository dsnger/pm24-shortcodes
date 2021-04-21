<?php

/**
 * Die Datei beinhaltet das Template für den Filter der Listenansicht. Es wird über das Template pm24-shortcodes-tmpl-post-list.php 
 * aufgerufen. 
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

//Globale Variablen werden benötigt
global $random_id, $query_taxonomy;
$post_type = 'pm24_produkte';

?>

<!-- filter container -->
<div class="pm24-shortcodes__filter pm24sc-margin pm24sc-margin-medium-bottom ">


  <div class="pm24sc-grid-small pm24sc-child-width-1-1 pm24sc-child-width-auto@s pm24sc-flex pm24sc-flex-between pm24sc-flex-wrap">
    <h3 class="pm24sc-display-block pm24sc-article-headline">Listenfilter</h3>
    <!-- reset button -->
    <div class="pm24sc-display-block pm24sc-margin-small-bottom">
      <button id="pm24_list_filter_all_<?= $random_id ?>" class="pm24_list_filter_reset pm24sc-button pm24sc-button-link pm24sc-button-small pm24sc-margin-left-auto@s" type="button" pm24sc-filter-control><span pm24sc-icon="close" class=pm24sc-margin-small-right></span>Filter zurücksetzen</button>
    </div>
    <!-- /reset button -->
  </div>

  <div class="pm24sc-grid-small pm24sc-child-width-1-1 pm24sc-child-width-1-2@s pm24sc-child-width-1-3@m pm24sc-child-width-expand@l pm24sc-flex pm24sc-flex-wrap">
    <?php
    /**
     * 
     * Taxonomien Filter
     * Alle Taxonomien (z.B. pm24_fileformat..) des Post Type "pm24_produkte", um jeweils einen Filter zu generieren
     * 
     */
    $taxonomies = get_object_taxonomies($post_type);

    foreach ($taxonomies as $taxonomy) :
      $tax = get_taxonomy($taxonomy);

      //zeige Filter nur, wenn im Shortcode die Tax nicht voreingestellt ist
      if ($tax->name != $query_taxonomy) :
    ?>
        <!-- filter -->
        <div class="pm24sc-display-block pm24sc-margin-small-bottom">
          <button id="pm24_list_filter_<?= $tax->name ?>_<?= $random_id ?>" class="pm24_list_filter pm24sc-button pm24sc-button-default pm24sc-position-relative" type="button"><?= $tax->label ?> <span pm24sc-icon="icon: triangle-down;"></span><span class="pm24_filter_text">Alle</span></button>
          <div id="pm24_list_filter_<?= $tax->name ?>_dd_<?= $random_id ?>" class="pm24_list_filter_dropdown" pm24sc-dropdown="mode: click; pos: bottom">

            <ul class="pm24sc-nav pm24sc-dropdown-nav">
              <li pm24sc-filter-control=" group: <?= $tax->name ?>;"><a href="#" pm24sc-toggle="target: #pm24_list_filter_<?= $tax->name ?>_dd_<?= $random_id ?>">Alle</a></li>

              <?php
              //Alle Terms dieser Taxonomy als weiter Filter-Links
              $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
              ]);
              foreach ($terms as $term) :
                echo '<li pm24sc-filter-control="filter: .tag-' . $tax->name . '-' . $term->slug . '; group: ' . $tax->name . '; "><a href="#" pm24sc-toggle="target: #pm24_list_filter_' . $tax->name . '_dd_' . $random_id . '">' . $term->name . '</a></li>';
              endforeach;
              ?>

            </ul>
          </div>
        </div>
        <!-- /filter -->

    <?php
      endif;
    endforeach;
    ?>

    <?php

    /**
     *
     * Filter für die freigeschalteten Produkte
     *
     */
    ?>
    <!-- filter -->
    <div class="pm24sc-display-block pm24sc-margin-small-bottom">
      <button id="pm24_list_filter_unlock_<?= $random_id ?>" class="pm24_list_filter pm24sc-button pm24sc-button-default pm24sc-position-relative" type="button">freigeschaltet <span pm24sc-icon="icon: triangle-down;"></span><span class="pm24_filter_text">Alle</span></button>
      <div id="pm24_list_filter_unlock_dd_<?= $random_id ?>" class="pm24_list_filter_dropdown" pm24sc-dropdown="mode: click; pos: bottom">
        <ul class="pm24sc-nav pm24sc-dropdown-nav">
          <li pm24sc-filter-control=""><a href="#" pm24sc-toggle="target: #pm24_list_filter_unlock_dd_<?= $random_id ?>">Alle</a></li>
          <li pm24sc-filter-control="filter: .tag-unlock-true; group: unlock;"><a href="#" pm24sc-toggle="target: #pm24_list_filter_unlock_dd_<?= $random_id ?>">Freigeschaltet</a></li>
          <li pm24sc-filter-control="filter: .tag-unlock-false; group: unlock;"><a href="#" pm24sc-toggle="target: #pm24_list_filter_unlock_dd_<?= $random_id ?>">Nicht freigeschaltet</a></li>
        </ul>
      </div>
    </div>
    <!-- /filter -->

  </div>
  <!-- /filter grid -->

</div>
<!-- /filter container -->