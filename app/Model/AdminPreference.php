<?php

App::uses('AppModel', 'Model');

/**
 * AdminPreference Model
 *
 */
class AdminPreference extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'cut_off_date' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Cut off date should not be empty',
            ),
            'date' => array(
                'rule' => array('date'),
                'message' => 'Please select a valid date',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'BackDate' => array(
                'rule' => array('BackDate', 'cut_off_date'),
                'message' => 'The Cut off date should be a date from now and this should not be today date or  previous than today.'),
        ),
        'no_of_college' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Number of college should not be empty',
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Number of college should be numeric',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'year' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Year should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Year should be numeric'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 4),
                'message' => 'Year in YYYY format'
            ),
            'minLength' => array(
                'rule' => array('minLength', 4),
                'message' => 'Year in YYYY format'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This Year already exist'
            )
        ),
        'domestic_application_fee' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Domestic application fee should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Domestic application fee should be numeric'
            )
        ),
        'international_application_fee' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Internation application fee should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Domestic application fee should be numeric'
            )
        ),
        'markslimit' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Marks limit should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Marks limit should be numeric',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 2),
                'message' => 'Marks limit should not exceed 2 characters'
            )
        ),
    );

    function BackDate($data, $field) {
        if (strtotime($data[$field]) < time()) {
            return FALSE;
        }
        return TRUE;
    }

}
