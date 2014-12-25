<?php

App::uses('AppModel', 'Model');

/**
 * GroupSubMenu Model
 *
 * @property Group $Group
 * @property SubMenu $SubMenu
 */
class GroupSubMenu extends AppModel {
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
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

    public function afterSave($created = false) {
        //pr($this->data);die;
        $group_id = $this->data['GroupSubMenu']['group_id'];
        $grouppermission = $this->find('all', array('conditions' => array('group_id' => $group_id)));
        $users = ClassRegistry::init('User');
        $groupusers = $users->find('all', array('conditions' => array('group_id' => $group_id)));
        foreach ($groupusers as $groupuser) {
            $perarray = array();
            $usersSubMenu = ClassRegistry::init('UserSubMenu');            
            $usersSubMenu->deleteAll(array('user_id' => $groupuser['User']['id']));            
            foreach ($grouppermission as $per) {
                $per = array('menu_id' => $per['GroupSubMenu']['menu_id'], 'sub_menu_id' => $per['GroupSubMenu']['sub_menu_id'],'menu_action_id'=>$per['GroupSubMenu']['menu_action_id'], 'user_id' => $groupuser['User']['id']);
                array_push($perarray, $per);
            }
            $usersSubMenu->create(false);            
            $usersSubMenu->saveAll($perarray);
        }
        return false;
    }

}
