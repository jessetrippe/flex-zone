<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />

	<link rel="apple-touch-startup-image" href="img/splash.png" />
	<link rel="apple-touch-icon-precomposed" href="img/icon.png"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="masthead" class="site-header border-bottom bg-white">
		<?php if ( is_front_page() || is_tax() ) : ?>
			<nav id="site-navigation" class="main-navigation p-2 p-absolute">
				<?php if ( is_front_page() ) : ?>
					<button type="button" id="user-toggle" class="d-block" data-toggle="modal" data-target="#sign-out-screen">
						<svg class="d-block" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 22 22">
						  <circle class="fill-silver" cx="11" cy="11" r="11"/>
						  <path class="fill-black" fill-rule="nonzero" d="M12,13.041 L12,12.216 C13.102,11.595 14,10.048 14,8.5 C14,6.015 14,4 11,4 C8,4 8,6.015 8,8.5 C8,10.048 8.898,11.595 10,12.216 L10,13.041 C6.608,13.318 4,14.985 4,17 L18,17 C18,14.985 15.392,13.318 12,13.041 Z"/>
						</svg>
					</button>
				<?php elseif (is_tax()) :
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$parent = get_term_by( 'id', $term->parent, 'week' );
					echo '<a href="';
						if ($parent) :
							echo get_term_link($parent->slug, 'week') . '" title="' . $parent->name . '">';
						else :
							echo bloginfo(url) . '" title="Home">';
						endif;
					echo '&nbsp;</a>';
				endif;
				echo '</nav><div class="py-2 h6 m-0 text-uppercase text-center">';
					if( is_front_page() ) {
						bloginfo('name');
					} elseif (is_tax()) {
						echo $term->name;
					}
				?>
			</div>
		<? endif; ?>
	</header><!-- #masthead -->

	<main id="content" class="site-main">
