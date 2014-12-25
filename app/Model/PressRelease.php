<?php
App::uses('AppModel', 'Model');
/**
 * PressRelease Model
 *
 */
class PressRelease extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'press_release' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Press Release should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
