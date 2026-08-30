<?php
// Remove misleading "demo unit loan" phrasing from the /slowth-contact/ page
// (page 3515): both hero headings + the form lede paragraph.

$post_id = 3515;
$content = get_post_field( 'post_content', $post_id );

$heading_old = '<h2 class="smb-section__title">SlowTH 導入相談・デモ依頼</h2>';
$heading_new = '<h2 class="smb-section__title">SlowTH 導入相談</h2>';
$heading_count = substr_count( $content, $heading_old );
if ( $heading_count < 1 ) {
    WP_CLI::error( 'Hero heading string not found — aborting, no changes made.' );
}
$content = str_replace( $heading_old, $heading_new, $content );

$lede_old = 'マシニング加工現場の自動化についてのご相談・デモ依頼はこちらのフォームからお送りください。現場や機械の写真を添付いただくと、その後のご相談がスムーズです。下記フォームに必要事項を入力後、確認ボタンを押して送信してください。';
$lede_new = 'マシニング加工現場の自動化についてのご相談はこちらのフォームからお送りください。現場や機械の写真を添付いただくと、その後のご相談がスムーズです。下記フォームに必要事項を入力後、確認ボタンを押して送信してください。';
if ( false === strpos( $content, $lede_old ) ) {
    WP_CLI::error( 'Form lede paragraph not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $lede_old, $lede_new, $content );

if ( false !== strpos( $content, 'デモ依頼' ) || false !== strpos( $content, 'デモ機' ) ) {
    WP_CLI::error( '"デモ依頼"/"デモ機" still present after replacement — aborting, no changes made.' );
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3515-demo-text-NEW.html', $content );

WP_CLI::success( "Content transformed ($heading_count heading occurrences). Not yet saved to DB. New content written to /tmp/page-3515-demo-text-NEW.html for review." );
