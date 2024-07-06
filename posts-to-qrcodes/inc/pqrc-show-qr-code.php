<?php

function pqrc_display_qrcode( $content ) {

    // Get current post id
    $current_post_id = get_the_ID();
    // Get post title
    $current_post_title = get_the_title( $current_post_id );
    // Get current post url
    $current_post_url = urlencode( get_permalink( $current_post_id ) );
    // Get current post type
    $current_post_type = get_post_type( $current_post_id );

    //Exclude post types
    $excluded_posts_type = apply_filters( 'pqrc_excluded_post_types', array() );
    if ( in_array( $current_post_type, $excluded_posts_type ) ) {
        return $content;
    }

    // Image Dimension
    $height = get_option( 'pqrc_qrcode_height' );
    $width  = get_option( 'pqrc_qrcode_width' );

    $height     = $height ?? 150;
    $width      = $width ?? 150;
    $dimensions = apply_filters( 'pqrc_qrcode_dimension', "$width" . "x" . "$height" );

    // Add Image Attribute
    $attributes = apply_filters( 'pqrc_image_attributes', '' );

    // Generate QR Code
    $image_src = sprintf( "https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=%s&amp;qzone=1&amp;margin=0&amp;size=%s&amp;ecc=L", $current_post_url, $dimensions );

    $content .= sprintf( '<div class="qrcode"><img %s src="%s" alt="%s" /></div>', $attributes, $image_src, $current_post_title );
    return $content;
}
add_filter( 'the_content', 'pqrc_display_qrcode' );