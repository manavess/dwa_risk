<?php
App::uses('AppModel', 'Model');
/**
 * FeeStructure Model
 *
 */
class FeeStructure extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'pagetext' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Field can not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
