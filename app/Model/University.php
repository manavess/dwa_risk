<?php

App::uses('AppModel', 'Model');

/**
 * University Model
 *
 * @property City $City
 * @property State $State
 * @property Email $Email
 * @property College $College
 */
class University extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'code' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'University Name should not be empty',
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                'message' => 'University name should be characters.'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'University name should not exceed 100 characters'
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => ' University name you entered already exist',
            ),
        ),
        'address1' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'University Address should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            ),
        ),
        'address2' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'University Address should not be empty',
                'allowEmpty' => true,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            ),
        ),
        'address3' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'University Address should not be empty',
                'allowEmpty' => true,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            ),
        ),
        'city_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Select City',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'state_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Select State',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'contact_person' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Contact Person should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                'message' => 'Contact Person should be characters.'
            )
        ),
        'email_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email should be correct',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'contact_no' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Contact No. should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Contact No. should be numeric',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Contact number should be between 10 to 15 digits'
            ),
            'minLength' => array(
                'rule' => array('minLength', 10),
                'message' => 'Contact number should be between 10 to 15 digits'
            )
        ),
        'pincode' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'allowEmpty' => true,
                'message' => 'Pincode should be numeric',
            ),
        ),
        'website' => array(
            'rule' => 'url',
            'allowEmpty' => true,
            'message' => 'Please enter a valid Website URL',
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'College' => array(
            'className' => 'College',
            'foreignKey' => 'university_id',
            'dependent' => false,
            'conditions' => array('College.university_id' => 'University.id'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
