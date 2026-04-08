<?php

add_action( 'wp_enqueue_scripts', 'jpf_enqueue_styles' );
function jpf_enqueue_styles() {
    wp_enqueue_style(
        'jpf-child-style',
        get_stylesheet_uri(),
        array( 'neve-style' ),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}

add_filter( 'wp_nav_menu_objects', 'jpf_fix_home_menu_links', 10, 2 );
add_filter( 'template_include', 'jpf_use_english_slowth_template', 99 );
add_filter( 'body_class', 'jpf_add_english_slowth_body_class' );
add_filter( 'pre_get_document_title', 'jpf_english_slowth_document_title' );
add_filter( 'redirect_canonical', 'jpf_disable_english_slowth_canonical_redirect', 10, 2 );
add_filter( 'pll_check_canonical_url', 'jpf_disable_english_slowth_polylang_canonical' );

function jpf_is_english_request() {
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

    return 0 === strpos( untrailingslashit( $request_uri ) . '/', '/en/' );
}

function jpf_is_english_slowth_request() {
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

    return '/en/slowth/' === untrailingslashit( $request_uri ) . '/';
}

function jpf_fix_home_menu_links( $items, $args ) {
    $legacy_url_map = array(
        home_url( '/top/' )     => home_url( '/' ),
        home_url( '/?page_id=8' ) => home_url( '/' ),
        home_url( '/tophurui/' ) => home_url( '/' ),
        home_url( '/en/top-2/' ) => home_url( '/en/' ),
    );

    foreach ( $items as $item ) {
        if ( isset( $legacy_url_map[ $item->url ] ) ) {
            $item->url = $legacy_url_map[ $item->url ];
        }

        if ( jpf_is_english_request() && home_url( '/slowth/' ) === $item->url ) {
            $item->url   = home_url( '/en/slowth/' );
            $item->title = 'AI_ロボット';
        }
    }

    return $items;
}

function jpf_use_english_slowth_template( $template ) {
    if ( ! jpf_is_english_slowth_request() ) {
        return $template;
    }

    global $wp_query;

    if ( isset( $wp_query ) ) {
        $wp_query->is_404     = false;
        $wp_query->is_page    = true;
        $wp_query->is_singular = true;
        $wp_query->is_home    = false;
        $wp_query->is_archive = false;
    }

    status_header( 200 );

    return get_stylesheet_directory() . '/template-slowth-en.php';
}

function jpf_add_english_slowth_body_class( $classes ) {
    if ( ! jpf_is_english_slowth_request() ) {
        return $classes;
    }

    $classes[] = 'wp-singular';
    $classes[] = 'page-template-default';
    $classes[] = 'page';
    $classes[] = 'page-id-3337';
    $classes[] = 'jpf-slowth-en';

    return array_unique( $classes );
}

function jpf_english_slowth_document_title( $title ) {
    if ( ! jpf_is_english_slowth_request() ) {
        return $title;
    }

    return 'SlowTH - JPF';
}

function jpf_disable_english_slowth_canonical_redirect( $redirect_url, $requested_url ) {
    if ( jpf_is_english_slowth_request() ) {
        return false;
    }

    return $redirect_url;
}

function jpf_disable_english_slowth_polylang_canonical( $check_canonical ) {
    if ( jpf_is_english_slowth_request() ) {
        return false;
    }

    return $check_canonical;
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
        '/tophurui/' === untrailingslashit( $request_uri ) . '/' ||
        '/en/top-2/' === untrailingslashit( $request_uri ) . '/' ||
        '8' === $page_id
    ) {
        $redirect_to = '/en/top-2/' === untrailingslashit( $request_uri ) . '/' ? home_url( '/en/' ) : home_url( '/' );
        wp_safe_redirect( $redirect_to, 301 );
        exit;
    }
}