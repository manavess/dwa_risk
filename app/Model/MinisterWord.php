<?php
App::uses('AppModel', 'Model');
/**
 * MinisterWord Model
 *
 */
class MinisterWord extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'minister_word' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ministers Word should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
