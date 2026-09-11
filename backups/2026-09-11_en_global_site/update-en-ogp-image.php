<?php
// Priority A fix #1: /en/'s OGP + Twitter card image is currently AIOSEO's
// "default" fallback (the JPF navi_logo.png), because post 2385's
// wp_aioseo_posts row has og_image_type/twitter_image_type = 'default'
// with no custom image set. Switch both to the same real machined-parts
// photo already used as the page's own hero background
// (attachment ID 3088, IMG_0730.jpg — verified live, HTTP 200).

global $wpdb;

$post_id       = 2385;
$attachment_id = 3088;
$image_url     = 'https://jp-factory.co.jp/wp-content/uploads/2024/03/IMG_0730.jpg';

$existing = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}aioseo_posts WHERE post_id = %d", $post_id ) );
if ( ! $existing ) {
	WP_CLI::error( "No wp_aioseo_posts row found for post {$post_id}." );
}

$updated = $wpdb->update(
	$wpdb->prefix . 'aioseo_posts',
	array(
		'og_image_type'             => 'custom',
		'og_image_url'              => $image_url,
		'og_image_custom_url'       => $image_url,
		'og_image_width'            => 2000,
		'og_image_height'           => 1500,
		'twitter_image_type'        => 'custom',
		'twitter_image_url'         => $image_url,
		'twitter_image_custom_url'  => $image_url,
	),
	array( 'post_id' => $post_id )
);

if ( false === $updated ) {
	WP_CLI::error( '$wpdb->update failed: ' . $wpdb->last_error );
}

clean_post_cache( $post_id );

$verify = $wpdb->get_row( $wpdb->prepare(
	"SELECT og_image_type, og_image_url, twitter_image_type, twitter_image_url FROM {$wpdb->prefix}aioseo_posts WHERE post_id = %d",
	$post_id
) );

if ( 'custom' !== $verify->og_image_type || $image_url !== $verify->og_image_url ) {
	WP_CLI::error( 'Post-update verification failed for og_image fields.' );
}
if ( 'custom' !== $verify->twitter_image_type || $image_url !== $verify->twitter_image_url ) {
	WP_CLI::error( 'Post-update verification failed for twitter_image fields.' );
}

WP_CLI::success( 'OGP + Twitter card image updated to IMG_0730.jpg (attachment 3088) for post 2385, verified.' );
