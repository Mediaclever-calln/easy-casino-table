<?php
add_action('init', 'ect_casino_posttype');

function ect_casino_posttype() {

$args = array(
  'labels' => array(
         'name' => __( 'Reviews' , 'ectplugin'),
         'singular_name' => __( 'Review', 'ectplugin' ),
        'add_new' => __( 'Add New review', 'ectplugin' ),
	'add_new_item' => __( 'Add New review', 'ectplugin' ),
	'edit' => __( 'Edit review' , 'ectplugin'),
	'edit_item' => __( 'Edit review', 'ectplugin' ),
	'new_item' => __( 'New review', 'ectplugin' ),
	'view' => __( 'View review', 'ectplugin' ),
	'view_item' => __( 'View review' , 'ectplugin'),
	'search_items' => __( 'Search reviews' , 'ectplugin'),
	'not_found' => __( 'No reviews found', 'ectplugin' ),
	'not_found_in_trash' => __( 'No reviews found in Trash' , 'ectplugin'),
	'parent' => __( 'Parent review' , 'ectplugin'),

                ),

  'public' => true,
  'show_ui' => true,
  'menu_icon' => 'dashicons-media-text',
  'capability_type' => 'post',
  'hierarchical' => false,
  'show_in_rest' => true,
  'label'        => 'casinos',
  'rewrite' => array( 'slug' => 'ect-casino', 'with_front' => false ),
  'supports' => array('title', 'thumbnail', 'editor', 'page-attributes')
);

register_post_type('ect-casino',$args);
}
