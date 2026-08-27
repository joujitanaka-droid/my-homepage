<?php
// Fill the remaining 3 PHOTO REQUIRED quality-card slots on page 3435:
// 寸法管理 -> IMG_2142.JPG (caliper measurement against a drawing)
// トレーサビリティ -> IMG_2140.JPG (order/production record management at a desk)
// 出荷前確認 -> IMG_2145.JPG (packaged parts with spec sheet, ready to ship)

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old_dim = '        <div class="quality-card photo-required" data-photo-note="寸法管理(測定データ活用)の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>寸法管理</h3>
            <p>測定データを活用して品質を安定化。</p>
        </div>';
$new_dim = '        <div class="quality-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_dimension.jpg" alt="寸法管理のようす" loading="lazy" width="500" height="375">
            <h3>寸法管理</h3>
            <p>測定データを活用して品質を安定化。</p>
        </div>';

$old_trace = '        <div class="quality-card photo-required" data-photo-note="トレーサビリティ管理の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>トレーサビリティ</h3>
            <p>必要な製造履歴を管理。</p>
        </div>';
$new_trace = '        <div class="quality-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_traceability.jpg" alt="トレーサビリティ管理のようす" loading="lazy" width="500" height="375">
            <h3>トレーサビリティ</h3>
            <p>必要な製造履歴を管理。</p>
        </div>';

$old_ship = '        <div class="quality-card photo-required" data-photo-note="出荷前確認の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>出荷前確認</h3>
            <p>最終確認を行ってから出荷。</p>
        </div>';
$new_ship = '        <div class="quality-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_shipping.jpg" alt="出荷前確認のようす" loading="lazy" width="500" height="375">
            <h3>出荷前確認</h3>
            <p>最終確認を行ってから出荷。</p>
        </div>';

foreach ( array(
    array( $old_dim, $new_dim, '寸法管理' ),
    array( $old_trace, $new_trace, 'トレーサビリティ' ),
    array( $old_ship, $new_ship, '出荷前確認' ),
) as $pair ) {
    list( $old, $new, $label ) = $pair;
    if ( false === strpos( $content, $old ) ) {
        WP_CLI::error( $label . ' placeholder block not found — aborting, no changes made.' );
    }
    $content = str_replace( $old, $new, $content );
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-quality-photos-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-quality-photos-NEW.html for review.' );
