<?php
App::uses('AppModel', 'Model');
/**
 * UpgradedStudentGrade Model
 *
 * @property UpgradedStudent $UpgradedStudent
 * @property Gradepoints $Gradepoints
 */
class UpgradedStudentGrade extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'UpgradedStudent' => array(
			'className' => 'UpgradedStudent',
			'foreignKey' => 'upgraded_student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gradepoints' => array(
			'className' => 'Gradepoints',
			'foreignKey' => 'gradepoints_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
