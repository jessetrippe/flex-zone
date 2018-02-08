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

	<!-- iPhone Icons -->
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-icon-57x57.png" sizes="57x57" rel="apple-touch-icon">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-icon-114x114.png" sizes="114x114" rel="apple-touch-icon">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-icon-144x144.png" sizes="144x144" rel="apple-touch-icon">

	<!-- iPhone Splash Screens -->
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-startup-image-320x460.png" media="(device-width: 320px) and (orientation: portrait)" rel="apple-touch-startup-image">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-startup-image-640x1136.png" media="(device-width: 640px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-startup-image-750x1334.png" media="(device-width: 750px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-startup-image-1125x2436.png" media="(device-width: 1125px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<link href="http://cdn.madebyjesse.com/lifting-assets/ios-pwa-assets/apple-touch-startup-image-1242x2208.png" media="(device-width: 1242px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation d-flex">
			<?php
				if ( is_front_page() ) {
					echo '<a class="p-3 mr-auto" href="/sign-out/" title="Sign out">';
						echo get_template_part( 'img/icon-user.svg' );
					echo '</a>';
				} elseif (is_tax()) {
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$parent = get_term_by( 'id', $term->parent, 'week' );
					echo '<a class="p-3" href="';
						if ($parent) :
							echo get_term_link($parent->slug, 'week') . '" title="' . $parent->name . '">';
						else :
							echo bloginfo(url) . '" title="Home">';
						endif;
					echo get_template_part( 'img/icon-arrow-left.svg' ) . '</a>';
				} elseif (is_page('sign-out')) {
					echo '<a class="p-3 ml-auto" href="';
					echo bloginfo(url) . '" title="Home">';
					echo get_template_part( 'img/icon-arrow-right.svg' );
					echo '</a>';
				}
			?>
		</nav>
			<?php
				if (!is_page('sign-out')) {
					echo '<h1 class="text-white h1 px-3 pb-1 mt-4">';
					if( is_front_page() ) {
						echo 'Welcome';
					} elseif (is_tax()) {
						echo $term->name;
					}
					echo '</h1>';
				}
			?>
		</nav>
	</header><!-- #masthead -->

	<main id="main-content" class="site-main">
