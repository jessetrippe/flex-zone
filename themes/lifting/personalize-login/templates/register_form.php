
<?php get_template_part( 'img/logo.svg' ); ?>

<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
	<?php foreach ( $attributes['errors'] as $error ) : ?>
		<p class="alert alert-error">
			<?php echo $error; ?>
		</p>
	<?php endforeach; ?>
<?php endif; ?>

<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
	<p class="mb-2">
		<input class="text-input" type="email" name="email" id="email" placeholder="Email address" required>
	</p>
	<p class="mb-2">
		<input class="text-input" type="text" name="first_name" id="first-name" placeholder="First name" required>
	</p>
	<p class="mb-2">
		<input class="text-input" type="text" name="last_name" id="last-name" placeholder="Last name" required>
	</p>
	<p class="mb-3">
		<input class="text-input" type="password" name="password" id="password" placeholder="New password" autocomplete="off" required pattern="^.{5,20}$" title="Password must be at least 5 characters and at most 20 characters.">
	</p>
	<p>
		<input class="btn btn-block" type="submit" name="submit" value="Register"/>
	</p>
</form>
