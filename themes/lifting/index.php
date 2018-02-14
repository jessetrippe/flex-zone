<?php
/**
 * The main template file
 */

get_header();

if ( is_front_page() || is_tax() ) {

	$taxonomy_name = 'week';

	if ( is_front_page()) {
		$terms = get_terms($taxonomy_name, array('parent' => 0, 'orderby' => 'id',) );

		foreach($terms as $term) {
			echo '<h2 class="h6 mx-3 mt-3 mb-1 text-muted text-uppercase">' . $term->name . '</h2>';

			$terms = get_terms($taxonomy_name, array('parent' => $term->term_id, 'orderby' => 'id',));

			echo '<div class="bg-white">';
			foreach($terms as $term) {
				echo '<a class="d-flex p-3 h6 border-bottom align-items-center" href="' . get_term_link($term) . '">' . $term->name;
				echo get_template_part( 'img/icon-chevron-right.svg' ) . '</a>';
			}
			echo '</div>';
		}
	} else {
		get_template_part( 'partials/list' );
		get_template_part( 'partials/modals' );
	}

} else {
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="px-4">
			<?php the_content(); ?>
		</div>
	<?php endwhile;
	else :
		echo '<h1>Page cannot be found</h1>';
	endif;
}

get_footer();
