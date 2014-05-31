/*
 * Miscellaneous JS Snippets/Fixes pertaining to the theme
 */

(function($)
{

// Add a utility class to anchors containing images to style differently from text-links
$('img').parent('a').addClass('contains-image');

// temporary hack
$('span.copyright').each(function() {
  $(this).text("copylefted 2008 - 2014, Club of Roam - Autostop!");
});

}(jQuery));