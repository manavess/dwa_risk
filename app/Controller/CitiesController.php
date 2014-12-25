<?php

App::uses('AppController', 'Controller');

/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->City->recursive = 0;
        $this->set('cities', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->City->exists($id)) {
            throw new NotFoundException(__('Invalid city'));
        }
        $options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
        $cityData = $this->City->find('first', $options);
        $this->loadModel('User');
        $createUserId = $cityData['City']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $cityData['City']['modified_by'];
        $cityData['City']['created'] = date("d-m-Y", strtotime($cityData['City']['created']));
        $cityData['City']['modified'] = date("d-m-Y", strtotime($cityData['City']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('city', $cityData);
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
            $this->request->data['City']['created_by'] = $userid;
            $this->City->create();
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash('The city has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The city could not be saved. Please, try again.','default',array('class'=>'successmessage')));
            }
        }
        $states = $this->City->State->find('list');
        $this->set(compact('states'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->City->exists($id)) {
            throw new NotFoundException(__('Invalid city'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['City']['modified_by'] = $userid;
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash('The city has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The city could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
            $this->request->data = $this->City->find('first', $options);
        }
        $states = $this->City->State->find('list');
        $this->set(compact('states'));
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
        $this->City->id = $id;
        if (!$this->City->exists()) {
            throw new NotFoundException(__('Invalid city'));
        }
        try {
        $this->request->onlyAllow('post', 'delete');
        if ($this->City->delete()) {
            $this->Session->setFlash('City deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('This city has been used for other related records. So it can not be deleted'));	
        $this->redirect(array('action' => 'index'));
    }

}
