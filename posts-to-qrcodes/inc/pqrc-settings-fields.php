<?php

$pqrc_countries = array(
    __( 'Afganistan', 'posts-to-qrcodes' ),
    __( 'Bangladesh', 'posts-to-qrcodes' ),
    __( 'India', 'posts-to-qrcodes' ),
    __( 'Bhutan', 'posts-to-qrcodes' ),
    __( 'Pakistan', 'posts-to-qrcodes' ),
    __( 'Nepal', 'posts-to-qrcodes' ),
    __( 'Sri Lanka', 'posts-to-qrcodes' ),
    __( 'Maldives', 'posts-to-qrcodes' ),
);

// Add settings fields for qr code options
function pqrc_admin_settings_fields() {

    // Register Settings Section
    add_settings_section( 'pqrc_section', __( 'Posts To QR Codes', 'posts-to-qrcodes' ), 'pqrc_section_callback', 'general' );

    add_settings_field( 'pqrc_qrcode_height', __( 'QR Code Height', 'posts-to-qrcodes' ), 'pqrc_qrcode_height_callback', 'general', 'pqrc_section' );
    add_settings_field( 'pqrc_qrcode_width', __( 'QR Code Width', 'posts-to-qrcodes' ), 'pqrc_qrcode_width_callback', 'general', 'pqrc_section' );
    add_settings_field( 'pqrc_qrcode_select', __( 'Dropdown', 'posts-to-qrcodes' ), 'pqrc_qrcode_select_field_callback', 'general', 'pqrc_section' );
    add_settings_field( 'pqrc_qrcode_checkbox', __( 'Select Countries', 'posts-to-qrcodes' ), 'pqrc_qrcode_checkboxgroup_callback', 'general', 'pqrc_section' );
    add_settings_field( 'pqrc_qrcode_toggle', __( 'Toggle Field', 'posts-to-qrcodes' ), 'pqrc_qrcode_togglefield_callback', 'general', 'pqrc_section' );

    register_setting( 'general', 'pqrc_qrcode_height', array( 'sanitize_callback' => 'esc_attr' ) );
    register_setting( 'general', 'pqrc_qrcode_width', array( 'sanitize_callback' => 'esc_attr' ) );
    register_setting( 'general', 'pqrc_qrcode_select', array( 'sanitize_callback' => 'esc_attr' ) );
    register_setting( 'general', 'pqrc_qrcode_checkbox' );
    register_setting( 'general', 'pqrc_qrcode_toggle' );
}

function pqrc_qrcode_togglefield_callback() {

    $option = get_option( 'pqrc_qrcode_toggle' );

    echo '<div id="toggle1"></div>';
    echo '<input type="hidden" name="pqrc_qrcode_toggle" id="pqrc_qrcode_toggle" value="' . $option . '" />';
}

function pqrc_qrcode_checkboxgroup_callback() {

    global $pqrc_countries;
    $option    = get_option( 'pqrc_qrcode_checkbox' );
    $countries = apply_filters( 'pqrc_qrcode_countries', $pqrc_countries );

    foreach ( $countries as $country ) {
        $selected = '';
        if ( is_array( $option ) && in_array( $country, $option ) ) {
            $selected = ' checked';
        }
        printf( '<input type="checkbox" name="pqrc_qrcode_checkbox[]" value="%s" %s /> %s <br />', $country, $selected, $country );
    }

}

function pqrc_qrcode_select_field_callback() {

    global $pqrc_countries;
    $option    = get_option( 'pqrc_qrcode_select' );
    $countries = apply_filters( 'pqrc_qrcode_countries', $pqrc_countries );

    printf( '<select id="%s" name="%s">', 'pqrc_qrcode_select', 'pqrc_qrcode_select' );
    foreach ( $countries as $country ) {
        $selected = '';
        if ( $option == $country ) {
            $selected = ' selected';
        }
        printf( '<option value="%s" %s >%s</option>', $country, $selected, $country );
    }
    echo '</select>';
}

function pqrc_section_callback() {
    echo "<p>" . __( 'Settings for QR Codes', 'posts-to-qrcodes' ) . "</p>";
}

function pqrc_qrcode_height_callback() {
    $height = get_option( 'pqrc_qrcode_height' );
    printf( '<input type="number" id="%s" name="%s" value="%s" />', 'pqrc_qrcode_height', 'pqrc_qrcode_height', $height );
}

function pqrc_qrcode_width_callback() {
    $width = get_option( 'pqrc_qrcode_width' );
    printf( '<input type="number" id="%s" name="%s" value="%s" />', 'pqrc_qrcode_width', 'pqrc_qrcode_width', $width );
}

add_action( 'admin_init', 'pqrc_admin_settings_fields' );