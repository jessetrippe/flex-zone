<?php
/**
 * The main template file
 */

get_header();

if ( is_front_page() || is_tax() ) {

	$taxonomy_name = 'week';
	$term_id = get_queried_object()->term_id;

	$terms = get_terms($taxonomy_name, array('parent' => $term_id,) );
	if ($terms) {
		foreach($terms as $term){
			echo '<a class="d-flex p-3 h5 border-bottom align-items-center" href="' . get_term_link($term) . '">';
			echo $term->name;
			echo get_template_part( 'img/icon-arrow-right-alt.svg' );
			echo '</a>';
		}
	} else {
		get_template_part( 'partials/list' );
		get_template_part( 'partials/modals' );
	}

} else {
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="px-4">
			<?php the_content(); ?>
		</article>
	<?php endwhile;
	else :
		echo '<h1>Page cannot be found</h1>';
	endif;
}

get_footer();
