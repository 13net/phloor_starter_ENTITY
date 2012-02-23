<?php

// populate the subtype
if (get_subtype_id('object', 'phloor_starter_ENTITY')) {
	update_subtype('object', 'phloor_starter_ENTITY', 'PhloorStarterEntity');
} else {
	add_subtype('object', 'phloor_starter_ENTITY', 'PhloorStarterEntity');
}
