<?php

/* COLOR SCHEME
-----------------------------------------

grey 1              #55606e
light blue 1	    #b3e7fa
light blue 2	    #89daf8
magenta             #dfe8ff

*/


/* THEME ESSENTIALS
----------------------------------------- */

/* load theme textdomain */
function cor_theme_setup(){
    load_child_theme_textdomain( 'cor', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'cor_theme_setup' );

/* loads scripts & libraries */
function cor_theme_load_scripts() {
	if ( ! is_admin() ) {
		/* Adjustment of parent theme */
		wp_deregister_script( 'avia-shortcodes' );
		wp_register_script( 'avia-shortcodes', get_stylesheet_directory_uri() . '/js/shortcodes.js', array( 'jquery' ), '1.1', true );
		wp_enqueue_script( 'avia-shortcodes' );

		/* Register custom scripts */
		wp_register_script( 'cor-miscellaneous', get_stylesheet_directory_uri() . '/js/cor-miscellaneous.js', array( 'jquery' ), '2014-05-30-01', true );
		wp_register_script( 'header-image', get_stylesheet_directory_uri() . '/js/header-image.js', array( 'jquery', 'jquery-scrollTo' ), '2014.05.01.1', true );
		wp_register_script( 'jquery-scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.js', array( 'jquery' ), '2014-05-01-01', true );
		wp_register_script( 'pille-baseline-grid', get_stylesheet_directory_uri() . '/js/pille-baseline-grid.js', array( 'jquery' ), '2014-07-14-01', true );
		wp_register_script( 'pille-form-styling', get_stylesheet_directory_uri() . '/js/pille-form-styling.js', array( 'jquery' ), '2014-07-14-01', true );
		wp_register_script( 'pille-tooltip', get_stylesheet_directory_uri() . '/js/pille-tooltip.js', false, '2014-07-14-01', true );

		wp_enqueue_script( 'cor-miscellaneous' );
		//wp_enqueue_script( 'header-image' );
		wp_enqueue_script( 'jquery-scrollTo' );
		wp_enqueue_script( 'pille-baseline-grid' );
		//wp_enqueue_script( 'pille-form-styling' );
		wp_enqueue_script( 'pille-tooltip' );
	}
}
add_action ( 'wp_enqueue_scripts', 'cor_theme_load_scripts' );


/* MODIFICATIONS OF PARENT
----------------------------------------- */

/* unset copyright notice */
function cor_unset_copyright(){
    return '';
}
add_filter( 'kriesi_backlink', 'cor_unset_copyright' );

/* add fonts */
function cor_add_fonts(){
    return array(
		'Web save fonts'=> array(
			'Arial'=>'Arial-websave',
			'Georgia'=>'Georgia-websave',
			'Verdana'=>'Verdana-websave',
			'Helvetica'=>'Helvetica-websave',
			'Helvetica Neue'=>'Helvetica-Neue,Helvetica-websave',
			'Lucida'=>'"Lucida-Sans",-"Lucida-Grande",-"Lucida-Sans-Unicode-websave"'
		),
		'Google fonts'=> array(
			'Arimo'=>'Arimo',
			'Cardo'=>'Cardo',
			'Droid Sans'=>'Droid Sans',
			'Droid Serif'=>'Droid Serif',
			'Kameron'=>'Kameron',
			'Lato'=>'Lato:300,400,700',
			'Lora'=>'Lora',
			'Maven Pro'=>'Maven Pro',
			'Nunito'=>'Nunito:300,600',
			'Open Sans'=>'Open Sans:400,600',
			'Raleway'=>'Raleway'
		)
	);
}
add_filter( 'avf_google_content_font', 'cor_add_fonts' );


/**
 * Google Web Fonts done right
 */
function cor_google_fonts() {
	wp_register_style( 'p1lle-google-webfonts', 'http://fonts.googleapis.com/css?family=Raleway:700,900,400,300,200,100', array(), '2014-05-18' );
	wp_enqueue_style( 'p1lle-google-webfonts' );
}
add_action( 'wp_enqueue_scripts', 'cor_google_fonts' );


/**
 * Pre-Selection for Theme Options
 */
function cor_add_style( $styles ){
	unset( $styles['Vine'] );

	$styles['Club of Roam'] = array(
		"style"=> "background-color:#55606e;",
		"default_font" => "Helvetica",
		"google_webfont" => "Raleway",
		"color_scheme"	=> "Tramprennen",

		// header
		"colorset-header_color-bg"				=> "#55606e",
		"colorset-header_color-bg2"				=> "#55606e",
		"colorset-header_color-primary"			=> "#e1e1e1",
		"colorset-header_color-secondary"		=> "#ffffff",
		"colorset-header_color-color"			=> "#e1e1e1",
		"colorset-header_color-border"			=> "#55606e",
		"colorset-header_color-img"				=> "",
		"colorset-header_color-customimage"		=> "",
		"colorset-header_color-pos" 			=> "top center",
		"colorset-header_color-repeat" 			=> "repeat",
		"colorset-header_color-attach" 			=> "scroll",

		// main
		"colorset-main_color-bg"				=> "#ffffff",
		"colorset-main_color-bg2"				=> "#e1e1e1",
		"colorset-main_color-primary"			=> "#e2007a",
		"colorset-main_color-secondary"			=> "#e2007a",
		"colorset-main_color-color"				=> "#4a4d54",
		"colorset-main_color-border"			=> "#e1e1e1",
		"colorset-main_color-img"				=> "",
		"colorset-main_color-customimage"		=> "",
		"colorset-main_color-pos" 				=> "top center",
		"colorset-main_color-repeat" 			=> "repeat",
		"colorset-main_color-attach" 			=> "scroll",

		// Alternate
		"colorset-alternate_color-bg"				=> "#dfe8ff",
		"colorset-alternate_color-bg2"				=> "#92b1ff",
		"colorset-alternate_color-primary"			=> "#e2007a",
		"colorset-alternate_color-secondary"		=> "#c79a52",
		"colorset-alternate_color-color"			=> "#4a4d54",
		"colorset-alternate_color-border"			=> "#92b1ff",
		"colorset-alternate_color-img"				=> "",
		"colorset-alternate_color-customimage"		=> "",
		"colorset-alternate_color-pos" 				=> "top center",
		"colorset-alternate_color-repeat" 			=> "repeat",
		"colorset-alternate_color-attach" 			=> "scroll",

		// Slideshow
		"colorset-slideshow_color-bg"			=> "#e1e1e1",
		"colorset-slideshow_color-bg2"			=> "#e1e1e1",
		"colorset-slideshow_color-primary"		=> "#e2007a",
		"colorset-slideshow_color-secondary"	=> "#c79a54",
		"colorset-slideshow_color-color"		=> "#4a4d54",
		"colorset-slideshow_color-border"		=> "#e1e1e1",
		"colorset-slideshow_color-img"			=> "",
		"colorset-slideshow_color-customimage"	=> "",
		"colorset-slideshow_color-pos" 			=> "top center",
		"colorset-slideshow_color-repeat" 		=> "repeat",
		"colorset-slideshow_color-attach" 		=> "scroll",

		// Footer
		"colorset-footer_color-bg"				=> "#55606e",
		"colorset-footer_color-bg2"				=> "#55606e",
		"colorset-footer_color-primary"			=> "#ffffff",
		"colorset-footer_color-secondary"		=> "#dfe8ff",
		"colorset-footer_color-color"			=> "#ffffff",
		"colorset-footer_color-border"			=> "#4a4d54",
		"colorset-footer_color-img"				=> "",
		"colorset-footer_color-customimage"		=> "",
		"colorset-footer_color-pos" 			=> "top center",
		"colorset-footer_color-repeat" 			=> "repeat",
		"colorset-footer_color-attach" 			=> "scroll",

		// Socket
		"colorset-socket_color-bg"				=> "#4a4d54",
		"colorset-socket_color-bg2"				=> "#4a4d54",
		"colorset-socket_color-primary"			=> "#e2007a",
		"colorset-socket_color-secondary"		=> "#c79a54",
		"colorset-socket_color-color"			=> "#dfe8ff",
		"colorset-socket_color-border"			=> "#55606e",
		"colorset-socket_color-img"				=> "",
		"colorset-socket_color-customimage"		=> "",
		"colorset-socket_color-pos" 			=> "top center",
		"colorset-socket_color-repeat" 			=> "repeat",
		"colorset-socket_color-attach" 			=> "scroll",

		//body bg
		"color-body_style"						=> "stretched",
		"color-body_color"						=> "#ffffff",
		"color-body_fontcolor"					=> "#4a4d54",
		"color-body_attach"						=> "scroll",
		"color-body_repeat"						=> "repeat",
		"color-body_pos"						=> "top center",
		"color-body_img"						=> AVIA_BASE_URL."images/background-images/grunge-big-superlight.png",
		"color-body_customimage"				=> "",
	);

	return $styles;
}
add_filter( 'avf_skin_options', 'cor_add_style' );


/* LOG- IN/OUT LINKS
----------------------------------------- */

function cor_add_loginout_link( $items, $args )
{
	if ( $args->theme_location == 'avia' ) {
		if ( is_user_logged_in() ) {
			global $current_user;
			if ( ! in_array( 'route', $current_user->roles ) ) {
				$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level "><a href="http://tramprennen.org/profile" title="' . __( 'Edit your user profile & settings', 'cor-theme' ) . '">' . $current_user->user_login . '</a></li>';
			} else {
				$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level "><a style="font-weight:bold;" href="http://tramprennen.org/submit-points/" title="' . __( 'Submit race results', 'cor-theme' ) . '">' . __( 'Submit Points', 'cor-theme' ) . '</a></li>';
			}
			$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level "><a href="' . wp_logout_url() . '" title="' . __( 'Leave', 'cor-theme' ) . '">' . __( 'Logout', 'cor-theme' ) . '</a></li>';
		} else {
			$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-top-level "><a href="http://tramprennen.org/login" title="' . __( 'Login to tramprennen.org', 'cor-theme' ) . '">' . __( 'Login', 'cor-theme' ) . '</a></li>';
		}
	}
    return $items;
}
add_filter( 'wp_nav_menu_items', 'cor_add_loginout_link', 99, 2 );


global $sitepress; // if needed
remove_action('show_user_profile', array($sitepress, 'show_user_options'));


/* SECONDARY FILES
----------------------------------------- */

// none so far


/* UPDATE NAG
----------------------------------------- */

// temporary "fix"
// The current (parent) theme is incompatible with WordPress 4.0 and up...

function remove_core_updates()
{
	global $wp_version;
	return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

?>