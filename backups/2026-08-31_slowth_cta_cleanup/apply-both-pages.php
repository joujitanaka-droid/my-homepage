<?php
$jobs = array(
    3337 => '/tmp/page-3337-demo-text-NEW.html',
    3515 => '/tmp/page-3515-demo-text-NEW.html',
);

foreach ( $jobs as $post_id => $file ) {
    $new_content = file_get_contents( $file );
    if ( empty( $new_content ) ) {
        WP_CLI::error( "New content file empty for post $post_id — aborting." );
    }

    $result = wp_update_post(
        array(
            'ID'           => $post_id,
            'post_content' => $new_content,
        ),
        true
    );

    if ( is_wp_error( $result ) ) {
        WP_CLI::error( "Update failed for post $post_id: " . $result->get_error_message() );
    }

    WP_CLI::log( "Post $post_id updated." );
}

// Also fix the page title of /slowth-contact/ (3515) to match the corrected heading.
$title_result = wp_update_post(
    array(
        'ID'         => 3515,
        'post_title' => 'SlowTH 導入相談',
    ),
    true
);
if ( is_wp_error( $title_result ) ) {
    WP_CLI::error( 'post_title update failed: ' . $title_result->get_error_message() );
}

WP_CLI::success( 'Both pages (3337, 3515) and 3515 post_title updated.' );
