<?php
// Emergency fix: restore "業者様ログイン" to the header nav (menu 36,
// ヘッダーナビ（新JP）), positioned after the 6 sales items and before the
// language switcher, so it reads as a small, clearly-secondary sub-link
// rather than a 7th sales menu item. The footer link (already present,
// unchanged) and the verified-correct URL are reused as-is.

$menu = wp_get_nav_menu_object( 'ヘッダーナビ（新JP）' );
if ( ! $menu ) {
    WP_CLI::error( 'Header menu not found.' );
}

// Push the Language item from position 7 to 8 to make room.
$lang_item_id = 3482;
wp_update_nav_menu_item(
    $menu->term_id,
    $lang_item_id,
    array(
        'menu-item-title'    => 'Language',
        'menu-item-url'      => '#pll_switcher',
        'menu-item-status'   => 'publish',
        'menu-item-type'     => 'custom',
        'menu-item-position' => 8,
    )
);

$vendor_login_id = wp_update_nav_menu_item(
    $menu->term_id,
    0,
    array(
        'menu-item-title'     => '業者様ログイン',
        'menu-item-url'       => 'https://jpf.diksoftware.online/view/customer_login',
        'menu-item-status'    => 'publish',
        'menu-item-type'      => 'custom',
        'menu-item-position'  => 7,
        'menu-item-classes'   => 'jpf-header-sublink',
    )
);

if ( is_wp_error( $vendor_login_id ) ) {
    WP_CLI::error( 'Failed to add vendor login item: ' . $vendor_login_id->get_error_message() );
}

WP_CLI::success( 'Vendor login restored to header menu, item ID: ' . $vendor_login_id );
