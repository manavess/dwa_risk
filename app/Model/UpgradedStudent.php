<?php
App::uses('AppModel', 'Model');
/**
 * UpgradedStudent Model
 *
 */
class UpgradedStudent extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
                'application_number' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Application number should not be number',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            
		'to_course_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Course name should not be empty',
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
			
			),
		),
		
	);
        
        
         public $belongsTo = array(
		'StudentRegistration' => array(
			'className' => 'StudentRegistration',
			'foreignKey' => 'student_registration_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'fromCourse' => array(
			'className' => 'Course',
			'foreignKey' => 'from_course_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'toCourse' => array(
			'className' => 'Course',
			'foreignKey' => 'to_course_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	public $hasMany = array(
	'UpgradedStudentMark' =>array(
		'className' => 'UpgradedStudentMark',
			'foreignKey' => 'upgraded_student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
	),
	'UpgradedStudentGrade' =>array(
		'className' => 'UpgradedStudentGrade',
			'foreignKey' => 'upgraded_student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
	),
	);
}
