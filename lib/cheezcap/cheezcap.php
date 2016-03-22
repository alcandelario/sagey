<?php
namespace Fyda\Sagey;

//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2011 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://github.com/cheezburger/cheezcap
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//
global $Fyda_cap;

require_once( 'library.php' );
require_once( 'config.php' );

$Fyda_cap = new autoconfig();

// if ( ! defined( 'Fyda\Sagey\LOADED_CONFIG' ) ) {
// 		\add_action( 'admin_menu', 'Fyda\Sagey\cap_add_admin' );
// 		define( 'Fyda\Sagey\LOADED_CONFIG', 1 );
// }

function cap_add_admin() {
	global $Fyda_themename, $Fyda_req_cap_to_edit, $Fyda_cap_menu_position, $Fyda_cap_icon_url;

	if ( ! \current_user_can ( $Fyda_req_cap_to_edit ) )
		return;

	if ( isset( $_GET['page'] ) && $_GET['page'] == ADMIN_MENU_SLUG . '_options' ) {
		$options = cap_get_options();

		$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
		$method = false;
		$done = false;
		$data = new ImportData();
		switch ( $action ) {
			case 'save':
				$method = 'Update';
				break;
			case 'Reset':
				$method = 'Reset';
				break;
			case 'Export':
				$method = 'Export';
				$done = 'cap_serialize_export';
				break;
			case 'Import':
				$method = 'Import';
				$data = \unserialize( \file_get_contents( $_FILES['file']['tmp_name'] ) );
				break;
		}

		if ( $method ) {
			foreach ( $options as $group ) {
				foreach ( $group->options as $option ) {
					\call_user_func( array( $option, $method ), $data );
				}
					}
			if ( $done )
				\call_user_func( $done, $data );
		}
	}

	$pgName = "$Fyda_themename Settings";

	// Cheezcap as a standard, top-level options page
	if ( INIT_OPTIONS_PAGE && !OPTIONS_AS_SUBMENU ) {
		$hook = \add_menu_page( $pgName, $pgName, isset( $Fyda_req_cap_to_edit ) ? $Fyda_req_cap_to_edit : 'manage_options', ADMIN_MENU_SLUG . '_options', 'top_level_settings', isset( $Fyda_cap_icon_url ) ? $Fyda_cap_icon_url : $default, isset( $Fyda_cap_menu_position ) ? $Fyda_cap_menu_position : $default );
	}

	// Cheezcap as Sagey's submenu page
	else {
		$hook = \add_submenu_page( ADMIN_MENU_SLUG , __( 'Sagey options', TEXTD ), __( 'Options', TEXTD ), 'manage_options', ADMIN_MENU_SLUG . '_options',  'Fyda\Sagey\top_level_settings' );
	}

	\add_action( "admin_print_scripts-$hook", 	'Fyda\Sagey\cap_admin_js_libs' );
	\add_action( "admin_footer-$hook", 					'Fyda\Sagey\cap_admin_js_footer' );
	\add_action( "admin_print_styles-$hook", 		'Fyda\Sagey\cap_admin_css' );
}