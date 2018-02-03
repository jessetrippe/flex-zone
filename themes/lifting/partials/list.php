
<table class="table-clickable-rows border-bottom">
	<tbody>
		<?php while ( have_posts() ) : the_post(); ?>
			<tr <?php post_class(); ?> id="post-<?php echo the_ID(); ?>"  data-toggle="modal" data-target="#modal-exercise-<?php echo get_the_ID() ?>">
				<td class="w-1">
					<?php echo '<img alt="' . $post->post_title . '" height="100" width="100" class="d-block" src="http://cdn.madebyjesse.com/lifting-assets/' . $post->post_name . '.jpg">'; ?>
				</td>
				<td id="settings-<?php echo get_the_ID() ?>" class="border-top">
					<?php
					// Get weight/sets/reps
					$args = array(
						'user_id' => get_current_user_id(),
						'number' => '1',
						'post_id' => get_the_ID(),
					);
					$comments = get_comments( $args );
					if ( !empty( $comments ) ) : foreach( $comments as $comment ) : echo $comment->comment_content; endforeach; else : echo '0×0×0'; endif;
					?>
				</td>
				<td class="border-top">
					<?php the_title(); ?>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
