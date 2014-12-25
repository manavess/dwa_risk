<?php
App::uses('AppModel', 'Model');
/**
 * AboutMinistry Model
 *
 */
class AboutMinistry extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'about_us' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'About Us should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
}
