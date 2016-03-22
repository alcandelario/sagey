<?php 
namespace Fyda\Sagey;

// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2011 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://github.com/cheezburger/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html

global $Fyda_themename, $Fyda_req_cap_to_edit, $Fyda_cap_menu_position, $Fyda_cap_icon_url; 	// Required when loading cheezcap inside a namespaced plugin

$Fyda_themename = ADMIN_PAGE_NAME; 				// used on the title of the custom admin page
$Fyda_req_cap_to_edit = 'manage_options'; // the user capability that is required to access the CheezCap settings page
$Fyda_cap_menu_position = 150; 						// OPTIONAL: This value represents the order in the dashboard menu that the CheezCap menu will display in. Larger numbers push it further down.
$Fyda_cap_icon_url = ""; 									// OPTIONAL: Path to a custom icon for the CheezCap menu item. ex. $cap_icon_url = WP_CONTENT_URL . '/your-theme-name/images/awesomeicon.png'; Image size should be around 20px x 20px.

function cap_get_options() {

	return array(

		new Group( 'Main Settings', 'some_opts_Fyda' , 
			array(
				
				new TextOption( 				//Name, Description, OptionID, Default, UseTextArea
					'Favorite Starter Plugin Name',
					'',
					'favorite_name_Fyda',					
					'Sagey',
					false
				),

				new BooleanOption(
					'Show Featured Page',
					'',
					'show_feat_Fyda'
				),
				
				new DropdownOption(
					'Featured Page',
					'',
					'featured_Fyda',
					cap_get_all_pages(),
					0
				)
			)
		),

		new Group( 'Other Settings', 'some_other_opts_Fyda' , 
			array(
				
				new MultiOption(
					'Select all pages you\'d like. They\'ll be saved as a serialized array',
					'',
					'featured_pages_list_Fyda',
					cap_get_all_pages(),
					0
				),

				new MediaOption(
					'Featured Icon',
					'(used around various places where appropriate)',
					'featured_icon_Fyda'
				)
			)
		)
	);
}


/**
 * Example helper for cheezcap
 * 
 * @param  string $post_type - post type of posts to return
 * @return array  $posts - collection of posts
 */
function cap_get_all_pages( $post_type = 'page' ) {
	
	$query = new \WP_Query( array( 'post_type' => $post_type ) );

	$return = array( 'None' );
	
	foreach( $query->posts as $post ) {

		$time = \date( 'M j, o @g:ia', \strtotime( $post->post_modified ) );
		
		$return[] = $post->post_title . " (" . $time . ", ID=" . $post->ID . ")";
	}

	return $return;
}

/**
 * Example helper for cheezcap
 * 
 * @return array $terms - collection of term objects
 */
function cap_get_tax_terms() {
	
	$return = array();

	$terms = \get_terms( 'category', array( 'hide_empty' => false ) );

	foreach( $terms as $term ) {
		$return[] = $term->name; 
	}

	return $return;
}