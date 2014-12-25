<?php

App::uses('AppModel', 'Model');

/**
 * College Model
 *
 * @property City $City
 * @property State $State
 * @property University $University
 * @property CollegeGroupSubject $CollegeGroupSubject
 */
class College extends AppModel {

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
        'college_code' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'College code should not be empty',
            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'College code should be alphanumeric characters',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => ' College code you entered already exist',
            ),
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'College name should not be empty',
            ),
            'alpha' => array(
                'rule' => '/^[^%#*@!+=;:&,012456789]+$/',
                'message' => 'College name should be characters.'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'College name should not exceed 100 characters'
            ),
        ),
        'address1' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'College address should not be empty',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters'
            ),
        ),
        'address2' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters',
                'allowEmpty' => true
            ),
        ),
        'address3' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Address should not exceed 100 characters',
                'allowEmpty' => true
            ),
        ),
        'city_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'City Name should not be empty',
            ),
        ),
        'state_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'State name should not be empty',
            ),
        ),
        'university_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'University name should not be empty',
            ),
        ),
        'contact_person' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Contact Person should not be empty',
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                'message' => 'Contact Person name should be characters.'
            )
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email should not be empty',
            ),
            'email' => array(
                'rule' => array('email'),
                'required' => true,
                'message' => 'Email id should be valid',
            ),
        ),
        'phone_no' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Phone number should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Phone number should be numeric',
            ),
            'between' => array(
                'rule' => array('between', 10, 15),
                'message' => 'Phone number should be between 10 to 15 digits'
            ),
        ),
        'mobile_no' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Mobile number should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Mobile number should be numeric',
            ),
            'between' => array(
                'rule' => array('between', 10, 15),
                'message' => 'Mobile number should be between 10 to 15 digits'
            ),
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
        'no_of_seats' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Number of seats should be number',
            ),
        ),
        'affilated_from' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'The affilated from date should not be empty',
            ),
            'date' => array(
                'rule' => array('date'),
                'message' => 'Please select a valid date',
            ),
        ),
        'affilated_to' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Please select a valid date',
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'The affilated to date should not be empty',
            ),
        ),
        'affilated_from' => array(
            'startBeforeEnd' => array(
                'rule' => array('startBeforeEnd', 'affilated_to'),
                'message' => 'The affilated from must be before the affilated to.'
            ),
            'futureDate' => array(
                'rule' => array('futureDate', 'affilated_from'),
                'message' => 'The affilated from can not be greater than today date.'
            ),
        ),
            /* 'pincode'=>array(
              'alphaNumeric' => array(
              'rule' => array('alphaNumeric'),
              'message' => 'Pincode should be alphanumeric characters',
              ),
              ), */

            /* 'pincode'=>array(
              'alphaNumeric' => array(
              'rule' => array('alphaNumeric'),
              'message' => 'Pincode should be alphanumeric characters',
              ),
              ), */
    );

    function startBeforeEnd($field = array(), $compare_field = null) {
        foreach ($field as $key => $value) {
            /*  $v1 = $value;
              $v2 = $this->data[$this->name][ $compare_field ]; */
            $v1 = strtotime($value);
            $v2 = strtotime($this->data[$this->name][$compare_field]);
            if ($v1 >= $v2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }

    function futureDate($data, $field) {
        if (strtotime($data[$field]) > time()) {
            return FALSE;
        }
        return TRUE;
    }

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
        ),
        'University' => array(
            'className' => 'University',
            'foreignKey' => 'university_id',
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
        'CollegeGroupSubject' => array(
            'className' => 'CollegeGroupSubject',
            'foreignKey' => 'college_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'StudentPreferedColleges' => array(
            'className' => 'StudentPreferedColleges',
            'foreignKey' => 'college_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'StudentAlotment' => array(
            'className' => 'StudentAlotment',
            'foreignKey' => 'college_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
