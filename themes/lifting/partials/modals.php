<?php rewind_posts(); while (have_posts()) : the_post(); ?>
	<div class="modal bg-white d-flex flex-column vh-100 is-hidden" id="modal-exercise-<?php echo the_ID(); ?>">
		<button class="ml-auto btn-link p-2" data-dismiss="modal">Done</button>
		<div class="p-relative">
			<video muted playsinline loop class="w-100 d-block" id="video-<?php echo the_ID(); ?>" title="<?php echo the_title(); ?>">
				<?php echo '<source src="http://cdn.madebyjesse.com/lifting-assets/' . $post->post_name . '.mp4" type="video/mp4">'; ?>
			</video>
			<h2 class="video-title"><?php echo the_title(); ?></h2>
		</div>
		<button class="d-flex p-3 border-bottom" id="settings-sets-<?php echo the_ID(); ?>" data-toggle="modal" data-target="#modal-settings-<?php echo the_ID(); ?>" data-settings-type="sets">
			<span class="font-weight-bold">Sets</span>
			<span class="ml-auto btn-link" id="sets-<?php the_ID(); ?>"></span>
		</button>
		<button class="d-flex p-3 border-bottom" id="settings-reps-<?php echo the_ID(); ?>" data-toggle="modal" data-target="#modal-settings-<?php echo the_ID(); ?>" data-settings-type="reps">
			<span class="font-weight-bold">Reps</span>
			<span class="ml-auto btn-link" id="reps-<?php the_ID(); ?>"></span>
		</button>
		<button class="d-flex p-3 border-bottom" id="settings-weight-<?php echo the_ID(); ?>" data-toggle="modal" data-target="#modal-settings-<?php echo the_ID(); ?>" data-settings-type="weight">
			<span class="font-weight-bold">Weight</span>
			<span class="ml-auto btn-link" id="weight-<?php the_ID(); ?>"></span>
		</button>
	<div class="px-3 pb-3 pt-3">
		<button class="btn btn-block" data-dismiss="modal">Close</button>
	</div>
	</div>
	<div class="modal bg-white d-flex flex-column vh-100 is-hidden" id="modal-settings-<?php echo the_ID(); ?>">
		<div class="d-flex p-2">
			<button class="ml-auto btn-link" data-dismiss="modal">Done</button>
		</div>
		<div class="border-top" id="modal-settings-list-<?php echo the_ID(); ?>">
			<div class="webkit-overflow-scroll-bug" id="overflow-scroll-bug-<?php echo the_ID(); ?>"></div>
		</div>
	</div>
	<div class="is-hidden" id="comments-<?php echo the_ID(); ?>">
		<?php
			$comments_args = array(
				'id_submit' => 'submit-' . $post->ID,
				'id_form' => 'commentform-' . $post->ID,
				'title_reply' => '',
				'title_reply_before' => '',
				'title_reply_after' => '',
				'logged_in_as' => '',
				'cancel_reply_after' => '',
				'cancel_reply_link' => '',
				'cancel_reply_before' => '',
				'comment_notes_after' => '',
				'comment_field' => '<input type="text" name="comment" value="0" id="comment-' . $post->ID . '">',
			);
			comment_form($comments_args);
		?>
	</div>
<?php endwhile; ?>
