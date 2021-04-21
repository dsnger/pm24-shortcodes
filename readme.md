
# PM24 Shortcode Plugin

  

Dieses WP-Plugin ist eine individuelle Spezialanwendung für die Seite Projektmanagement24.de. Es liefert Shortcodes, die genutzt werden können, um einen "pm24_produkte" - Custom Post Type auszugeben. Dazu ergänzt es, den auf anderem Wege (z. B. mit CPTUI-Plugin) erstellten Custom Post Type "pm24_produkte" und dessen individuellen Meta-Felder (Advanced Custom Fields), um bestimmte Ausgabe-Templates.

Der Post Type "pm24_produkte" liefert Inhalte, die mit Digimember-Produkten verknüpft werden, um diese mit bestimmten Angaben zu erweitern: Bild, Videos, Preis, Readmore-Links...

Die Zuordnung des Post Types mit dem Digimember-Produkt erfolgt über ein ACF-Feld "pm24_products_leadmagnet_id". Über dieses Id-Feld und das Feld "pm24_products_has" (= Ids der Digimember-Produkt-Bundles, die dieses Produkt beinhalten) werden auch die Nutzerrechte gesteuert. Die Ausgabe der "pm24_produkte"-Posts beinhaltet verschiedene Elemente, die von den Nutzerrechten abhängig sind.

  

## !!WICHTIGE Voraussetzungen

* Plugin Digimember muss aktiv sein!

* Custom Post Type "pm24_produkte" müssen eingerichtet sein

* Taxonomien für den Custom Post Type müssen eingerichtet sein

* (eine PHP-Import-Datei des Custom Post Types ist unter: /assets/import/pm24-shortcodes-cpt.php)

* Plugin ACF PRO muss aktiv sein

* pm24_products ACF-Felder müssen eingerichtet sein

* (eine PHP-Import-Datei des Custom Post Types ist unter: /assets/import/pm24-shortcodes-acf.php)

  
 
## Installation

Datei pm24_shortcodes.zip auf der Pluginseite hochladen oder per FTP im Pluginverzeichnis von WP entpacken.

Falls der notwendige Custom Post Type "pm24_produkte" und die notwendigen ACF-Felder nicht installiert sind, können die Dateien /assets/import/pm24-shortcodes-cpt.php und /assets/import/pm24-shortcodes-acf.php in den Themeordner kopiert werden und in der functions.php des Themes eingebunden werden. Entweder den Code reinkopieren oder die Dateien per php inkludieren.

  

## Benutzung

  
### 1. Listenausgabe-Shortcode:   [pm24-list]

**Attribute:**

* **order** : Sortierung (DESC,ASC). Default = 'ASC'

* **order_by** : Sortierung nach (Feldname). Default = 'meta_value'

* **posts** : Anzahl (-1 für Alle). Default = -1

* **meta_key** : Name ACF Feld. Default = 'pm24_product_sortid'

* **taxonomy** : Taxonomiename. Default = ''

* **term** : Termname / Begriff aus der o.g. Taxonomie. Default = ''

* **filter** : true/false. Default = false


### Beispiele:

 - ##### Alle Posts mit Sortierungsfilter 
	 **`[pm24-list filter="true"]`** = Listet alles Posts und gibt den Sortierungsfilter aus
 - ##### Alle Posts mit best. Taxonomie
	 **`[pm24-list filter="true" taxonomy="pm24_doctype" term="video"]`**  = Gibt NUR Posts mit der Taxonomie "pm24_doctype" und dem Term/Begriff "video" aus, sowie den Sortierungsfilter.
 - ##### Liste nach Dokumenttyp
	 **`[pm24-list filter="true" taxonomy="pm24_doctype" term="video"]`**
 - ##### Liste nach Wissensgebiet
	 **`[pm24-list filter="true" taxonomy="pm24_subject" term="beschaffungsmanagement"]`**
 - ##### Liste nach Dateityp
	 **`[pm24-list filter="true" taxonomy="pm24_fileformat" term="doc"]`**
 - ##### Liste nach Phase
	 **`[pm24-list filter="true" taxonomy="pm24_phase" term="abschluss"]`**
  
  
### 2. Einzelpost (Single-Post-Widget) -Shortcode:  [pm24-single]

**Attribute:**

* **id** = Id des PM24-Produkte-Posts, der angezeigt werden soll

  
### Beispiel:

**`[pm24-single id="1234"]`** = Gibt das Post-Single-Widget des Posts mit der Id "1234" aus.

  

## Plugindateistruktur

* **ASSETS** *-> Ordner für Zubehör*

	* FONTS

	* ICONS

	* IMPORT

* **INCLUDE** *-> Ordner für die Hauptfunktionen des Plugins*

	* pm24-shortcodes-shortcodes.php *->Beinhaltet die Shortcode-Funktionen*

	* pm24-shortcodes-template-func.php *->Beinhaltet übergeordnete Funktionen, die in mehreren Templates genutzt werden*

  
* **PUBLIC** *-> Alles für die Ausgabe: Templates, CSS, JS..*

	* CSS
		* pm24-shortcodes-public.css

	* JS
		* pm24-shortcodes-public.js

	* **TEMPLATE-PARTS** *-> Ausgabe-Templates, HTML*

		* pm24-shortcodes-tmpl-filter.php *->Template für den Listenfilter, wird im Post List Template inkludiert!*

		* pm24-shortcodes-tmpl-noposts.php *->Template für die Ausgabe "Keine Beiträge"*

		* pm24-shortcodes-tmpl-post-list.php *->Template für Post List-Ausgabe*

		* pm24-shortcodes-tmpl-register-modal.php *->Template für das Registrierungs-Modal/Popup*

		* pm24-shortcodes-tmpl-single.php *->Template für Single Post Widget-Ausgabe*

	* pm24-shortcodes-public.php *->Bindet CSS und JS für die Ausgabe ein*

	* index.php *->Leere index aus Sicherheitsgründen*

* **pm24-shortcodes.php** *->Plugin Initialisierung / Hauptdatei des Plugins*
* pm24-shortcodes-admin-description.php *->Diese Beschreibungs- und Hilfeseite*

* index.php *->Leere index aus Sicherheitsgründen*
