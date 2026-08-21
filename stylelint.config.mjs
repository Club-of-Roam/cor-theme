/** @type {import('stylelint').Config} */
export default {
	extends: ['@wordpress/stylelint-config'],
	rules: {
		'selector-class-pattern': ['^([a-z][a-z0-9]*)([-_][a-z0-9]+)*$'],
		'no-descending-specificity': null,
	},
};
