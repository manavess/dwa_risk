<?php

App::uses('AppModel', 'Model');

/**
 * Subject Model
 *
 */
class Subject extends AppModel {

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
        'subject_code' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Subject code should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Subject code should be Alphabets and number only',
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Subject code you entered already exist'
            ),
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Subject name should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                'message' => 'Subject name should be characters.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This Subject name already exist'
            ),
        ),
    );

}
