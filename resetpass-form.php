<?php
/**
 * Customize reset password form.
 *
 * @package cor-theme
 * @global $template
 */

?>

<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">

	<?php
	$template->the_action_template_message( 'resetpass' );
	$template->the_errors();

	wp_enqueue_script( 'user-profile' );

	/**
	 * Disables the email notification to admin when user changes password.
	 *
	 * @param array $email Used to build wp_mail().
	 *
	 * @return array
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_password_change_notification_email/
	 */
	function my_stop_email( array $email ): array {
		$email['to'] = ''; // empty the 'TO:' part -> will fail to send
		return $email;
	}

	add_filter( 'wp_password_change_notification_email', 'my_stop_email' );
	?>

	<form name="resetpasswordform" id="resetpasswordform<?php $template->the_instance(); ?>"
			action="<?php $template->the_action_url( 'resetpass' ); ?>" method="post">

		<h3 class="top-space-more">
			<?php esc_html_e( 'Reset Password', 'cor-theme' ); ?>
		</h3>
		<div class="form-row tml-user-pass1-wrap">
			<label for="pass11">
				<?php esc_html_e( 'New Password', 'cor-theme' ); ?>
			</label>
			<input autocomplete="off" name="pass1" id="pass11" class="input" size="20" value="" type="password">
		</div>
		<div class="form-row tml-user-pass2-wrap">
			<label for="pass21">
				<?php esc_html_e( 'Confirm Password', 'cor-theme' ); ?>
			</label>
			<input autocomplete="off" name="pass2" id="pass21" class="input" size="20" value="" type="password">
		</div>

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>"
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>"
					value="<?php esc_attr_e( 'Reset Password', 'cor-theme' ); ?>" />
		</div>

		<input type="hidden" id="user_login" value="<?php echo esc_attr( $GLOBALS['rp_login'] ); ?>" autocomplete="off" />
		<input type="hidden" name="rp_key" value="<?php echo esc_attr( $GLOBALS['rp_key'] ); ?>" />
		<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		<input type="hidden" name="action" value="resetpass" />

	</form>

	<p style="display: flex; justify-content: center;">
		<a href="<?php echo esc_url( cor_home_url( '/home/privacy-data-policy' ) ); ?>">
			<?php esc_attr_e( 'Privacy data policy', 'cor-theme' ); ?>
		</a>
	</p>

	<?php $template->the_action_links( [ 'lostpassword' => false ] ); ?>

</div>
