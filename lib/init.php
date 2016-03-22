<?php
namespace Fyda\Sagey;

class Init {

  function __construct() {
  }

  /**
   * Load any necessary CSS/JS
   */
  public static function load_scripts() {

    global $post;

    if ( LOAD_ASSETS ) {

      /**
       * Enqueue plugin scripts
       */
      \wp_enqueue_script( 'jquery', array(), APP_VER, true );
      \wp_enqueue_script( __NAMESPACE__ . 'Fyda_sagey_js', asset_path( "scripts/main.js" ), array( 'jquery' ), APP_VER, true );
      \wp_enqueue_style( __NAMESPACE__  . 'Fyda_sagey_css', asset_path( "styles/main.css" ), array(), APP_VER, false );                
      
      /**
       * Set the AJAX nonce
       */
      $nonce = \wp_create_nonce( 'AJAX_NONCE' );

      \wp_localize_script(  __NAMESPACE__ . 'Fyda_sagey_js', 'Fyda_Plugin_AJAX', array(
          'ajax_url'  => admin_url( 'admin-ajax.php' ),
          'nonce'     => $nonce,
          'site_url'  => site_url(),
          'plugin_url'=> PLUGIN_URL
      ) );
    }
  }

  /**
   * Set body class in admin
   */
  public static function set_body_class( $classes ) {
    global $post;

    $class[] = 'Fyda-plugin';

    return $classes;
  } 

  /**
   * Register custom post types
   * and taxonomies here
   */
  public static function cpt_and_tax() {
  
    $labels = Help::cpt_auto_labels( "Sagey Plugin Post" );

    \register_post_type( 'Fyda_post_type', array(
      'labels'            => $labels,
      'query_var'         => 'Fyda_post_type',
      'capability_type'   => 'post',
      'has_archive'       => true,
      'hierarchical'      => true,
      'show_ui'           => true,
      'supports'          => array( 'title' ),
      'menu_position'     => 100,
      'rewrite'           => true,
      'publicly_queryable'=> false
    ));
  }

}