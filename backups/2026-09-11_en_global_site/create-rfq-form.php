<?php
// Create the new English RFQ form (Snow Monkey Forms CPT), modeled on the
// working JP quote form (3473) which already has file-upload + CAD mime
// support wired up in functions.php. Mail routing mirrors the JP form
// (same admin recipients), with all customer-facing text in English.

$form_content = file_get_contents( '/tmp/rfq-form-content.html' );
if ( empty( $form_content ) ) {
    WP_CLI::error( 'Form content file empty — aborting.' );
}

$blocks = parse_blocks( $form_content );
if ( empty( $blocks ) ) {
    WP_CLI::error( 'parse_blocks() returned empty for form content — aborting.' );
}

$post_id = wp_insert_post(
    array(
        'post_type'    => 'snow-monkey-forms',
        'post_title'   => 'RFQ Form (English)',
        'post_status'  => 'publish',
        'post_content' => $form_content,
    ),
    true
);

if ( is_wp_error( $post_id ) ) {
    WP_CLI::error( 'Form creation failed: ' . $post_id->get_error_message() );
}

$meta = array(
    'administrator_email_to'      => 'jpf-30568@leto.eonet.ne.jp,kato-go@jp-factory.co.jp',
    'administrator_email_subject' => '[JPF RFQ] {company} | {submitted_at}',
    'administrator_email_body'    => "A new RFQ has been submitted via the JPF Global English site.\n\n"
        . "[Company] {company}\n"
        . "[Name] {fullname}\n"
        . "[Email] {email}\n"
        . "[Phone] {tel}\n"
        . "[Country] {country}\n"
        . "[State / Region] {state_region}\n"
        . "[Material] {material}\n"
        . "[Quantity] {quantity}\n"
        . "[Required Delivery Date] {delivery}\n"
        . "[Drawing File] {drawing_file}\n"
        . "[Additional Requirements] {message}\n",
    'administrator_email_replyto'  => '{email}',
    'use_confirm_page'             => 1,
    'use_progress_tracker'         => 1,
    'auto_reply_email_to'          => '{email}',
    'auto_reply_email_from'        => 'wordpress@jp-factory.co.jp',
    'auto_reply_email_sender'      => 'J.P.F Co., Ltd.',
    'auto_reply_email_subject'     => '[JPF] RFQ Received – Thank You for Your Inquiry',
    'auto_reply_email_body'        => "{company}\nDear {fullname},\n\n"
        . "Thank you for your RFQ.\n"
        . "Our engineering team will review your drawing and contact you regarding your quotation.\n\n"
        . "This is an automated confirmation email.\n\n"
        . "J.P.F Co., Ltd.\nhttps://jp-factory.co.jp/en/",
);

foreach ( $meta as $key => $value ) {
    update_post_meta( $post_id, $key, $value );
}

WP_CLI::success( 'RFQ form created, post ID: ' . $post_id );
