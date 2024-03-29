<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

        <?php //$template->the_action_template_message( 'register' ); ?>
	<?php $template->the_errors(); ?>

	<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post">

		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'hhh-theme' ); ?></label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div>

		<div class="form-row">
			<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'hhh-theme' ); ?></label>
			<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
		</div>

		<div class="form-row pass-row">
			<?php do_action( 'register_form' ); ?>

			<!-- <p id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'A password will be e-mailed to you.', 'theme-my-login' ) ); ?></p> -->
		</div>
		
		<div class="form-row check-row column-row">
			<label for="privacy_data_police<?php $template->the_instance(); ?>"><?php _e( 'Accept the privacy data police', 'hhh-theme' ) ?></label>
			<input type="checkbox" name="privacy_data_police" id="privacy_data_police<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'privacy_data_police' ); ?>" />
			<p>Please read our privacy data police carefully. <a href="https://tramprennen.org/privacy-data-policy/">You will find it here.</a> </p>
		</div>

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'hhh-theme' ); ?>" />
		</div>

		<!-- <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" /> -->
		<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		<input type="hidden" name="action" value="register" />

	</form>

	<?php $template->the_action_links( array( 'register' => false ) ); ?>

</div>