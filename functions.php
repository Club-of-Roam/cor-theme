<?php
/**
 * Enfold Child Theme entry file.
 *
 * @package cor-theme
 */

/*
THEME ESSENTIALS
-----------------------------------------
*/

/**
 * Load theme textdomain.
 *
 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
function cor_theme_setup() {
	load_child_theme_textdomain( 'cor-theme', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'cor_theme_setup' );


/**
 * Loads scripts & styles.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
function cor_theme_load_scripts() {
	if ( ! is_admin() ) {
		// TODO: Remove this and delete file to use original version from enfold theme.
		/* Adjustment of parent theme */
		wp_deregister_script( 'avia-shortcodes' );
		wp_register_script( 'avia-shortcodes', get_stylesheet_directory_uri() . '/js/shortcodes.js', [ 'jquery' ], '1.1', true );
		wp_enqueue_script( 'avia-shortcodes' );

		/* Register custom scripts */
		wp_register_script( 'cor-miscellaneous', get_stylesheet_directory_uri() . '/js/cor-miscellaneous.js', [ 'jquery' ], '2014-05-30-01', true );
		// TODO: Remove this and delete file. It is not used anymore.
		wp_register_script(
			'header-image',
			get_stylesheet_directory_uri() . '/js/header-image.js',
			[
				'jquery',
				'jquery-scrollTo',
			],
			'2014.05.01.1',
			true
		);
		// TODO: Remove this and delete file. It is not used anymore.
		wp_register_script( 'jquery-scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.js', [ 'jquery' ], '2014-05-01-01', true );
		wp_register_script( 'pille-baseline-grid', get_stylesheet_directory_uri() . '/js/pille-baseline-grid.js', [ 'jquery' ], '2014-07-14-01', true );
		wp_register_script( 'pille-form-styling', get_stylesheet_directory_uri() . '/js/pille-form-styling.js', [ 'jquery' ], '2014-07-14-01', true );
		wp_register_script( 'pille-tooltip', get_stylesheet_directory_uri() . '/js/pille-tooltip.js', false, '2014-07-14-01', true );

		/* Enqueue custom scripts */
		wp_enqueue_script( 'cor-miscellaneous' );
		// TODO: Remove this and delete file. It is not used anymore.
		wp_enqueue_script( 'jquery-scrollTo' );
		wp_enqueue_script( 'pille-baseline-grid' );
		wp_enqueue_script( 'pille-tooltip' );
	}
}

add_action( 'wp_enqueue_scripts', 'cor_theme_load_scripts' );


/*
Add Polylang support (to use instead of WPML)
-----------------------------------------
*/

/** Append Polylang language switcher to header */
function append_polylang_func() {
	$option = avia_get_option( 'wpml_header_lang_flags' );

	if ( 'hide_all' === $option || ! function_exists( 'pll_the_languages' ) ) {
		return;
	}

	$language_switcher = pll_the_languages(
		[
			'show_flags' => 1,
			'show_names' => 0,
			'echo'       => 0,
		]
	);

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo "<ul class='lang_switcher_polylang'>$language_switcher</ul>";
}

add_action( 'avia_meta_header', 'append_polylang_func' );
add_action( 'ava_main_header_sidebar', 'append_polylang_func' );

/**
 * Turn off canonical URL check for Polylang.
 * This fixes the issue that Polylang redirects to the default language URL if both posts have the same name.
 */
add_filter( 'pll_check_canonical_url', '__return_false' );

/**
 * Custom home_url() function to use Polylang.
 *
 * @param string $path Optional. Path relative to the home URL. Default empty.
 *
 * @return string
 */
