<?php
// Link post 3435 (JP top) and post 2385 (EN top) as Polylang translations of
// each other, so Polylang emits correct hreflang tags for /en/ and /.
// Verified safe: the site's actual language-switcher links (jpf_get_japanese_switch_url_for_english_request
// and the #pll_switcher hookup) are driven entirely by a hardcoded URL map in
// functions.php, not by Polylang's post_translations relationship — so this
// change is purely additive metadata for hreflang/SEO purposes and does not
// alter any existing navigation behavior on either language.

if ( ! function_exists( 'pll_save_post_translations' ) ) {
    WP_CLI::error( 'pll_save_post_translations() not available — Polylang not loaded as expected.' );
}

pll_save_post_translations( array(
    'ja' => 3435,
    'en' => 2385,
) );

// Verify.
$en_translation = function_exists( 'pll_get_post' ) ? pll_get_post( 3435, 'en' ) : null;
$ja_translation = function_exists( 'pll_get_post' ) ? pll_get_post( 2385, 'ja' ) : null;

WP_CLI::log( 'pll_get_post(3435, en) => ' . var_export( $en_translation, true ) );
WP_CLI::log( 'pll_get_post(2385, ja) => ' . var_export( $ja_translation, true ) );

if ( 2385 !== (int) $en_translation || 3435 !== (int) $ja_translation ) {
    WP_CLI::error( 'Translation link verification failed.' );
}

WP_CLI::success( 'Post 3435 (JP) and 2385 (EN) linked as Polylang translations, verified both directions.' );
