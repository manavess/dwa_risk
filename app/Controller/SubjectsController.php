<?php

App::uses('AppController', 'Controller');

/**
 * Subjects Controller
 *
 * @property Subject $Subject
 */
class SubjectsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js', 'Permission');
    public $components = array('Session');

    /**
     * index method
     *
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        
        parent::checkpagepermission();
    }

    public function index() {
        $this->Subject->recursive = 0;
        $this->set('subjects', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Subject->exists($id)) {
            throw new NotFoundException(__('Invalid subject'));
        }
        $options = array('conditions' => array('Subject.' . $this->Subject->primaryKey => $id));
        $subjectData = $this->Subject->find('first', $options);
        $this->loadModel('User');
        $createUserId = $subjectData['Subject']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $subjectData['Subject']['modified_by'];
        $subjectData['Subject']['created'] = date("d-m-Y", strtotime($subjectData['Subject']['created']));
        $subjectData['Subject']['modified'] = date("d-m-Y", strtotime($subjectData['Subject']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('subject', $subjectData);
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
        $this->request->data['Subject']['created'] =date('Y-m-d h:i:s'); 
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Subject']['created_by'] = $userid;
            $this->Subject->create();
            if ($this->Subject->save($this->request->data)) {
                $this->Session->setFlash('The subject has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The subject could not be saved. Please, try again.'));
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
        if (!$this->Subject->exists($id)) {
            throw new NotFoundException(__('Invalid subject'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
        	$this->request->data['Subject']['modified'] =date('Y-m-d h:i:s'); 
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Subject']['modified_by'] = $userid;
            if ($this->Subject->save($this->request->data)) {
                $this->Session->setFlash('The subject has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The subject could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Subject.' . $this->Subject->primaryKey => $id));
            $this->request->data = $this->Subject->find('first', $options);
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
        $this->Subject->id = $id;
        if (!$this->Subject->exists()) {
            throw new NotFoundException(__('Invalid subject'));
        }
        try {
        $this->request->onlyAllow('post', 'delete');
        if ($this->Subject->delete()) {
            $this->Session->setFlash('Subject deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('Subject cannot be deleted because it has been used at various sections'));
        $this->redirect(array('action' => 'index'));
        
    }

}

