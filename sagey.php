<?php
namespace Fyda\Sagey;

/*
Plugin Name: Sagey Starter Plugin
Plugin URI: http://github.com/alcandelario/sagey
Description: A Sage-inspired WordPress starter plugin
Version: 1.0.0
Author: Doejo LLC
Author URI: http://doejo.com
Text Domain: 'sagey'
License:
License URI:
Domain Path:
*/

class Plugin {

  private static $instance = null;

  function __construct() {

    /* 
     * Plugin core
     */    
    require_once __DIR__ . '/constants.php';    // Constants
    require_once __DIR__ . '/lib/assets.php';   // Enqueing scripts helper
    require_once __DIR__ . '/lib/admin.php';    // Setup admin-related pages for this plugin
    require_once __DIR__ . '/lib/init.php';     // Init scripts and styles
    require_once __DIR__ . '/lib/help.php';     // Helper library
    
    /* 
     * Register the plugin hooks/actions/filters
     */
    Plugin::register();
  }

  /**
   * Singleton constructor
   *
   * @return Plugin|null
   */
  public static function get_instance() {
      if ( null == self::$instance ) {
          self::$instance = new self;
      }

      return self::$instance;
  }

  /**
   * Register any WP hooks/actions here
   */
  public static function register() {

    // Standard Sagey hooks/actions
    Plugin::register_core();

    // Optional admin-related actions/filters
    Plugin::register_admin();
    
    // Optional actions/filters 
    Plugin::register_optional();
  }

  /**
   * Register helpful, but optional plugin hooks
   */
  public static function register_optional() {
      
    // Auto labels for custom post types
    // add_action( 'auto_labels',            array( __NAMESPACE__ . '\\Help', 'cpt_auto_labels' ) );

    // Setup post types
    add_action( 'init',                   array( __NAMESPACE__ . '\\Init' , 'cpt_and_tax' ), 0 );

    // Add body classes where applicable
    add_filter( 'body_class',             array( __NAMESPACE__ . '\\Init', 'set_body_class' ) );

    // Enqueue front-end scripts but do it late in case we need to run dequeue_scripts
    add_action( 'wp_enqueue_scripts',     array( __NAMESPACE__ . '\\Init', 'load_scripts' ), 99 );
  }   

  /**
   * Register core hooks/actions/filters
   */
  public static function register_core() {
      
    // Activation tasks
    register_activation_hook( __FILE__,   array( __NAMESPACE__ . '\\Plugin' , 'activate_plugin' ) );

    // Deactivation tasks
    register_deactivation_hook( __FILE__, array( __NAMESPACE__ . '\\Plugin', 'deactivate_plugin' ) );

    // Display activation status messages
    add_action( 'admin_notices',          array( __NAMESPACE__ . '\\Plugin', 'display_activation_notices' ) );
  }

  /**
   * Register Admin-related hooks/actions
   */
  public static function register_admin() {
    
    // Setup admin menu items 
    add_action( 'admin_menu',             array( __NAMESPACE__ . '\\Admin', 'menu' ) );

    // Enqueue admin scripts
    add_action( 'admin_enqueue_scripts',  array( __NAMESPACE__ . '\\Init', 'load_scripts' ) );
  }

  /**
   * Plugin activation tasks
   */
  public static function activate_plugin() {

    Plugin::add_notice( 'Sagey the plugin is now active!' );
  }

  /**
   * Plugin de-activation tasks
   */
  public static function deactivate_plugin() {

    delete_option( ACTIVATION_NOTICES );
  }

  /**
   * Display plugin activation messages
   */
  public static function display_activation_notices() {

    if ( $notices = get_option( ACTIVATION_NOTICES ) ) {

      foreach ($notices as $notice) {
          echo "<div class='updated'><p>$notice</p></div>";
      }

      delete_option( ACTIVATION_NOTICES );
    }
  }

  /**
   * Add a notice to show the user
   */
  public static function add_notice( $notice ) {

    $notices = get_option( ACTIVATION_NOTICES );

    $notices[] =  $notice;

    update_option( ACTIVATION_NOTICES, $notices );
  }
}

Plugin::get_instance();