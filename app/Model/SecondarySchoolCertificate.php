<?php

App::uses('AppModel', 'Model');

/**
 * SecondarySchoolCertificate Model
 *
 */
class SecondarySchoolCertificate extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'certificate_number';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'certificate_number' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Certificate Number should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Certificate Number should be numeric',
				
			),
        ),
        'certificate_type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Certificate type should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;."|:&,012456789]+$/', 
                               'message' => 'Certificate type should be characters.'
                         ),
        ),
        'certificate_date' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Certificate date should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'date_of_birth' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Date of birth should not be empty',
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
				'rule' => array('numeric'),
				'message' => 'Year should be numeric',
				
			),
        ),
    );

}
