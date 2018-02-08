<?php get_header(); ?>

<div class="text-center p-5">
	<?php get_template_part( 'img/icon-user-lg.svg' ); ?>
	<h1 class="h6 text-uppercase mb-1"><?php global $current_user; echo $current_user->display_name; ?></h1>
	<p class="small text-muted mb-4">Member Since <?php echo date("F Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?></p>
	<a id="sign-out" href="<?php echo wp_logout_url( home_url() ); ?>" class="btn">Sign out</a>
</div>

<?php get_footer(); ?>
