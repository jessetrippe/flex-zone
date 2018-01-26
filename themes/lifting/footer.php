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

<button type="button" id="overlay-backdrop" class="overlay" style="display:none;"></button>

<div id="sign-out-screen" class="text-center modal bg-white is-hidden">
	<div class="d-flex p-2">
		<button class="ml-auto close" data-dismiss="modal">&times;</button>
	</div>
	<div class="overlay-content">
		<svg class="d-block mx-auto my-4" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 22 22">
			<circle class="fill-silver" cx="11" cy="11" r="11"/>
			<path class="fill-black" fill-rule="nonzero" d="M12,13.041 L12,12.216 C13.102,11.595 14,10.048 14,8.5 C14,6.015 14,4 11,4 C8,4 8,6.015 8,8.5 C8,10.048 8.898,11.595 10,12.216 L10,13.041 C6.608,13.318 4,14.985 4,17 L18,17 C18,14.985 15.392,13.318 12,13.041 Z"/>
		</svg>
		<h1 class="h6 text-uppercase mb-1"><?php global $current_user; echo $current_user->display_name; ?></h1>
		<p class="small text-muted mb-4">Member Since <?php echo date("F Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?></p>
		<a id="sign-out" href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-ghost w-33">Sign Out</a>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
