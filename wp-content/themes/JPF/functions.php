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

function jpf_is_english_home_request() {
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

    return '/en/' === untrailingslashit( $request_uri ) . '/';
}

function jpf_get_normalized_path( $url ) {
    $path = wp_parse_url( $url, PHP_URL_PATH );

    if ( ! is_string( $path ) ) {
        return '';
    }

    return untrailingslashit( urldecode( $path ) ) . '/';
}

function jpf_get_english_menu_order_rank( $item ) {
    $normalized_path = jpf_get_normalized_path( $item->url );

    $order_map = array(
        '/en/'                      => 10,
        '/en/会社概要-en/'            => 20,
        '/en/profile-en/'           => 20,
        '/en/業務内容-en/'            => 30,
        '/en/content-en/'           => 30,
        '/en/slowth/'               => 40,
        '/en/factory-introduction/' => 50,
        '/en/recruitment-2/'        => 60,
        '/en/お問い合わせ-en/'        => 70,
        '/en/contact-en/'           => 70,
    );

    if ( isset( $order_map[ $normalized_path ] ) ) {
        return $order_map[ $normalized_path ];
    }

    if ( 'https://jpe.jp-factory.co.jp/' === $item->url ) {
        return 80;
    }

    if ( 'https://jpf.diksoftware.online/view/customer_login' === $item->url ) {
        return 90;
    }

    return 1000;
}

function jpf_fix_home_menu_links( $items, $args ) {
    $legacy_url_map = array(
        home_url( '/top/' )     => home_url( '/' ),
        home_url( '/?page_id=8' ) => home_url( '/' ),
        home_url( '/tophurui/' ) => home_url( '/' ),
        home_url( '/en/top-2/' ) => home_url( '/en/' ),
    );

    $english_title_map = array(
        '/en/'                              => 'HOME',
        '/en/会社概要-en/'                    => 'Profile',
        '/en/業務内容-en/'                    => 'Content',
        '/en/slowth/'                       => 'AI Robot',
        '/en/factory-introduction/'         => 'Factory',
        '/en/recruitment-2/'                => 'Recruitment',
        '/en/お問い合わせ-en/'                => 'Contact',
        '/en/contact-en/'                   => 'Contact',
        '/slowth/'                          => 'AI Robot',
        '/contact/'                         => 'Contact',
        '/recruitment/'                     => 'Recruitment',
        '/introduction-2/'                  => 'Factory',
        '/content/'                         => 'Content',
        '/profile/'                         => 'Profile',
        '/en/'                              => 'HOME',
        '/en/slowth/'                       => 'AI Robot',
    );

    $english_external_title_map = array(
        'https://jpe.jp-factory.co.jp/'                      => 'JPF Engineering',
        'https://jpf.diksoftware.online/view/customer_login' => 'Customer Login',
    );

    foreach ( $items as $item ) {
        if ( isset( $legacy_url_map[ $item->url ] ) ) {
            $item->url = $legacy_url_map[ $item->url ];
        }

        if ( jpf_is_english_request() && home_url( '/slowth/' ) === $item->url ) {
            $item->url   = home_url( '/en/slowth/' );
            $item->title = 'AI Robot';
        }

        if ( jpf_is_english_request() ) {
            $normalized_path = jpf_get_normalized_path( $item->url );

            if ( isset( $english_title_map[ $normalized_path ] ) ) {
                $item->title = $english_title_map[ $normalized_path ];
            }

            if ( isset( $english_external_title_map[ $item->url ] ) ) {
                $item->title = $english_external_title_map[ $item->url ];
            }
        }
    }

    if ( jpf_is_english_request() ) {
        usort(
            $items,
            function ( $a, $b ) {
                $rank_a = jpf_get_english_menu_order_rank( $a );
                $rank_b = jpf_get_english_menu_order_rank( $b );

                if ( $rank_a === $rank_b ) {
                    return (int) $a->menu_order <=> (int) $b->menu_order;
                }

                return $rank_a <=> $rank_b;
            }
        );
    }

    return $items;
}

function jpf_use_english_slowth_template( $template ) {
    global $wp_query;

    if ( jpf_is_english_slowth_request() ) {
        if ( isset( $wp_query ) ) {
            $wp_query->is_404      = false;
            $wp_query->is_page     = true;
            $wp_query->is_singular = true;
            $wp_query->is_home     = false;
            $wp_query->is_archive  = false;
        }

        status_header( 200 );

        return get_stylesheet_directory() . '/template-slowth-en.php';
    }

    if ( jpf_is_english_home_request() ) {
        if ( isset( $wp_query ) ) {
            $wp_query->is_404      = false;
            $wp_query->is_page     = true;
            $wp_query->is_singular = true;
            $wp_query->is_home     = false;
            $wp_query->is_archive  = false;
            $wp_query->is_posts_page = false;
        }

        status_header( 200 );

        return get_stylesheet_directory() . '/template-top-en.php';
    }

    return $template;
}

function jpf_add_english_slowth_body_class( $classes ) {
    if ( jpf_is_english_slowth_request() ) {
        $classes[] = 'wp-singular';
        $classes[] = 'page-template-default';
        $classes[] = 'page';
        $classes[] = 'page-id-3337';
        $classes[] = 'jpf-slowth-en';
    }

    if ( jpf_is_english_home_request() ) {
        $classes[] = 'home';
        $classes[] = 'wp-singular';
        $classes[] = 'page-template-default';
        $classes[] = 'page';
        $classes[] = 'page-id-3435';
        $classes[] = 'jpf-top-en';

        $remove_classes = array( 'blog', 'archive', 'home-blog' );
        $classes        = array_values( array_diff( $classes, $remove_classes ) );
    }

    return array_unique( $classes );
}

function jpf_english_slowth_document_title( $title ) {
    if ( jpf_is_english_slowth_request() ) {
        return 'SlowTH - JPF';
    }

    if ( jpf_is_english_home_request() ) {
        return 'TOP - JPF';
    }

    return $title;
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