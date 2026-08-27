<?php
// Change the hero's two "特徴" badges (試作1個から対応 / 秘密保持対応) from the
// yellow button-like .badge-chip--accent style to a plain checkmark-text style
// (.hero-feature), so they no longer look like clickable CTAs.
//
// IMPORTANT: the exact same text/class also appears in the final-cta section
// (body.page-id-3435 .badge-row--dark), which the user explicitly said NOT to
// touch. This script only replaces the FIRST occurrence of each exact string
// (str_replace with a count limit via explicit substr_replace on the first
// match), which is inside the <section class="hero ..."> block.

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

function replace_first( $search, $replace, $subject ) {
    $pos = strpos( $subject, $search );
    if ( false === $pos ) {
        return array( $subject, false );
    }
    $new = substr_replace( $subject, $replace, $pos, strlen( $search ) );
    return array( $new, true );
}

// Sanity check: confirm the hero section is really where we think it is,
// and that it precedes the final-cta occurrence of the same accent class.
$hero_pos = strpos( $content, '<section class="hero hero-machining reveal">' );
$first_accent_pos = strpos( $content, 'badge-chip badge-chip--accent' );
$last_accent_pos = strrpos( $content, 'badge-chip badge-chip--accent' );

if ( false === $hero_pos || false === $first_accent_pos || $first_accent_pos < $hero_pos ) {
    WP_CLI::error( 'Hero section / accent badge not found in expected position — aborting, no changes made.' );
}
if ( $first_accent_pos === $last_accent_pos ) {
    WP_CLI::error( 'Only one badge-chip--accent occurrence found (expected 2: hero + final-cta) — aborting to avoid touching the wrong one.' );
}

$old1 = '<span class="badge-chip badge-chip--accent">試作1個から対応</span>';
$new1 = '<span class="hero-feature">試作1個から対応</span>';
list( $content, $ok1 ) = replace_first( $old1, $new1, $content );
if ( ! $ok1 ) {
    WP_CLI::error( 'First target span (試作1個から対応) not found in expected form — aborting, no changes made.' );
}

$old2 = '<span class="badge-chip badge-chip--accent">秘密保持対応</span>';
$new2 = '<span class="hero-feature">秘密保持対応</span>';
list( $content, $ok2 ) = replace_first( $old2, $new2, $content );
if ( ! $ok2 ) {
    WP_CLI::error( 'Second target span (秘密保持対応) not found in expected form — aborting, no changes made.' );
}

// Confirm the final-cta section's identical text still has the untouched
// original classes (i.e. we did not accidentally change both occurrences).
if ( false === strpos( $content, '<span class="badge-chip badge-chip--accent">試作1個からOK</span>' ) ) {
    WP_CLI::error( 'final-cta badge (試作1個からOK) no longer found unchanged — aborting to be safe.' );
}
if ( substr_count( $content, '<span class="badge-chip badge-chip--accent">秘密保持対応</span>' ) !== 1 ) {
    WP_CLI::error( 'Expected exactly 1 remaining badge-chip--accent 秘密保持対応 span (final-cta) — aborting to be safe.' );
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-hero-features-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-hero-features-NEW.html for review.' );
