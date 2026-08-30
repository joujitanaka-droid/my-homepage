<?php
$post_id = 3337;
$new_content = file_get_contents( '/tmp/page-3337-flow-photos-NEW.html' );

if ( empty( $new_content ) ) {
    WP_CLI::error( 'New content file empty — aborting.' );
}

$result = wp_update_post(
    array(
        'ID'           => $post_id,
        'post_content' => $new_content,
    ),
    true
);

if ( is_wp_error( $result ) ) {
    WP_CLI::error( 'Update failed: ' . $result->get_error_message() );
}

WP_CLI::success( 'Page 3337 updated, post ID: ' . $result );
