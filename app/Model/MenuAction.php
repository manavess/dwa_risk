<?php
App::uses('AppModel', 'Model');
/**
 * MenuAction Model
 *
 * @property SubMenu $SubMenu
 */
class MenuAction extends AppModel {

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
                    'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                               'message' => 'Name should be characters.'
                         )                    
		),
		'action' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Action should not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                    'alpha'=>array(
                               'rule' => '/^[^%#\/*@!+-=;:&,012456789]+$/',
                               'message' => 'Action should be characters.'
                         )                    
		),
		'sub_menu_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Select SubMenu',
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
	public $belongsTo = array(
		'SubMenu' => array(
			'className' => 'SubMenu',
			'foreignKey' => 'sub_menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
