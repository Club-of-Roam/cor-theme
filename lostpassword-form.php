<div class="login island" id="theme-my-login<?php $template->the_instance(); ?>">

	<?php $template->the_action_template_message( 'lostpassword' ); ?>
	<?php $template->the_errors(); ?>

	<form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'lostpassword' ); ?>" method="post">

		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username or E-mail:', 'hhh-theme' ); ?></label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div>

		<?php do_action( 'lostpassword_form' ); ?>

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Get New Password', 'hhh-theme' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="lostpassword" />
		</div>

	</form>
	
	<p align="center"> <a href="https://tramprennen.org/privacy-data-policy/">Privacy data police</a> </p>

	<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>

</div>