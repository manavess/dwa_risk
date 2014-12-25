<?php

App::uses('AppModel', 'Model');

/**
 * ContactForm Model
 *
 */
class ContactForm extends AppModel {

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
                'message' => 'Name should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                'message' => 'Name should be character only.',
            )
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email id should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'email' => array(
                'rule' => array('email'),
                //'required' => true,
                'message' => 'Email id should be valid',
            ),
        ),
        'phone' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Phone number should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Mobile number should be numeric',
            ),
        ),
        'subject' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Subject should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alpha' => array(
                'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                'message' => 'Subject should be character only.',
            )
        ),
        'comment' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Comment should not be empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

}
