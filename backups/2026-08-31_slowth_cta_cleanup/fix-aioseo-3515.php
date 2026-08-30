<?php
global $wpdb;

$post_id = 3515;
$title = 'SlowTH 導入相談｜AIロボット SlowTH';
$description = 'マシニング加工現場の自動化についての導入相談・現場確認はこちらから。使用中の加工機や自動化したい作業をお聞かせください。株式会社J・P・F。';

$updated = $wpdb->update(
    $wpdb->prefix . 'aioseo_posts',
    array(
        'title'       => $title,
        'description' => $description,
    ),
    array( 'post_id' => $post_id )
);

if ( false === $updated ) {
    WP_CLI::error( 'DB update failed: ' . $wpdb->last_error );
}

$row = $wpdb->get_row( $wpdb->prepare( "SELECT title, description FROM {$wpdb->prefix}aioseo_posts WHERE post_id = %d", $post_id ) );
WP_CLI::log( 'title: ' . $row->title );
WP_CLI::log( 'description: ' . $row->description );

if ( $row->title !== $title || $row->description !== $description ) {
    WP_CLI::error( 'Verification mismatch after update — values do not match intended text.' );
}

WP_CLI::success( 'AIOSEO title/description for page 3515 corrected and verified.' );
