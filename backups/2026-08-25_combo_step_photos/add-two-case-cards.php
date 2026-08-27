<?php
// Add 2 more real case-study cards to the #cases grid on page 3435, so the
// 6-card grid (4 + 2, leaving a visible gap) becomes a clean 8-card grid.
// Source: real photos + real material names already used on the existing
// "業務内容" page (ID 17, 試作・単品加工事例 / 量産品加工事例 sections),
// for materials not yet represented on the top-page case grid: A6063, S55C.
// No fabricated tolerance/dimension/delivery claims — only material facts
// and what is visually verifiable in the photo (part geometry).

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old_tail = '        <div class="case-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_sus316_1s.jpg" alt="SUS316 マシニング加工事例" loading="lazy" width="600" height="450">
            <div class="case-card__body">
                <span class="case-card__material">SUS316</span>
                <span class="case-card__method">マシニング加工</span>
                <p>耐食性が必要な部品を高精度に加工。</p>
                <p class="case-card__point">加工ポイント：耐食性を要する形状のため、表面や寸法の精度を保ちながら効率よく仕上げられるマシニングを選択。</p>
            </div>
        </div>
    </div>';

if ( false === strpos( $content, $old_tail ) ) {
    WP_CLI::error( 'Anchor block (SUS316 case card + closing case-grid div) not found — aborting, no changes made.' );
}

$new_tail = '        <div class="case-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_sus316_1s.jpg" alt="SUS316 マシニング加工事例" loading="lazy" width="600" height="450">
            <div class="case-card__body">
                <span class="case-card__material">SUS316</span>
                <span class="case-card__method">マシニング加工</span>
                <p>耐食性が必要な部品を高精度に加工。</p>
                <p class="case-card__point">加工ポイント：耐食性を要する形状のため、表面や寸法の精度を保ちながら効率よく仕上げられるマシニングを選択。</p>
            </div>
        </div>
        <div class="case-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_a6063_1s.jpg" alt="A6063 マシニング加工事例" loading="lazy" width="600" height="450">
            <div class="case-card__body">
                <span class="case-card__material">A6063</span>
                <span class="case-card__method">マシニング加工</span>
                <p>段付きボス形状と角形ベースを一体加工。</p>
                <p class="case-card__point">加工ポイント：押出用アルミ合金A6063の丸ボス部と角形ベース部を1つの部品として、段取り替えを抑えながらマシニングで一体加工。</p>
            </div>
        </div>
        <div class="case-card">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/ryosan_s55c_1s.jpg" alt="S55C マシニング加工事例" loading="lazy" width="600" height="450">
            <div class="case-card__body">
                <span class="case-card__material">S55C</span>
                <span class="case-card__method">マシニング加工</span>
                <p>角度のついたブラケット形状を精度良く加工。</p>
                <p class="case-card__point">加工ポイント：構造用炭素鋼S55Cの角度付き腕部と本体部を一体でマシニングし、穴位置の精度を確保。</p>
            </div>
        </div>
    </div>';

$content = str_replace( $old_tail, $new_tail, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-two-cases-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-two-cases-NEW.html for review.' );
