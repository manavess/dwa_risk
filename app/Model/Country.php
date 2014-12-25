<?php

App::uses('AppModel', 'Model');

/**
 * Country Model
 *
 * @property State $State
 */
class Country extends AppModel {

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
        'id' => array(
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
                'message' => 'Country name should not be empty',
            
            ),

			'alpha'=>array(
				'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
				'message' => 'Country name should be characters.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This Country name already exist'
			),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'country_id',
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

}
