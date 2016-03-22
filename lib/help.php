<?php
namespace Fyda\Sagey;

class Help {

    private static $instance = null;

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

    public static function cpt_auto_labels( $singular, $plural = '' ) {

        if ( empty( $plural ) ) {
            $plural = $singular . 's';
        }

        return array(
            'name' => $plural,
            'singular_name' => $singular,
            'search_items' => 'Search ' . $plural,
            'all_items' => $plural,
            'edit_item' => 'Edit ' . $singular,
            'add_new_item' => 'Add New ' . $singular,
            'menu_name' => $plural,
            'new_item' => 'New ' . $singular,
            'view_item' => 'View ' . $plural,
            'not_found' => 'No ' . $plural . ' found',
            'not_found_in_trash' => 'No ' . $plural . ' found in Trash',
            'parent_item_colon' => '',
        );
    }
}