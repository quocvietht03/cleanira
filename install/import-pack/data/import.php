<?php
/**
 * Import pack data package demo
 *
 */
$plugin_includes = array(
  array(
    'name'     => __( 'Elementor Website Builder', 'cleanira' ),
    'slug'     => 'elementor',
  ),
  array(
    'name'     => __( 'Elementor Pro', 'cleanira' ),
    'slug'     => 'elementor-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'elementor-pro.zip',
  ),
  array(
    'name'     => __( 'Smart Slider 3 Pro', 'cleanira' ),
    'slug'     => 'nextend-smart-slider3-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'nextend-smart-slider3-pro.zip',
  ),
  array(
    'name'     => __( 'Advanced Custom Fields PRO', 'cleanira' ),
    'slug'     => 'advanced-custom-fields-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'advanced-custom-fields-pro.zip',
  ),
  array(
    'name'     => __( 'Gravity Forms', 'cleanira' ),
    'slug'     => 'gravityforms',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'gravityforms.zip',
  ),
  array(
    'name'     => __( 'Newsletter', 'cleanira' ),
    'slug'     => 'newsletter',
  ),
  array(
    'name'     => __( 'WooCommerce', 'cleanira' ),
    'slug'     => 'woocommerce',
  ),

);

return apply_filters( 'cleanira/import_pack/package_demo', [
    [
        'package_name' => 'cleanira-main',
        'preview' => get_template_directory_uri() . '/screenshot.jpg',
        'url_demo' => 'https://cleanira.beplusthemes.com/',
        'title' => __( 'Cleanira Demo', 'cleanira' ),
        'description' => __( 'Cleanira main demo.', 'cleanira' ),
        'plugins' => $plugin_includes,
    ],
] );
