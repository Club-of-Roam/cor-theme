(($) => {
	const baselineAdjust = () => {
		const viewportWidth = window.outerWidth,
			verticalRhythm = 23;
		$('.content-container img').each(() => {
			const imgHeight = $(this).height();
			if (
				$(this).parent().is('p') &&
				!$(this).hasClass('no-bsl-adjust')
			) {
				const pImgBaselineOffset =
					(imgHeight - (verticalRhythm - verticalRhythm / 3)) %
					verticalRhythm;
				if (pImgBaselineOffset !== 0) {
					const imgWidth = $(this).width();
					const resizeRatio =
						(imgHeight - pImgBaselineOffset) / imgHeight;
					$(this).css('height', imgHeight - pImgBaselineOffset);
					$(this).css('width', Math.round(imgWidth * resizeRatio));
				}
			} else if (
				viewportWidth > 767 &&
				$(this).hasClass('baseline-adjustable')
			) {
				const imgBaselineOffset = imgHeight % verticalRhythm;
				$(this).css(
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
