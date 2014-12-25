<?php

App::uses('AppController', 'Controller');

/**
 * States Controller
 *
 * @property State $State
 */
class StatesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Js');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->State->recursive = 0;
        $this->set('states', $this->paginate());
        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->State->exists($id)) {
            throw new NotFoundException(__('Invalid state'));
        }
        $options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
        $stateData = $this->State->find('first', $options);
        $this->loadModel('User');
        $createUserId = $stateData['State']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $stateData['State']['modified_by'];
        $stateData['State']['created'] = date("d-m-Y", strtotime($stateData['State']['created']));
        $stateData['State']['modified'] = date("d-m-Y", strtotime($stateData['State']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('state', $stateData);
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
            $this->State->create();
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['State']['created_by'] = $userid;
            if ($this->State->save($this->request->data)) {
                $this->Session->setFlash('The state has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The state could not be saved. Please, try again.'));
            }
        }
        $countries = $this->State->Country->find('list');
        $this->set(compact('countries'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->State->exists($id)) {
            throw new NotFoundException(__('Invalid state'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['State']['modified_by'] = $userid;
            if ($this->State->save($this->request->data)) {
                $this->Session->setFlash('The state has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The state could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
            $this->request->data = $this->State->find('first', $options);
        }
        $countries = $this->State->Country->find('list');
        $this->set(compact('countries'));
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
        $this->State->id = $id;
        if (!$this->State->exists()) {
            throw new NotFoundException(__('Invalid state'));
        }
        try {
        $this->request->onlyAllow('post', 'delete');
        if ($this->State->delete()) {
            $this->Session->setFlash('State deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('This state has been used for other related records. So it can not be deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