function cor_home_url( string $path = '' ): string {
	$post_id = url_to_postid( $path );

	if ( $post_id > 0 ) {
		$translated_post_id = 0;

		if ( function_exists( 'pll_get_post' ) ) {
			$translated_post_id = pll_get_post( $post_id );
		} elseif ( function_exists( 'icl_object_id' ) ) {
			$translated_post_id = icl_object_id( $post_id, 'page', true );
		}

		return get_permalink( $translated_post_id > 0 ? $translated_post_id : $post_id );
	}

	$home_url = get_home_url();
	if ( function_exists( 'pll_home_url' ) ) {
		$home_url = pll_home_url();
	} elseif ( function_exists( 'icl_get_home_url' ) ) {
		$home_url = icl_get_home_url();
	}

	return $home_url . ltrim( $path, '/' );
}


/*
MODIFICATIONS OF PARENT
-----------------------------------------
*/

/** Unset copyright notice of Enfold theme */
function cor_unset_copyright(): string {
	return '';
}

add_filter( 'kriesi_backlink', 'cor_unset_copyright' );

/** Add current year shortcode to use it in the copyright notice */
function year_shortcode() {
	return gmdate( 'Y' );
}

add_shortcode( 'year', 'year_shortcode' );


/**
 * Add fonts.
 *
 * TODO: Remove this and use self-hosted fonts
 */
function cor_add_fonts(): array {
	return [
		'Web save fonts' => [
			'Arial'          => 'Arial-websave',
			'Georgia'        => 'Georgia-websave',
			'Verdana'        => 'Verdana-websave',
			'Helvetica'      => 'Helvetica-websave',
			'Helvetica Neue' => 'Helvetica-Neue,Helvetica-websave',
			'Lucida'         => '"Lucida-Sans",-"Lucida-Grande",-"Lucida-Sans-Unicode-websave"',
		],
		'Google fonts'   => [
			'Arimo'       => 'Arimo',
			'Cardo'       => 'Cardo',
			'Droid Sans'  => 'Droid Sans',
			'Droid Serif' => 'Droid Serif',
			'Kameron'     => 'Kameron',
			'Lato'        => 'Lato:300,400,700',
			'Lora'        => 'Lora',
			'Maven Pro'   => 'Maven Pro',
			'Nunito'      => 'Nunito:300,600',
			'Open Sans'   => 'Open Sans:400,600',
			'Raleway'     => 'Raleway',
		],
	];
}

add_filter( 'avf_google_content_font', 'cor_add_fonts' );


/**
 * Load Google Web Font Raleway.
 *
 * TODO: Remove this and use self-hosted fonts
 */
function cor_google_fonts() {
	wp_register_style( 'p1lle-google-webfonts', 'https://fonts.googleapis.com/css?family=Raleway:700,900,400,300,200,100', [], '2014-05-18' );
	wp_enqueue_style( 'p1lle-google-webfonts' );
}

add_action( 'wp_enqueue_scripts', 'cor_google_fonts' );


/**
 * Pre-Selection for Theme Options
 *
 * @param array<string, array> $styles skin options
 *
 * @return array
 */
