<?php
function cptui_register_my_cpts()
{

  /**
   * Post Type: PM24 Produkte.
   */

  $labels = [
    "name" => __("PM24 Produkte", "thrive-theme"),
    "singular_name" => __("PM24 Produkt", "thrive-theme"),
    "menu_name" => __("PM24-Produkte", "thrive-theme"),
    "all_items" => __("Alle PM24-Podukte", "thrive-theme"),
    "add_new" => __("PM24-Podukt hinzufügen", "thrive-theme"),
    "add_new_item" => __("PM24-Podukt erstellen", "thrive-theme"),
    "edit_item" => __("PM24-Podukt bearbeiten", "thrive-theme"),
    "new_item" => __("Neues PM24-Podukt", "thrive-theme"),
    "view_item" => __("PM24-Podukt anzeigen", "thrive-theme"),
    "view_items" => __("PM24-Podukte anzeigen", "thrive-theme"),
    "search_items" => __("PM24-Podukt suchen", "thrive-theme"),
    "not_found" => __("Keine PM24-Podukt gefunden", "thrive-theme"),
    "featured_image" => __("PM24-Podukt-Vorschaubild", "thrive-theme"),
    "set_featured_image" => __("PM24-Podukt-Vorschaubild wählen", "thrive-theme"),
    "remove_featured_image" => __("PM24-Podukt-Vorschaubild löschen", "thrive-theme"),
  ];

  $args = [
    "label" => __("PM24 Produkte", "thrive-theme"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => false,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => "PM24-Podukte",
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => ["slug" => "pm24_produkte", "with_front" => true],
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-cart",
    "supports" => ["title", "editor", "thumbnail"],
  ];

  register_post_type("pm24_produkte", $args);
}

add_action('init', 'cptui_register_my_cpts');


function cptui_register_my_cpts_pm24_produkte()
{

  /**
   * Post Type: PM24 Produkte.
   */

  $labels = [
    "name" => __("PM24 Produkte", "thrive-theme"),
    "singular_name" => __("PM24 Produkt", "thrive-theme"),
    "menu_name" => __("PM24-Produkte", "thrive-theme"),
    "all_items" => __("Alle PM24-Podukte", "thrive-theme"),
    "add_new" => __("PM24-Podukt hinzufügen", "thrive-theme"),
    "add_new_item" => __("PM24-Podukt erstellen", "thrive-theme"),
    "edit_item" => __("PM24-Podukt bearbeiten", "thrive-theme"),
    "new_item" => __("Neues PM24-Podukt", "thrive-theme"),
    "view_item" => __("PM24-Podukt anzeigen", "thrive-theme"),
    "view_items" => __("PM24-Podukte anzeigen", "thrive-theme"),
    "search_items" => __("PM24-Podukt suchen", "thrive-theme"),
    "not_found" => __("Keine PM24-Podukt gefunden", "thrive-theme"),
    "featured_image" => __("PM24-Podukt-Vorschaubild", "thrive-theme"),
    "set_featured_image" => __("PM24-Podukt-Vorschaubild wählen", "thrive-theme"),
    "remove_featured_image" => __("PM24-Podukt-Vorschaubild löschen", "thrive-theme"),
  ];

  $args = [
    "label" => __("PM24 Produkte", "thrive-theme"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => false,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => "PM24-Podukte",
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => ["slug" => "pm24_produkte", "with_front" => true],
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-cart",
    "supports" => ["title", "editor", "thumbnail"],
  ];

  register_post_type("pm24_produkte", $args);
}

add_action('init', 'cptui_register_my_cpts_pm24_produkte');

function cptui_register_my_taxes()
{

  /**
   * Taxonomy: Dokumenttypen.
   */

  $labels = [
    "name" => __("Dokumenttypen", "thrive-theme"),
    "singular_name" => __("Dokumenttyp", "thrive-theme"),
    "menu_name" => __("PM24-Dokumenttyp", "thrive-theme"),
    "all_items" => __("Alle Dokumenttyp", "thrive-theme"),
    "edit_item" => __("Alle Dokumenttyp bearbeiten", "thrive-theme"),
    "view_item" => __("Dokumenttyp anzeigen", "thrive-theme"),
    "add_new_item" => __("Neuen Dokumenttyp hinzufügen", "thrive-theme"),
  ];

  $args = [
    "label" => __("Dokumenttypen", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_doctype', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_doctype",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_doctype", ["pm24_produkte"], $args);

  /**
   * Taxonomy: Dateiformate.
   */

  $labels = [
    "name" => __("Dateiformate", "thrive-theme"),
    "singular_name" => __("Dateiformat", "thrive-theme"),
    "menu_name" => __("PM24-Dateiformate", "thrive-theme"),
    "all_items" => __("Alle PM24-Dateiformate", "thrive-theme"),
    "edit_item" => __("PM24-Dateiformat bearbeiten", "thrive-theme"),
    "view_item" => __("PM24-Dateiformat anzeigen", "thrive-theme"),
    "add_new_item" => __("Neues PM24-Dateiformat erstellen", "thrive-theme"),
    "new_item_name" => __("Neues PM24-Dateiformat", "thrive-theme"),
  ];

  $args = [
    "label" => __("Dateiformate", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_fileformat', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_fileformat",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_fileformat", ["pm24_produkte"], $args);

  /**
   * Taxonomy: Wissensgebiete.
   */

  $labels = [
    "name" => __("Wissensgebiete", "thrive-theme"),
    "singular_name" => __("Wissensgebiet", "thrive-theme"),
    "menu_name" => __("PM24-Wissensgebiete", "thrive-theme"),
    "all_items" => __("Alle PM24-Wissensgebiete", "thrive-theme"),
    "edit_item" => __("PM24-Wissensgebiet bearbeiten", "thrive-theme"),
    "view_item" => __("PM24-Wissensgebiet anzeigen", "thrive-theme"),
    "add_new_item" => __("Neues PM24-Wissensgebiet hinzufügen", "thrive-theme"),
  ];

  $args = [
    "label" => __("Wissensgebiete", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_subject', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_subject",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_subject", ["pm24_produkte"], $args);

  /**
   * Taxonomy: Phasen.
   */

  $labels = [
    "name" => __("Phasen", "thrive-theme"),
    "singular_name" => __("Phase", "thrive-theme"),
    "menu_name" => __("PM24-Phasen", "thrive-theme"),
    "all_items" => __("Alle PM24-Phasen", "thrive-theme"),
    "edit_item" => __("PM24-Phase bearbeiten", "thrive-theme"),
    "view_item" => __("PM24-Phase anzeigen", "thrive-theme"),
    "add_new_item" => __("Neue PM24-Phase hinzufügen", "thrive-theme"),
  ];

  $args = [
    "label" => __("Phasen", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_phase', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_phase",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_phase", ["pm24_produkte"], $args);
}
add_action('init', 'cptui_register_my_taxes');

function cptui_register_my_taxes_pm24_doctype()
{

  /**
   * Taxonomy: Dokumenttypen.
   */

  $labels = [
    "name" => __("Dokumenttypen", "thrive-theme"),
    "singular_name" => __("Dokumenttyp", "thrive-theme"),
    "menu_name" => __("PM24-Dokumenttyp", "thrive-theme"),
    "all_items" => __("Alle Dokumenttyp", "thrive-theme"),
    "edit_item" => __("Alle Dokumenttyp bearbeiten", "thrive-theme"),
    "view_item" => __("Dokumenttyp anzeigen", "thrive-theme"),
    "add_new_item" => __("Neuen Dokumenttyp hinzufügen", "thrive-theme"),
  ];

  $args = [
    "label" => __("Dokumenttypen", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_doctype', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_doctype",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_doctype", ["pm24_produkte"], $args);
}
add_action('init', 'cptui_register_my_taxes_pm24_doctype');


function cptui_register_my_taxes_pm24_fileformat()
{

  /**
   * Taxonomy: Dateiformate.
   */

  $labels = [
    "name" => __("Dateiformate", "thrive-theme"),
    "singular_name" => __("Dateiformat", "thrive-theme"),
    "menu_name" => __("PM24-Dateiformate", "thrive-theme"),
    "all_items" => __("Alle PM24-Dateiformate", "thrive-theme"),
    "edit_item" => __("PM24-Dateiformat bearbeiten", "thrive-theme"),
    "view_item" => __("PM24-Dateiformat anzeigen", "thrive-theme"),
    "add_new_item" => __("Neues PM24-Dateiformat erstellen", "thrive-theme"),
    "new_item_name" => __("Neues PM24-Dateiformat", "thrive-theme"),
  ];

  $args = [
    "label" => __("Dateiformate", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_fileformat', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_fileformat",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_fileformat", ["pm24_produkte"], $args);
}
add_action('init', 'cptui_register_my_taxes_pm24_fileformat');

function cptui_register_my_taxes_pm24_subject()
{

  /**
   * Taxonomy: Wissensgebiete.
   */

  $labels = [
    "name" => __("Wissensgebiete", "thrive-theme"),
    "singular_name" => __("Wissensgebiet", "thrive-theme"),
    "menu_name" => __("PM24-Wissensgebiete", "thrive-theme"),
    "all_items" => __("Alle PM24-Wissensgebiete", "thrive-theme"),
    "edit_item" => __("PM24-Wissensgebiet bearbeiten", "thrive-theme"),
    "view_item" => __("PM24-Wissensgebiet anzeigen", "thrive-theme"),
    "add_new_item" => __("Neues PM24-Wissensgebiet hinzufügen", "thrive-theme"),
  ];

  $args = [
    "label" => __("Wissensgebiete", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_subject', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_subject",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_subject", ["pm24_produkte"], $args);
}
add_action('init', 'cptui_register_my_taxes_pm24_subject');


function cptui_register_my_taxes_pm24_phase()
{

  /**
   * Taxonomy: Phasen.
   */

  $labels = [
    "name" => __("Phasen", "thrive-theme"),
    "singular_name" => __("Phase", "thrive-theme"),
    "menu_name" => __("PM24-Phasen", "thrive-theme"),
    "all_items" => __("Alle PM24-Phasen", "thrive-theme"),
    "edit_item" => __("PM24-Phase bearbeiten", "thrive-theme"),
    "view_item" => __("PM24-Phase anzeigen", "thrive-theme"),
    "add_new_item" => __("Neue PM24-Phase hinzufügen", "thrive-theme"),
  ];

  $args = [
    "label" => __("Phasen", "thrive-theme"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'pm24_phase', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "pm24_phase",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "show_in_quick_edit" => false,
  ];
  register_taxonomy("pm24_phase", ["pm24_produkte"], $args);
}
add_action('init', 'cptui_register_my_taxes_pm24_phase');
