<?php
App::uses('AppModel', 'Model');
/**
 * SecretaryWord Model
 *
 */
class SecretaryWord extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'secretary_word' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Secretaries Word shoul not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
