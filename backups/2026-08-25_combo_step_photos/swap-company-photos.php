<?php
// Replace the 3 company-intro photos on page 3435 (#jpf-company section):
// top large photo: factory_top.jpg -> company_exterior.jpg (IMG_2027, JPF building exterior with sign)
// bottom-left: factory_photo2_s.jpg -> company_floor1.jpg (IMG_2138, factory floor/wire machine)
// bottom-right: factory_photo3_s.jpg -> company_floor2.jpg (現場風景①, factory floor with robot arm)

$post_id = 3435;
$content = get_post_field( 'post_content', $post_id );

$old_block = '        <div class="company-intro__photos">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_top.jpg" alt="JPF 工場外観" loading="lazy" width="700" height="525">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_photo2_s.jpg" alt="JPFのスタッフ" loading="lazy" width="340" height="255">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_photo3_s.jpg" alt="JPF 工場入口" loading="lazy" width="340" height="255">
        </div>';

if ( false === strpos( $content, $old_block ) ) {
    WP_CLI::error( 'company-intro__photos block not found in expected form — aborting, no changes made.' );
}

$new_block = '        <div class="company-intro__photos">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/company_exterior.jpg" alt="JPF 工場外観" loading="lazy" width="700" height="525">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/company_floor1.jpg" alt="JPF 工場内のようす" loading="lazy" width="340" height="255">
            <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/company_floor2.jpg" alt="JPF 工場内のようす" loading="lazy" width="340" height="255">
        </div>';

$content = str_replace( $old_block, $new_block, $content );

$blocks = parse_blocks( $content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty — aborting, no changes made.' );
}

file_put_contents( '/tmp/page-3435-company-photos-NEW.html', $content );

WP_CLI::success( 'Content transformed and validated in memory. Not yet saved to DB. New content written to /tmp/page-3435-company-photos-NEW.html for review.' );
