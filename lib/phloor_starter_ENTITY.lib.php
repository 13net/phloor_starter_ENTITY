<?php

namespace phloor_starter_ENTITY;

function instance_of($entity) {
    return elgg_instanceof($entity, 'object', 'phloor_starter_ENTITY', 'PhloorStarterEntity');
}

/**
 * Define the default attributes of your Entity
 * 
 * array(
 * 	[attribute_name] => [default_value],
 *  ...
 * )
 * 
 */
function default_vars($hook, $type, $return, $params) {
    $return = array(
    	'title'          => 'DEFAULT TITLE',
    	'description'    => 'DEFAULT DESCRIPTION',
    	'comments_on'    => 'Off',
    	'tags'           => '',
    	'access_id'      => ACCESS_DEFAULT,
    );

    return $return;
}


/**
 * Define the form attributes of your Entity
 * 
 * array(
 * 	[attribute_name] => [input_view],
 *  ...
 * )
 * 
 * The input view must exist otherwise
 * an error is displayed!
 * 
 */
function form_vars($hook, $type, $return, $params) {
    $return = array(
    	'title'       => 'input/text',
    	'description' => 'input/longtext',
    	'comments_on' => 'phloor/input/enable_comments',
    	'tags'        => array(
			'view'        => 'input/tags',
			'label'       => 'OVERRIDDEN LABEL FOR TAGS SET IN form_vars!',
			'description' => 'OVERRIDDEN DESCRIPTION FOR TAGS: comma seperated list',
		 ),
		'access_id'   => array(
			'view'  => 'input/access',
			'label' => '', // will be replaced with default language key if present
		 ),
    );

    return $return;
}

/**
* Prepare the form attributes of your Entity
* 
* Here you can add additional parameters
* or volatile metadata.
* 
* In this example not much is done.. just reordering 
* for demonstration purposes!
* 
* The $return array has this structure:
* 'variable_name' => array(
* 	'view'        => [input/output view],
* 	'value'       => [a value],
* 	'label'       => [a label],
* 	'description' => [a description],
* )
*/
function prepare_form_vars($hook, $type, $return, $params) {
    
    $new_return = array(
		'title'       => elgg_extract('title',       $return, array()),
    	'tags'        => elgg_extract('tags',        $return, array()),
    	'description' => elgg_extract('description', $return, array()),
		'access_id'   => elgg_extract('access_id',   $return, array()),
    	'comments_on' => elgg_extract('comments_on', $return, array()),
    ); 
    
    $new_return = $new_return + $return;
    
    return $new_return;
}

/**
 * Check attributes of your Entity before it is saved
 * to the database.
 * 
 * Here you can adapt and manipulate the value
 * of the save form.
 * 
 * Return false and the entity wont get saved.
 * 
 * This example checks for the 'title' attribute
 * and raises an error if it is empty!
 */
function check_vars($hook, $type, $return, $params) {

    $entity = elgg_extract("entity", $params, NULL);
    // check for valid class instance
    if (!namespace\instance_of($entity)) {
        return false;
    }

    // check if title value is given
    if (empty($return['title'])) {
        register_error(elgg_echo('phloor_starter_ENTITY:error:check_vars:title:empty'));
        return false;
    }
    
    if(strcmp('On', $return['comments_on']) != 0) {
        $return['comments_on'] = 'Off';
    }

    return $return;
}




