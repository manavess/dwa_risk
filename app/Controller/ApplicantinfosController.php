<?php

App::uses('AppController', 'Controller');

/**
 * Applicantinfos Controller
 *
 * @property Applicantinfo $Applicantinfo
 */
class ApplicantinfosController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');


	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalapplicantinfohtml');
        
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Applicantinfo->recursive = 0;
        $this->set('applicantinfos', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Applicantinfo->exists($id)) {
            throw new NotFoundException(__('Invalid applicantinfo'));
        }
        $options = array('conditions' => array('Applicantinfo.' . $this->Applicantinfo->primaryKey => $id));
        $applicantinfoData = $this->Applicantinfo->find('first', $options);
        $this->loadModel('User');
        $createUserId = $applicantinfoData['Applicantinfo']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $applicantinfoData['Applicantinfo']['modified_by'];
        $applicantinfoData['Applicantinfo']['created'] = date("d-m-Y", strtotime($applicantinfoData['Applicantinfo']['created']));
        $applicantinfoData['Applicantinfo']['modified'] = date("d-m-Y", strtotime($applicantinfoData['Applicantinfo']['modified']));
        $applicantinfoData['Applicantinfo']['pagetext'] = strip_tags($applicantinfoData['Applicantinfo']['pagetext']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('applicantinfo', $applicantinfoData);
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
            $this->request->data['Applicantinfo']['created_by'] = $userid;
            $this->request->data['Applicantinfo']['pagetext'] = trim($this->request->data['Applicantinfo']['pagetext']);
            $this->Applicantinfo->create();
            if ($this->Applicantinfo->save($this->request->data)) {
                $this->Session->setFlash('The applicantinfo has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The applicantinfo could not be saved. Please, try again.'));
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
        if (!$this->Applicantinfo->exists($id)) {
            throw new NotFoundException(__('Invalid applicantinfo'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Applicantinfo']['modified_by'] = $userid;
            $this->request->data['Applicantinfo']['pagetext'] = trim($this->request->data['Applicantinfo']['pagetext']);
            if ($this->Applicantinfo->save($this->request->data)) {
                $this->Session->setFlash('The applicantinfo has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The applicantinfo could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Applicantinfo.' . $this->Applicantinfo->primaryKey => $id));
            $this->request->data = $this->Applicantinfo->find('first', $options);
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
        $this->Applicantinfo->id = $id;
        if (!$this->Applicantinfo->exists()) {
            throw new NotFoundException(__('Invalid applicantinfo'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Applicantinfo->delete()) {
            $this->Session->setFlash('Applicantinfo deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Applicantinfo was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function generalapplicantinfohtml() {
        $this->set('applicantinfo', $this->Applicantinfo->find('first'));
    }

}
