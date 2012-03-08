<?php
/**
 * View for starter ENTITY objects
 *
 */

$full   = elgg_extract('full_view', $vars, FALSE);
$entity = elgg_extract('entity', $vars, FALSE);

if (!$entity) {
	return TRUE;
}

$owner      = $entity->getOwnerEntity();
$container  = $entity->getContainerEntity();
$categories = elgg_view('output/categories', $vars);

$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$owner_link = elgg_view('output/url', array(
	'href' => "phloor/object/phloor_starter_ENTITY/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$tags        = elgg_view('output/tags', array('tags' => $entity->tags));
$date        = elgg_view_friendly_time($entity->time_created);

// comments enabled?
if ($entity->comments_on != 'Off') {
	$comments_count = $entity->countComments();
	//only display if there are commments
	if ($comments_count != 0) {
		$text = elgg_echo("comments") . " ($comments_count)";
		$comments_link = elgg_view('output/url', array(
			'href'       => $entity->getURL() . '#phloor-starter-ENTITY-comments',
			'text'       => $text,
			'is_trusted' => true,
		));
	} else {
		$comments_link = '';
	}
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity'  => $entity,
	'handler' => 'phloor_starter_ENTITY',
	'sort_by' => 'priority',
	'class'   => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full) {    
	
	$description = elgg_view('output/longtext', array(
			'value' => $entity->description,
			'class' => 'phloor-starter-ENTITY-description',
	));
		
	$body = $description;
	
	if($entity->hasImage()) {
	    $sizes = array('tiny', 'small', 'thumb', 'medium', 'large');
	    
	    // create a gauss pyramide [haha :) ]
	    foreach ($sizes as $size) {
    	    $image_url = elgg_format_url($entity->getImageURL($size));
    	
    	    $image = elgg_view('output/img', array(
    			'src'   => $image_url,
            	'alt'   => $entity->title,
            	'title' => $entity->title,
            	'class' => 'phloor-starter-ENTITY-image',
    	    ));
    	
    	    $body .= $image;
	    }
	}
	
	if ($entity->canComment()) {
	    $body .= elgg_view_comments($entity, true);
	}
	
	$params = array(
			'entity'   => $entity,
			'title'    => false,
			'metadata' => $metadata,
			'subtitle' => $subtitle,
			'tags'     => $tags,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);
	
	echo elgg_view('object/elements/full', array(
		'summary' => $summary,
		'icon'    => $owner_icon,
		'body'    => $body,
	));	
	
	echo 'tags:'. $tags;
	
} else {        
	$params = array(
		'entity'   => $entity,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags'     => $tags,
	);
	
	// display image if it exists
	if($entity->hasImage()) {
	    $size = 'tiny';
	    $image_url = elgg_format_url($entity->getImageURL($size));
	
	    $image_alt = elgg_view('phloor/output/avatar', array(
			'src'   => $image_url,
			'size'  => $size,
        	'alt'   => $entity->title,
        	'title' => $entity->title,
	    ));
	
	    $params['image_alt'] = $image_alt;
	}
	
	$content = elgg_view_image_block($menuitem_icon, $list_body, $params);
	
	$params = $params + $vars;
	
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $list_body, $params);
	
	echo 'tags:'. $tags;
	
}
