<?php

App::uses('AppModel', 'Model');

/**
 * UserSubMenu Model
 *
 * @property User $User
 * @property SubMenu $SubMenu
 */
class UserSubMenu extends AppModel {
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'SubMenu' => array(
            'className' => 'SubMenu',
            'foreignKey' => 'sub_menu_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Menu' => array(
            'className' => 'Menu',
            'foreignKey' => 'menu_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'MenuAction' => array(
            'className' => 'MenuAction',
            'foreignKey' => 'menu_action_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
