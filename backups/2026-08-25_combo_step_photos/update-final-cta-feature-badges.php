<?php
// Apply the same fix to the final-cta section's two "特徴" badges
// (試作1個からOK / 秘密保持対応): change from the yellow button-like
// .badge-chip--accent to the plain checkmark-text .hero-feature style
// already used in the hero, so they read as information rather than CTAs.

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old1 = '<span class="badge-chip badge-chip--accent">試作1個からOK</span>';
$new1 = '<span class="hero-feature">試作1個からOK</span>';

if ( false === strpos( $content, $old1 ) ) {
    WP_CLI::error( 'final-cta badge (試作1個からOK) not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old1, $new1, $content );

$old2 = '<span class="badge-chip badge-chip--accent">秘密保持対応</span>';
$new2 = '<span class="hero-feature">秘密保持対応</span>';

if ( false === strpos( $content, $old2 ) ) {
    WP_CLI::error( 'final-cta badge (秘密保持対応) not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old2, $new2, $content );

// Sanity check: no badge-chip--accent should remain anywhere now.
if ( false !== strpos( $content, 'badge-chip--accent' ) ) {
    WP_CLI::error( 'Unexpected remaining badge-chip--accent occurrence — aborting to be safe.' );
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-final-cta-features-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-final-cta-features-NEW.html for review.' );
