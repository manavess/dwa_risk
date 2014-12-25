<?php
App::uses('AppModel', 'Model');
/**
 * DirectorWord Model
 *
 */
class DirectorWord extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'director_word' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Directors words should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