function cor_add_style( array $styles ): array {
	unset( $styles['Vine'] );

	$styles['Club of Roam'] = [
		'style'                                => 'background-color:#55606e;',
		'default_font'                         => 'Helvetica',
		'google_webfont'                       => 'Raleway',
		'color_scheme'                         => 'Tramprennen',

		// header
		'colorset-header_color-bg'             => '#55606e',
		'colorset-header_color-bg2'            => '#55606e',
		'colorset-header_color-primary'        => '#e1e1e1',
		'colorset-header_color-secondary'      => '#ffffff',
		'colorset-header_color-color'          => '#e1e1e1',
		'colorset-header_color-border'         => '#55606e',
		'colorset-header_color-img'            => '',
		'colorset-header_color-customimage'    => '',
		'colorset-header_color-pos'            => 'top center',
		'colorset-header_color-repeat'         => 'repeat',
		'colorset-header_color-attach'         => 'scroll',

		// main
		'colorset-main_color-bg'               => '#ffffff',
		'colorset-main_color-bg2'              => '#e1e1e1',
		'colorset-main_color-primary'          => '#e2007a',
		'colorset-main_color-secondary'        => '#e2007a',
		'colorset-main_color-color'            => '#4a4d54',
		'colorset-main_color-border'           => '#e1e1e1',
		'colorset-main_color-img'              => '',
		'colorset-main_color-customimage'      => '',
		'colorset-main_color-pos'              => 'top center',
		'colorset-main_color-repeat'           => 'repeat',
		'colorset-main_color-attach'           => 'scroll',

		// Alternate
		'colorset-alternate_color-bg'          => '#dfe8ff',
		'colorset-alternate_color-bg2'         => '#92b1ff',
		'colorset-alternate_color-primary'     => '#e2007a',
		'colorset-alternate_color-secondary'   => '#c79a52',
		'colorset-alternate_color-color'       => '#4a4d54',
		'colorset-alternate_color-border'      => '#92b1ff',
		'colorset-alternate_color-img'         => '',
		'colorset-alternate_color-customimage' => '',
		'colorset-alternate_color-pos'         => 'top center',
		'colorset-alternate_color-repeat'      => 'repeat',
		'colorset-alternate_color-attach'      => 'scroll',

		// Slideshow
		'colorset-slideshow_color-bg'          => '#e1e1e1',
		'colorset-slideshow_color-bg2'         => '#e1e1e1',
		'colorset-slideshow_color-primary'     => '#e2007a',
		'colorset-slideshow_color-secondary'   => '#c79a54',
		'colorset-slideshow_color-color'       => '#4a4d54',
		'colorset-slideshow_color-border'      => '#e1e1e1',
		'colorset-slideshow_color-img'         => '',
		'colorset-slideshow_color-customimage' => '',
		'colorset-slideshow_color-pos'         => 'top center',
		'colorset-slideshow_color-repeat'      => 'repeat',
		'colorset-slideshow_color-attach'      => 'scroll',

		// Footer
		'colorset-footer_color-bg'             => '#55606e',
		'colorset-footer_color-bg2'            => '#55606e',
		'colorset-footer_color-primary'        => '#ffffff',
		'colorset-footer_color-secondary'      => '#dfe8ff',
		'colorset-footer_color-color'          => '#ffffff',
		'colorset-footer_color-border'         => '#4a4d54',
		'colorset-footer_color-img'            => '',
		'colorset-footer_color-customimage'    => '',
		'colorset-footer_color-pos'            => 'top center',
		'colorset-footer_color-repeat'         => 'repeat',
		'colorset-footer_color-attach'         => 'scroll',

		// Socket
		'colorset-socket_color-bg'             => '#4a4d54',
		'colorset-socket_color-bg2'            => '#4a4d54',
		'colorset-socket_color-primary'        => '#e2007a',
		'colorset-socket_color-secondary'      => '#c79a54',
		'colorset-socket_color-color'          => '#dfe8ff',
		'colorset-socket_color-border'         => '#55606e',
		'colorset-socket_color-img'            => '',
		'colorset-socket_color-customimage'    => '',
		'colorset-socket_color-pos'            => 'top center',
		'colorset-socket_color-repeat'         => 'repeat',
		'colorset-socket_color-attach'         => 'scroll',

		// body bg
		'color-body_style'                     => 'stretched',
		'color-body_color'                     => '#ffffff',
		'color-body_fontcolor'                 => '#4a4d54',
		'color-body_attach'                    => 'scroll',
		'color-body_repeat'                    => 'repeat',
		'color-body_pos'                       => 'top center',
		'color-body_img'                       => AVIA_BASE_URL . 'images/background-images/grunge-big-superlight.png',
		'color-body_customimage'               => '',
	];

	return $styles;
}

add_filter( 'avf_skin_options', 'cor_add_style' );


/*
LOG- IN/OUT LINKS
-----------------------------------------
*/

/**
 * Add user profile and login/out links to avia menu.
 *
 * @param string   $items The HTML list content for the menu items.
 * @param stdClass $args An object containing wp_nav_menu() arguments.
 *
 * @return string
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_nav_menu_items/
 */
