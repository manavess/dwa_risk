<?php
App::uses('AppModel', 'Model');
/**
 * CollegeGroupSubject Model
 *
 * @property College $College
 * @property GroupSubjects $GroupSubjects
 */
class CollegeGroupSubject extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'college_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_subjects_id' => array(
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
		'College' => array(
			'className' => 'College',
			'foreignKey' => 'college_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'GroupSubjects' => array(
			'className' => 'GroupSubjects',
			'foreignKey' => 'group_subjects_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'StudentPreferedColleges' => array(
			'className' => 'StudentPreferedColleges',
			'foreignKey' => 'college_group_subject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
}