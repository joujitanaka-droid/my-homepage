<?php
// Remove misleading "demo unit loan" phrasing from the SlowTH JP sales page
// (page 3337). JPF does not currently lend out a physical demo unit.
// "デモ動画を見る" (watch demo video, links to #video) is intentionally left
// unchanged — it refers to the real embedded YouTube videos already on the
// page, not to lending equipment, and was not in the user's target list.

$post_id = 3337;
$content = get_post_field( 'post_content', $post_id );

$replacements = array(
    '<a class="btn btn-primary" href="https://jp-factory.co.jp/slowth-contact/" data-gtm-event="slowth_consult_click">導入相談・デモ依頼</a>'
        => '<a class="btn btn-primary" href="https://jp-factory.co.jp/slowth-contact/" data-gtm-event="slowth_consult_click">導入相談</a>',
    '<a class="btn btn-primary btn-large" href="https://jp-factory.co.jp/slowth-contact/" data-gtm-event="slowth_consult_click">導入相談・デモ依頼はこちら</a>'
        => '<a class="btn btn-primary btn-large" href="https://jp-factory.co.jp/slowth-contact/" data-gtm-event="slowth_consult_click">導入相談はこちら</a>',
);

foreach ( $replacements as $old => $new ) {
    if ( false === strpos( $content, $old ) ) {
        WP_CLI::error( 'Expected string not found: ' . substr( $old, 0, 80 ) . ' — aborting, no changes made.' );
    }
    $content = str_replace( $old, $new, $content );
}

if ( false !== strpos( $content, 'デモ依頼' ) ) {
    WP_CLI::error( '"デモ依頼" still present after replacement — aborting, no changes made.' );
}
if ( false === strpos( $content, 'デモ動画を見る' ) ) {
    WP_CLI::error( '"デモ動画を見る" (intentionally unchanged) went missing — aborting, no changes made.' );
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3337-demo-text-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3337-demo-text-NEW.html for review.' );
