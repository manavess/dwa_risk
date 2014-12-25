<?php
App::uses('AppModel', 'Model');
/**
 * Notice Model
 *
 */
class Notice extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'notice' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Notice should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
