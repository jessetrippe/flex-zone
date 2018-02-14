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

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if ( !is_page('member-register') && !is_page('member-login') && !is_page('member-password-lost') && !is_page('member-password-reset') ) : ?>
		<header id="masthead" class="site-header">
			<nav id="site-navigation" class="main-navigation d-flex">
				<?php
					if ( is_front_page() ) {
						echo '<a class="p-3 mr-auto" href="/sign-out/" title="Sign out">';
							echo get_template_part( 'img/icon-user.svg' ) . '</a>';
					} elseif (is_tax()) {
						echo '<a class="p-3 mr-auto" href="/" title="Home">';
						echo get_template_part( 'img/icon-arrow-left.svg' ) . '</a>';
					} elseif (is_page('sign-out')) {
						echo '<a class="p-3 ml-auto" href="/" title="Home">';
						echo get_template_part( 'img/icon-arrow-right.svg' ) . '</a>';
					}
				?>
			</nav>
				<?php
					if (!is_page('sign-out')) {
						if( is_front_page() ) {
							echo '<h1 class="text-white h1 px-3 pb-1 mt-4">Welcome</h1>';
						} elseif (is_tax()) {
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							$parent = get_term_by( 'id', $term->parent, get_query_var( 'taxonomy' ) );
							echo '<h1 class="text-white h4 px-3 pb-1 mt-4">';
							echo $parent->name . '<span class="p-2">';
							echo get_template_part('img/icon-chevron-right-alt.svg');
							echo '</span>' . $term->name;
							echo '</h1>';
						}
					}
				?>
		</header><!-- #masthead -->
	<?php endif; ?>

	<main id="main-content" class="site-main">
