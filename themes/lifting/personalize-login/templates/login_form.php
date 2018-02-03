<div class="login-form-container px-4">

	<?php get_template_part( 'img/logo.svg' ); ?>

	<?php if ( true ) : ?>

		<!-- Show errors if there are any -->
		<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
			<?php foreach ( $attributes['errors'] as $error ) : ?>
				<p class="login-error mb-3">
					<?php echo $error; ?>
				</p>
			<?php endforeach; ?>
		<?php endif; ?>

		<p class="mb-3">
			<?php
				if ( $attributes['logged_out'] ) {
					echo 'You have signed out. Would you like to sign in again?';
				}
				if ( $attributes['registered'] ) {
					echo 'You have registered successfully. Sign in below.';
				}
				if ( $attributes['lost_password_sent'] ) {
					echo 'Check your email for a link to reset your password.';
				}
				if ( $attributes['password_updated'] ) {
					echo 'Your password has been changed. You can sign in now.';
				}
			?>
		</p>

		<form method="post" action="<?php echo wp_login_url(); ?>" class="">
			<p class="mb-2">
				<input class="text-input" type="email" name="log" id="user_login" placeholder="Email address">
			</p>
			<p class="mb-3">
				<input class="text-input" type="password" name="pwd" id="user_pass" placeholder="Password">
			</p>
			<p class="mb-3">
				<label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label>
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
			Don't have an account?
			<a href="<?php echo wp_lostpassword_url(); ?>">
				Sign up
			</a>
		</p>

	</div>
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
</div>
