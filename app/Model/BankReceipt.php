<?php

App::uses('AppModel', 'Model');

/**
 * BankReceipt Model
 *
 * @property StudentRegistration $StudentRegistration
 */
class BankReceipt extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'receipt_no' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Receipt number should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Receipt number should be numeric',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'application_number' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Application number should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Application number should be numeric',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'admission_amount' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Admission amount should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Admission amount should be numeric',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'bank_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Bank name should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;"\.:&,012456789]+$/',
                               'message' => 'Bank name should be characters.'
                         ),
        ),
        'bank_receipt_date' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Bank receipt date should not be empty',
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
    /* public $belongsTo = array(
      'StudentRegistration' => array(
      'className' => 'StudentRegistration',
      'foreignKey' => 'application_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
      )
      ); */
}
