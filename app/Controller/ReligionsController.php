<?php

App::uses('AppController', 'Controller');

/**
 * Religions Controller
 *
 * @property Religion $Religion
 */
class ReligionsController extends AppController {

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
        $this->Religion->recursive = 0;
        $this->set('religions', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Religion->exists($id)) {
            throw new NotFoundException(__('Invalid religion'));
        }
        $options = array('conditions' => array('Religion.' . $this->Religion->primaryKey => $id));
        $religionData = $this->Religion->find('first', $options);
        $this->loadModel('User');
        $createUserId = $religionData['Religion']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $religionData['Religion']['modified_by'];
        $religionData['Religion']['created'] = date("d-m-Y", strtotime($religionData['Religion']['created']));
        $religionData['Religion']['modified'] = date("d-m-Y", strtotime($religionData['Religion']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('religion', $religionData);
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
            $this->request->data['Religion']['created_by'] = $userid;
            $this->Religion->create();
            if ($this->Religion->save($this->request->data)) {
                $this->Session->setFlash('The religion has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The religion could not be saved. Please, try again.'));
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
        if (!$this->Religion->exists($id)) {
            throw new NotFoundException(__('Invalid religion'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Religion']['modified_by'] = $userid;
            if ($this->Religion->save($this->request->data)) {
                $this->Session->setFlash('The religion has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The religion could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Religion.' . $this->Religion->primaryKey => $id));
            $this->request->data = $this->Religion->find('first', $options);
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
        $this->Religion->id = $id;
        if (!$this->Religion->exists()) {
            throw new NotFoundException(__('Invalid religion'));
        }
        try {

        $this->request->onlyAllow('post', 'delete');
        if ($this->Religion->delete()) {
            $this->Session->setFlash('Religion deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('Religion cannot be deleted because it has been used at various sections'));

        $this->redirect(array('action' => 'index'));
    }

}
