<?php
App::uses('AppModel', 'Model');
/**
 * Goal Model
 *
 */
class Goal extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'goal' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Goal should not be empty ',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
