<?php

App::uses('AppController', 'Controller');

/**
 * Visions Controller
 *
 * @property Vision $Vision
 */
class VisionsController extends AppController {

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
        $this->Auth->allow('generalvisionhtml');
    }

    public function index() {
        $this->Vision->recursive = 0;
        $this->set('visions', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Vision->exists($id)) {
            throw new NotFoundException(__('Invalid vision'));
        }
        $options = array('conditions' => array('Vision.' . $this->Vision->primaryKey => $id));
        $visionData = $this->Vision->find('first', $options);
        $this->loadModel('User');
        $createUserId = $visionData['Vision']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $visionData['Vision']['modified_by'];
        $visionData['Vision']['created'] = date("d-m-Y", strtotime($visionData['Vision']['created']));
        $visionData['Vision']['modified'] = date("d-m-Y", strtotime($visionData['Vision']['modified']));
        $visionData['Vision']['vision'] = strip_tags($visionData['Vision']['vision']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('vision', $visionData);
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
            $this->request->data['Vision']['created_by'] = $userid;
            $this->request->data['Vision']['vision'] = trim($this->request->data['Vision']['vision']);
            $this->Vision->create();
            if ($this->Vision->save($this->request->data)) {
                $this->Session->setFlash(__('The vision has been saved','default',array('class'=>'successmessage')));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vision could not be saved. Please, try again.'));
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
        if (!$this->Vision->exists($id)) {
            throw new NotFoundException(__('Invalid vision'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Vision']['modified_by'] = $userid;
            $this->request->data['Vision']['vision'] = trim($this->request->data['Vision']['vision']);
            if ($this->Vision->save($this->request->data)) {
                $this->Session->setFlash('The vision has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vision could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Vision.' . $this->Vision->primaryKey => $id));
            $this->request->data = $this->Vision->find('first', $options);
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
        $this->Vision->id = $id;
        if (!$this->Vision->exists()) {
            throw new NotFoundException(__('Invalid vision'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Vision->delete()) {
            $this->Session->setFlash(__('Vision deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Vision was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function generalvisionhtml() {
        $this->set('vision', $this->Vision->find('first'));
    }

}
