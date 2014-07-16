<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>

<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" class="stand-alone-form" action="<?php $template->the_action_url( 'lostpassword' ); ?>" method="post">
		<?php $template->the_action_template_message( 'lostpassword' ); ?>
		<?php $template->the_errors(); ?>
		<div class="form-row">
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username or E-mail:', 'theme-my-login' ) ?></label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div>
<?php
do_action( 'lostpassword_form' ); // Wordpress hook
do_action_ref_array( 'tml_lostpassword_form', array( &$template ) ); // TML hook
?>
		<div class="form-row">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( 'Get New Password', 'theme-my-login' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		</div>
		<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>
	</form>
</div>