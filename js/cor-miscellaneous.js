/*
 * Miscellaneous JS Snippets/Fixes pertaining to the theme
 */

(($) => {
	// Add a utility class to anchors containing images to style differently from text-links
	$('img').parent('a').addClass('contains-image');

	// temporary hack
	$('span.copyright').each((_, element) => {
		$(element).text(
			`copylefted 2008 - ${new Date().getFullYear()}, Club of Roam - Autostop!`
		);
	});
})(jQuery);
