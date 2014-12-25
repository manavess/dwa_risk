<?php
App::uses('AppModel', 'Model');
/**
 * Religion Model
 *
 */
class Religion extends AppModel {

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
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Religion name should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                               'message' => 'Religion name should be characters.'
                         ), 
                         
               'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This Religion name already exist'
				),                      
		),
	);
	
	
}
