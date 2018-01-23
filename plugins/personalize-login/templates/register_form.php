<?php if ( $attributes['show_title'] ) : ?>
	<h3><?php _e( 'Register', 'personalize-login' ); ?></h3>
<?php endif; ?>

<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
	<?php foreach ( $attributes['errors'] as $error ) : ?>
		<p class="bg-red white p-3">
			<?php echo $error; ?>
		</p>
	<?php endforeach; ?>
<?php endif; ?>

<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
	<p class="mb-3">
		<label class="d-block" for="email"><?php _e( 'Email', 'personalize-login' ); ?> <strong>*</strong></label>
		<input class="w-100 border border-silver py-1 px-2" type="email" name="email" id="email" required>
	</p>

	<p class="mb-3">
		<label class="d-block" for="first_name"><?php _e( 'First name', 'personalize-login' ); ?> <strong>*</strong></label>
		<input class="w-100 border border-silver py-1 px-2" type="text" name="first_name" id="first-name" required>
	</p>

	<p class="mb-3">
		<label class="d-block" for="last_name"><?php _e( 'Last name', 'personalize-login' ); ?> <strong>*</strong></label>
		<input class="w-100 border border-silver py-1 px-2" type="text" name="last_name" id="last-name" required>
	</p>

	<p class="mb-3">
		<label class="d-block" for="password">Password <strong>*</strong></label>
		<input class="w-100 border border-silver py-1 px-2" type="password" name="password" id="password" required pattern="^.{5,20}$" title="Password must be at least 5 characters and at most 20 characters.">
	</p>

	<p>
		<input class="p-2 bg-teal w-100" type="submit" name="submit" value="<?php _e( 'Register', 'personalize-login' ); ?>"/>
	</p>
</form>
