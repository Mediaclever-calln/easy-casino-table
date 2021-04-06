<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function my_block_cgb_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'my_block-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'my_block-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'my_block-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'my_block-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-my-block', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'my_block-cgb-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'my_block-cgb-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'my_block-cgb-block-editor-css',
			'render_callback' => 'render_post_block'
		)
	);
}

function render_post_block($attributes) {

	$postid = $attributes['selectedCasino'];
		
	ob_start();
		
		echo '<div class="tablewrapper"><div class="ectcell"><table class="ecttable"><tbody class="ecttbody"><tr><td class="ectimg">' . get_the_post_thumbnail( $postid ) . '</td>';
		echo '<td class="ectcol1"><span class="col1start">' . get_the_title($postid) . '</span><br><a href="'. get_permalink( $postid ) . '" class="tc-link">'.get_option('ect_settings_input_readmore').'</td>';
		echo '<td class="ectcol2"><span class="col2start">' . get_post_meta($postid, 'ect-column2', true) . '</span><br><span class="col2follow">'.get_post_meta($postid, 'ect-column2-follow', true).'<span></td>';
		echo '<td class="ectlink"><a rel="nofollow" target="_blank" href="'. get_bloginfo('url') .'/go/'. get_post_meta($postid, 'ect-outgoing-slug', true) .'/ ">'.get_option('ect_settings_input_visitbutton').'</a></td></tr></tbody></table>';
		echo '<div class="ectinfobox"><a class="tclink" rel="nofollow" target="_blank" href="'. get_bloginfo('url') .'/tc/'. get_post_meta($postid, 'ect-outgoing-slug', true) .'/ ">'.get_option('ect_settings_input_tclink').'</a>  |  <span class="ectinfotext">' . get_post_meta( $postid, 'ect-column3', true ) . '</span></div></div></div>';
        
	return ob_get_clean();
}

// Hook: Block assets.
add_action( 'init', 'my_block_cgb_block_assets' );
