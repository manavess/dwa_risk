<?php

App::uses('AppModel', 'Model');

/**
 * SubMenu Model
 *
 * @property Menu $Menu
 */
class SubMenu extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Sub Menu name should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                    'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;:&,]+$/',
                               'message' => 'Sub Menu name should be characters.'
                         )
		),
                'menu_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Select Menu',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'url should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'alpha'=>array(
                               'rule' => '/^[^%\*@!+;:&,]+$/',
                               'message' => 'Url should be characters.'
                         )   
		),
        
		
	);


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Menu' => array(
            'className' => 'Menu',
            'foreignKey' => 'menu_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasMany = array(
        'MenuAction' => array(
            'className' => 'MenuAction',
            'foreignKey' => 'sub_menu_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'GroupSubMenu' => array(
            'className' => 'GroupSubMenu',
            'foreignKey' => 'sub_menu_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
