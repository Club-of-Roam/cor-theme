<?php
/**
 * Customize login form.
 *
 * @package cor-theme
 * @global $template
 */

?>

<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_errors(); ?>

	<form name="loginform" id="loginform<?php $template->the_instance(); ?>"
			action="<?php $template->the_action_url( 'login' ); ?>" method="post">

		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>">
				<?php esc_html_e( 'Username', 'cor-theme' ); ?>
			</label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input"
					value="<?php $template->the_posted_value( 'log' ); ?>" size="20"/>
		</div>

		<div class="form-row">
			<label for="user_pass<?php $template->the_instance(); ?>">
				<?php esc_html_e( 'Password', 'cor-theme' ); ?>
			</label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value=""
					size="20" autocomplete="off"/>
		</div>

		<?php do_action( 'login_form' ); ?>

		<input type="hidden" name="_wp_original_http_referer" value="<?php echo esc_attr( wp_get_original_referer() ); ?>" />
		<input type="hidden" name="_wp_http_referer" value="<?php echo esc_attr( wp_get_referer() ); ?>" />

		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>"
					value="<?php esc_attr_e( 'Log In', 'cor-theme' ); ?>"/>
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>
			<input type="hidden" name="action" value="login"/>
		</div>
	</form>

	<p style="display: flex; justify-content: center;">
		<a href="<?php echo esc_url( cor_home_url( '/home/privacy-data-policy' ) ); ?>">
			<?php esc_attr_e( 'Privacy data policy', 'cor-theme' ); ?>
		</a>
	</p>

	<?php $template->the_action_links( [ 'login' => false ] ); ?>
</div>
