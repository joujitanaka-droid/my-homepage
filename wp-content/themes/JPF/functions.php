<?php

add_filter( 'wp_nav_menu_objects', 'jpf_fix_home_menu_links', 10, 2 );

function jpf_fix_home_menu_links( $items, $args ) {
    $home_url = home_url( '/' );
    $legacy_paths = array(
        home_url( '/top/' ),
        home_url( '/?page_id=8' ),
    );

    foreach ( $items as $item ) {
        if ( in_array( $item->url, $legacy_paths, true ) ) {
            $item->url = $home_url;
        }
    }

    return $items;
}

add_action( 'template_redirect', 'jpf_redirect_legacy_top_page' );

function jpf_redirect_legacy_top_page() {
    if ( is_admin() || wp_doing_ajax() ) {
        return;
    }

    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
    $page_id = isset( $_GET['page_id'] ) ? sanitize_text_field( wp_unslash( $_GET['page_id'] ) ) : '';

    if ( '/top/' === untrailingslashit( $request_uri ) . '/' || '8' === $page_id ) {
        wp_safe_redirect( home_url( '/' ), 301 );
        exit;
    }
}