import wordpress from '@wordpress/eslint-plugin';
import globals from 'globals';
import eslintConfigPrettier from 'eslint-config-prettier/flat';

export default [
	{ ignores: ['node_modules/', 'build/', 'vendor/'] },
	...wordpress.configs.recommended,
	...wordpress.configs.i18n,
	eslintConfigPrettier,
	{
		languageOptions: {
			globals: {
				...globals.browser,
				...globals.jquery,
				wp: 'readonly',
			},
		},
		rules: {
			curly: ['error', 'all'],
			'no-unused-vars': 'warn',
			'prefer-arrow-callback': 'warn',
			'jsdoc/require-jsdoc': [
				'warn',
				{
					require: {
						FunctionDeclaration: true,
						ArrowFunctionExpression: true,
						ClassDeclaration: true,
						ClassExpression: true,
						FunctionExpression: true,
						MethodDefinition: true,
					},
					exemptEmptyFunctions: true,
				},
			],
			'jsdoc/require-param': 'warn',
			'jsdoc/require-param-type': 'warn',
			'jsdoc/require-returns': 'warn',
			'jsdoc/require-returns-type': 'warn',
			'jsdoc/require-returns-description': 'off',
		},
	},
];
