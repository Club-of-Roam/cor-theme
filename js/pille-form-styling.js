(($) => {
	const pilleSetupLabel = () => {
		if ($('.check-row input').length) {
			$('.check-row').each(() => {
				$(this).addClass('check-off');
				$(this).removeClass('check-on');
			});
			$('.check-row input:checked').each(() => {
				$(this).parent('div').addClass('check-on');
				$(this).parent('div').removeClass('check-off');
			});
		}

		if ($('.radio-row input').length) {
			$('.radio-row').each(() => {
				$(this).addClass('radio-off');
				$(this).removeClass('radio-on');
			});
			$('.radio-row input:checked').each(() => {
				$(this).parent('div').addClass('radio-on');
				$(this).parent('div').removeClass('radio-off');
			});
		}
	};

	$(() => {
		$('.check-row label, .radio-row label').on('click', () => {
			pilleSetupLabel();
		});
		pilleSetupLabel();
	});
})(jQuery);
