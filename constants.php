<?php 
namespace Fyda\Sagey;

/* ------------- Core ------------- */

define( __NAMESPACE__ . '\\APP_VER', '1.0.0' );
define( __NAMESPACE__ . '\\PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( __NAMESPACE__ . '\\PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/* -------------  End Core -------------  */

define( __NAMESPACE__ . '\\ACTIVATION_NOTICES', 'Fyda_activation_notices' );
define( __NAMESPACE__ . '\\TEXTD', 'Fyda_sagey' );                                 // Text domain for locatlization
define( __NAMESPACE__ . '\\AJAX_NONCE', "Fyda_ajax_nonce" );
define( __NAMESPACE__ . '\\LOAD_ASSETS', true );                                   // Whether or not to enqueue scripts

// Plugin admin page config (general)
define( __NAMESPACE__ . '\\USE_ADMIN_MENU', true );                                // Does the plugin require an admin or settings menu page?
define( __NAMESPACE__ . '\\ADMIN_MENU_SLUG', 'Fyda_sagey_plugin');                 // The base page slug for any plugin menu pages
define( __NAMESPACE__ . '\\ADMIN_PAGE_NAME', 'Sagey' );                            // The plugin-option's page name
 
// Plugin admin page config (cheezcap)
define( __NAMESPACE__ . '\\INIT_OPTIONS_PAGE', true );                              // Enable the cheezcap-based options page for the plugin
define( __NAMESPACE__ . '\\OPTIONS_AS_SUBMENU', true );                             // Plugin options page appears as a submenu link
