<?php
// Fill the remaining 2 PHOTO REQUIRED equipment-card slots on page 3435:
// 自動化システム -> IMG_1907(1).JPG (collaborative robot arm mounted on a
//   FANUC ROBODRILL, real automation-system photo)
// 測定機器各種 -> IMG_2144.JPG (KEYENCE image measurement system in use,
//   real measurement-equipment photo)

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old_block = '        <div class="equipment-card photo-required" data-photo-note="自動化システム(ロボット等)の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>自動化システム</h3>
            <p>安定した品質と生産性を実現。</p>
        </div>
        <div class="equipment-card photo-required" data-photo-note="三次元測定機の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>測定機器各種</h3>
            <p>三次元測定機・ノギス等の測定機器を保有。</p>
        </div>';

if ( false === strpos( $content, $old_block ) ) {
    WP_CLI::error( '自動化システム/測定機器各種 placeholder block not found — aborting, no changes made.' );
}

$new_block = '        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/factory_automation.jpg" alt="自動化システム" loading="lazy" width="600" height="450">
            <h3>自動化システム</h3>
            <p>安定した品質と生産性を実現。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/factory_measure.jpg" alt="測定機器各種" loading="lazy" width="600" height="450">
            <h3>測定機器各種</h3>
            <p>三次元測定機・ノギス等の測定機器を保有。</p>
        </div>';

$content = str_replace( $old_block, $new_block, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-automation-measure-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-automation-measure-NEW.html for review.' );
