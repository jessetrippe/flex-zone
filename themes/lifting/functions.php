<?php
/**
 * setup functions and definitions
 */

if ( ! function_exists( 'setup' ) ) :

    function setup() {

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'lifting' ),
        ) );
    }
endif;
add_action( 'after_setup_theme', 'setup' );

/**
 * Remove Wordpress junk from head.
 */
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0 ); // remove json link
remove_action('wp_head', 'print_emoji_detection_script', 7); // remove wp-emoji
remove_action('wp_print_styles', 'print_emoji_styles'); // remove wp-emoji
remove_action('wp_head', 'wp_resource_hints', 2); // remove DNS pre-fetch
/**
 * Enqueue scripts and styles.
 */
function scripts() {
    /**
     * Production styles and scripts.
     */
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i', false, time(), 'screen' );
    wp_enqueue_style( 'lifting-style', get_template_directory_uri() . '/style.css', false, time(), 'screen' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, time(), true );
    wp_enqueue_script( 'form', get_stylesheet_directory_uri() . '/js/jquery.form.js', array('jquery'), time(), true );
    wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', false, time(), true );
}
add_action( 'wp_enqueue_scripts', 'scripts' );

/**
 * Remove posts.
 */
function remove_posts_menu() {
    remove_menu_page('edit.php');
}
add_action('admin_init', 'remove_posts_menu');

/**
 * Create exercises post type.
 */
function exercises_posttype() {
    register_post_type('exercises', array(
        'label' => 'Exercises',
        'supports' => array(
            'title',
            'comments',
        ),
        'public' => true,
        'rewrite' => array(
            'slug' => 'exercises'
        ),
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'hierarchical' => true,
        // 'taxonomies' => array('post_tag','category'),
        'register_meta_box_cb' => 'add_exercises_metaboxes',
    ));
}

add_action('init', 'exercises_posttype');

/**
 * Add taxonomies (tags and categories) for exercises post type.
 */
add_action( 'init', 'build_taxonomies', 0 );
function build_taxonomies() {
    register_taxonomy( 'week', 'exercises', array(
        'hierarchical' => true,
        'label' => 'Week',
        'query_var' => true,
        'rewrite' => true,
    ) );
}

//Registers individual meta boxes for custom post type
function add_exercises_metaboxes($post) {
    add_meta_box('exercises-sets', 'Sets', 'exercises_sets_meta', 'exercises', 'side', 'default');
    add_meta_box('exercises-reps', 'Reps', 'exercises_reps_meta', 'exercises', 'side', 'default');
}

function exercises_sets_meta() {
    global $post;

    //Nonce to verify the data
    echo '<input type="hidden" '
    . 'name="exercises_meta_noncename" '
    . 'id="exercises_meta_noncename" '
    . 'value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

    //Get the sets data if it is already written
    $sets = get_post_meta($post->ID, '_sets', true);

    //Output the field
    echo '<input type="number" name="_sets" value="' .
    $sets . '" class="exercises-sets" />';
}

function exercises_reps_meta() {
    global $post;

    //Nonce to verify the data
    echo '<input type="hidden" '
    . 'name="exercises_meta_noncename" '
    . 'id="exercises_meta_noncename" '
    . 'value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

    //Get the reps data if it is already written
    $reps = get_post_meta($post->ID, '_reps', true);

    //Output the field
    echo '<input type="number" name="_reps" value="' .
    $reps . '" class="exercises-reps" />';
}

// Action hook to save the post meta data
add_action('save_post', 'save_exercises_meta', 1, 2);

function save_exercises_meta($post_id, $post) {

    //Verify it came from proper authorization.
    if (!wp_verify_nonce($_POST['exercises_meta_noncename'], plugin_basename(__FILE__))) {
        return $post->ID;
    }

    //Check if the current user can edit the post
    if (!current_user_can('edit_post', $post->ID)) {
        return $post->ID;
    }

    //Add values to custom fields
    $exercises_meta['_sets'] = $_POST['_sets'];

    //Add values to custom fields
    foreach ($exercises_meta as $key => $value) {
        if ($post->post_type == "revision")
            return;
        $value = implode(',', (array) $value);

        if (get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        } else {
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key);
        }
    }

    //Add values to custom fields
    $exercises_meta['_reps'] = $_POST['_reps'];

    //Add values to custom fields
    foreach ($exercises_meta as $key => $value) {
        if ($post->post_type == "revision")
            return;
        $value = implode(',', (array) $value);

        if (get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        } else {
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key);
        }
    }
}

/**
 * Allow duplicate comments.
 */
add_filter('duplicate_comment_id', '__return_false');

/**
 * Remove admin bar.
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Only allow sign-in users.
 */
function members_only() {
    if ( !is_user_logged_in() && !is_page('member-register') && !is_page('member-login') && !is_page('member-password-lost') && !is_page('member-password-reset') ) {
       auth_redirect();
    }
}
add_action( 'wp', 'members_only' );

require( 'personalize-login/personalize-login.php' );

/**
 * Add page slug to body class.
 */
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
