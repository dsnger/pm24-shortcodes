<?php

/**
 * Beschreibung und Hilfeseite des Plugins für den Adminbereich
 *
 * Die Seite wird unter dem Menupunkt "Beschreibung & Hilfe" beim Post Type PM24-Produkte als Untermenu angezeigt!
 *
 * @link              projektmanagement24.de
 * @since             1.0.2
 * @package           pm24_shortcodes
 *
 */

// SICHERHEIT: Diese Datei kann nicht direkt aufgerufen werden!
if (!defined('WPINC')) {
	die;
}

?>

<link rel="stylesheet" href="https://stackedit.io/style.css" />
<style>
	p {
		font-size: 17px;
		line-height: 1.5;
		margin: 1em 0;
	}

	ul {
		list-style: inherit;
	}

	ol,
	ul {
		padding: 0 0 0 40px;
	}

	.stackedit__html {
		margin-bottom: 180px;
		margin-left: auto;
		margin-right: auto;
		padding-left: 30px;
		padding-right: 30px;
		max-width: 1040px;
	}
</style>

<!DOCTYPE html>
<html>



<div class="stackedit__html">
	<h1 id="pm24-shortcode-plugin">PM24 Shortcode Plugin</h1>
	<p>Dieses WP-Plugin ist eine individuelle Spezialanwendung für die Seite <a href="http://Projektmanagement24.de">Projektmanagement24.de</a>. Es liefert Shortcodes, die genutzt werden können, um einen “pm24_produkte” - Custom Post Type auszugeben. Dazu ergänzt es, den auf anderem Wege (z. B. mit CPTUI-Plugin) erstellten Custom Post Type “pm24_produkte” und dessen individuellen Meta-Felder (Advanced Custom Fields), um bestimmte Ausgabe-Templates.</p>
	<p>Der Post Type “pm24_produkte” liefert Inhalte, die mit Digimember-Produkten verknüpft werden, um diese mit bestimmten Angaben zu erweitern: Bild, Videos, Preis, Readmore-Links…</p>
	<p>Die Zuordnung des Post Types mit dem Digimember-Produkt erfolgt über ein ACF-Feld "pm24_products_leadmagnet_id". Über dieses Id-Feld und das Feld "pm24_products_has" (= Ids der Digimember-Produkt-Bundles, die dieses Produkt beinhalten) werden auch die Nutzerrechte gesteuert. Die Ausgabe der "pm24_produkte"-Posts beinhaltet verschiedene Elemente, die von den Nutzerrechten abhängig sind.
	</p>
	<h2 id="wichtige-voraussetzungen">!!WICHTIGE Voraussetzungen</h2>
	<ul>
		<li>
			<p>Plugin Digimember muss aktiv sein!</p>
		</li>
		<li>
			<p>Custom Post Type “pm24_produkte” müssen eingerichtet sein</p>
		</li>
		<li>
			<p>Taxonomien für den Custom Post Type müssen eingerichtet sein</p>
		</li>
		<li>
			<p>(eine PHP-Import-Datei des Custom Post Types ist unter: /assets/import/pm24-shortcodes-cpt.php)</p>
		</li>
		<li>
			<p>Plugin ACF PRO muss aktiv sein</p>
		</li>
		<li>
			<p>pm24_products ACF-Felder müssen eingerichtet sein</p>
		</li>
		<li>
			<p>(eine PHP-Import-Datei des Custom Post Types ist unter: /assets/import/pm24-shortcodes-acf.php)</p>
		</li>
	</ul>
	<h2 id="installation">Installation</h2>
	<p>Datei pm24_shortcodes.zip auf der Pluginseite hochladen oder per FTP im Pluginverzeichnis von WP entpacken.</p>
	<p>Falls der notwendige Custom Post Type “pm24_produkte” und die notwendigen ACF-Felder nicht installiert sind, können die Dateien /assets/import/pm24-shortcodes-cpt.php und /assets/import/pm24-shortcodes-acf.php in den Themeordner kopiert werden und in der functions.php des Themes eingebunden werden. Entweder den Code reinkopieren oder die Dateien per php inkludieren.</p>
	<h2 id="benutzung">Benutzung</h2>
	<h3 id="listenausgabe-shortcode---pm24-list">1. Listenausgabe-Shortcode: [pm24-list]</h3>
	<p><strong>Attribute:</strong></p>
	<ul>
		<li>
			<p><strong>order</strong> : Sortierung (DESC,ASC). Default = ‘ASC’</p>
		</li>
		<li>
			<p><strong>order_by</strong> : Sortierung nach (Feldname). Default = ‘meta_value’</p>
		</li>
		<li>
			<p><strong>posts</strong> : Anzahl (-1 für Alle). Default = -1</p>
		</li>
		<li>
			<p><strong>meta_key</strong> : Name ACF Feld. Default = ‘pm24_product_sortid’</p>
		</li>
		<li>
			<p><strong>taxonomy</strong> : Taxonomiename. Default = ‘’</p>
		</li>
		<li>
			<p><strong>term</strong> : Termname / Begriff aus der o.g. Taxonomie. Default = ‘’</p>
		</li>
		<li>
			<p><strong>filter</strong> : true/false. Default = false</p>
		</li>
	</ul>
	<h3 id="beispiele">Beispiele:</h3>
	<ul>
		<li>
			<h5 id="alle-posts-mit-sortierungsfilter">Alle Posts mit Sortierungsfilter</h5>
			<strong><code>[pm24-list filter="true"]</code></strong> = Listet alles Posts und gibt den Sortierungsfilter aus
		</li>
		<li>
			<h5 id="alle-posts-mit-best.-taxonomie">Alle Posts mit best. Taxonomie</h5>
			<strong><code>[pm24-list filter="true" taxonomy="pm24_doctype" term="video"]</code></strong> = Gibt NUR Posts mit der Taxonomie “pm24_doctype” und dem Term/Begriff “video” aus, sowie den Sortierungsfilter.
		</li>
		<li>
			<h5 id="liste-nach-dokumenttyp">Liste nach Dokumenttyp</h5>
			<strong><code>[pm24-list filter="true" taxonomy="pm24_doctype" term="video"]</code></strong>
		</li>
		<li>
			<h5 id="liste-nach-wissensgebiet">Liste nach Wissensgebiet</h5>
			<strong><code>[pm24-list filter="true" taxonomy="pm24_subject" term="beschaffungsmanagement"]</code></strong>
		</li>
		<li>
			<h5 id="liste-nach-dateityp">Liste nach Dateityp</h5>
			<strong><code>[pm24-list filter="true" taxonomy="pm24_fileformat" term="doc"]</code></strong>
		</li>
		<li>
			<h5 id="liste-nach-phase">Liste nach Phase</h5>
			<strong><code>[pm24-list filter="true" taxonomy="pm24_phase" term="abschluss"]</code></strong>
		</li>
	</ul>
	<h3 id="einzelpost-single-post-widget--shortcode--pm24-single">2. Einzelpost (Single-Post-Widget) -Shortcode: [pm24-single]</h3>
	<p><strong>Attribute:</strong></p>
	<ul>
		<li><strong>id</strong> = Id des PM24-Produkte-Posts, der angezeigt werden soll</li>
	</ul>
	<h3 id="beispiel">Beispiel:</h3>
	<p><strong><code>[pm24-single id="1234"]</code></strong> = Gibt das Post-Single-Widget des Posts mit der Id “1234” aus.</p>
	<h2 id="plugindateistruktur">Plugindateistruktur</h2>
	<ul>
		<li>
			<p><strong>ASSETS</strong> <em>-&gt; Ordner für Zubehör</em></p>
			<ul>
				<li>
					<p>FONTS</p>
				</li>
				<li>
					<p>ICONS</p>
				</li>
				<li>
					<p>IMPORT</p>
				</li>
			</ul>
		</li>
		<li>
			<p><strong>INCLUDE</strong> <em>-&gt; Ordner für die Hauptfunktionen des Plugins</em></p>
			<ul>
				<li>
					<p>pm24-shortcodes-shortcodes.php <em>-&gt;Beinhaltet die Shortcode-Funktionen</em></p>
				</li>
				<li>
					<p>pm24-shortcodes-template-func.php <em>-&gt;Beinhaltet übergeordnete Funktionen, die in mehreren Templates genutzt werden</em></p>
				</li>
			</ul>
		</li>
		<li>
			<p><strong>PUBLIC</strong> <em>-&gt; Alles für die Ausgabe: Templates, CSS, JS…</em></p>
			<ul>
				<li>
					<p>CSS</p>
					<ul>
						<li>pm24-shortcodes-public.css</li>
					</ul>
				</li>
				<li>
					<p>JS</p>
					<ul>
						<li>pm24-shortcodes-public.js</li>
					</ul>
				</li>
				<li>
					<p><strong>TEMPLATE-PARTS</strong> <em>-&gt; Ausgabe-Templates, HTML</em></p>
					<ul>
						<li>
							<p>pm24-shortcodes-tmpl-filter.php <em>-&gt;Template für den Listenfilter, wird im Post List Template inkludiert!</em></p>
						</li>
						<li>
							<p>pm24-shortcodes-tmpl-noposts.php <em>-&gt;Template für die Ausgabe “Keine Beiträge”</em></p>
						</li>
						<li>
							<p>pm24-shortcodes-tmpl-post-list.php <em>-&gt;Template für Post List-Ausgabe</em></p>
						</li>
						<li>
							<p>pm24-shortcodes-tmpl-register-modal.php <em>-&gt;Template für das Registrierungs-Modal/Popup</em></p>
						</li>
						<li>
							<p>pm24-shortcodes-tmpl-single.php <em>-&gt;Template für Single Post Widget-Ausgabe</em></p>
						</li>

					</ul>
				</li>
				<li>
					<p>pm24-shortcodes-public.php <em>-&gt;Bindet CSS und JS für die Ausgabe ein</em></p>
				</li>
				<li>
					<p>index.php <em>-&gt;Leere index aus Sicherheitsgründen</em></p>
				</li>
			</ul>
		</li>
		<li>
			<p><strong>pm24-shortcodes.php</strong> <em>-&gt;Plugin Initialisierung / Hauptdatei des Plugins</em></p>
		</li>
		<li>
			<p>pm24-shortcodes-admin-description.php <em>-&gt;Diese Beschreibungs- und Hilfeseite</em></p>
		</li>
		<li>
			<p>index.php <em>-&gt;Leere index aus Sicherheitsgründen</em></p>
		</li>
	</ul>
</div>