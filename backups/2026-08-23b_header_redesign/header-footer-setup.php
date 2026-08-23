<?php
// One-off setup script: creates the new JP header/footer nav menus, wires the
// Polylang per-language menu mapping to them, and configures the Neve header
// builder (hfg_header_layout_v2 + button_base component) for the new
// "Machining x Wire EDM" sales header. Run once via `wp eval-file`.

function jpf_get_or_create_menu( $name ) {
    $existing = wp_get_nav_menu_object( $name );
    if ( $existing ) {
        return $existing->term_id;
    }
    $id = wp_create_nav_menu( $name );
    if ( is_wp_error( $id ) ) {
        WP_CLI::error( 'Failed to create menu ' . $name . ': ' . $id->get_error_message() );
    }
    return $id;
}

function jpf_clear_menu_items( $menu_id ) {
    $items = wp_get_nav_menu_items( $menu_id );
    if ( $items ) {
        foreach ( $items as $item ) {
            wp_delete_post( $item->ID, true );
        }
    }
}

function jpf_add_link_item( $menu_id, $title, $url, $parent = 0, $position = 0 ) {
    $item_id = wp_update_nav_menu_item(
        $menu_id,
        0,
        array(
            'menu-item-title'     => $title,
            'menu-item-url'       => $url,
            'menu-item-status'    => 'publish',
            'menu-item-type'      => 'custom',
            'menu-item-parent-id' => $parent,
            'menu-item-position'  => $position,
        )
    );
    if ( is_wp_error( $item_id ) ) {
        WP_CLI::error( 'Failed to add menu item ' . $title . ': ' . $item_id->get_error_message() );
    }
    return $item_id;
}

