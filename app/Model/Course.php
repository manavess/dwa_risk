<?php
App::uses('AppModel', 'Model');
/**
 * Course Model
 *
 */
class Course extends AppModel {

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
				'message' => 'Course name should not be empty',
				
			),
			'alpha'=>array(
					'rule' => '/^[^%#\/*@!+=;:&,012456789]+$/',
					'message' => 'Course name should be characters.'
					), 
			'isUnique' => array(
					'rule' => 'isUnique',
					'message' => 'This Subject name already exist'
					),                     
		),
		'no_of_subject' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Number of subject should not be empty',
			
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Number of subjects should be numeric',
				
			),
		),

	);

}
