<?php
/**
 * Customize profile form.
 *
 * @package cor-theme
 * @global $template
 */

global $current_user, $h3_mgmt_profile;
$profile_user = get_user_to_edit( $current_user->ID );

$city_switch = is_array( $current_user->roles ) && in_array( 'city', $current_user->roles, true );
?>
<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post">

		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />

		<?php $template->the_action_template_message( 'profile' ); ?>
		<?php $template->the_errors(); ?>

		<?php do_action( 'personal_options', $profile_user ); ?>
		<?php do_action( 'profile_personal_options', $profile_user ); ?>

		<h3><?php esc_html_e( 'Name', 'cor-theme' ); ?></h3>

		<div class="form-row">
			<label for="user_login" class="silent-tip"
					onmouseover="tooltip('<?php echo esc_js( esc_html__( 'Your username cannot be changed.', 'cor-theme' ) ); ?>');"
					onmouseout="exit();"
			>
				<?php esc_html_e( 'Username', 'cor-theme' ); ?>
			</label>
			<input type="text" name="user_login" id="user_login"
					value="<?php echo esc_attr( $profile_user->user_login ); ?>"
					disabled="disabled" class="regular-text" />
		</div>

		<div class="form-row">
			<label for="first_name">
				<?php esc_html_e( 'First name', 'cor-theme' ); ?>
			</label>
			<input type="text" name="first_name" id="first_name" <?php echo $city_switch ? 'disabled' : ''; ?>
					value="<?php echo esc_attr( $profile_user->first_name ); ?>" class="regular-text" />
		</div>

		<div class="form-row">
			<label for="last_name">
				<?php esc_html_e( 'Last name', 'cor-theme' ); ?>
			</label>
			<input type="text" name="last_name" id="last_name" <?php echo $city_switch ? 'disabled' : ''; ?>
					value="<?php echo esc_attr( $profile_user->last_name ); ?>" class="regular-text" />
		</div>

		<div class="form-row">
			<input type="hidden" name="nickname" id="nickname" <?php echo $city_switch ? 'disabled' : ''; ?>
					value="<?php echo esc_attr( $profile_user->nickname ); ?>" class="regular-text" />
		</div>

		<h3 class="top-space-more">
			<?php esc_html_e( 'Contact Info', 'cor-theme' ); ?>
		</h3>

		<div class="form-row">
			<label for="email">
				<?php esc_html_e( 'E-mail', 'cor-theme' ); ?>
			</label>
			<input type="email" name="email" id="email"
					value="<?php echo esc_attr( $profile_user->user_email ); ?>" class="regular-text" />
		</div>

		<h3 class="top-space-more">
			<?php esc_html_e( 'About You', 'cor-theme' ); ?>
		</h3>

		<?php
		if ( defined( 'H3_MGMT_ABSPATH' ) ) {

			$fields = [
				[
					'label' => _x( 'City', 'Team Profile Form', 'h3-mgmt' ),
					'id'    => 'city',
					'type'  => 'text',
				],
				[
					'label' => _x( 'Date of Birth', 'Team Profile Form', 'h3-mgmt' ),
					'id'    => 'birthday',
					'type'  => 'date',
				],
				[
					'label' => _x( 'Mobile Phone', 'Team Profile Form', 'h3-mgmt' ),
					'id'    => 'mobile',
					'type'  => 'text',
				],
				[
					'label'   => '', // _x( 'Shirt Size', 'Team Profile Form', 'h3-mgmt' ),
					'id'      => 'shirt_size',
					'type'    => 'hidden',
					'options' => [
						0 => [
							'value' => 0,
							'label' => _x( 'Please select your size...', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'ms',
							'label' => _x( 'Unisex S', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'mm',
							'label' => _x( 'Unisex M', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'ml',
							'label' => _x( 'Unisex L', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'mx',
							'label' => _x( 'Unisex XL', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'gs',
							'label' => _x( 'Slimfit S', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'gm',
							'label' => _x( 'Slimfit M', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'gl',
							'label' => _x( 'Slimfit L', 'Team Profile Form', 'h3-mgmt' ),
						],
					],
				],
				[
					'label'   => '', // _x( 'Could we give our partner Ortel Mobile your personal Information?', 'Team Profile Form', 'h3-mgmt' ),
					'id'      => 'public_mobile_inf',
					'type'    => 'hidden',
					'options' => [
						0 => [
							'value' => 0,
							'label' => _x( 'Please select if it is ok or not...', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'yes',
							'label' => _x( 'YES, give them my personal information', 'Team Profile Form', 'h3-mgmt' ),
						],
						[
							'value' => 'no',
							'label' => _x( 'Please not (So you do not get your sponsored sim-card', 'Team Profile Form', 'h3-mgmt' ),
						],
					],
				],
				[
					'label' => '',
					'id'    => 'addressMobile',
					'type'  => 'hidden',
				],
			];

			wp_get_current_user();
			$field_count = count( $fields );
			for ( $i = 0; $i < $field_count; $i++ ) {
					$fields[ $i ]['value'] = esc_attr( get_user_meta( $current_user->ID, $fields[ $i ]['id'], true ) );
			}

			global $output;
			require_once H3_MGMT_ABSPATH . '/templates/frontend-form.php';

            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $output;
		}
		?>

		<?php wp_enqueue_script( 'user-profile' ); ?>

		<h3 class="top-space-more">
			<?php esc_html_e( 'New Password', 'cor-theme' ); ?>
		</h3>

		<div class="form-row tml-user-pass1-wrap">
			<p class="description">
				<?php esc_html_e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'cor-theme' ); ?>
			</p>
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

		<?php if ( ! isset( $city_switch ) || false === $city_switch ) { ?>
			<h3 class="top-space-more">
				<?php esc_html_e( 'Leave for good', 'cor-theme' ); ?>
			</h3>

			<div class="form-row check-row column-row">
				<span class="box-test"></span>
				<input name="deleteme" type="checkbox" id="deleteme" value="forever" />
				<label for="deleteme" class="warning">
					<span class="box"></span>
					<?php esc_html_e( 'Delete my account permanently', 'cor-theme' ); ?>
				</label>
			</div>
		<?php } ?>

		<div class="form-row">
			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<!--suppress EqualityComparisonWithCoercionJS -->
			<input type="submit" onclick="
				if( jQuery('#deleteme').is(':checked') ) {
					return confirm('<?php echo esc_js( __( 'Do you really want to delete your account? This will be permanent and cannot be undone!', 'cor-theme' ) ); ?>');
				} else if( jQuery('#birthday-year').val() <= new Date().getFullYear() - 100 ) {
					return confirm('<?php echo esc_js( __( 'Are you really a hundred years old???', 'cor-theme' ) ); ?>');
				} else if( jQuery('#birthday-year').val() == 1970 && jQuery('#birthday-month').val() == 1 && jQuery('#birthday-day').val() == 1 ) {
					return confirm('<?php echo esc_js( __( 'Have you really been born on January 1st, 1970?', 'cor-theme' ) ); ?>');
				}
			" class="button-primary"
				value="<?php esc_attr_e( 'Update Profile', 'cor-theme' ); ?>" name="submit" />
		</div>

	</form>

	<p style="display: flex; justify-content: center;">
		<a href="<?php echo esc_url( cor_home_url( '/home/privacy-data-policy' ) ); ?>">
			<?php esc_attr_e( 'Privacy data policy', 'cor-theme' ); ?>
		</a>
	</p>
</div>
