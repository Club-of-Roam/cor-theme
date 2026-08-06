(($) => {
	const baselineAdjust = () => {
		const viewportWidth = window.outerWidth,
			verticalRhythm = 23;
		$('.content-container img').each((_, element) => {
			const imgHeight = $(element).height();
			if (
				$(element).parent().is('p') &&
				!$(element).hasClass('no-bsl-adjust')
			) {
				const pImgBaselineOffset =
					(imgHeight - (verticalRhythm - verticalRhythm / 3)) %
					verticalRhythm;
				if (pImgBaselineOffset !== 0) {
					const imgWidth = $(element).width();
					const resizeRatio =
						(imgHeight - pImgBaselineOffset) / imgHeight;
					$(element).css('height', imgHeight - pImgBaselineOffset);
					$(element).css('width', Math.round(imgWidth * resizeRatio));
				}
			} else if (
				viewportWidth > 767 &&
				$(element).hasClass('baseline-adjustable')
			) {
				const imgBaselineOffset = imgHeight % verticalRhythm;
				$(element).css(
					'margin-bottom',
					2 * verticalRhythm - imgBaselineOffset + 'px'
				);
			}
		});
	};

	$(window).on('resize', () => {
		baselineAdjust();
	});

	$(window).on('load', () => {
		baselineAdjust();
	});
})(jQuery);
