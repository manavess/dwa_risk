<?php
App::uses('AppModel', 'Model');
/**
 * AdmissionCancellation Model
 *
 * @property StudentRegistration $StudentRegistration
 */
class AdmissionCancellation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'student_registration_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'remarks' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Remark should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'created_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'StudentRegistration' => array(
			'className' => 'StudentRegistration',
			'foreignKey' => 'student_registration_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
