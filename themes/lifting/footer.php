<?php
/**
* The template for displaying the footer
*
* Contains the closing of the #content div and all content after.
*/

?>

</main>

<footer class="site-footer text-center pt-4 pb-3 px-2">
	<p class="m-0 small text-muted">Copyright &copy; <?php echo date("Y"); ?> Jesse Trippe. All rights reserved.</p>
</footer>

<div id="sign-out-screen" class="text-center modal bg-white is-hidden">
	<div class="d-flex p-2">
		<button class="ml-auto btn-link" data-dismiss="modal">Done</button>
	</div>
	<div class="overlay-content">
		<?php get_template_part( 'img/icon-user-lg.svg' ); ?>
		<h1 class="h6 text-uppercase mb-1"><?php global $current_user; echo $current_user->display_name; ?></h1>
		<p class="small text-muted mb-4">Member Since <?php echo date("F Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?></p>
		<a id="sign-out" href="<?php echo wp_logout_url( home_url() ); ?>" class="btn">Sign out</a>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
