<?php
// Replace the "JPFが自社で使うから、現場目線で考えます。" section's right-side
// photo (#why-jpf .slowth-why-jpf__photo) with the new 2025-08-30 shopfloor
// development photo. Heading, left-side text, check list, caption text,
// layout, and every other section are left untouched.

$post_id = 3337;
$content = get_post_field( 'post_content', $post_id );

$old = '<img src="https://jp-factory.co.jp/wp-content/uploads/2026/04/S__31137805.jpg" alt="JPFスタッフによるスロースの開発・調整風景" loading="lazy" width="700" height="525">';
$new = '<img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-jpf-shopfloor-development.jpg" alt="JPFが自社工場でSlowTHを開発・調整する様子" loading="lazy" width="700" height="525">';

if ( false === strpos( $content, $old ) ) {
    WP_CLI::error( 'why-jpf photo <img> tag not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old, $new, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3337-shopfloor-photo-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3337-shopfloor-photo-NEW.html for review.' );
