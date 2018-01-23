<?php
/**
 * The main template file
 */

get_header();

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
if ($term->parent == 0) {
	echo '<h1>Term parent == 0';
wp_list_categories('taxonomy=week&depth=1&show_count=0
&title_li=&child_of=' . $term->term_id);
} else {
	echo '<h1>Term parent != 0';
wp_list_categories('taxonomy=week&show_count=0
&title_li=&child_of=' . $term->parent);
}


	// Week or Day Page
	if (is_tax()) {
		$queried_object = get_queried_object();
		$term_id = $queried_object->term_id;

		$terms = get_terms(array(
			'taxonomy' => 'week',
			'child_of' => $queried_object->term_id,
			'hide_empty' => false
		));


		echo '<div class="p-5 text-center"><h3 class="h3 text-uppercase font-weight-bold mb-2">' .get_queried_object()->name . '</h3><p>' . get_queried_object()->description . '</p></div>';

		// Week Page
		if (!empty($terms)) {
			foreach ($terms as $term) {
				echo '<a class="day-parent text-center d-block p-5 white h3 text-uppercase font-weight-bold m-0" href="' . get_term_link($term) . '">' . $term->name . '</a>';
			}

		// Day Page
		} else {

			echo '<ul>';
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<li <?php post_class(); ?> data-post-id="<?php echo the_ID(); ?>">
					<button data-toggle="modal" data-target="#modal-<?php echo the_ID(); ?>" class="p-relative bg-white border-silver border-bottom d-flex align-items-center text-left font-weight-bold w-100">
							<?php echo '<img height="100" width="100" class="mr-3 bg-gray d-block" src="http://cdn.madebyjesse.com/lifting-assets/' . $post->post_name . '.jpg">'; ?>
							<span class="w-25 js-set-settings">
								<?php
									$args = array(
										'user_id' => $current_user->ID,
										'number' => '1',
										'post_id' => $post->ID,
									);
									$comments = get_comments( $args );
									if ( !empty( $comments ) ) : foreach( $comments as $comment ) : echo $comment->comment_content; endforeach; else : echo '0×0×0'; endif;
								?>
							</span>
							<span class="ml-3 m-0">
								<?php the_title(); ?>
							</span>
					</button>
					<div class="text-center modal bg-white is-hidden" id="modal-<?php echo the_ID(); ?>">
					  <div class="d-flex p-2">
					    <button class="ml-auto close" data-dismiss="modal">&times;</button>
					  </div>
						<video muted playsinline loop class="w-100 d-block">
							<?php echo '<source src="http://cdn.madebyjesse.com/lifting-assets/' . $post->post_name . '.mp4" type="video/mp4">'; ?>
						</video>
						<div class="px-3 actionlist js-set-options-container">
							<button class="actionlist-item" data-toggle="actionsheet" data-target="#actionsheet-<?php the_ID(); ?>">
								<span class="actionlist-title font-weight-bold text-capitalize js-unit"></span>
								<span class="actionlist-value js-value">
									<?php
										// Get weight/sets/reps
										$args = array(
											'user_id' => $current_user->ID,
											'number' => '1',
											'post_id' => $post->ID,
										);
										$comments = get_comments( $args );
										if ( !empty( $comments ) ) : foreach( $comments as $comment ) : echo $comment->comment_content; endforeach; else : echo '0×0×0'; endif;
									?>
								</span>
							</button>
						</div>
						<?php
							// Store weight/sets/resp in hidden comments form
							$comments_args = array(
								'id_form' => 'commentform-' . $post->ID,
								'title_reply' => '',
								'logged_in_as' => '',
								'comment_notes_after' => '',
								'comment_field' => '<input type="text" id="comment" name="comment" aria-required="true" required="required" value="0">',
							);

							comment_form($comments_args);
						?>
						<div class="actionsheet is-hidden" id="actionsheet-<?php echo the_ID(); ?>">
							<div class="actionsheet-options js-set-options-list-1"></div>
							<div class="actionsheet-cancel">
								<button class="btn btn-block btn-ghost" data-dismiss="actionsheet">Cancel</button>
							</div>
						</div>
						<div class="p-3 modal-done-container">
							<button class="btn btn-block btn-ghost black" data-dismiss="modal">Done</button>
						</div>
					</div>
				</li><!-- .accordion-item -->
			<?php endwhile; endif;
			echo '</ul><!-- .accordion -->';
		}
	}

get_footer();
