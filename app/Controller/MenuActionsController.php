<?php
App::uses('AppController', 'Controller');
/**
 * MenuActions Controller
 *
 * @property MenuAction $MenuAction
 */
class MenuActionsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->MenuAction->recursive = 0;
        $this->set('menuActions', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->MenuAction->exists($id)) {
            throw new NotFoundException(__('Invalid menu action'));
        }
        $options = array('conditions' => array('MenuAction.' . $this->MenuAction->primaryKey => $id));
        $menuActionData = $this->MenuAction->find('first', $options);
        $this->loadModel('User');
        $createUserId = $menuActionData['MenuAction']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $menuActionData['MenuAction']['modified_by'];
        $menuActionData['MenuAction']['created'] = date("d-m-Y", strtotime($menuActionData['MenuAction']['created']));
        $menuActionData['MenuAction']['modified'] = date("d-m-Y", strtotime($menuActionData['MenuAction']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('menuAction', $menuActionData);
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
            $this->request->data['MenuAction']['created_by'] = $userid;
            $this->MenuAction->create();
            if ($this->MenuAction->save($this->request->data)) {
                $this->Session->setFlash('The menu action has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The menu action could not be saved. Please, try again.'));
            }
        }
        $subMenus = $this->MenuAction->SubMenu->find('list');
        $this->set(compact('subMenus'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->MenuAction->exists($id)) {
            throw new NotFoundException(__('Invalid menu action'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['MenuAction']['modified_by'] = $userid;
            if ($this->MenuAction->save($this->request->data)) {
                $this->Session->setFlash('The menu action has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The menu action could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('MenuAction.' . $this->MenuAction->primaryKey => $id));
            $this->request->data = $this->MenuAction->find('first', $options);
        }
        $subMenus = $this->MenuAction->SubMenu->find('list');
        $this->set(compact('subMenus'));
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
        $this->MenuAction->id = $id;
        if (!$this->MenuAction->exists()) {
            throw new NotFoundException(__('Invalid menu action'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->MenuAction->delete()) {
            $this->Session->setFlash('Menu action deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Menu action was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
