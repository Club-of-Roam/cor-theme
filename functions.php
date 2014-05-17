<?php

/* COLOR SCHEME
-----------------------------------------

grey 1			#b2a8ad
light blue 1	#b3e7fa
light blue 2	#89daf8
magenta			#d11847

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
		wp_register_script( 'jquery-scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.js', array( 'jquery' ), '2014.05.01.1', true );
		wp_register_script( 'header-image', get_template_directory_uri() . '/js/header-image.js', array( 'jquery', 'jquery-scrollTo' ), '2014.05.01.1', true );

		wp_enqueue_script( 'jquery-scrollTo' );
		wp_enqueue_script( 'header-image' );
	}
}
add_action ( 'wp_enqueue_scripts', 'cor_theme_load_scripts' );

/* MODIFICATIONS OF PARENT
----------------------------------------- */

/* unset copyright notice */
function cor_unset_copyright(){
    return '';
}
add_filter( 'kriesi_backlink', 'unset_copyright' );

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
			'Raleway'=>'Raleway:100'
		)
	);
}
add_filter( 'avf_google_content_font', 'cor_add_fonts' );

/* add self defined styles in place of a default style */


/* add fonts */
function cor_add_style( $styles ){
	unset( $styles['Vine'] );

	$styles['Tramprennen'] = array(
		"style"=> "background-color:#b2a8ad;",
		"default_font" => "Open Sans",
		"google_webfont" => "Raleway:200,400",
		"color_scheme"	=> "Tramprennen",

		// header
		"colorset-header_color-bg"				=> "#b2a8ad",
		"colorset-header_color-bg2"				=> "#b2a8ad",
		"colorset-header_color-primary"			=> "#ffffff",
		"colorset-header_color-secondary"		=> "#d11847",
		"colorset-header_color-color"			=> "#ffffff",
		"colorset-header_color-border"			=> "#d11847",
		"colorset-header_color-img"				=> "",
		"colorset-header_color-customimage"		=> "",
		"colorset-header_color-pos" 			=> "top center",
		"colorset-header_color-repeat" 			=> "repeat",
		"colorset-header_color-attach" 			=> "scroll",

		// main
		"colorset-main_color-bg"				=> "#ffffff",
		"colorset-main_color-bg2"				=> "#eeeeee",
		"colorset-main_color-primary"			=> "#000000",
		"colorset-main_color-secondary"			=> "#d11847",
		"colorset-main_color-color"				=> "#000000",
		"colorset-main_color-border"			=> "#dddddd",
		"colorset-main_color-img"				=> "",
		"colorset-main_color-customimage"		=> "",
		"colorset-main_color-pos" 				=> "top center",
		"colorset-main_color-repeat" 			=> "repeat",
		"colorset-main_color-attach" 			=> "scroll",

		// Alternate
		"colorset-alternate_color-bg"				=> "#b3e7fa",
		"colorset-alternate_color-bg2"				=> "#89daf8",
		"colorset-alternate_color-primary"			=> "#000000",
		"colorset-alternate_color-secondary"		=> "#d11847",
		"colorset-alternate_color-color"			=> "#000000",
		"colorset-alternate_color-border"			=> "#35c2f6",
		"colorset-alternate_color-img"				=> "",
		"colorset-alternate_color-customimage"		=> "",
		"colorset-alternate_color-pos" 				=> "top center",
		"colorset-alternate_color-repeat" 			=> "repeat",
		"colorset-alternate_color-attach" 			=> "scroll",

		// Slideshow
		"colorset-slideshow_color-bg"			=> "#fcfcfc",
		"colorset-slideshow_color-bg2"			=> "#ffffff",
		"colorset-slideshow_color-primary"		=> "888888",
		"colorset-slideshow_color-secondary"	=> "#d11847",
		"colorset-slideshow_color-color"		=> "#888888",
		"colorset-slideshow_color-border"		=> "#ebebeb",
		"colorset-slideshow_color-img"			=> "",
		"colorset-slideshow_color-customimage"	=> "",
		"colorset-slideshow_color-pos" 			=> "top center",
		"colorset-slideshow_color-repeat" 		=> "repeat",
		"colorset-slideshow_color-attach" 		=> "scroll",

		// Footer
		"colorset-footer_color-bg"				=> "#989194",
		"colorset-footer_color-bg2"				=> "#989194",
		"colorset-footer_color-primary"			=> "#ffffff",
		"colorset-footer_color-secondary"		=> "#d11847",
		"colorset-footer_color-color"			=> "#ffffff",
		"colorset-footer_color-border"			=> "#807877",
		"colorset-footer_color-img"				=> "",
		"colorset-footer_color-customimage"		=> "",
		"colorset-footer_color-pos" 			=> "top center",
		"colorset-footer_color-repeat" 			=> "repeat",
		"colorset-footer_color-attach" 			=> "scroll",

		// Socket
		"colorset-socket_color-bg"				=> "#b2a8ad",
		"colorset-socket_color-bg2"				=> "#b2a8ad",
		"colorset-socket_color-primary"			=> "#000000",
		"colorset-socket_color-secondary"		=> "#d11847",
		"colorset-socket_color-color"			=> "#000000",
		"colorset-socket_color-border"			=> "#806e6e",
		"colorset-socket_color-img"				=> "",
		"colorset-socket_color-customimage"		=> "",
		"colorset-socket_color-pos" 			=> "top center",
		"colorset-socket_color-repeat" 			=> "repeat",
		"colorset-socket_color-attach" 			=> "scroll",

		//body bg
		"color-body_style"						=> "stretched",
		"color-body_color"						=> "#ffffff",
		"color-body_fontcolor"					=> "#ffffff",
		"color-body_attach"						=> "scroll",
		"color-body_repeat"						=> "repeat",
		"color-body_pos"						=> "top center",
		"color-body_img"						=> AVIA_BASE_URL."images/background-images/grunge-big-superlight.png",
		"color-body_customimage"				=> "",
	);

	return $styles;
}
add_filter( 'avf_skin_options', 'cor_add_style' );


/* SECONDARY FILES
----------------------------------------- */

require_once( 'landing-page.php' );