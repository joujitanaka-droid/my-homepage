<?php
// Creates the SlowTH-specific header nav menu used by jpf_swap_slowth_primary_menu()
// in functions.php. This menu is only swapped in on the JP /slowth/ page; it is
// never assigned to a real theme location, so it has no effect anywhere else.

function jpf_slowth_get_or_create_menu( $name ) {
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

function jpf_slowth_clear_menu_items( $menu_id ) {
    $items = wp_get_nav_menu_items( $menu_id );
    if ( $items ) {
        foreach ( $items as $item ) {
            wp_delete_post( $item->ID, true );
        }
    }
}

function jpf_slowth_add_link_item( $menu_id, $title, $url, $position ) {
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

$base = home_url( '/slowth/' );
$menu_id = jpf_slowth_get_or_create_menu( 'SlowTHヘッダーナビ' );
jpf_slowth_clear_menu_items( $menu_id );

$pos = 1;
jpf_slowth_add_link_item( $menu_id, '特徴', $base . '#features', $pos++ );
jpf_slowth_add_link_item( $menu_id, '導入効果', $base . '#before-after', $pos++ );
jpf_slowth_add_link_item( $menu_id, '動作フロー', $base . '#flow', $pos++ );
jpf_slowth_add_link_item( $menu_id, '導入事例', $base . '#why-jpf', $pos++ );
jpf_slowth_add_link_item( $menu_id, '対応機種・作業', $base . '#compatible', $pos++ );
jpf_slowth_add_link_item( $menu_id, '導入までの流れ', $base . '#onboarding', $pos++ );
jpf_slowth_add_link_item( $menu_id, 'FAQ', $base . '#faq', $pos++ );

WP_CLI::success( 'SlowTH header menu ready: term_id=' . $menu_id );
