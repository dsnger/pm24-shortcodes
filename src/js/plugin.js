//@prepros-prepend vendor.js

(function ($, root, undefined) {
	$(function() {
		
		console.log('pm24-plugin ready!')

		var $dropdown = UIkit.dropdown('.pm24sc-dropdown', {
			delayHide: 0
		});

		
		/** Klick auf Filterdropdown tauscht den Text in dem Filter-Toogle-Button mit dem Text des geklickten Dropdownlinks.
		Dadurch wird, ähnlich wir bei einem SELECT, die ausgewählte Option in dem Button als Text angezeigt */
		const $pm24_list_filter_dropdown_link = $('.pm24_list_filter_dropdown > ul > li a');

		$pm24_list_filter_dropdown_link.click(function () {

			const $dropdown = $(this).parent().parent().parent();
			const $dropdown_toggle = $dropdown.prev();

			var $filter_text = $dropdown_toggle.find('.pm24_filter_text');
			$filter_text.text($(this).text().substring(0, 16) + "...");

		})
		

		/** KLick auf den Filtereset Button ändert alle Filtertexte zurück auf "Alle" */
		const $pm24_list_filter_reset = $('.pm24_list_filter_reset');
		$pm24_list_filter_reset.click(function () {
			
			const $filter = $(this).closest('.pm24-shortcodes__filter');
			const $pm24_list_filter_button = $filter.children().find('.pm24_list_filter');

			$pm24_list_filter_button.find('.pm24_filter_text').text('Alle');

		})


	});
})(jQuery, this);
