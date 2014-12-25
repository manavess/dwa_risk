<?php
App::uses('AppModel', 'Model');
/**
 * About Model
 *
 */
class About extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'pagetext' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Pagetext should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
