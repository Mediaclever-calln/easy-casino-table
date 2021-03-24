<?php
add_action('init', 'lmfao_redirect'); 
//Function to get redirect key and then redirect to affiliate url
function lmfao_redirect () {
     global $wpdb;
	$redirectkey='go';
	$request = $_SERVER['REQUEST_URI'];
	if (!isset($_SERVER['REQUEST_URI'])) {
		$request = substr($_SERVER['PHP_SELF'], 1);
		if (isset($_SERVER['QUERY_STRING']) AND $_SERVER['QUERY_STRING'] != '') { $request.='?'.$_SERVER['QUERY_STRING']; }
	}
	if (isset($_GET['affkey'])) {
		$request = '/'. $redirectkey .'/'.sanitize_text_field($_GET['affkey']).'/';
    }

	if ( strpos('/'.$request, '/'. $redirectkey .'/') ) {
		$affkey_key = explode(''. $redirectkey .'/', $request);
		$affkey_key = $affkey_key[1];
		$affkey_key = str_replace('/', '', $affkey_key);
            
           $url=lmfao_find_tc_room($affkey_key);
           header('Location: ' . $url . "\n\n");
	   exit;

	} 
	
}

function lmfao_find_tc_room($affkey_key) {
	global $wpdb;
	global $post;
	
	query_posts('post_type=lmfao-casino&meta_key=lmfao-outgoing-slug&meta_value='.$affkey_key .''); 
	
	if ( have_posts() ) {
		the_post();
		$url= get_post_meta( get_the_ID(), 'lmfao-affiliate-link', true );
	}
  return $url;
}

