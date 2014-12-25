<?php

App::uses('AppController', 'Controller');

/**
 * SubMenus Controller
 *
 * @property SubMenu $SubMenu
 */
class SubMenusController extends AppController {

     public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('guestsubmenulist');
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->SubMenu->recursive = 0;
        $this->set('subMenus', $this->paginate());
    }

    public function submenulist($menuid) {
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        return $this->SubMenu->find('all', array('conditions' => array('menu_id' => $menuid, 'SubMenu.status' => 'Y'), 'order' => 'SubMenu.id ASC', 'limit' => 15));
    }
    
    
     public function guestsubmenulist($menuid) {
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        return $this->SubMenu->find('all', array('conditions' => array('menu_id' => $menuid,'SubMenu.require_login'=>'N', 'SubMenu.status' => 'Y'), 'order' => 'SubMenu.id ASC', 'limit' => 15));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->SubMenu->exists($id)) {
            throw new NotFoundException(__('Invalid sub menu'));
        }
        $options = array('conditions' => array('SubMenu.' . $this->SubMenu->primaryKey => $id));
        $subMenuData = $this->SubMenu->find('first', $options);
        $this->loadModel('User');
        $createUserId = $subMenuData['SubMenu']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $subMenuData['SubMenu']['modified_by'];
        $subMenuData['SubMenu']['created'] = date("d-m-Y", strtotime($subMenuData['SubMenu']['created']));
        $subMenuData['SubMenu']['modified'] = date("d-m-Y", strtotime($subMenuData['SubMenu']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('subMenu', $subMenuData);
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
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['SubMenu']['created_by'] = $userid;
            $this->SubMenu->create();
           $this->SubMenu->set($this->request->data);        
        if ($this->SubMenu->validates()) {  
            if ($this->SubMenu->save($this->request->data)) {
                $this->Session->setFlash('The sub menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sub menu could not be saved. Please, try again.'));
            }
        } else {
            $errors = $this->SubMenu->validationErrors;
        }       
            
        }
        $menus = $this->SubMenu->Menu->find('list');
        $this->set(compact('menus'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->SubMenu->exists($id)) {
            throw new NotFoundException(__('Invalid sub menu'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['SubMenu']['modified_by'] = $userid;
            $this->SubMenu->set($this->request->data);        
        if ($this->SubMenu->validates()) {  
            if ($this->SubMenu->save($this->request->data)) {
                $this->Session->setFlash('The sub menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sub menu could not be saved. Please, try again.'));
            }
        } else {
                $errors = $this->SubMenu->validationErrors;
        }           
            
        } else {
            $options = array('conditions' => array('SubMenu.' . $this->SubMenu->primaryKey => $id));
            $this->request->data = $this->SubMenu->find('first', $options);
        }
        $menus = $this->SubMenu->Menu->find('list');
        $this->set(compact('menus'));
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
        $this->SubMenu->id = $id;
        if (!$this->SubMenu->exists()) {
            throw new NotFoundException(__('Invalid sub menu'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->SubMenu->delete()) {
            $this->Session->setFlash('Sub menu deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Sub menu was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
