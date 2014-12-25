<?php
App::uses('AppModel', 'Model');
/**
 * Vision Model
 *
 */
class Vision extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'vision' => array(
			'notempty' => array(
				'rule' => array('notempty'),

				'message' => 'Vision should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
                                //'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
