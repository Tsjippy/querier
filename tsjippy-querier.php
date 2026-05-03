<?php
namespace TSJIPPY\QUERIER;

/**
 * Plugin Name:  		Tsjippy Querier
 * Description:  		This plugin adds the role of querier. This allows to give them a certain permission, but not the full rights other users
 * Version:      		10.0.1
 * Author:       		Ewald Harmsen
 * AuthorURI:			harmseninnigeria.nl
 * Requires at least:	6.3
 * Requires PHP: 		8.3
 * Tested up to: 		6.9
 * Plugin URI:			https://github.com/Tsjippy/querier
 * Tested:				6.9
 * TextDomain:			tsjippy
 * Requires Plugins:	tsjippy-shared-functionality
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @author Ewald Harmsen
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pluginData = get_plugin_data(__FILE__, false, false);

// Define constants
define(__NAMESPACE__ .'\PLUGIN', plugin_basename(__FILE__));
define(__NAMESPACE__ .'\PLUGINPATH', __DIR__.'/');
define(__NAMESPACE__ .'\PLUGINVERSION', $pluginData['Version']);
define(__NAMESPACE__ .'\PLUGINSLUG', str_replace('tsjippy-', '', basename(__FILE__, '.php')));
define(__NAMESPACE__ .'\SETTINGS', get_option('tsjippy_'.PLUGINSLUG.'_settings', []));

// run right before activation
register_activation_hook( __FILE__, function(){
	$roleSet = get_role( 'contributor' )->capabilities;

	// Only add the new role if it does not exist
	if(!wp_roles()->is_role( 'enquirer' )){
		add_role(
			'enquirer',
			'Enquirer',
			$roleSet
		);
	}
} );

// run on deactivation
register_deactivation_hook( __FILE__, function(){
} );