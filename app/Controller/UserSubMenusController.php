<?php

App::uses('AppController', 'Controller');

/**
 * UserSubMenus Controller
 *
 * @property UserSubMenu $UserSubMenu
 */
class UserSubMenusController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->UserSubMenu->recursive = 0;
        $this->set('userSubMenus', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UserSubMenu->exists($id)) {
            throw new NotFoundException(__('Invalid user sub menu'));
        }
        $options = array('conditions' => array('UserSubMenu.' . $this->UserSubMenu->primaryKey => $id));
        $userSubMenuData = $this->UserSubMenu->find('first', $options);
        $this->loadModel('User');
        $createUserId = $userSubMenuData['UserSubMenu']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $userSubMenuData['UserSubMenu']['modified_by'];
        $userSubMenuData['UserSubMenu']['created'] = date("d-m-Y", strtotime($userSubMenuData['UserSubMenu']['created']));
        $userSubMenuData['UserSubMenu']['modified'] = date("d-m-Y", strtotime($userSubMenuData['UserSubMenu']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('userSubMenu', $userSubMenuData);
        $this->set('createuser', $createUserData['User']['username']);
        $this->set('modifyuser', $modifyUserData['User']['username']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $perarray = array();
            //pr($this->request->data);
            //echo $this->request->data['UserSubMenu']['user_id'];
            $userid = $this->Session->read('Auth.User.id');
            foreach ($this->request->data['UserSubMenu']['menu_id'] as $menu) {
                $menus = $this->UserSubMenu->Menu->read(null, $menu);
                if (empty($menus['SubMenu'])) {
                    $per = array('menu_id' => $menu, 'menu_action_id' => '', 'user_id' => $this->request->data['UserSubMenu']['user_id'],'created_by'=>$userid);
                    array_push($perarray, $per);
                }
            }
            foreach ($this->request->data['UserSubMenu']['subMenu_id'] as $submenu) {
                $submenus = $this->UserSubMenu->SubMenu->read(null, $submenu);
                if (empty($submenu['MenuAction'])) {
                    $per = array('sub_menu_id' => $submenu, 'menu_action_id' => '', 'menu_id' => $submenus['Menu']['id'], 'group_id' => $this->request->data['UserSubMenu']['user_id'],'created_by'=>$userid);
                    array_push($perarray, $per);
                }
            }
            
            foreach ($this->request->data['UserSubMenu']['MenuAction_id'] as $menuaction) {
                $this->UserSubMenu->SubMenu->MenuAction->recursive = 2;
                $menuactions = $this->UserSubMenu->SubMenu->MenuAction->read(null, $menuaction);
                $per = array('sub_menu_id' => $menuactions['SubMenu']['id'], 'menu_action_id' => $menuaction, 'menu_id' => $menuactions['SubMenu']['Menu']['id'], 'user_id' => $this->request->data['UserSubMenu']['user_id'],'created_by'=>$userid);
                array_push($perarray, $per);
            }
            $this->UserSubMenu->deleteAll(array('user_id' => $this->request->data['UserSubMenu']['user_id']));


                        
            $this->UserSubMenu->create();
            if ($this->UserSubMenu->saveAll($perarray)) {
                $this->Session->setFlash('The user sub menu has been saved','default',array('class'=>'successmessage'));
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user sub menu could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserSubMenu->User->find('list');
        $this->UserSubMenu->SubMenu->Menu->recursive = 1;
        $subMenus = $this->UserSubMenu->SubMenu->Menu->find('all');
        $this->set(compact('users', 'subMenus'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->UserSubMenu->exists($id)) {
            throw new NotFoundException(__('Invalid user sub menu'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['UserSubMenu']['modified_by'] = $userid;
            if ($this->UserSubMenu->save($this->request->data)) {
                $this->Session->setFlash('The user sub menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user sub menu could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UserSubMenu.' . $this->UserSubMenu->primaryKey => $id));
            $this->request->data = $this->UserSubMenu->find('first', $options);
        }
        $users = $this->UserSubMenu->User->find('list');
        $subMenus = $this->UserSubMenu->SubMenu->find('list');
        $this->set(compact('users', 'subMenus'));
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
        $this->UserSubMenu->id = $id;
        if (!$this->UserSubMenu->exists()) {
            throw new NotFoundException(__('Invalid user sub menu'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->UserSubMenu->delete()) {
            $this->Session->setFlash(__('User sub menu deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User sub menu was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function getmenusubmenulist() {
        if ($this->request->is('ajax')) {
            $group_id = $this->request->data['id'];
            $this->UserSubMenu->SubMenu->Menu->recursive = 2;
            $subMenus = $this->UserSubMenu->SubMenu->Menu->find('all');
            $permission = $this->UserSubMenu->find('all', array('conditions' => array('user_id' => $group_id)));
            $result = array('Menus' => $subMenus, 'Permission' => $permission);
            echo json_encode($result);
            die;
        }
    }

}
