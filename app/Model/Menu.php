<?php

App::uses('AppModel', 'Model');

/**
 * Menu Model
 *
 */
class Menu extends AppModel {

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
				'message' => 'Menu name should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;."|:&,012456789]+$/',
                               'message' => 'Menu name should be characters.'
                         )                    
		),
                'url' => array(
                    'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Url should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			      'alpha'=>array(
                               'rule' => '/^[^%\*@!+=;:&,]+$/',
                               'message' => 'Url should be characters.'
                         ),
                    
		),       
                
		
	);
    
    public $hasMany = array(		
		'SubMenu' => array(
			'className' => 'SubMenu',
			'foreignKey' => 'menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
