<?php
	global $current_user, $h3_mgmt_profile;
	$profileuser = get_user_to_edit( $current_user->ID );

	if ( ( is_array( $current_user->roles ) && in_array( 'city', $current_user->roles ) ) ) {
		$city_switch = true;
		$disable_field = ' disabled="disabled"';
	} else {
		$city_switch = false;
		$disable_field = '';
	}
?>
<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post">

		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />

		<?php $template->the_action_template_message( 'profile' ); ?>
		<?php $template->the_errors(); ?>

		<?php do_action( 'personal_options', $profileuser ); ?>
		<?php do_action( 'profile_personal_options', $profileuser ); ?>

		<h3><?php _e( 'Name', 'theme-my-login' ); ?></h3>

		<div class="form-row">
			<label for="user_login"><span class="silent-tip" onmouseover="tooltip('<?php _e( 'Your username cannot be changed.', 'theme-my-login' ); ?>');" onmouseout="exit();"><?php _e( 'Username', 'theme-my-login' ); ?></span></label>
			<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" />
		</div><div class="form-row">
			<label for="first_name"><?php _e( 'First name', 'theme-my-login' ) ?></label>
			<input type="text" name="first_name" id="first_name"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->first_name ) ?>" class="regular-text" />
		</div><div class="form-row">
			<label for="last_name"><?php _e( 'Last name', 'theme-my-login' ) ?></label>
			<input type="text" name="last_name" id="last_name"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->last_name ) ?>" class="regular-text" />
		</div><div class="form-row">
			<input type="hidden" name="nickname" id="nickname"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->nickname ) ?>" class="regular-text" />
		</div>

		<h3 class="top-space-more"><?php _e( 'Contact Info', 'theme-my-login' ) ?></h3>

		<div class="form-row">
			<label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?></label>
			<input type="email" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" class="regular-text" />
		</div>

		<h3 class="top-space-more"><?php _e( 'About You', 'theme-my-login' ) ?></h3>
                
		<?php
			$fields = array(
			array (
				'label'	=> _x( 'City', 'Team Profile Form', 'h3-mgmt' ),
				'id'	=> 'city',
				'type'	=> 'text'
			),
			array (
				'label'	=> _x( 'Date of Birth', 'Team Profile Form', 'h3-mgmt' ),
				'id'	=> 'birthday',
				'type'	=> 'date'
			),
			array (
				'label'	=> _x( 'Mobile Phone', 'Team Profile Form', 'h3-mgmt' ),
				'id'	=> 'mobile',
				'type'	=> 'text'
			),
			array (
				'label'	=> '',//_x( 'Shirt Size', 'Team Profile Form', 'h3-mgmt' ),
				'id'	=> 'shirt_size',
				'type'	=> 'hidden',
				'options' => array(
					0 => array(
						'value' => 0,
						'label' => _x( 'Please select your size...', 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'ms',
						'label' => _x( "Unisex S", 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'mm',
						'label' => _x( "Unisex M", 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'ml',
						'label' => _x( "Unisex L", 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'mx',
						'label' => _x( "Unisex XL", 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'gs',
						'label' => _x( 'Slimfit S', 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'gm',
						'label' => _x( 'Slimfit M', 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'gl',
						'label' => _x( 'Slimfit L', 'Team Profile Form', 'h3-mgmt' )
					)
				)
			),
			array (
				'label'	=> '',//_x( 'Could we give our partner Ortel Mobile your personal Information?', 'Team Profile Form', 'h3-mgmt' ),
				'id'	=> 'public_mobile_inf',
				'type'	=> 'hidden',
				'options' => array(
					0 => array(
						'value' => 0,
						'label' => _x( 'Please select if it is ok or not...', 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'yes',
						'label' => _x( "YES, give them my personal information", 'Team Profile Form', 'h3-mgmt' )
					),
					array(
						'value' => 'no',
						'label' => _x( "Please not (So you do not get your sponsored sim-card", 'Team Profile Form', 'h3-mgmt' )
					)					
				)
			),
			array (
				'label'	=> '',
				'id'	=> 'addressMobile',
				'type'	=> 'hidden'
			)
			);
			
			WP_GET_CURRENT_USER();
			$fcount = count($fields);
			for ( $i = 0; $i < $fcount; $i++ ) {
					$fields[$i]['value'] = esc_attr( get_user_meta( $current_user->ID, $fields[$i]['id'], true ) );
			}
			
			require_once( H3_MGMT_ABSPATH . '/templates/frontend-form.php' );

			echo $output;
			
		?>

		<?php wp_enqueue_script( 'user-profile' ); ?>

		<h3 class="top-space-more"><?php _e( 'New Password', 'theme-my-login' ) ?></h3>
		<div class="form-row tml-user-pass1-wrap">
			<p class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'theme-my-login' ) ?></p>
			<label for="pass11"><?php _e( 'New Password', 'theme-my-login' ) ?></label>
			<input autocomplete="off" name="pass1" id="pass11" class="input" size="20" value="" type="password">
		</div>
		<div class="form-row tml-user-pass2-wrap">
			<label for="pass21"><?php _e( 'Confirm Password', 'theme-my-login' ) ?></label>
			<input autocomplete="off" name="pass2" id="pass21" class="input" size="20" value="" type="password">
		</div>

		<?php if( ! isset( $city_switch ) || $city_switch === false ) { ?>
		<h3 class="top-space-more"><?php _e( 'Leave for good', 'theme-my-login' ); ?></h3>
		<div class="form-row check-row column-row">
			<span class="box-test"></span><input name="deleteme" type="checkbox" id="deleteme" value="forever" />
			<label for="deleteme" class="warning"><span class="box"></span><?php _e( 'Delete my account permanently', 'theme-my-login' ); ?></label>
		</div>
		<?php } ?>
		<div class="form-row">

			<input type="hidden" name="action" value="profile" />
            <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" onclick="
				if( jQuery('#deleteme').is(':checked') ) {
					if( confirm('<?php _e( "Do you really want to delete your account? This will be permanent and cannot be undone!", 'theme-my-login' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				} else if( jQuery('#birthday-year').val() <= <?php echo( (intval(date('Y')) - 100) ); ?> ) {
					if( confirm('<?php _e( 'Are you really a hundred years old???', 'theme-my-login' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				} else if( jQuery('#birthday-year').val() == 1970 && jQuery('#birthday-month').val() == 1 && jQuery('#birthday-day').val() == 1 ) {
					if( confirm('<?php _e( 'Have you really been born on January 1st, 1970?', 'theme-my-login' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				}
			" class="button-primary" value="<?php _e( 'Update Profile', 'theme-my-login' ); ?>" name="submit" />
		</div>

	</form>
	
	<p align="center"> <a href="https://tramprennen.org/privacy-data-policy/">Privacy data police</a> </p>
</div>