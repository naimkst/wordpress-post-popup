<?php

add_action('wp_ajax_nopriv_ajax_request', 'ajax_handle_request');
add_action('wp_ajax_ajax_request', 'ajax_handle_request');

function ajax_handle_request(){

	$postID = $_POST['id'];
	if (isset($_POST['id'])){
		$post_id = $_POST['id'];
	}else{
		$post_id = "";
	}

	$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 5, 'numberposts' => 5 );

	$posts = get_posts( $args );

	foreach($posts as $post) {
		$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($postID), array('220','220'), true );
		$thumbnail_url = $thumbnail_url[0];
		$image = ( !empty($thumbnail_url) ) ? $thumbnail_url : 'No thumb!';
	}

	$author_id = get_post_field( 'post_author', $postID );
	$author_name = get_the_author_meta( 'display_name', $author_id );
	$authorImg = get_avatar( get_the_author_meta( $author_id ), 60 );
	$url = get_permalink( $postID );

	global $post;
	$post = get_post($postID);
	$response = array(
		'sucess' => true,
		'post' => $post,
		'id' => $postID ,
		'image' => $image,
		'author' => $author_name,
		'avatar' => $authorImg,
		'url' => $url,
	);


	// generate the response
	echo json_encode($response);
	// IMPORTANT: don't forget to "exit"
	die();
}

?>
