<?php
namespace SIM\QUERIER;
use SIM;

add_filter('sim_module_querier_after_save', __NAMESPACE__.'\moduleUpdated');
function moduleUpdated($options){
	$roleSet = get_role( 'contributor' )->capabilities;

	// Only add the new role if it does not exist
	if(!wp_roles()->is_role( 'enquirer' )){
		add_role(
			'enquirer',
			'Enquirer',
			$roleSet
		);
	}

	return $options;
}

add_filter('sim_role_description', __NAMESPACE__.'\roleDescription', 10, 2);
function roleDescription($description, $role){
    if($role == 'enquirer'){
        return 'Someone who is investigating SIM Nigeria to serve with';
    }
	
    return $description;
}