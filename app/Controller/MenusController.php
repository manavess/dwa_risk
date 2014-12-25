<?php

App::uses('AppController', 'Controller');

/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('guestmenulist','getmenu');
    }

    public function index() {
        $this->Menu->recursive = 0;
        $this->set('menus', $this->paginate());
    }

    public function menulist() {
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        return $this->Menu->find('all', array('conditions' => array('require_login' => 'Y', 'status' => 'Y'), 'order' => 'Menu.id ASC'));
    }

    public function guestmenulist() {
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        return $this->Menu->find('all', array('conditions' => array('require_login' => 'N', 'status' => 'Y'), 'order' => 'Menu.id ASC'));
    }

    public function getmenu($menu) {
        
         $menuId = array();
        if (empty($this->request->params['requested'])) {
            throw new ForbiddenException();
        }
        $menu = strtolower($menu);
        $menulist = $this->Menu->find('all', array('conditions' => array('lower(url)' => $menu)));
        if (empty($menulist)) {
            $menulist = $this->Menu->SubMenu->find('all', array('conditions' => array('lower(SubMenu.url)' => $menu)));
            if (!empty($menulist))
                foreach ($menulist as $selmenu)
                    $menuId[] = $selmenu["SubMenu"]['menu_id'];
            else
                $menuId = array();
        }
        else
            foreach ($menulist as $selmenu)
                $menuId[] = $menulist['Menu']['id'];
//pr($menuId);die;
        return $menuId;
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Menu->exists($id)) {
            throw new NotFoundException(__('Invalid menu'));
        }
        $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
        $menuData = $this->Menu->find('first', $options);
        $this->loadModel('User');
        $createUserId = $menuData['Menu']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $menuData['Menu']['modified_by'];
        $menuData['Menu']['created'] = date("d-m-Y", strtotime($menuData['Menu']['created']));
        $menuData['Menu']['modified'] = date("d-m-Y", strtotime($menuData['Menu']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('menu', $menuData);
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
            $this->request->data['Menu']['created_by'] = $userid;
            $this->Menu->create();
            $this->Menu->set($this->request->data);        
        if ($this->Menu->validates()) {
            if ($this->Menu->save($this->request->data)) {
                $this->Session->setFlash('The menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
            }
        } else {        
            $errors = $this->Menu->validationErrors;
        }    
            
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Menu->exists($id)) {
            throw new NotFoundException(__('Invalid menu'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Menu']['modified_by'] = $userid;
           $this->Menu->set($this->request->data);        
        if ($this->Menu->validates()) {  
            if ($this->Menu->save($this->request->data)) {
                $this->Session->setFlash('The menu has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
            }
        } else {
                $errors = $this->Menu->validationErrors;
        }   
            
        } else {
            $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
            $this->request->data = $this->Menu->find('first', $options);
        }
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
        $this->Menu->id = $id;
        if (!$this->Menu->exists()) {
            throw new NotFoundException(__('Invalid menu'));
        }
        try{
        $this->request->onlyAllow('post', 'delete');
        if ($this->Menu->delete()) {
            $this->Session->setFlash('Menu deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        }catch( Exception $e ){     }
        $this->Session->setFlash(__('Menu cannot be deleted because it has been used at various Submenus'));
        $this->redirect(array('action' => 'index'));
    }

}
