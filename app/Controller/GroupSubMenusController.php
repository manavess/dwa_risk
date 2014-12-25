<?php

App::uses('AppController', 'Controller');

/**
 * GroupSubMenus Controller
 *
 * @property GroupSubMenu $GroupSubMenu
 */
class GroupSubMenusController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->GroupSubMenu->recursive = 0;
        $this->set('groupSubMenus', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->GroupSubMenu->exists($id)) {
            throw new NotFoundException(__('Invalid group sub menu'));
        }
        $options = array('conditions' => array('GroupSubMenu.' . $this->GroupSubMenu->primaryKey => $id));
        $groupSubMenuData = $this->GroupSubMenu->find('first', $options);
        $this->loadModel('User');
        $createUserId = $groupSubMenuData['GroupSubMenu']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $groupSubMenuData['GroupSubMenu']['modified_by'];
        $groupSubMenuData['GroupSubMenu']['created'] = date("d-m-Y", strtotime($groupSubMenuData['GroupSubMenu']['created']));
        $groupSubMenuData['GroupSubMenu']['modified'] = date("d-m-Y", strtotime($groupSubMenuData['GroupSubMenu']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('groupSubMenu', $groupSubMenuData);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        //pr($this->request->data);die;
        if ($this->request->is('post')) {
            $perarray = array();
            foreach ($this->request->data['GroupSubMenu']['menu_id'] as $menu) {
                $menus = $this->GroupSubMenu->Menu->read(null, $menu);
                if (empty($menus['SubMenu'])) {
                    $per = array('menu_id' => $menu, 'menu_action_id' => '', 'group_id' => $this->request->data['GroupSubMenu']['group_id']);
                    array_push($perarray, $per);
                }
            }
            foreach ($this->request->data['GroupSubMenu']['subMenu_id'] as $submenu) {
                $submenus = $this->GroupSubMenu->SubMenu->read(null, $submenu);
                if (empty($submenu['MenuAction'])) {
                    $per = array('sub_menu_id' => $submenu, 'menu_action_id' => '', 'menu_id' => $submenus['Menu']['id'], 'group_id' => $this->request->data['GroupSubMenu']['group_id']);
                    array_push($perarray, $per);
                }
            }
            //pr($perarray);die;
            foreach ($this->request->data['GroupSubMenu']['MenuAction_id'] as $menuaction) {
                $this->GroupSubMenu->SubMenu->MenuAction->recursive = 2;
                $menuactions = $this->GroupSubMenu->SubMenu->MenuAction->read(null, $menuaction);
                $per = array('sub_menu_id' => $menuactions['SubMenu']['id'], 'menu_action_id' => $menuaction, 'menu_id' => $menuactions['SubMenu']['Menu']['id'], 'group_id' => $this->request->data['GroupSubMenu']['group_id']);
                array_push($perarray, $per);
            }

            //$this->GroupSubMenu->Group->User->find(array('Group.id' => $this->request->data['GroupSubMenu']['group_id']));
            $this->GroupSubMenu->deleteAll(array('group_id' => $this->request->data['GroupSubMenu']['group_id']));
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['GroupSubMenu']['created_by'] = $userid;
            $this->GroupSubMenu->create();
            if ($this->GroupSubMenu->saveAll($perarray)) {
                $this->Session->setFlash('The group sub menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group sub menu could not be saved. Please, try again.'));
            }
        }
        $groups = $this->GroupSubMenu->Group->find('list');
        $this->GroupSubMenu->SubMenu->Menu->recursive = 1;
        $subMenus = $this->GroupSubMenu->SubMenu->Menu->find('all');
        $this->set(compact('groups', 'subMenus'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->GroupSubMenu->exists($id)) {
            throw new NotFoundException(__('Invalid group sub menu'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['GroupSubMenu']['modified_by'] = $userid;
            if ($this->GroupSubMenu->save($this->request->data)) {
                $this->Session->setFlash('The group sub menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group sub menu could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('GroupSubMenu.' . $this->GroupSubMenu->primaryKey => $id));
            $this->request->data = $this->GroupSubMenu->find('first', $options);
        }
        $groups = $this->GroupSubMenu->Group->find('list');
        $subMenus = $this->GroupSubMenu->SubMenu->find('list');
        $this->set(compact('groups', 'subMenus'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->GroupSubMenu->id = $id;
        if (!$this->GroupSubMenu->exists()) {
            throw new NotFoundException(__('Invalid group sub menu'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->GroupSubMenu->delete()) {
            $this->Session->setFlash('Group sub menu deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Group sub menu was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function getmenusubmenulist() {
        if ($this->request->is('ajax')) {
            $group_id = $this->request->data['id'];
            $this->GroupSubMenu->SubMenu->Menu->recursive = 2;
            $subMenus = $this->GroupSubMenu->SubMenu->Menu->find('all');
            $permission = $this->GroupSubMenu->find('all', array('conditions' => array('group_id' => $group_id)));
            $result = array('Menus' => $subMenus, 'Permission' => $permission);
            echo json_encode($result);
            die;
        }
    }

}

