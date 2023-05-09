<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">

	<!-- <h2><?php _ex( 'Login', 'Login Widget Title', 'hhh-theme' ); ?></h2> -->

	<?php //$template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>

	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">

		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'hhh-theme' ); ?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</div>

		<div class="form-row">
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'hhh-theme' ); ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" />
		</div>

		<?php do_action( 'login_form' ); ?>

<!--
		<div class="form-row check-row column-row forgetmenot">
			<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
			<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'hhh-theme' ); ?></label>
		</div>
-->

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'hhh-theme' ); ?>" />
			<!--<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" /> -->
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="login" />
		</div>

	</form>
	
	<p align="center"> <a href="https://tramprennen.org/privacy-data-policy/">Privacy data police</a> </p>

	<?php $template->the_action_links( array( 'login' => false ) ); ?>

</div>