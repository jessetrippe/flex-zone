<?php
/**
 * The main template file
 */

while ( have_posts() ) : the_post(); ?>
  <li <?php post_class(); ?> data-post-id="<?php echo the_ID(); ?>">
    <button data-toggle="modal" data-target="#modal-<?php echo get_the_ID() ?>" class="p-relative bg-white border-silver border-bottom d-flex align-items-center text-left font-weight-bold w-100">
        <?php echo '<img height="100" width="100" class="mr-3 bg-gray d-block" src="http://cdn.madebyjesse.com/lifting-assets/' . $post->post_name . '.jpg">'; ?>
          <span class="w-25 js-set-settings">
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
          </span>
        <span class="ml-3 m-0">
          <?php the_title(); ?>
        </span>
    </button>
    <div class="modal bg-white d-flex is-hidden" id="modal-<?php echo the_ID(); ?>">
      <div class="d-flex p-2">
        <button class="ml-auto close" data-dismiss="modal">&times;</button>
      </div>
      <video muted playsinline loop class="w-100 d-block">
        <?php echo '<source src="http://cdn.madebyjesse.com/lifting-assets/' . $post->post_name . '.mp4" type="video/mp4">'; ?>
      </video>
      <div class="actionlist px-3 mb-auto js-set-options-container">
        <button class="d-flex p-3 w-100 border-bottom border-silver js-sets-trigger" data-toggle="actionsheet" data-target="#actionsheet-<?php the_ID(); ?>">
          <span class="font-weight-bold">Sets</span>
          <span class="ml-auto js-value"></span>
        </button>
        <button class="d-flex p-3 w-100 border-bottom border-silver js-reps-trigger" data-toggle="actionsheet" data-target="#actionsheet-<?php the_ID(); ?>">
          <span class="font-weight-bold">Reps</span>
          <span class="ml-auto js-value"></span>
        </button>
        <button class="d-flex p-3 w-100 border-bottom border-silver js-weight-trigger" data-toggle="actionsheet" data-target="#actionsheet-<?php the_ID(); ?>">
          <span class="font-weight-bold">Weight</span>
          <span class="ml-auto js-value"></span>
        </button>
      </div>
      <div class="actionsheet is-hidden" id="actionsheet-<?php echo the_ID(); ?>">
        <div class="actionsheet-options js-set-options-list-1">
          <div class="webkit-overflow-scroll-bug"></div>
        </div>
        <div class="actionsheet-cancel">
          <button class="btn btn-block btn-ghost" data-dismiss="actionsheet">Cancel</button>
        </div>
      </div>
      <div class="p-3">
        <button class="btn btn-block btn-ghost black" data-dismiss="modal">Done</button>
      </div>
    </div>
    <div class="is-hidden">
      <?php
        $comments_args = array(
          'id_form' => 'commentform-' . $post->ID,
          'title_reply' => '',
          'title_reply_before' => '',
          'title_reply_after' => '',
          'logged_in_as' => '',
          'cancel_reply_after' => '',
          'cancel_reply_link' => '',
          'cancel_reply_before' => '',
          'comment_notes_after' => '',
          'comment_field' => '<input type="text" name="comment" value="0">',
        );
        comment_form($comments_args);
      ?>
    </div>
  </li>
<?php endwhile;
