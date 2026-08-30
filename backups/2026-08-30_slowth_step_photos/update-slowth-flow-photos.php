<?php
// Replace all 8 STEP photos in the SlowTH JP sales page's "実際の動作フロー"
// section with the 2026-08-30 photoshoot images (STEP1/5/8 had real photos
// before; STEP2/3/4/6/7 were PHOTO REQUIRED placeholders). Only the .slowth-flow-step__photo
// <img>/placeholder blocks are touched; STEP names, description text, and
// everything else on the page is left exactly as-is.

$post_id = 3337;
$content = get_post_field( 'post_content', $post_id );

$steps = array(
    1 => array(
        'old' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/04/IMG_0879.jpg" alt="ROBODRILL前に設置されたスロース実機" loading="lazy" width="700" height="525">
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step01-material-recognition.jpg" alt="SlowTH 材料認識" loading="lazy" width="700" height="525">
            </div>',
    ),
    2 => array(
        'old' => '<div class="slowth-flow-step__photo photo-required" data-photo-note="材料把持の瞬間の写真が必要です">
                <span class="photo-required__label">PHOTO REQUIRED</span>
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step02-material-pick.jpg" alt="SlowTH 材料把持" loading="lazy" width="700" height="525">
            </div>',
    ),
    3 => array(
        'old' => '<div class="slowth-flow-step__photo photo-required" data-photo-note="マシニング扉の開閉動作の写真が必要です">
                <span class="photo-required__label">PHOTO REQUIRED</span>
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step03-door-open-close.jpg" alt="SlowTH マシニング扉開閉" loading="lazy" width="700" height="525">
            </div>',
    ),
    4 => array(
        'old' => '<div class="slowth-flow-step__photo photo-required" data-photo-note="治具・チャックへのワークセットの写真が必要です">
                <span class="photo-required__label">PHOTO REQUIRED</span>
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step04-work-set.jpg" alt="SlowTH ワークセット" loading="lazy" width="700" height="525">
            </div>',
    ),
    5 => array(
        'old' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/04/S__31137802.jpg" alt="ROBODRILLと連携するスロース" loading="lazy" width="700" height="525">
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step05-machining-start.jpg" alt="SlowTH 加工開始" loading="lazy" width="700" height="525">
            </div>',
    ),
    6 => array(
        'old' => '<div class="slowth-flow-step__photo photo-required" data-photo-note="完成品取り出しの写真が必要です">
                <span class="photo-required__label">PHOTO REQUIRED</span>
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step06-product-pick.jpg" alt="SlowTH 完成品取り出し" loading="lazy" width="700" height="525">
            </div>',
    ),
    7 => array(
        'old' => '<div class="slowth-flow-step__photo photo-required" data-photo-note="完成品の整列・置き込みの写真が必要です">
                <span class="photo-required__label">PHOTO REQUIRED</span>
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step07-product-place.jpg" alt="SlowTH 完成品整列・置き込み" loading="lazy" width="700" height="525">
            </div>',
    ),
    8 => array(
        'old' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/04/IMG_0877.jpg" alt="次の材料を取るスロースのアーム" loading="lazy" width="700" height="525">
            </div>',
        'new' => '<div class="slowth-flow-step__photo">
                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/slowth-step08-next-cycle.jpg" alt="SlowTH 次サイクル" loading="lazy" width="700" height="525">
            </div>',
    ),
);

foreach ( $steps as $num => $pair ) {
    if ( false === strpos( $content, $pair['old'] ) ) {
        WP_CLI::error( "STEP $num block not found in expected exact form — aborting, no changes made." );
    }
    $content = str_replace( $pair['old'], $pair['new'], $content );
}

// Sanity checks: no PHOTO REQUIRED left in the flow section, all 8 new files present.
if ( false !== strpos( $content, 'slowth-flow-step__photo photo-required' ) ) {
    WP_CLI::error( 'A photo-required flow-step placeholder still remains — aborting, no changes made.' );
}
foreach ( range( 1, 8 ) as $n ) {
    $padded = str_pad( $n, 2, '0', STR_PAD_LEFT );
    if ( false === strpos( $content, "slowth-step$padded-" ) ) {
        WP_CLI::error( "New STEP $n image URL missing after replacement — aborting, no changes made." );
    }
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3337-flow-photos-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3337-flow-photos-NEW.html for review.' );
