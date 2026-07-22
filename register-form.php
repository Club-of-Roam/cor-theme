<?php
/**
 * Customize register form.
 *
 * @package cor-theme
 * @global $template
 */

?>

<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_errors(); ?>

	<form name="registerform" id="registerform<?php $template->the_instance(); ?>"
			action="<?php $template->the_action_url( 'register' ); ?>" method="post">

		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>">
				<?php esc_html_e( 'Username', 'cor-theme' ); ?>
			</label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input"
					value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div>

		<div class="form-row">
			<label for="user_email<?php $template->the_instance(); ?>">
				<?php esc_html_e( 'E-mail', 'cor-theme' ); ?>
			</label>
			<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input"
					value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
		</div>

		<div class="form-row pass-row">
			<?php do_action( 'register_form' ); ?>
		</div>

		<div class="form-row check-row column-row">
			<label for="privacy_data_police<?php $template->the_instance(); ?>">
				<?php esc_html_e( 'Accept the privacy data policy', 'cor-theme' ); ?>
			</label>
			<input type="checkbox" name="privacy_data_police" id="privacy_data_police<?php $template->the_instance(); ?>"
					class="input" value="<?php $template->the_posted_value( 'privacy_data_police' ); ?>" />
			<?php wp_nonce_field( 'accept-privacy-data-police-at-register', 'privacy_data_police_nonce' ); ?> ?>
			<p>
				<?php esc_html_e( 'Please read our privacy data policy carefully.', 'cor-theme' ); ?>
				<a href="<?php echo esc_url( cor_home_url( '/home/privacy-data-policy' ) ); ?>">
					<?php esc_html_e( 'You will find it here.', 'cor-theme' ); ?>
				</a>
			</p>
		</div>

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>"
					value="<?php esc_attr_e( 'Register', 'cor-theme' ); ?>" />
		</div>

		<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		<input type="hidden" name="action" value="register" />

	</form>

	<?php $template->the_action_links( [ 'register' => false ] ); ?>
</div>
