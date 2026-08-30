<?php
// wp_update_post() rejects this page with "無効なページテンプレートです" because
// its stored _wp_page_template meta ('page-templates/blank-content.php') points
// to a file that no longer exists in the current theme (get_page_templates()
// returns empty), even though the page renders fine live via whatever actually
// handles it. To avoid touching/breaking that template assignment at all, update
// post_content/post_title directly via $wpdb->update(), bypassing wp_insert_post()'s
// template re-validation entirely.

global $wpdb;

$post_id     = 3515;
$new_content = file_get_contents( '/tmp/page-3515-demo-text-NEW.html' );

if ( empty( $new_content ) ) {
    WP_CLI::error( 'New content file empty — aborting.' );
}

$updated = $wpdb->update(
    $wpdb->posts,
    array(
        'post_content' => $new_content,
        'post_title'   => 'SlowTH 導入相談',
    ),
    array( 'ID' => $post_id )
);

if ( false === $updated ) {
    WP_CLI::error( 'DB update failed: ' . $wpdb->last_error );
}

clean_post_cache( $post_id );

WP_CLI::success( "Page $post_id updated directly via \$wpdb->update() (rows affected: $updated)." );
