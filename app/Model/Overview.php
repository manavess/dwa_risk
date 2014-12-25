<?php
App::uses('AppModel', 'Model');
/**
 * Overview Model
 *
 */
class Overview extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'overview' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Overview should not be left blank',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
