<?php
add_action('init', 'lmfao_casino_posttype');

function lmfao_casino_posttype() {

$args = array(
  'labels' => array(
         'name' => __( 'Reviews' , 'lmfaoplugin'),
         'singular_name' => __( 'Review', 'lmfaoplugin' ),
        'add_new' => __( 'Add New review', 'lmfaoplugin' ),
	'add_new_item' => __( 'Add New review', 'lmfaoplugin' ),
	'edit' => __( 'Edit review' , 'lmfaoplugin'),
	'edit_item' => __( 'Edit review', 'lmfaoplugin' ),
	'new_item' => __( 'New review', 'lmfaoplugin' ),
	'view' => __( 'View review', 'lmfaoplugin' ),
	'view_item' => __( 'View review' , 'lmfaoplugin'),
	'search_items' => __( 'Search reviews' , 'lmfaoplugin'),
	'not_found' => __( 'No reviews found', 'lmfaoplugin' ),
	'not_found_in_trash' => __( 'No reviews found in Trash' , 'lmfaoplugin'),
	'parent' => __( 'Parent review' , 'lmfaoplugin'),

                ),

  'public' => true,
  'show_ui' => true,
  'menu_icon' => 'dashicons-media-text',
  'capability_type' => 'post',
  'hierarchical' => false,
  'show_in_rest' => true,
  'label'        => 'casinos',
  'rewrite' => array( 'slug' => 'lmfao-casino', 'with_front' => false ),
  'supports' => array('title', 'thumbnail', 'editor', 'page-attributes')
);

register_post_type('lmfao-casino',$args);
}
