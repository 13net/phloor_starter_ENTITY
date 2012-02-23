<?php

elgg_register_event_handler('init', 'system', 'phloor_starter_ENTITY_init');

/**
 * Initialize and setup
 */
function phloor_starter_ENTITY_init() {
    /**
     * LIBRARY
     */  
    elgg_register_library('phloor-starter-ENTITY-lib', elgg_get_plugins_path() . 'phloor_starter_ENTITY/lib/phloor_starter_ENTITY.lib.php');
    elgg_load_library('phloor-starter-ENTITY-lib'); // load immediately    
    /*
     * LIBRARY - END
     **/
    
    /**
     * PHLOOR entity handler functions
     */
    // let phloor know about your entity subtype
    if (\phloor\entity\object\phloor_my_subtype('phloor_starter_ENTITY')) {
        
        // populate your function for the DEFAULT VALUES of your entity
        elgg_register_plugin_hook_handler('phloor_object:default_vars', 'phloor_starter_ENTITY', '\phloor_starter_ENTITY\default_vars');
        
        // populate your function for the FROM ATTRIBUTES of your entity
        elgg_register_plugin_hook_handler('phloor_object:form_vars', 'phloor_starter_ENTITY', '\phloor_starter_ENTITY\form_vars');
        
        // prepare the FROM ATTRIBUTES and add/change/delete stuff
        elgg_register_plugin_hook_handler('phloor_object:prepare_form_vars', 'phloor_starter_ENTITY', '\phloor_starter_ENTITY\prepare_form_vars');
        
        // populate your function for VALIDATING the attributes of your entity
        elgg_register_plugin_hook_handler('phloor_object:check_vars', 'phloor_starter_ENTITY', '\phloor_starter_ENTITY\check_vars');
        /*
         *  PHLOOR entity handler functions - END
         **/
    }
    
    /**
    * CSS
    */
    elgg_extend_view('css/elgg',  'phloor_starter_ENTITY/css/elgg', 501);
    /*
     * CSS - END
    **/
    
    /**
     * MENU
     */
    /** site menu */
    $item = new ElggMenuItem('phloor_starter_ENTITY', elgg_echo('phloor_starter_ENTITY'), 'phloor/object/phloor_starter_ENTITY/all');
    elgg_register_menu_item('site', $item);
    /* site menu - END **/
    /*
     * MENU - END
    **/
      
}


