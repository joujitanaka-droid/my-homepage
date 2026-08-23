<?php
// Fix: Neve's footer-menu builder component only renders top-level menu
// items (no nested <ul> for children), so the earlier parent/child grouping
// left every child link (recruitment, contact, JPF Engineering, vendor
// login, SlowTH, quote) completely undiscoverable in the rendered footer.
// This rebuilds the footer menu as a single flat, logically ordered list so
// every link is actually reachable again.

$footer_menu = wp_get_nav_menu_object( 'フッターナビ（新JP）' );
if ( ! $footer_menu ) {
    WP_CLI::error( 'Footer menu not found.' );
}
$footer_menu_id = $footer_menu->term_id;

$items = wp_get_nav_menu_items( $footer_menu_id );
if ( $items ) {
    foreach ( $items as $item ) {
        wp_delete_post( $item->ID, true );
    }
}

function jpf_add_flat_item( $menu_id, $title, $url, $position ) {
    $item_id = wp_update_nav_menu_item(
        $menu_id,
        0,
        array(
            'menu-item-title'    => $title,
            'menu-item-url'      => $url,
            'menu-item-status'   => 'publish',
            'menu-item-type'     => 'custom',
            'menu-item-position' => $position,
        )
    );
    if ( is_wp_error( $item_id ) ) {
        WP_CLI::error( 'Failed to add menu item ' . $title . ': ' . $item_id->get_error_message() );
    }
    return $item_id;
}

$home = home_url( '/' );
$pos  = 1;

jpf_add_flat_item( $footer_menu_id, '図面を送って無料見積', $home . 'quote/', $pos++ );
jpf_add_flat_item( $footer_menu_id, '加工技術', $home . '#strength', $pos++ );
jpf_add_flat_item( $footer_menu_id, '加工事例', $home . '#cases', $pos++ );
jpf_add_flat_item( $footer_menu_id, '設備紹介', $home . '#equipment', $pos++ );
jpf_add_flat_item( $footer_menu_id, '対応材質・サイズ', $home . '#capability', $pos++ );
jpf_add_flat_item( $footer_menu_id, '品質について', $home . '#quality', $pos++ );
jpf_add_flat_item( $footer_menu_id, '会社情報', $home . '#jpf-company', $pos++ );
jpf_add_flat_item( $footer_menu_id, '採用情報', $home . 'recruitment/', $pos++ );
jpf_add_flat_item( $footer_menu_id, '一般お問い合わせ', $home . 'contact/', $pos++ );
jpf_add_flat_item( $footer_menu_id, 'SlowTH', $home . 'slowth/', $pos++ );
jpf_add_flat_item( $footer_menu_id, 'JPFエンジニアリング', 'https://jpe.jp-factory.co.jp/', $pos++ );
jpf_add_flat_item( $footer_menu_id, '業者様ログイン', 'https://jpf.diksoftware.online/view/customer_login', $pos++ );

$lang_item_id = wp_update_nav_menu_item(
    $footer_menu_id,
    0,
    array(
        'menu-item-title'    => 'Language',
        'menu-item-url'      => '#pll_switcher',
        'menu-item-status'   => 'publish',
        'menu-item-type'     => 'custom',
        'menu-item-position' => $pos++,
    )
);
update_post_meta(
    $lang_item_id,
    '_pll_menu_item',
    array(
        'hide_if_no_translation' => 0,
        'hide_current'           => 1,
        'force_home'             => 0,
        'show_flags'             => 0,
        'show_names'             => 1,
        'dropdown'               => 0,
    )
);

WP_CLI::success( 'Footer menu flattened: ' . count( wp_get_nav_menu_items( $footer_menu_id ) ) . ' items now top-level.' );
