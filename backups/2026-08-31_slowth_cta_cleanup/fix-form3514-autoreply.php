<?php
$post_id = 3514;

$old = get_post_meta( $post_id, 'auto_reply_email_body', true );

$needle = 'この度はSlowTHの導入相談・デモ依頼をいただき、ありがとうございます。';
if ( false === strpos( $old, $needle ) ) {
    WP_CLI::error( 'Expected sentence not found in auto_reply_email_body — aborting, no changes made.' );
}

$new = str_replace(
    $needle,
    'この度はSlowTHの導入相談をいただき、ありがとうございます。',
    $old
);

$result = update_post_meta( $post_id, 'auto_reply_email_body', $new );

$verify = get_post_meta( $post_id, 'auto_reply_email_body', true );
if ( $verify !== $new ) {
    WP_CLI::error( 'Verification mismatch after update.' );
}
if ( false !== strpos( $verify, 'デモ' ) ) {
    WP_CLI::error( '"デモ" still present after update — aborting further steps.' );
}

WP_CLI::success( 'auto_reply_email_body for form 3514 corrected and verified. New value: ' . "\n" . $verify );
