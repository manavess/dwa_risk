<?php

App::uses('AppController', 'Controller');

/**
 * ContactDetails Controller
 *
 * @property ContactDetail $ContactDetail
 */
class ContactDetailsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');


	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalcontactdetailhtml');
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->ContactDetail->recursive = 0;
        $this->set('contactDetails', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->ContactDetail->exists($id)) {
            throw new NotFoundException(__('Invalid Contact detail'));
        }
        $options = array('conditions' => array('ContactDetail.' . $this->ContactDetail->primaryKey => $id));
        $contactData = $this->ContactDetail->find('first', $options);
        $this->loadModel('User');
        $createUserId = $contactData['ContactDetail']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $contactData['ContactDetail']['modified_by'];
        $contactData['ContactDetail']['created'] = date("d-m-Y", strtotime($contactData['ContactDetail']['created']));
        $contactData['ContactDetail']['modified'] = date("d-m-Y", strtotime($contactData['ContactDetail']['modified']));
        $contactData['ContactDetail']['pagetext'] = strip_tags($contactData['ContactDetail']['pagetext']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('contactDetail', $contactData);
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
            $this->request->data['ContactDetail']['created_by'] = $userid;
            $this->request->data['ContactDetail']['pagetext'] = trim($this->request->data['ContactDetail']['pagetext']);
            $this->ContactDetail->create();
            if ($this->ContactDetail->save($this->request->data)) {
                $this->Session->setFlash('The Contact detail has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Contact detail could not be saved. Please, try again.'));
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
        if (!$this->ContactDetail->exists($id)) {
            throw new NotFoundException(__('Invalid Contact detail'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['ContactDetail']['created_by'] = $userid;
            $this->request->data['ContactDetail']['pagetext'] = trim($this->request->data['ContactDetail']['pagetext']);
            if ($this->ContactDetail->save($this->request->data)) {
                $this->Session->setFlash('The Contact detail has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Contact detail could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('ContactDetail.' . $this->ContactDetail->primaryKey => $id));
            $this->request->data = $this->ContactDetail->find('first', $options);
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
        $this->ContactDetail->id = $id;
        if (!$this->ContactDetail->exists()) {
            throw new NotFoundException(__('Invalid Contact detail'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ContactDetail->delete()) {
            $this->Session->setFlash('Contact deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Contact was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function contact_details() {
        $this->set('contactDetail', $this->ContactDetail->find('first'));
    }
    
    public function generalcontactdetailhtml() {
        $this->set('contact', $this->ContactDetail->find('first'));
    }

}
