<?php
// Set up correct AIOSEO metadata for post 2385 (top-en), which is the post
// the main query is now bound to for /en/ requests (see
// jpf_bind_english_home_main_query in functions.php). Previously this row
// was empty, so AIOSEO fell back to whatever the (wrongly-resolved) main
// query pointed at — the JP "News" listing page — and stamped /en/ with
// that page's title/description/OGP/schema.

global $wpdb;

$post_id = 2385;
$title = 'Precision CNC Machining & Wire EDM in Japan | JPF';
$description = 'JPF manufactures precision machined parts in Kyoto, Japan using CNC machining and wire EDM. Upload your drawing and request a quote.';

$data = array(
    'title'           => $title,
    'description'     => $description,
    'canonical_url'   => 'https://jp-factory.co.jp/en/',
    'og_title'        => $title,
    'og_description'  => $description,
    'twitter_title'   => $title,
    'twitter_description' => $description,
);

$existing = $wpdb->get_row( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}aioseo_posts WHERE post_id = %d", $post_id ) );

if ( $existing ) {
    $data['updated'] = current_time( 'mysql' );
    $wpdb->update( $wpdb->prefix . 'aioseo_posts', $data, array( 'post_id' => $post_id ) );
} else {
    $data['post_id'] = $post_id;
    $data['created'] = current_time( 'mysql' );
    $data['updated'] = current_time( 'mysql' );
    $wpdb->insert( $wpdb->prefix . 'aioseo_posts', $data );
}

$row = $wpdb->get_row( $wpdb->prepare( "SELECT title, description, canonical_url FROM {$wpdb->prefix}aioseo_posts WHERE post_id = %d", $post_id ) );
WP_CLI::log( 'title: ' . $row->title );
WP_CLI::log( 'description: ' . $row->description );
WP_CLI::log( 'canonical_url: ' . $row->canonical_url );

if ( $row->title !== $title || $row->description !== $description ) {
    WP_CLI::error( 'Verification mismatch.' );
}

WP_CLI::success( 'AIOSEO row for post 2385 (English top) set up and verified.' );
