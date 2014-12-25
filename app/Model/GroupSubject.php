<?php

App::uses('AppModel', 'Model');

/**
 * GroupSubject Model
 *
 * @property GroupSubSubject $GroupSubSubject
 * @property CollegeGroupSubject $CollegeGroupSubject
 */
class GroupSubject extends AppModel {

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
                'message' => 'Group Subject name should not be empty',
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+=;:&012456789]+$/',
                'message' => 'Group Subject name should be characters.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This Group Subject name already exist'
            ),
        ),
        'course_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Course should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Course should be numeric',
            ),
//            'checkcourse'=>array(
//                'rule'=>array('checkcourse','course_id'),
//                'message'=>'',
//            ),
        ),
    );

//    function checkcourse($data,$field){
//        print_r($this->data['GroupSubject']['GroupSubSubject']); 
//        exit;
//    }
    
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'CollegeGroupSubject' => array(
            'className' => 'CollegeGroupSubject',
            'foreignKey' => 'group_subjects_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public $belongsTo = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}
