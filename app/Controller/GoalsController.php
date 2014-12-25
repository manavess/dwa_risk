<?php

App::uses('AppController', 'Controller');

/**
 * Goals Controller
 *
 * @property Goal $Goal
 */
class GoalsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');

    /**
     * index method
     *
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalgoalhtml');
    }

    public function index() {
        $this->Goal->recursive = 0;
        $this->set('goals', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Goal->exists($id)) {
            throw new NotFoundException(__('Invalid goal'));
        }
        $options = array('conditions' => array('Goal.' . $this->Goal->primaryKey => $id));
        $goalData = $this->Goal->find('first', $options);
        $this->loadModel('User');
        $createUserId = $goalData['Goal']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $goalData['Goal']['modified_by'];
        $goalData['Goal']['created'] = date("d-m-Y", strtotime($goalData['Goal']['created']));
        $goalData['Goal']['modified'] = date("d-m-Y", strtotime($goalData['Goal']['modified']));
        $goalData['Goal']['goal'] = strip_tags($goalData['Goal']['goal']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('goal', $goalData);
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
            //$this->request->data['Goal']['goal'] = strip_tags($this->request->data['Goal']['goal']);
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Goal']['created_by'] = $userid;
            $this->request->data['Goal']['goal'] = trim($this->request->data['Goal']['goal']);
            $this->Goal->create();
            if ($this->Goal->save($this->request->data)) {
                $this->Session->setFlash('The goal has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The goal could not be saved. Please, try again.'));
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
        if (!$this->Goal->exists($id)) {
            throw new NotFoundException(__('Invalid goal'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //$this->request->data['Goal']['goal'] = strip_tags($this->request->data['Goal']['goal']);
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Goal']['modified_by'] = $userid;
            $this->request->data['Goal']['goal'] = trim($this->request->data['Goal']['goal']);
            if ($this->Goal->save($this->request->data)) {
                $this->Session->setFlash('The goal has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The goal could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Goal.' . $this->Goal->primaryKey => $id));
            $this->request->data = $this->Goal->find('first', $options);
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
        $this->Goal->id = $id;
        if (!$this->Goal->exists()) {
            throw new NotFoundException(__('Invalid goal'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Goal->delete()) {
            $this->Session->setFlash('Goal deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Goal was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function generalgoalhtml() {
        $this->set('goal', $this->Goal->find('first'));
    }

}
