<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function lmfao_register_meta_boxes() {
    add_meta_box( 'lmfao-info', __( 'Item specifications', 'lmfaoplugin' ), 'lmfao_display_callback', 'lmfao-casino' );
}
add_action( 'add_meta_boxes', 'lmfao_register_meta_boxes' );


function lmfao_display_callback( $post ) {
    include plugin_dir_path( __FILE__ ) . './form.php';
}


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function lmfao_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'lmfao-column2',
        'lmfao-column2-follow',
        'lmfao-column3',
        'lmfao-affiliate-link',
        'lmfao-tc-link',
        'lmfao-outgoing-slug',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'lmfao_save_meta_box' );


function lmfao_wl_posts() {
    
    $args = array(
        'numberpost' => 99999,
        'post_type' => 'lmfao-casino'
    );

    $posts = get_posts($args);

    $data = [];
    $i = 0;

    foreach($posts as $post) {
        $data[$i]['id'] = $post->ID;
        $data[$i]['title'] = $post->post_title;
        $i++;
    }

    return $data;
}
add_action( 'rest_api_init', function() {

    register_rest_route('wl/v1', 'lmfao-casino', array(
        'methods' => 'GET',
        'callback' => 'lmfao_wl_posts'
    ));
});

add_theme_support('post-thumbnails');
set_post_thumbnail_size( 150, 150, true );

function lmfao_settings_menu() {

    add_submenu_page(
        'edit.php?post_type=lmfao-casino',
        __( 'Settings', 'lmfaoplugin' ),
        __( 'Settings', 'lmfaoplugin' ),
        'manage_options',
        'lmfao-casino',
        'lmfao_settings_template_callback',
        '',
        null
    );

}
add_action('admin_menu', 'lmfao_settings_menu');

/**
 * Settings Template Page
 */
function lmfao_settings_template_callback() {
    ?>
    <div class="wrap">
        <h1>Reviews Settings</h1>

        <form action="options.php" method="post">
            <?php 
                // security field
                settings_fields( 'lmfao-settings-page' );

                // output settings section here
                do_settings_sections('lmfao-settings-page');

                // save settings button
                submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php 
}

/**
 * Settings Template
 */
function lmfao_settings_init() {

    // Setup settings section
    add_settings_section(
        'lmfao_settings_section',
        'Reviews link names on frontend',
        '',
        'lmfao-settings-page'
    );

    // Registe input field
    register_setting(
        'lmfao-settings-page',
        'lmfao_settings_input_visitbutton',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    register_setting(
        'lmfao-settings-page',
        'lmfao_settings_input_tclink',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    register_setting(
        'lmfao-settings-page',
        'lmfao_settings_input_readmore',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add text fields
    add_settings_field(
        'lmfao_settings_input_visitbutton',
        __( 'Visit button', 'my-plugin' ),
        'lmfao_settings_input_visitbutton_callback',
        'lmfao-settings-page',
        'lmfao_settings_section'
    );
    add_settings_field(
        'lmfao_settings_input_tclink',
        __( 'Link underneath', 'my-plugin' ),
        'lmfao_settings_input_tclink_callback',
        'lmfao-settings-page',
        'lmfao_settings_section'
    );
    add_settings_field(
        'lmfao_settings_input_readmore',
        __( 'Read more', 'my-plugin' ),
        'lmfao_settings_input_readmore_callback',
        'lmfao-settings-page',
        'lmfao_settings_section'
    );
}
add_action( 'admin_init', 'lmfao_settings_init' );

function lmfao_settings_input_visitbutton_callback() {
    $myplugin_input_field = get_option('lmfao_settings_input_visitbutton');
    ?>
    <input type="text" name="lmfao_settings_input_visitbutton" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}
function lmfao_settings_input_tclink_callback() {
    $myplugin_input_field = get_option('lmfao_settings_input_tclink');
    ?>
    <input type="text" name="lmfao_settings_input_tclink" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}
function lmfao_settings_input_readmore_callback() {
    $myplugin_input_field = get_option('lmfao_settings_input_readmore');
    ?>
    <input type="text" name="lmfao_settings_input_readmore" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}

function lmfao_remove_cpt_slug( $post_link, $post ) {
    if ( 'lmfao-casino' === $post->post_type && 'publish' === $post->post_status ) {
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'lmfao_remove_cpt_slug', 10, 2 );

function lmfao_add_cpt_post_names_to_main_query( $query ) {
    // Return if this is not the main query.
    if ( ! $query->is_main_query() ) {
        return;
    }
    // Return if this query doesn't match our very specific rewrite rule.
    if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
        return;
    }
    // Return if we're not querying based on the post name.
    if ( empty( $query->query['name'] ) ) {
        return;
    }
    // Add CPT to the list of post types WP will include when it queries based on the post name.
    $query->set( 'post_type', array( 'post', 'page', 'lmfao-casino' ) );
}
add_action( 'pre_get_posts', 'lmfao_add_cpt_post_names_to_main_query' );