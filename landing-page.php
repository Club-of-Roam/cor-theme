<?php

function cor_add_image_to_header()
{
	if ( is_front_page() ) {
		echo '<div id="header-image">' .
				'<img src="' . get_stylesheet_directory_uri() . '/img/test.jpg" />' .
			'</div>';
	}
}
add_action( 'ava_main_header', 'cor_add_image_to_header' );

?>
