<?php
// Remove the entire "さらに動画を見る" <details> block (additional videos +
// toggle) from the SlowTH JP sales page (#video section). The initially
// visible 6-video grid above it is left completely untouched, including
// order and URLs. No YouTube video IDs are deleted anywhere else (theme
// functions.php keeps the historical append-function body/data intact —
// only its add_filter hook was disabled separately).

$post_id = 3337;
$content = get_post_field( 'post_content', $post_id );

$old_block = '    <details class="slowth-video-more">
        <summary>さらに動画を見る</summary>
        <div class="slowth-video-grid">
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/Kck9lArXq3Q" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/P1X9X8E7KDE" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/q3STBqCVUxo" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/bAxqxciuxDg" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/HHPMZBQW7zQ" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/VqPr4ZMFhcs" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/ZRmHYVl0xQU" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/tr5EP9SzHzc" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/IcIDjk-MbUY" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/wZYY9ClGzKc" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/DPyeEMgBjm8" title="スロース動作動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/v63yNdh49Mc" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/zioNn9NBGRw" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/ODDtEVehepc" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/F88AGpGvlaA" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/HLrjQKxSLCc" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/AIvJ21tAozk" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/sNJ4ahaqU5M" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/9aWWcD6gM1M" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div class="video-wrapper"><iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/A-43awT59-I" title="スロース番外編テスト動画" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
        </div>
    </details>
</section>';

if ( false === strpos( $content, $old_block ) ) {
    WP_CLI::error( 'details.slowth-video-more block not found in expected exact form — aborting, no changes made.' );
}

$new_block = '</section>';
$content   = str_replace( $old_block, $new_block, $content );

// Sanity: the main (first, still-visible) video grid's 6 videos must remain,
// and the additional-video toggle/ids must be fully gone.
foreach ( array( 'G4vjMKLTvcg', 'ZJVlNO1-IMU', 'XlVHmkZ59cw', 'awXTHMx8cRk', 'ZuXrp5W4S9I', '1xXf5XV03G0' ) as $keep_id ) {
    if ( false === strpos( $content, $keep_id ) ) {
        WP_CLI::error( "Expected surviving main video $keep_id missing — aborting, no changes made." );
    }
}
if ( false !== strpos( $content, 'slowth-video-more' ) ) {
    WP_CLI::error( 'slowth-video-more still present after replacement — aborting, no changes made.' );
}
if ( 1 !== substr_count( $content, 'slowth-video-grid' ) ) {
    WP_CLI::error( 'Expected exactly 1 remaining slowth-video-grid — aborting, no changes made.' );
}

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3337-video-cleanup-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3337-video-cleanup-NEW.html for review.' );
