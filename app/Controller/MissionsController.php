<?php

App::uses('AppController', 'Controller');

/**
 * Missions Controller
 *
 * @property Mission $Mission
 */
class MissionsController extends AppController {

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
        $this->Auth->allow('generalmissionhtml');
    }

    public function index() {
        $this->Mission->recursive = 0;
        $this->set('missions', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Mission->exists($id)) {
            throw new NotFoundException(__('Invalid mission'));
        }
        $options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
        $missionData = $this->Mission->find('first', $options);
        $this->loadModel('User');
        $createUserId = $missionData['Mission']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $missionData['Mission']['modified_by'];
        $missionData['Mission']['created'] = date("d-m-Y", strtotime($missionData['Mission']['created']));
        $missionData['Mission']['modified'] = date("d-m-Y", strtotime($missionData['Mission']['modified']));
        $missionData['Mission']['mission'] = strip_tags($missionData['Mission']['mission']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('mission', $missionData);
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
            $this->request->data['Mission']['created_by'] = $userid;
            $this->request->data['Mission']['mission'] = trim($this->request->data['Mission']['mission']);
            $this->request->data['Mission']['mission']=trim($this->request->data['Mission']['mission']);
            $this->Mission->create();
            
            if ($this->Mission->save($this->request->data)) {
                $this->Session->setFlash('The mission has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
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
        if (!$this->Mission->exists($id)) {
            throw new NotFoundException(__('Invalid mission'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Mission']['modified_by'] = $userid;
            $this->request->data['Mission']['mission'] = trim($this->request->data['Mission']['mission']);
            $this->request->data['Mission']['mission']=trim($this->request->data['Mission']['mission']);
            if ($this->Mission->save($this->request->data)) {
                $this->Session->setFlash('The mission has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The mission could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Mission.' . $this->Mission->primaryKey => $id));
            $this->request->data = $this->Mission->find('first', $options);
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
        $this->Mission->id = $id;
        if (!$this->Mission->exists()) {
            throw new NotFoundException(__('Invalid mission'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Mission->delete()) {
            $this->Session->setFlash('Mission deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Mission was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function generalmissionhtml() {
        $this->set('mission', $this->Mission->find('first'));
    }

}
