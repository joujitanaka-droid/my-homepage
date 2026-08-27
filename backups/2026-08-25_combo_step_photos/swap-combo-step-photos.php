<?php
// Replace the combo-example (#combination-example) STEP1 and STEP2 photos on page 3435.
// STEP1: factory_ncf.jpg -> combo-step1-machining.jpg (real photo, same <img> tag pattern)
// STEP2: photo-required placeholder -> combo-step2-wire.jpg real <img>
// 完成 (result) photo is intentionally left untouched, per instruction.

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old_step1 = '<img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_ncf.jpg" alt="マシニング加工の工程" loading="lazy" width="700" height="525">';
$new_step1 = '<img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/combo-step1-machining.jpg" alt="マシニング加工の工程" loading="lazy" width="700" height="525">';

if ( false === strpos( $content, $old_step1 ) ) {
    WP_CLI::error( 'STEP1 <img> tag not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old_step1, $new_step1, $content );

$old_step2 = '<div class="combo-step-photo photo-required" data-photo-note="ワイヤー放電加工の工程写真が必要です">
                <span class="photo-required__label">PHOTO REQUIRED</span>
            </div>';
$new_step2 = '<div class="combo-step-photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/combo-step2-wire.jpg" alt="ワイヤー放電加工の工程" loading="lazy" width="700" height="525">
            </div>';

if ( false === strpos( $content, $old_step2 ) ) {
    WP_CLI::error( 'STEP2 placeholder block not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old_step2, $new_step2, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-combo-step-photos-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-combo-step-photos-NEW.html for review.' );
