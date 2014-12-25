<?php
App::uses('AppModel', 'Model');
/**
 * City Model
 *
 * @property State $State
 * @property College $College
 * @property University $University
 */
class City extends AppModel {

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
            'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'City name should not be empty',

				
               ),
               'alpha'=>array(
				'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/', 
				'message' => 'City name should be only Alphabetical characters.'
				),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This City name already exist'
				),
			

            ),
                     
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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
			'foreignKey' => 'city_id',
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
		'University' => array(
			'className' => 'University',
			'foreignKey' => 'city_id',
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
