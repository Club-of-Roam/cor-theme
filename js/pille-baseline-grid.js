(function($){ // closure

$(window).resize(function() {
	baselineAdjust();
});

window.onload = onloadFuncs;
function onloadFuncs() {
	baselineAdjust();
}

function baselineAdjust() {
	var viewportWidth = window.outerWidth,
		verticalRhythm = 23;
	$(".content-container img").each(function() {
		var imgHeight = $(this).height();
		if( $(this).parent().is('p') && ! $(this).hasClass('no-bsl-adjust') ) {
			var pImgBaselineOffset = ( imgHeight - ( verticalRhythm - ( verticalRhythm / 3 ) ) ) % verticalRhythm;
			if ( pImgBaselineOffset !== 0 ) {
				var imgWidth = $(this).width();
				var resizeRatio = ( imgHeight - pImgBaselineOffset ) / imgHeight;
				$(this).css( 'height', ( imgHeight - pImgBaselineOffset ) );
				$(this).css( 'width', Math.round( imgWidth * resizeRatio ) );
			}
		} else if ( viewportWidth > 767 && $(this).hasClass('baseline-adjustable') ) {
			var imgBaselineOffset = imgHeight % verticalRhythm;
			$(this).css( 'margin-bottom', ( 2 * verticalRhythm - imgBaselineOffset ) + 'px' );
		}
	});
}

})(jQuery); // closure