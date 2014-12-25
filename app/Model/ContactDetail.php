<?php
App::uses('AppModel', 'Model');
/**
 * ContactDetail Model
 *
 */
class ContactDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'pagetext' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Pagetext should not be empty ',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
