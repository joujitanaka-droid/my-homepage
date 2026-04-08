<?php

add_filter( 'wp_nav_menu_objects', 'jpf_fix_home_menu_links', 10, 2 );

function jpf_fix_home_menu_links( $items, $args ) {
    $legacy_url_map = array(
        home_url( '/top/' )     => home_url( '/' ),
        home_url( '/?page_id=8' ) => home_url( '/' ),
        home_url( '/en/top-2/' ) => home_url( '/en/' ),
    );

    foreach ( $items as $item ) {
        if ( isset( $legacy_url_map[ $item->url ] ) ) {
            $item->url = $legacy_url_map[ $item->url ];
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

    if (
        '/top/' === untrailingslashit( $request_uri ) . '/' ||
        '/en/top-2/' === untrailingslashit( $request_uri ) . '/' ||
        '8' === $page_id
    ) {
        $redirect_to = '/en/top-2/' === untrailingslashit( $request_uri ) . '/' ? home_url( '/en/' ) : home_url( '/' );
        wp_safe_redirect( $redirect_to, 301 );
        exit;
    }
}