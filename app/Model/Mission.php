<?php
App::uses('AppModel', 'Model');
/**
 * Mission Model
 *
 */
class Mission extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mission' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Mission should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
