
<table class="table-clickable-rows border-bottom mt-3 bg-white">
	<tbody>
		<?php while ( have_posts() ) : the_post(); ?>
			<tr <?php post_class(); ?> id="post-<?php echo the_ID(); ?>"  data-toggle="modal" data-target="#modal-exercise-<?php echo get_the_ID() ?>">
				<td class="w-1 py-2 px-3">
					<?php echo '<img alt="' . $post->post_title . '" height="75" width="75" class="d-block rounded" src="//jessetrippe-cdn-173419.appspot.com/flex-zone/poster-images/' . $post->post_name . '.jpg">'; ?>
				</td>
				<td class="border-bottom">
					<div class="font-weight-bold"><?php the_title(); ?></div>
					<div class="text-muted small">
						<span data-settings-type="sets" data-display-value data-post-id="<?php the_ID(); ?>">0</span> sets of
						<span data-settings-type="reps" data-display-value data-post-id="<?php the_ID(); ?>">0</span> reps
					</div>
				</td>
				<td class="border-bottom px-3 text-right text-link">
					<span class="" data-settings-type="weight" data-display-value data-post-id="<?php the_ID(); ?>">0</span>&nbsp;lbs
					<span id="settings-<?php echo get_the_ID() ?>" class="is-hidden">
						<?php
							// Get weight/sets/reps
							$args = array(
								'user_id' => get_current_user_id(),
								'number' => '1',
								'post_id' => get_the_ID(),
							);
							$comments = get_comments( $args );
							if ( !empty( $comments ) ) : foreach( $comments as $comment ) : echo $comment->comment_content; endforeach; else : echo '0'; endif;
						?>
					</span>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
