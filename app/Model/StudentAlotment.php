<?php
App::uses('AppModel', 'Model');
/**
 * StudentAlotment Model
 *
 * @property StudentRegistration $StudentRegistration
 * @property CollegeGroupSubject $CollegeGroupSubject
 */
class StudentAlotment extends AppModel {


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
			
		),
		'CollegeGroupSubject' => array(
			'className' => 'CollegeGroupSubject',
			'foreignKey' => 'college_group_subject_id'
			
		),
                'Colleges' => array(
			'className' => 'Colleges',
			'foreignKey' => 'college_id'
			
		)
	);
}