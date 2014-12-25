<?php

App::uses('AppController', 'Controller');

/**
 * AboutMinistries Controller
 *
 * @property AboutMinistry $AboutMinistry
 */
class AboutMinistriesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalaboutministryhtml');
    }
    /**
     * index method
     *
     * @return void
     */
     
     
    public function index() {
        $this->AboutMinistry->recursive = 0;
        $this->set('aboutMinistries', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->AboutMinistry->exists($id)) {
            throw new NotFoundException(__('Invalid about ministry'));
        }
        $options = array('conditions' => array('AboutMinistry.' . $this->AboutMinistry->primaryKey => $id));
        $aboutMinistryData = $this->AboutMinistry->find('first', $options);
        $this->loadModel('User');
        $createUserId = $aboutMinistryData['AboutMinistry']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $aboutMinistryData['AboutMinistry']['modified_by'];
        $aboutMinistryData['AboutMinistry']['created'] = date("d-m-Y", strtotime($aboutMinistryData['AboutMinistry']['created']));
        $aboutMinistryData['AboutMinistry']['modified'] = date("d-m-Y", strtotime($aboutMinistryData['AboutMinistry']['modified']));
        $aboutMinistryData['AboutMinistry']['about_us'] = strip_tags($aboutMinistryData['AboutMinistry']['about_us']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('aboutMinistry', $aboutMinistryData);
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
            $this->request->data['AboutMinistry']['created_by'] = $userid;
            $this->request->data['AboutMinistry']['about_us']=trim($this->request->data['AboutMinistry']['about_us']);
            $this->AboutMinistry->create();
            if ($this->AboutMinistry->save($this->request->data)) {
                $this->Session->setFlash('The about ministry has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The about ministry could not be saved. Please, try again.'));
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
        if (!$this->AboutMinistry->exists($id)) {
            throw new NotFoundException(__('Invalid about ministry'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['AboutMinistry']['modified_by'] = $userid;
            $this->request->data['AboutMinistry']['about_us']=trim($this->request->data['AboutMinistry']['about_us']);
            if ($this->AboutMinistry->save($this->request->data)) {
                $this->Session->setFlash('The about ministry has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The about ministry could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('AboutMinistry.' . $this->AboutMinistry->primaryKey => $id));
            $this->request->data = $this->AboutMinistry->find('first', $options);
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
        $this->AboutMinistry->id = $id;
        if (!$this->AboutMinistry->exists()) {
            throw new NotFoundException(__('Invalid about ministry'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->AboutMinistry->delete()) {
            $this->Session->setFlash('About ministry deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('About ministry was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function generalaboutministryhtml() {
        $this->set('aboutMinistry', $this->AboutMinistry->find('first'));
    }

}
