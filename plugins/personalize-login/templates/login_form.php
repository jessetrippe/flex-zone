<?php if ( true ) : ?>
<div class="login-form-container">
	<?php if ( $attributes['show_title'] ) : ?>
		<h2><?php _e( 'Sign In', 'personalize-login' ); ?></h2>
	<?php endif; ?>

	<!-- Show errors if there are any -->
	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="login-error">
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<!-- Show logged out message if user just logged out -->
	<?php if ( $attributes['logged_out'] ) : ?>
		<p>
			<?php _e( 'You have signed out. Would you like to sign in again?', 'personalize-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['registered'] ) : ?>
		<p>You have registered successfully. Sign in below.</p>
	<?php endif; ?>

	<?php if ( $attributes['lost_password_sent'] ) : ?>
		<p>
			<?php _e( 'Check your email for a link to reset your password.', 'personalize-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['password_updated'] ) : ?>
		<p>
			<?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?>
		</p>
	<?php endif; ?>

	<?php
		// wp_login_form(
		// 	array(
		// 		'label_username' => __( 'Email', 'personalize-login' ),
		// 		'label_log_in' => __( 'Sign In', 'personalize-login' ),
		// 		'redirect' => $attributes['redirect'],
		// 	)
		// );
	?>

	<form method="post" action="<?php echo wp_login_url(); ?>">
		<p class="mb-3">
			<label for="user_login">Email</label>
			<input class="border border-silver py-1 px-2 w-100" type="email" name="log" id="user_login" class="input" value="" size="20">
		</p>
		<p class="mb-3">
			<label for="user_pass">Password</label>
			<input class="border border-silver py-1 px-2 w-100" type="password" name="pwd" id="user_pass" class="input" value="" size="20">
			<a class="teal small text-underline" href="<?php echo wp_lostpassword_url(); ?>">
				<?php _e( 'Forgot your password?', 'personalize-login' ); ?>
			</a>
		</p>
		<p class="mb-3">
			<label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label>
		</p>
		<p>
			<input class="bg-teal white w-100 p-2" type="submit" name="wp-submit" id="wp-submit" value="Sign In">
			<input type="hidden" name="redirect_to" value="http://localhost:8888/">
		</p>
	</form>

	<p class="create-account-callout my-3 p-2 border border-silver">
		New to <?php echo get_bloginfo( 'name' ); ?>?
		<a class="teal text-underline" href="<?php echo wp_registration_url(); ?>">Create an account</a>.
	</p>

</div>
<?php else : ?>
	<form method="post" action="<?php echo wp_login_url(); ?>">
		<p class="mb-3">
			<label class="d-block" for="user_login"><?php _e( 'Email', 'personalize-login' ); ?></label>
			<input class="w-100 border border-silver py-1 px-2" type="text" name="log" id="user_login">
		</p>
		<p class="mb-3">
			<label class="d-block" for="user_pass"><?php _e( 'Password', 'personalize-login' ); ?></label>
			<input class="w-100 border border-silver py-1 px-2" type="password" name="pwd" id="user_pass">
		</p>
		<p>
			<input class="p-2 bg-teal w-100" type="submit" value="<?php _e( 'Sign In', 'personalize-login' ); ?>">
		</p>
	</form>
<?php endif; ?>
