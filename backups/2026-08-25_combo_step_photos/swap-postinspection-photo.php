<?php
// Replace the 加工後検査 (post-machining inspection) card photo on page 3435
// (#quality-check section): factory_photo1_s.jpg -> quality_postinspection.jpg
// (IMG_2143, KEYENCE measurement system inspecting a part).

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old = '<img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_photo1_s.jpg" alt="加工後検査のようす" loading="lazy" width="500" height="375">';
$new = '<img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_postinspection.jpg" alt="加工後検査のようす" loading="lazy" width="500" height="375">';

if ( false === strpos( $content, $old ) ) {
    WP_CLI::error( '加工後検査 <img> tag not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old, $new, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-postinspection-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-postinspection-NEW.html for review.' );
