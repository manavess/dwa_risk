<?php

App::uses('AppController', 'Controller');

/**
 * DirectorWords Controller
 *
 * @property DirectorWord $DirectorWord
 */
class DirectorWordsController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');


	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generaldirectorwordhtml');
        
    }
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->DirectorWord->recursive = 0;
        $this->set('directorWords', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DirectorWord->exists($id)) {
            throw new NotFoundException(__('Invalid director word'));
        }
        $options = array('conditions' => array('DirectorWord.' . $this->DirectorWord->primaryKey => $id));
        $directorWordData = $this->DirectorWord->find('first', $options);
        $this->loadModel('User');
        $createUserId = $directorWordData['DirectorWord']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $directorWordData['DirectorWord']['modified_by'];
        $directorWordData['DirectorWord']['created'] = date("d-m-Y", strtotime($directorWordData['DirectorWord']['created']));
        $directorWordData['DirectorWord']['modified'] = date("d-m-Y", strtotime($directorWordData['DirectorWord']['modified']));
        $directorWordData['DirectorWord']['director_word'] = strip_tags($directorWordData['DirectorWord']['director_word']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('directorWord', $directorWordData);
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
            $this->request->data['DirectorWord']['created_by'] = $userid;
            $this->request->data['DirectorWord']['director_word'] = trim($this->request->data['DirectorWord']['director_word']);
            $this->DirectorWord->create();
            if ($this->DirectorWord->save($this->request->data)) {
                $this->Session->setFlash('The director word has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The director word could not be saved. Please, try again.'));
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
        if (!$this->DirectorWord->exists($id)) {
            throw new NotFoundException(__('Invalid director word'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['DirectorWord']['modified_by'] = $userid;
            $this->request->data['DirectorWord']['director_word'] = trim($this->request->data['DirectorWord']['director_word']);
            if ($this->DirectorWord->save($this->request->data)) {
                $this->Session->setFlash('The director word has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The director word could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('DirectorWord.' . $this->DirectorWord->primaryKey => $id));
            $this->request->data = $this->DirectorWord->find('first', $options);
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
        $this->DirectorWord->id = $id;
        if (!$this->DirectorWord->exists()) {
            throw new NotFoundException(__('Invalid director word'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->DirectorWord->delete()) {
            $this->Session->setFlash('Director word deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Director word was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function generaldirectorwordhtml() {
        $this->set('directorWord', $this->DirectorWord->find('first'));
    }
    
}
