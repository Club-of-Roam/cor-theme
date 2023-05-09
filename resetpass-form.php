<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">

	<?php $template->the_action_template_message( 'resetpass' ); ?>
	<?php $template->the_errors(); ?>
	
	<?php wp_enqueue_script( 'user-profile' ); ?>
	<?php 
	// disable the email notification to admin when user changes password
	add_filter('wp_password_change_notification_email','my_stop_email');
	function my_stop_email($email, $user, $site) {
		$email['to']=''; //empty the TO: part, will fail to send
		return $email;
	}
	?>

	<form name="resetpasswordform" id="resetpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'resetpass' ); ?>" method="post">

		<h3 class="top-space-more"><?php _e( 'Reset Password', 'theme-my-login' ) ?></h3>
		<div class="form-row tml-user-pass1-wrap">
			<label for="pass11"><?php _e( 'New Password', 'theme-my-login' ) ?></label>
			<input autocomplete="off" name="pass1" id="pass11" class="input" size="20" value="" type="password">
		</div>
		<div class="form-row tml-user-pass2-wrap">
			<label for="pass21"><?php _e( 'Confirm Password', 'theme-my-login' ) ?></label>
			<input autocomplete="off" name="pass2" id="pass21" class="input" size="20" value="" type="password">
		</div>

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Reset Password', 'theme-my-login' ); ?>" />
		</div>

		<input type="hidden" id="user_login" value="<?php echo esc_attr( $GLOBALS['rp_login'] ); ?>" autocomplete="off" />
		<input type="hidden" name="rp_key" value="<?php echo esc_attr( $GLOBALS['rp_key'] ); ?>" />
		<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		<input type="hidden" name="action" value="resetpass" />

	</form>
	
	<p align="center"> <a href="https://tramprennen.org/privacy-data-policy/">Privacy data police</a> </p>

	<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>

</div>