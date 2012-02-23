/**
 * Phloor Starter ENTITY
 * 
 * @package phloor_starter_ENTITY
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author void <void@13net.at>
 * @copyright 2012 by 13net
 * @link http://www.13net.at/
 */
/**
 * Reuqirements
 */
 - PHP version 5.3.0 or above
 - phloor 1.8.3 or above
  
/**
 * Description
 */
This plugin is just for demonstration purposes.
It will get you started on how to create and manage
your own Entity type with the phloor framework.

This example is kept short and simple and just
for your understanding of the inner mechanismns of phloor -
it will only show you the _mininum_ effort possible to create
your own entity.

An entity controlled by phloor is automatically
able to be: created/edited/deleted/viewed/listed!

Everything from routing and displaying the pages 
'all', 'owner', 'friends', 'edit', 'add', 'view'
to defining the create/update/delete actions is
done by phloor.


The only thing you need to do is:
- create a class extending ElggObject
- implement at least 'default_vars' and 'form_vars' hook


Attributes of the starter ENTITY are:
    - title: a custom title
    - description: a custom description
    - tags: a comma seperated list of tags
    - comments_on: turn comments off/on
    - access_id: read access

It uses the following phloors entity object hooks:
    - 'phloor_object:default_vars',      'phloor_starter_ENTITY'
    - 'phloor_object:form_vars',         'phloor_starter_ENTITY'
    - 'phloor_object:prepare_form_vars', 'phloor_starter_ENTITY'
    - 'phloor_object:check_vars',        'phloor_starter_ENTITY' 

/**
 * Languages
 */
English

