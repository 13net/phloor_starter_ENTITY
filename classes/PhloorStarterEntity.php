<?php

/**
 *
 */
class PhloorStarterEntity extends AbstractPhloorElggThumbnails {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['type']    = "object";
		$this->attributes['subtype'] = "phloor_starter_ENTITY";
	}

	public function canComment($user_guid = 0) {
		$result = parent::canComment($user_guid);
		if ($result == false) {
			return false;
		}

		if (strcmp("On", $this->comments_on) != 0) {
			return false;
		}

		return true;
	}

}