<?php
// Emergency fix: the vendor portal's extension-less URL rewrite
// (https://.../view/customer_login) is currently broken server-side (404),
// while the direct .php file (https://.../view/customer_login.php) works
// correctly. Point all 3 known "業者様ログイン" menu items at the working
// .php URL. Display title "業者様ログイン" is left unchanged.
// No changes are made on the diksoftware.online portal side.

$old_url = 'https://jpf.diksoftware.online/view/customer_login';
$new_url = 'https://jpf.diksoftware.online/view/customer_login.php';

$item_ids = array( 1833, 3510, 3527 );
$results  = array();

foreach ( $item_ids as $id ) {
    $current = get_post_meta( $id, '_menu_item_url', true );
    if ( $current !== $old_url ) {
        WP_CLI::error( "Menu item $id current URL unexpected ('$current') — aborting, no changes made." );
    }

    $updated = update_post_meta( $id, '_menu_item_url', $new_url );
    $verify  = get_post_meta( $id, '_menu_item_url', true );

    if ( $verify !== $new_url ) {
        WP_CLI::error( "Verification failed for menu item $id after update." );
    }

    $results[] = "Item $id: $current -> $verify";
}

// Also confirm the display title on all 3 items is still unchanged.
foreach ( $item_ids as $id ) {
    $title = get_the_title( $id );
    if ( '業者様ログイン' !== $title ) {
        WP_CLI::error( "Menu item $id title changed unexpectedly to '$title' — investigate." );
    }
}

foreach ( $results as $line ) {
    WP_CLI::log( $line );
}

WP_CLI::success( 'All 3 vendor-login menu items updated to the .php URL and verified. Titles unchanged.' );
