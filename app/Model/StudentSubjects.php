<?php

App::uses('AppModel', 'Model');

/**
 * Course Model
 *
 */
class StudentSubjects extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'subject_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
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
    );
    
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
