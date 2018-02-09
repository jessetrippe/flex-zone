<?php rewind_posts(); while (have_posts()) : the_post(); ?>
	<div class="modal is-hidden" id="modal-exercise-<?php echo the_ID(); ?>">
		<div class="modal-header d-flex">
			<button class="ml-auto p-3" data-dismiss="modal">
				<?php echo get_template_part( 'img/icon-x.svg' ); ?>
			</button>
		</div>
		<div class="video-container" style="background-image: url(//jessetrippe-cdn-173419.appspot.com/flex-zone/poster-images/<?php echo $post->post_name; ?>.jpg)">
			<video muted playsinline loop class="w-100 d-block" id="video-<?php echo the_ID(); ?>" title="<?php echo the_title(); ?>">
				<?php echo '<source src="//jessetrippe-cdn-173419.appspot.com/flex-zone/videos/' . $post->post_name . '.mp4" type="video/mp4">'; ?>
			</video>
			<h2 class="video-title"><?php echo the_title(); ?></h2>
		</div>
		<button class="d-flex p-3 border-bottom" id="settings-sets-<?php echo the_ID(); ?>" data-toggle="modal" data-target="#modal-settings-<?php echo the_ID(); ?>" data-settings-type="sets">
			<span class="font-weight-bold">Sets</span>
			<span class="ml-auto text-link" data-settings-type="sets" data-display-value data-post-id="<?php the_ID(); ?>"></span>
		</button>
		<button class="d-flex p-3 border-bottom" id="settings-reps-<?php echo the_ID(); ?>" data-toggle="modal" data-target="#modal-settings-<?php echo the_ID(); ?>" data-settings-type="reps">
			<span class="font-weight-bold">Reps</span>
			<span class="ml-auto text-link" data-settings-type="reps" data-display-value data-post-id="<?php the_ID(); ?>"></span>
		</button>
		<button class="d-flex p-3 border-bottom" id="settings-weight-<?php echo the_ID(); ?>" data-toggle="modal" data-target="#modal-settings-<?php echo the_ID(); ?>" data-settings-type="weight">
			<span class="font-weight-bold">Weight</span>
			<span class="ml-auto text-link" data-settings-type="weight" data-display-value data-post-id="<?php the_ID(); ?>"></span>
		</button>
		<div class="p-3" id="exercise-details-close-container-<?php the_ID(); ?>">
			<button class="btn btn-block btn-secondary" data-dismiss="modal">Close</button>
		</div>
		<?php
			$comments_args = array(
				'id_form' => 'comment-form-' . $post->ID,
				'title_reply' => '',
				'logged_in_as' => '',
				'comment_field' => '<input type="text" class="text-input is-hidden" name="comment" value="0" id="exercise-input-' . $post->ID . '">',
				'submit_button' => '<input name="submit" type="submit" id="submit-' . $post->ID . '" class="btn btn-block" value="Save &amp; Close" data-dismiss="modal">',
				'title_reply_before' => '',
				'submit_field' => '<div class="p-3 is-hidden" id="submit-container-' . $post->ID . '">%1$s %2$s</div>',
			);
			comment_form($comments_args);
		?>
	</div>
	<div class="modal is-hidden" id="modal-settings-<?php echo the_ID(); ?>">
		<div class="modal-header d-flex">
			<button class="ml-auto p-3" data-dismiss="modal">
				<?php echo get_template_part( 'img/icon-x.svg' ); ?>
			</button>
		</div>
		<div class="modal-body" id="modal-settings-list-<?php echo the_ID(); ?>">
			<div class="webkit-overflow-scroll-bug" id="overflow-scroll-bug-<?php echo the_ID(); ?>"></div>
		</div>
	</div>
<?php endwhile; ?>
