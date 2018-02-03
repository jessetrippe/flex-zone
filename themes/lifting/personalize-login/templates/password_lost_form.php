<div id="password-lost-form" class="password-lost-form-container px-4">

	<?php get_template_part( 'img/logo.svg' ); ?>

	<?php if ( $attributes['show_title'] ) : ?>
		<h3><?php _e( 'Forgot Your Password?', 'personalize-login' ); ?></h3>
	<?php endif; ?>

	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p>
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<p class="mb-3">
		<?php
			_e(
				"Enter your email address and we'll send you a link you can use to pick a new password.",
				'personalize_login'
			);
		?>
	</p>

	<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
		<p class="mb-3">
			<input class="text-input" type="text" name="user_login" id="user_login" placeholder="Email address">
		</p>

		<p class="mb-5">
			<input class="btn btn-block" type="submit" name="submit" class="btn btn-block lostpassword-button" value="Send"/>
		</p>
	</form>
</div>
