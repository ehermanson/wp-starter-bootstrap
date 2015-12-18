<?php

/***************************************************************
* Function erh_font_url
* Registers font urls to be loaded in the styles function
***************************************************************/

if ( ! function_exists( 'erh_font_url' ) ) :

function erh_font_url() {
  $fonts_url = '';
  $fonts = array();

  $fonts[] = 'Open+Sans:300,400';

  if ( $fonts ) {
    $fonts_url = add_query_arg( array(
      'family' => implode( '|', $fonts )
    ), 'https://fonts.googleapis.com/css' );
  }

  return $fonts_url;
}

endif;

/***************************************************************
* Function erh_asset_path
* Returns the paths for CSS and JS files
***************************************************************/

if ( ! function_exists( 'erh_asset_path' ) ) :

function erh_asset_path( $type ) {
  $asset_path = '';
  $base_path = get_template_directory_uri() . '/assets/build/';

  if ( $type === 'js' ) {
    $asset_path = $base_path . 'js/';
  }

  if ($type === 'css' ) {
    $asset_path = $base_path . 'css/';
  }

  return $asset_path;
}

endif;

/***************************************************************
* Function erh_styles
* Register and enqueue styles and scripts
***************************************************************/

function erh_styles() {

  wp_enqueue_style( 'erh-fonts', erh_font_url() );
  wp_enqueue_style( 'erh-styles', erh_asset_path('css') . 'style.css', array(), filemtime( get_template_directory().'/assets/build/css/style.css' ) );

  // wp_enqueue_script( 'erh-modernizr', erh_asset_path('js') . 'modernizr.min.js', array('jquery'), null, false );
  wp_enqueue_script( 'erh-js', erh_asset_path('js') . 'global.min.js', array('jquery'), null, true );

  /// LiveReload for local development
  if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    wp_register_script('livereload', 'http://localhost:8888/livereload.js?snipver=1', null, false, true);
    wp_enqueue_script('livereload');
  }
}

add_action( 'wp_enqueue_scripts', 'erh_styles' );

/***************************************************************
* Function erh_add_editor_styles
* Add styles for TinyMCE editor
***************************************************************/

function erh_add_editor_styles() {

  add_editor_style( erh_asset_path('css') . 'editor-style.css' );
  add_editor_style( str_replace( ',', '%2C', erh_font_url() ) );
}

add_action( 'init', 'erh_add_editor_styles' );

/***************************************************************
* Function erh_login_css
* Function erh_login_url
* Function erh_login_title
* Customize the login screen
***************************************************************/


function erh_login_css() {
  wp_enqueue_style( 'erh_login_css', erh_asset_path('css') . 'login.css', false );
}

function erh_login_url() {
  return home_url();
}

function erh_login_title() {
  return get_option( 'blogname' );
}

add_action( 'login_enqueue_scripts', 'erh_login_css', 10 );
add_filter( 'login_headerurl', 'erh_login_url' );
add_filter( 'login_headertitle', 'erh_login_title' );

add_editor_style( 'editor-style.css' );

/***************************************************************
* Function erh_respond_js
* Conditionally add Respond.js for IE8
***************************************************************/

// function erh_respond_js () {
//   echo '<!--[if lte IE 9]>';
//   echo '<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>';
//   echo '<![endif]-->';
// }
// add_action('wp_head', 'erh_respond_js');

/***************************************************************
* Function erh_deregister_styles
* Remove specific plugin CSS
***************************************************************/

// add_action( 'wp_print_styles', 'erh_deregister_styles', 100 );

// function erh_deregister_styles() {
//  wp_deregister_style( 'contact-form-7' );
// }

/***************************************************************
* Function erh_deregister_scripts
* Remove specific plugin JS
***************************************************************/

//add_action( 'wp_print_scripts', 'erh_deregister_scripts', 100 );

// function erh_deregister_scripts() {
//  if ( !is_page('contact') ) {
//    wp_deregister_script( 'contact-form-7' );
//  }
// }