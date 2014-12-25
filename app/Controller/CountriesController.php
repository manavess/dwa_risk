<?php

App::uses('AppController', 'Controller');

/**
 * Countries Controller
 *
 * @property Country $Country
 */
class CountriesController extends AppController {

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
        $this->Country->recursive = 0;
        $this->set('countries', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Country->exists($id)) {
            throw new NotFoundException(__('Invalid country'));
        }
        $options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
        $countryData = $this->Country->find('first', $options);
        $this->loadModel('User');
        $createUserId = $countryData['Country']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $countryData['Country']['modified_by'];
        $countryData['Country']['created'] = date("d-m-Y", strtotime($countryData['Country']['created']));
        $countryData['Country']['modified'] = date("d-m-Y", strtotime($countryData['Country']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('country', $countryData);
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
            $this->request->data['Country']['created_by'] = $userid;
            $this->Country->create();
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash('The country has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The country could not be saved. Please, try again.'));
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
        if (!$this->Country->exists($id)) {
            throw new NotFoundException(__('Invalid country'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');

	    $this->request->data['Country']['modified_by'] = $userid;
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash('The country has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The country could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
            $this->request->data = $this->Country->find('first', $options);
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
        $this->Country->id = $id;
        if (!$this->Country->exists()) {
            throw new NotFoundException(__('Invalid country'));
        }
         try {
            $this->request->onlyAllow('post', 'delete');
            if ($this->Country->delete()) {
                $this->Session->setFlash('Country deleted','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            }
    }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('This country has been used for other related records. So it can not be deleted'));	
        $this->redirect(array('action' => 'index'));
    }

}
