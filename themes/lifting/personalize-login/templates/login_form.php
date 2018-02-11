
<?php get_template_part( 'img/logo.svg' ); ?>

<?php if ( true ) : ?>

	<!-- Show errors if there are any -->
	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="alert alert-error">
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php
		if ( $attributes['logged_out'] ) {
			echo '<p class="mb-3">You have signed out. Would you like to sign in again?</p>';
		}
		if ( $attributes['registered'] ) {
			echo '<p class="mb-3">You have registered successfully. Sign in below.</p>';
		}
		if ( $attributes['lost_password_sent'] ) {
			echo '<p class="mb-3">Check your email for a link to reset your password.</p>';
		}
		if ( $attributes['password_updated'] ) {
			echo '<p class="mb-3">Your password has been changed. You can sign in now.</p>';
		}
	?>

	<form method="post" action="<?php echo wp_login_url(); ?>" class="">
		<p class="mb-2">
			<input class="text-input" type="email" name="log" id="user_login" placeholder="Email address">
		</p>
		<p class="mb-3">
			<input class="text-input" type="password" name="pwd" id="user_pass" placeholder="Password">
		</p>
		<p class="custom-control custom-checkbox mb-3">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom-control-input">
			<label class="custom-control-label" for="rememberme">Remember Me</label>
		</p>
		<p class="mb-5">
			<input class="btn btn-block" type="submit" name="wp-submit" id="wp-submit" value="Sign in">
			<input type="hidden" name="redirect_to" value="http://localhost:8888/">
		</p>
	</form>
	<p class="text-center mb-1">
		<a href="<?php echo wp_lostpassword_url(); ?>">
			Forgot your password?
		</a>
	</p>
	<p class="text-center mb-5">
		Don't have an account? <a href="<?php echo wp_registration_url(); ?>">Sign up</a>
	</p>

<?php else : ?>
	<h1>False</h1>
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
