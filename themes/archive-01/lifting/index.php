<?php
/**
 * The main template file
 */

get_header();

if ( is_front_page() || is_tax() ) {

	echo '<div class="p-5 text-center"><h3 class="h3 text-uppercase font-weight-bold mb-2">';

	if ( is_front_page() ) {
		echo 'Welcome';
	} else {
		echo get_queried_object()->name;
	}
	echo '</h3>';
	if ( is_front_page() ) {
		echo get_bloginfo('description');
	} else {
		echo get_queried_object()->description;
	}
	echo '</div><ul>';

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	if ($term->parent == 0) {
		wp_list_categories('taxonomy=week&depth=1&title_li=&child_of=' . $term->term_id);
	}
	echo '</ul>';

} else {

	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class("p-2"); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="h4 mb-3">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile;

	else :

		echo '<h1>Page cannot be found</h1>';

	endif;
}

get_footer();
