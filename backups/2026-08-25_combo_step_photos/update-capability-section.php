<?php
// Restructure the #capability section on page 3435 per explicit instructions:
// 1. Title: "対応加工・材質・サイズ" -> "対応加工・材質"
// 2. 対応材質: replace specific material grades/codes with 7 broad categories
// 3. Remove the "サイズ・精度" column entirely
// Also updates the matching quick-nav in-page link text (same section,
// currently says "対応材質・サイズ" which would otherwise no longer match
// the section it points to).
// No other section's text/photos/CSS classes are touched.

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

// 1) Section title
$old_title = '<h2>対応加工・材質・サイズ</h2>';
$new_title = '<h2>対応加工・材質</h2>';
if ( false === strpos( $content, $old_title ) ) {
    WP_CLI::error( 'Section title not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old_title, $new_title, $content );

// 2) Quick-nav in-page link text (same section, keep it consistent with the new title)
$old_nav = '<a href="#capability">対応材質・サイズ</a>';
$new_nav = '<a href="#capability">対応材質</a>';
if ( false === strpos( $content, $old_nav ) ) {
    WP_CLI::error( 'Quick-nav link not found in expected form — aborting, no changes made.' );
}
$content = str_replace( $old_nav, $new_nav, $content );

// 3) Replace the whole capability-cols block (材質 list + remove サイズ・精度 column)
$old_block = '    <div class="capability-cols">
        <div class="capability-col">
            <h3>対応加工</h3>
            <ul class="tag-list">
                <li class="tag">マシニング加工</li>
                <li class="tag">ワイヤー放電加工</li>
                <li class="tag">穴加工・タップ加工</li>
                <li class="tag">精密部品加工</li>
                <li class="tag">治具・機械部品</li>
                <li class="tag">試作（単品）</li>
                <li class="tag">量産加工（小ロット／中ロット）</li>
            </ul>
        </div>
        <div class="capability-col">
            <h3>対応材質</h3>
            <ul class="tag-list">
                <li class="tag">A5052</li>
                <li class="tag">A7075</li>
                <li class="tag">A6063</li>
                <li class="tag">A5056</li>
                <li class="tag">SUS304</li>
                <li class="tag">SUS316</li>
                <li class="tag">S55C</li>
                <li class="tag">SKD11</li>
                <li class="tag">HAP40</li>
                <li class="tag">その他（ご相談ください）</li>
            </ul>
            <p class="capability-note">※上記は加工実績のある材質です。記載のない材質もご相談ください。</p>
        </div>
        <div class="capability-col">
            <h3>サイズ・精度</h3>
            <p>主要設備は、マシニングセンター（GENOS M560-V／VCN430A）、FANUC ROBODRILL（α-T21iEL／α-T21iFL／α-T21iD／D-21LiA5 計5台）、ワイヤー放電加工機 FANUC ROBOCUT（α-0iD／α-C400iA 計3台）です。</p>
            <p>各設備の可動範囲（目安）は、マシニングセンターが最大900×1050mm程度、ROBODRILLが500〜700×400mm程度、ROBOCUTが370×270×255mm程度です（機種により異なり、実際に加工可能なサイズは形状・治具により変わります）。</p>
            <p>寸法公差・仕上げ精度は部品形状や材質、加工方法の組み合わせによって異なるため、図面公差については個別にご相談ください。</p>
            <p class="capability-note">※加工範囲は当社「工場紹介」ページに掲載の設備一覧に基づく参考値です。</p>
        </div>
    </div>';

if ( false === strpos( $content, $old_block ) ) {
    WP_CLI::error( 'capability-cols block not found in expected exact form — aborting, no changes made.' );
}

$new_block = '    <div class="capability-cols">
        <div class="capability-col">
            <h3>対応加工</h3>
            <ul class="tag-list">
                <li class="tag">マシニング加工</li>
                <li class="tag">ワイヤー放電加工</li>
                <li class="tag">穴加工・タップ加工</li>
                <li class="tag">精密部品加工</li>
                <li class="tag">治具・機械部品</li>
                <li class="tag">試作（単品）</li>
                <li class="tag">量産加工（小ロット／中ロット）</li>
            </ul>
        </div>
        <div class="capability-col">
            <h3>対応材質</h3>
            <ul class="tag-list">
                <li class="tag">アルミ</li>
                <li class="tag">ステンレス</li>
                <li class="tag">鉄</li>
                <li class="tag">プレハーデン鋼</li>
                <li class="tag">チタン</li>
                <li class="tag">インコネル</li>
                <li class="tag">その他材質もご相談ください</li>
            </ul>
            <p class="capability-note">※上記は加工実績のある材質です。記載のない材質もご相談ください。</p>
        </div>
    </div>';

$content = str_replace( $old_block, $new_block, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-capability-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-capability-NEW.html for review.' );
