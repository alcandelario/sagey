<?php
namespace Fyda\Sagey;

class Admin {

  private static $instance = null;

  public static $admin_colors;

    public function __construct() {   
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
     * Register plugin menu nav items
     */
    public static function menu() {

        if( is_admin() && USE_ADMIN_MENU ) {

            // Plugin main page has nothing to do with cheezcap
            if ( !INIT_OPTIONS_PAGE || INIT_OPTIONS_PAGE && OPTIONS_AS_SUBMENU ) {
                add_menu_page( __( 'Sagey Plugin Admin', TEXTD ), __( 'Sagey Plugin', TEXTD ), 'manage_options', ADMIN_MENU_SLUG, 'Fyda\Sagey\Admin::mainPage', null, 99 );
            }
            
            // Plugin main page is a cheezcap options page
            if ( INIT_OPTIONS_PAGE && !OPTIONS_AS_SUBMENU ) {
                Admin::initOptionsPage();
            }

            // Plugin has a subpage that is cheezcap options page
            else if ( INIT_OPTIONS_PAGE && OPTIONS_AS_SUBMENU ) {
                Admin::initOptionsPage();
            }
        }
    }

    /**
     * Returns the template for the plugin's menu menu page
     * 
     * @return [type] [description]
     */
    public static function mainPage() {

        // A main plugin page that isn't an options/settings page
        require_once PLUGIN_DIR . "/templates/admin/main.php";
    }

    /**
     * Sets up a cheezcap-based options page, either as a main, or
     * submenu admin page
     */
    public static function initOptionsPage() {
        
        \add_action('admin_head', function(){global $_wp_admin_css_colors; Admin::$admin_colors = $_wp_admin_css_colors;});
        
        require_once PLUGIN_DIR . "/lib/cheezcap/cheezcap.php";
        
        cap_add_admin();
    }

    public static function getColors( $which = false ) {
        
        $colors = Admin::$admin_colors[ \get_user_option('admin_color') ];

        if ( $which !== false ) {
            
            switch( $which ) {
                case 'menu_active_bg':
                    $index = 2;
                    break;
                case 'menu_back':
                    $index = 0;
                    break;
                default: 
                    break;
            }

            return $colors->colors[ $index ];
        }
        else {
            return $colors;
        }
    }
}

Admin::get_instance();