function jpf_add_language_switcher_item( $menu_id, $position ) {
    $item_id = jpf_add_link_item( $menu_id, __( 'Language', 'jpf' ), '#pll_switcher', 0, $position );
    update_post_meta(
        $item_id,
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
    return $item_id;
}

$home = home_url( '/' );

// ---------------------------------------------------------------------
// 1) Header menu (JP): 6 sales-nav anchors + language switcher.
// ---------------------------------------------------------------------
$header_menu_id = jpf_get_or_create_menu( 'ヘッダーナビ（新JP）' );
jpf_clear_menu_items( $header_menu_id );

$pos = 1;
jpf_add_link_item( $header_menu_id, '加工技術', $home . '#strength', 0, $pos++ );
jpf_add_link_item( $header_menu_id, '加工事例', $home . '#cases', 0, $pos++ );
jpf_add_link_item( $header_menu_id, '設備紹介', $home . '#equipment', 0, $pos++ );
jpf_add_link_item( $header_menu_id, '対応材質・サイズ', $home . '#capability', 0, $pos++ );
jpf_add_link_item( $header_menu_id, '品質について', $home . '#quality', 0, $pos++ );
jpf_add_link_item( $header_menu_id, '会社情報', $home . '#jpf-company', 0, $pos++ );
jpf_add_language_switcher_item( $header_menu_id, $pos++ );

WP_CLI::log( 'Header menu ready: term_id=' . $header_menu_id );

// ---------------------------------------------------------------------
// 2) Footer menu (JP): grouped links (加工について / 会社について / 関連 / Language).
// ---------------------------------------------------------------------
$footer_menu_id = jpf_get_or_create_menu( 'フッターナビ（新JP）' );
jpf_clear_menu_items( $footer_menu_id );

$pos = 1;

$group1 = jpf_add_link_item( $footer_menu_id, '加工について', '#', 0, $pos++ );
$cpos = 1;
jpf_add_link_item( $footer_menu_id, '加工技術', $home . '#strength', $group1, $cpos++ );
jpf_add_link_item( $footer_menu_id, '加工事例', $home . '#cases', $group1, $cpos++ );
jpf_add_link_item( $footer_menu_id, '設備紹介', $home . '#equipment', $group1, $cpos++ );
jpf_add_link_item( $footer_menu_id, '対応材質・サイズ', $home . '#capability', $group1, $cpos++ );
jpf_add_link_item( $footer_menu_id, '品質について', $home . '#quality', $group1, $cpos++ );
jpf_add_link_item( $footer_menu_id, '図面見積', $home . 'quote/', $group1, $cpos++ );

$group2 = jpf_add_link_item( $footer_menu_id, '会社について', '#', 0, $pos++ );
$cpos = 1;
jpf_add_link_item( $footer_menu_id, '会社情報', $home . '#jpf-company', $group2, $cpos++ );
jpf_add_link_item( $footer_menu_id, '採用情報', $home . 'recruitment/', $group2, $cpos++ );
jpf_add_link_item( $footer_menu_id, '一般お問い合わせ', $home . 'contact/', $group2, $cpos++ );

$group3 = jpf_add_link_item( $footer_menu_id, '関連', '#', 0, $pos++ );
$cpos = 1;
jpf_add_link_item( $footer_menu_id, 'SlowTH', $home . 'slowth/', $group3, $cpos++ );
jpf_add_link_item( $footer_menu_id, 'JPFエンジニアリング', 'https://jpe.jp-factory.co.jp/', $group3, $cpos++ );
jpf_add_link_item( $footer_menu_id, '業者様ログイン', 'https://jpf.diksoftware.online/view/customer_login', $group3, $cpos++ );

jpf_add_language_switcher_item( $footer_menu_id, $pos++ );

WP_CLI::log( 'Footer menu ready: term_id=' . $footer_menu_id );

// ---------------------------------------------------------------------
// 3) Point Polylang's per-language menu mapping at the new menus for JA.
//    EN and top-bar mappings are left untouched.
// ---------------------------------------------------------------------
$polylang = get_option( 'polylang' );
$polylang['nav_menus']['JPF']['primary']['ja'] = $header_menu_id;
$polylang['nav_menus']['JPF']['footer']['ja']  = $footer_menu_id;
update_option( 'polylang', $polylang );

WP_CLI::log( 'Polylang JA primary/footer menu mapping updated.' );

// ---------------------------------------------------------------------
// 4) Neve header builder: logo left / primary-menu center / CTA button right
//    (desktop), logo left / hamburger right (mobile main row), with the CTA
//    button also placed in the mobile off-canvas menu.
// ---------------------------------------------------------------------
$theme_mods = get_option( 'theme_mods_JPF' );

// Neve's builder reads this theme_mod through json_decode(), so it MUST be
// stored as a JSON string, not a native PHP array (storing an array here
// would break json_decode() and take the header down site-wide).
$header_layout_v2 = array(
    'desktop' => array(
        'top'    => array( 'left' => array(), 'c-left' => array(), 'center' => array(), 'c-right' => array(), 'right' => array() ),
        'main'   => array(
            'left'    => array( array( 'id' => 'logo' ) ),
            'c-left'  => array(),
            'center'  => array( array( 'id' => 'primary-menu' ) ),
            'c-right' => array(),
            'right'   => array( array( 'id' => 'button_base' ) ),
        ),
        'bottom' => array( 'left' => array(), 'c-left' => array(), 'center' => array(), 'c-right' => array(), 'right' => array() ),
    ),
    'mobile'  => array(
        'top'    => array( 'left' => array(), 'c-left' => array(), 'center' => array(), 'c-right' => array(), 'right' => array() ),
        'main'   => array(
            'left'    => array( array( 'id' => 'logo' ) ),
            'c-left'  => array(),
            'center'  => array(),
            'c-right' => array(),
            'right'   => array( array( 'id' => 'nav-icon' ) ),
        ),
        'bottom'  => array( 'left' => array(), 'c-left' => array(), 'center' => array(), 'c-right' => array(), 'right' => array() ),
        'sidebar' => array( array( 'id' => 'primary-menu' ), array( 'id' => 'button_base' ) ),
    ),
);

$theme_mods['hfg_header_layout_v2'] = wp_json_encode( $header_layout_v2 );

$theme_mods['button_base_link_setting'] = 'https://jp-factory.co.jp/quote/';
$theme_mods['button_base_text_setting'] = '図面を送って無料見積';
$theme_mods['button_base_new_tab']      = 0;

update_option( 'theme_mods_JPF', $theme_mods );

WP_CLI::log( 'Neve header layout + CTA button configured.' );
WP_CLI::success( 'Header/footer setup complete.' );
