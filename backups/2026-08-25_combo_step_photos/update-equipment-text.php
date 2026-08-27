<?php
// Two text-only corrections in the #equipment section of page 3435:
// 1. マシニングセンタ card: update description text (photo/heading unchanged).
// 2. NC旋盤 card: the equipment name was wrong -> rename heading to
//    「回転円テーブル」, update its description, and update the img alt text
//    to match (the photo itself is kept as-is, only the alt wording that
//    names it follows the corrected equipment name).
// FANUC ROBODRILL / ワイヤー放電加工機 / 自動化システム / 測定機器各種 cards
// are untouched.

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

// 1) マシニングセンタ description
$old1 = '<p>多面加工・精密加工に対応。</p>';
$new1 = '<p>複雑形状や高精度を求められる部品の切削加工に対応。</p>';
if ( false === strpos( $content, $old1 ) ) {
    WP_CLI::error( 'マシニングセンタ description not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old1, $new1, $content );

// 2) NC旋盤 -> 回転円テーブル (img alt + heading + description), single block
$old2 = '<img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_ncen.jpg" alt="NC旋盤" loading="lazy" width="600" height="450">
            <h3>NC旋盤</h3>
            <p>軸物部品の高精度加工に対応。</p>';
$new2 = '<img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_ncen.jpg" alt="回転円テーブル" loading="lazy" width="600" height="450">
            <h3>回転円テーブル</h3>
            <p>多面加工、割り出し加工も高精度に実現。</p>';
if ( false === strpos( $content, $old2 ) ) {
    WP_CLI::error( 'NC旋盤 card block not found in expected exact form — aborting, no changes made.' );
}
$content = str_replace( $old2, $new2, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-equipment-text-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-equipment-text-NEW.html for review.' );