function cor_add_loginout_link( string $items, stdClass $args ): string {
	if ( doing_action( 'customize_register' ) ) {
		return $items;
	}

	if ( 'avia' === $args->theme_location ) {
		if ( is_user_logged_in() ) {
			global $current_user;
			if ( ! in_array( 'route', $current_user->roles, true ) ) {
				$profile_url          = esc_url( cor_home_url( '/profile' ) );
				$profile_button_title = esc_attr__( 'Edit your user profile & settings', 'cor-theme' );
				$user_login           = esc_html( $current_user->user_login );
				$items               .= <<<HTML
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level">
						<a href="$profile_url" title="$profile_button_title">$user_login</a>
					</li>
HTML;
			} else {
				$submit_points_url   = esc_url( cor_home_url( '/submit-points' ) );
				$submit_points_title = esc_attr__( 'Submit race results', 'cor-theme' );
				$submit_points_text  = esc_html__( 'Submit Points', 'cor-theme' );

				$items .= <<<HTML
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level">
						<a style="font-weight:bold;" href="$submit_points_url" title="$submit_points_title">$submit_points_text</a>
					</li>
HTML;
			}
			$logout_url          = esc_url( cor_home_url( '/logout' ) );
			$logout_button_title = esc_attr__( 'Leave', 'cor-theme' );
			$logout_button_text  = esc_html__( 'Logout', 'cor-theme' );
			$items              .= <<<HTML
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level ">
					<a href="$logout_url" title="$logout_button_title">$logout_button_text</a>
				</li>
HTML;
		} else {
			$login_url          = esc_url( cor_home_url( '/login' ) );
			$login_button_title = esc_attr__( 'Login to tramprennen.org', 'cor-theme' );
			$login_button_text  = esc_html__( 'Login', 'cor-theme' );
			$items             .= <<<HTML
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level ">
					<a href="$login_url" title="$login_button_title">$login_button_text</a>
				</li>
HTML;
		}
	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'cor_add_loginout_link', 10, 2 );


/**
 * Remove admin bar for non-admin users.
 *
 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
function remove_admin_bar() {
	global $current_user;
	show_admin_bar( in_array( 'administrator', $current_user->roles, true ) );
}

add_action( 'after_setup_theme', 'remove_admin_bar' );


/**
 * Remove the WPML-Function `$sitepress->show_user_options` from the hook to edit user profile page.
 *
 * @see https://developer.wordpress.org/reference/hooks/show_user_profile/
 */
global $sitepress; // $sitepress is the main instance from WPML Multilingual CMS Plugin
remove_action( 'show_user_profile', [ $sitepress, 'show_user_options' ] );


/*
Registration custom fields
-----------------------------------------
*/

/**
 * Generate custom errors for registration.
 *
 * @param WP_Error $errors A WP_Error object containing any errors encountered during registration.
 *
 * @return WP_Error
 *
 * @see https://developer.wordpress.org/reference/hooks/registration_errors/
 */
function tml_registration_errors( WP_Error $errors ): WP_Error {
	if ( ! isset( $_POST['privacy_data_police_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['privacy_data_police_nonce'] ), 'accept-privacy-data-police-at-register' ) ) {
		return $errors;
	}

	if ( ! isset( $_POST['privacy_data_police'] ) ) {
		$error_title = esc_html__( 'ERROR', 'cor-theme' );
		$error_text  = esc_html__( 'Please accept the privacy data policy.', 'cor-theme' );

		$errors->add( 'empty_first_name', "<strong>$error_title</strong>: $error_text" );
	}

	return $errors;
}

add_filter( 'registration_errors', 'tml_registration_errors' );


/**
 * Save `privacy_data_police` to user meta from registration.
 *
 * @param int $user_id User ID.
 *
 * @see https://developer.wordpress.org/reference/hooks/user_register/
 */
function tml_user_register( int $user_id ) {
	if ( ! isset( $_POST['privacy_data_police_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['privacy_data_police_nonce'] ), 'accept-privacy-data-police-at-register' ) ) {
		return;
	}

	if ( isset( $_POST['privacy_data_police'] ) ) {
		update_user_meta( $user_id, 'privacy_data_police', true );
	}
}

add_action( 'user_register', 'tml_user_register' );


/**
 * Save privacy data police after theme loaded and user logged in.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_footer/
 */
function check_privacy_data_option() {
	$user_id      = get_current_user_id();
	$user_privacy = get_user_meta( $user_id, 'privacy_data_police', true );

	if ( ! is_user_logged_in() || ! current_user_can( 'edit_user', $user_id ) || '1' === $user_privacy ) {
		return;
	}

	$valid_nonce = isset( $_POST['privacy_data_police_nonce'] ) && wp_verify_nonce(
		sanitize_key( $_POST['privacy_data_police_nonce'] ),
		'accept-privacy-data-police-after-login'
	);

	if ( $valid_nonce && isset( $_POST['privacy_data_police_action'] ) && 'Delete my account' === $_POST['privacy_data_police_action'] ) {
		require_once ABSPATH . 'wp-admin/includes/user.php';
		$user_id = get_current_user_id();

		wp_delete_user( $user_id );

		echo <<<'HTML'
			<div class="overlay_data_police main_color">
				<div class="innerlay_data_police">
					<h3>
HTML;
		esc_html_e( 'Please wait, your account will be deleted soon!', 'cor-theme' );
		echo <<<'HTML'
					</h3>
				</div>
			</div>
HTML;

		wp_enqueue_script( 'h3-mgmt-redirect' );

		wp_localize_script(
			'h3-mgmt-redirect',
			'app_vars',
			[
				'url' => cor_home_url(),
			]
		);

		return;
	}

	$show_message = false;

	if ( $valid_nonce && isset( $_POST['privacy_data_police_action'] ) && 'Accept' === $_POST['privacy_data_police_action'] ) {
		if ( isset( $_POST['privacy_data_police'] ) ) {
			update_user_meta( $user_id, 'privacy_data_police', true );

			return;
		} else {
			$show_message = true;
		}
	}

	echo <<<'HTML'
<div class="overlay_data_police main_color" style="
    position: fixed;
    padding: 100px 0;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: rgba(51,51,51,0.7);
    z-index: 9999999999999;
	">
		<div class="innerlay_data_police" style="
			background: white;
			width: 70%;
			height: inherit;
			max-height: max-content;
			margin: auto;
			padding: 10px;
			overflow: auto;
			position: relative;
		">
HTML;

	if ( $show_message ) {
		echo '<p style="font-size: 1.5em; line-height: 1.533333333333; padding: 0 0 1.533333333333em 0;" class="error">';
		esc_html_e( 'Please check the checkbox to accept our privacy data policy.', 'cor-theme' );
		echo '</p>';
	}

	echo '<h3>';
	esc_html_e( 'Welcome back,', 'cor-theme' );
	echo <<<'HTML'
		</h3>
			<p style="
				font-size: 1.5em;
				line-height: 1.533333333333;
				padding: 0 0 1.533333333333em 0;
			">
HTML;
	echo nl2br( esc_html__( 'you have to update your privacy settings!\nPlease accept our privacy data policy to continue. Otherwise, you have to delete your account...', 'cor-theme' ) );

	echo <<<'HTML'
			</p>

			<form id="privacy_data_police_form" action="" method="post">
				<div class="form-row">
					<label style="display: block; font-weight: bold; font-size: 1.5em;" for="privacy_data_police">
HTML;
	esc_html_e( 'Accept the privacy data policy', 'cor-theme' );

	echo <<<'HTML'
					</label>
					<input type="checkbox" name="privacy_data_police" id="privacy_data_police" class="input" value="" />
HTML;
	wp_nonce_field( 'accept-privacy-data-police-after-login', 'privacy_data_police_nonce' );

	echo <<<'HTML'
					<p style="
						font-size: 1.5em;
						line-height: 1.533333333333;
						padding: 0 0 1.533333333333em 0;
					">
					HTML;
	esc_html_e( 'Please read our privacy data policy carefully.', 'cor-theme' );
	echo ' <a href="';
	echo esc_url( cor_home_url( '/home/privacy-data-policy' ) );
	echo ' target="_blank">';
	esc_html_e( 'You will find it here.', 'cor-theme' );
	echo <<<'HTML'
						</a>
					</p>
				</div>

				<div class="form-row">
					<input type="submit" name="privacy_data_police_action" id="privacy_data_police_action" value="Accept" />
				</div>

				<div class="form-row">
					<input type="submit" name="privacy_data_police_action"
						id="privacy_data_police_action"
						value="Delete my account"
						onclick="return confirm('Do you really want to delete your account? This will be permanent and cannot be undone!');"
					/>
				</div>

			</form>
		</div>
	</div>
HTML;
}

add_action( 'wp_footer', 'check_privacy_data_option' );


/**
 * Changes the login redirect to referer if no specific redirect was requested.
 * (Replaces TML redirect module)
 *
 * @param string           $redirect_to The redirect destination URL.
 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
 * @param WP_User|WP_Error $user WP_User object if login was successful, WP_Error object otherwise.
 *
 * @return string
 *
 * @see https://developer.wordpress.org/reference/hooks/login_redirect/
 */
function login_referer_redirect( string $redirect_to, string $requested_redirect_to, $user ): string {
	if ( ! $user instanceof WP_User ) {
		return $redirect_to;
	}

	// Only redirect if no specific redirect was requested
	if ( empty( trim( $requested_redirect_to ) ) ) {
		$referer = wp_get_original_referer();

		if ( false === $referer ) {
			$referer = wp_get_referer();
		}

		// Ensure the referrer exists and is not the login or admin page
		if ( ! $referer || strpos( $referer, 'login' ) !== false || strpos( $referer, 'wp-admin' ) !== false ) {
			return cor_home_url();
		}

		return $referer;
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'login_referer_redirect', 10, 3 );


/**
 * Redirect to localized home URL after logout.
 * (Replaces TML redirect module)
 *
 * @return string
 *
 * @see https://developer.wordpress.org/reference/hooks/logout_redirect/
 */
function logout_home_redirect(): string {
	return cor_home_url();
}

add_filter( 'logout_redirect', 'logout_home_redirect' );


/**
 * Changes the action URL for login, register and lostpassword to their translated counterparts.
 * (For TML with Polylang)
 *
 * @param string $url The requested action URL.
 * @param string $action Action to retrieve. ('login'|'register'|'lostpassword')
 *
 * @return string
 *
 * @see https://docs.thememylogin.com/article/54-legacy-changing-action-links
 */
function tml_action_url( string $url, string $action ): string {
	if ( 'login' === $action ) {
		$url = cor_home_url( '/login' );
	} elseif ( 'register' === $action ) {
		$url = cor_home_url( '/register' );
	} elseif ( 'lostpassword' === $action ) {
		$url = cor_home_url( '/lostpassword' );
	}

	return $url;
}

add_filter( 'tml_action_url', 'tml_action_url', 10, 2 );

/**
 * Sets a 404 error for wp-login.php.
 * (Replaces 'Private Login' of TML security module)
 *
 * @see https://developer.wordpress.org/reference/hooks/init/
 */
function disable_wp_login() {
	global $wp_query, $pagenow;

	if ( 'wp-login.php' === $pagenow ) {
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();

		$template = get_404_template();
		include $template;
		exit;
	}
}

add_action( 'init', 'disable_wp_login' );

/*
SECONDARY FILES
-----------------------------------------
*/

// none so far
