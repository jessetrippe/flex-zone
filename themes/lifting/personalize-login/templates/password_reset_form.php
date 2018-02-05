
<?php get_template_part( 'img/logo.svg' ); ?>

<form name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
	<input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off" />
	<input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />

	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="alert alert-error">
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<p class="mb-2">
		<input class="text-input" type="password" name="pass1" id="pass1" placeholder="New password" autocomplete="off" required pattern="^.{5,20}$" title="Password must be at least 5 characters and at most 20 characters.">
	</p>
	<p class="mb-2">
		<input type="password" name="pass2" id="pass2" class="text-input" value="" autocomplete="off" />
	</p>

	<p class="description mb-3"><?php echo wp_get_password_hint(); ?></p>

	<p class="resetpass-submit mb-5">
		<input type="submit" name="submit" id="resetpass-button" class="btn btn-block" value="Reset password" />
	</p>
</form>
