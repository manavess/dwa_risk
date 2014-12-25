<?php
App::uses('AppModel', 'Model');
/**
 * StuentGrade Model
 *
 * @property StudentRegistration $StudentRegistration
 */
class StudentGrade extends AppModel {


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
