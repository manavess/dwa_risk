<?php

App::uses('AppController', 'Controller');

/**
 * Overviews Controller
 *
 * @property Overview $Overview
 */
class OverviewsController extends AppController {

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
        $this->Auth->allow('generaloverviewhtml');
    }

    public function index() {
        $this->Overview->recursive = 0;
        $this->set('overviews', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Overview->exists($id)) {
            throw new NotFoundException(__('Invalid overview'));
        }
        $options = array('conditions' => array('Overview.' . $this->Overview->primaryKey => $id));
        $overviewData = $this->Overview->find('first', $options);
        $this->loadModel('User');
        $createUserId = $overviewData['Overview']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $overviewData['Overview']['modified_by'];
        $overviewData['Overview']['created'] = date("d-m-Y", strtotime($overviewData['Overview']['created']));
        $overviewData['Overview']['modified'] = date("d-m-Y", strtotime($overviewData['Overview']['modified']));
        $overviewData['Overview']['overview'] = strip_tags($overviewData['Overview']['overview']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('overview', $overviewData);
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
            $this->request->data['Overview']['created_by'] = $userid;
            $this->request->data['Overview']['overview'] = trim($this->request->data['Overview']['overview']);
            $this->Overview->create();
            if ($this->Overview->save($this->request->data)) {
                $this->Session->setFlash('The overview has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The overview could not be saved. Please, try again.'));
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
        if (!$this->Overview->exists($id)) {
            throw new NotFoundException(__('Invalid overview'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Overview']['modified_by'] = $userid;
            $this->request->data['Overview']['overview'] = trim($this->request->data['Overview']['overview']);
            if ($this->Overview->save($this->request->data)) {
                $this->Session->setFlash('The overview has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The overview could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Overview.' . $this->Overview->primaryKey => $id));
            $this->request->data = $this->Overview->find('first', $options);
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
        $this->Overview->id = $id;
        if (!$this->Overview->exists()) {
            throw new NotFoundException(__('Invalid overview'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Overview->delete()) {
            $this->Session->setFlash('Overview deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Overview was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function generaloverviewhtml() {
        $this->set('overviews', $this->Overview->find('first'));
    }

}
