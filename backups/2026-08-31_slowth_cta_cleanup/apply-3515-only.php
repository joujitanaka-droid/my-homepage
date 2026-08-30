<?php
$post_id = 3515;
$new_content = file_get_contents( '/tmp/page-3515-demo-text-NEW.html' );

if ( empty( $new_content ) ) {
    WP_CLI::error( 'New content file empty — aborting.' );
}

$result = wp_update_post(
    array(
        'ID'            => $post_id,
        'post_content'  => $new_content,
        'post_title'    => 'SlowTH 導入相談',
        'page_template' => 'page-templates/blank-content.php',
    ),
    true
);

if ( is_wp_error( $result ) ) {
    WP_CLI::error( 'Update failed: ' . $result->get_error_message() );
}

WP_CLI::success( 'Page 3515 updated (content + title), post ID: ' . $result );
