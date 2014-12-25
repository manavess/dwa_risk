<?php
App::uses('AppModel', 'Model');
/**
 * UpgradedStudentMark Model
 *
 * @property UpgradedStudent $UpgradedStudent
 */
class UpgradedStudentMark extends AppModel {


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
		)
	);
}
