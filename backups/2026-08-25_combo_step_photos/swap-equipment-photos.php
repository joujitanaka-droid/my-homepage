<?php
// Swap two equipment-section photos on page 3435, per explicit user instruction:
// - FANUC ROBODRILL card's current photo (factory_cut.jpg) -> ワイヤー放電加工機 card
// - 自動化システム card's current photo (factory_robo.jpg) -> FANUC ROBODRILL card
// 自動化システム card becomes a photo-required placeholder (its photo moved away).
// User was explicitly warned that factory_cut.jpg visually shows a drilling/
// machining center, not a wire-EDM machine, and confirmed to proceed anyway.

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old_block = '        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_cut.jpg" alt="FANUC ROBODRILL" loading="lazy" width="600" height="450">
            <h3>FANUC ROBODRILL</h3>
            <p>高速・高精度なマシニング加工に対応。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2022/12/factory_mc.jpg" alt="マシニングセンタ" loading="lazy" width="600" height="450">
            <h3>マシニングセンタ</h3>
            <p>多面加工・精密加工に対応。</p>
        </div>
        <div class="equipment-card photo-required" data-photo-note="ワイヤー放電加工機(ROBOCUT等)の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>ワイヤー放電加工機</h3>
            <p>高精度ワイヤー放電加工を実現。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_ncen.jpg" alt="NC旋盤" loading="lazy" width="600" height="450">
            <h3>NC旋盤</h3>
            <p>軸物部品の高精度加工に対応。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_robo.jpg" alt="自動化システム" loading="lazy" width="600" height="450">
            <h3>自動化システム</h3>
            <p>安定した品質と生産性を実現。</p>
        </div>';

if ( false === strpos( $content, $old_block ) ) {
    WP_CLI::error( 'Equipment-grid block not found in expected form — aborting, no changes made.' );
}

$new_block = '        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_robo.jpg" alt="FANUC ROBODRILL" loading="lazy" width="600" height="450">
            <h3>FANUC ROBODRILL</h3>
            <p>高速・高精度なマシニング加工に対応。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2022/12/factory_mc.jpg" alt="マシニングセンタ" loading="lazy" width="600" height="450">
            <h3>マシニングセンタ</h3>
            <p>多面加工・精密加工に対応。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_cut.jpg" alt="ワイヤー放電加工機" loading="lazy" width="600" height="450">
            <h3>ワイヤー放電加工機</h3>
            <p>高精度ワイヤー放電加工を実現。</p>
        </div>
        <div class="equipment-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_ncen.jpg" alt="NC旋盤" loading="lazy" width="600" height="450">
            <h3>NC旋盤</h3>
            <p>軸物部品の高精度加工に対応。</p>
        </div>
        <div class="equipment-card photo-required" data-photo-note="自動化システム(ロボット等)の写真が必要です">
            <span class="photo-required__label">PHOTO REQUIRED</span>
            <h3>自動化システム</h3>
            <p>安定した品質と生産性を実現。</p>
        </div>';

$content = str_replace( $old_block, $new_block, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-equipment-swap-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-equipment-swap-NEW.html for review.' );
