<?php

App::uses('AppModel', 'Model');

/**
 * Course Model
 *
 */
class StudentPreferedColleges extends AppModel {
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
    );
    public $belongsTo = array(
        'StudentRegistration' => array(
            'className' => 'StudentRegistration',
            'foreignKey' => 'student_registration_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'CollegeGroupSubject' => array(
            'className' => 'CollegeGroupSubject',
            'foreignKey' => 'college_group_subject_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Colleges' => array(
            'className' => 'Colleges',
            'foreignKey' => 'college_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}