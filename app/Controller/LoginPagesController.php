<?php
App::uses('AppController', 'Controller');
/**
 * LoginPages Controller
 *
 * @property LoginPage $LoginPage
 */
class LoginPagesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');


	public function beforeFilter() {
		    parent::beforeFilter();
		    $this->Auth->allow('general_loginpagehtml');
		   
		}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->LoginPage->recursive = 0;
		$this->set('loginPages', $this->paginate());
	}
	
   public function general_loginpagehtml(){
   $this->LoginPage->recursive = 0;
		$this->set('loginPages', $this->LoginPage->find('first'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LoginPage->exists($id)) {
			throw new NotFoundException(__('Invalid login page'));
		}
		$options = array('conditions' => array('LoginPage.' . $this->LoginPage->primaryKey => $id));
		$loginPagesData = $this->LoginPage->find('first', $options);
                $this->loadModel('User');
                $createUserId = $loginPagesData['LoginPage']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $loginPagesData['LoginPage']['modified_by'];
                $loginPagesData['LoginPage']['created'] = date("d-m-Y", strtotime($loginPagesData['LoginPage']['created']));
                $loginPagesData['LoginPage']['modified'] = date("d-m-Y", strtotime($loginPagesData['LoginPage']['modified']));
                $loginPagesData['LoginPage']['pagetext'] = strip_tags($loginPagesData['LoginPage']['pagetext']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                $this->set('loginPage', $loginPagesData);
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
                    $this->request->data['LoginPage']['pagetext'] = strip_tags($this->request->data['LoginPage']['pagetext']);
		    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['LoginPage']['created_by'] = $userid;
                    $this->request->data['LoginPage']['pagetext'] = trim($this->request->data['LoginPage']['pagetext']);
                    $this->LoginPage->create();
			if ($this->LoginPage->save($this->request->data)) {
				$this->Session->setFlash('The login page has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The login page could not be saved. Please, try again.'));
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
		if (!$this->LoginPage->exists($id)) {
			throw new NotFoundException(__('Invalid login page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $this->request->data['LoginPage']['pagetext'] = strip_tags($this->request->data['LoginPage']['pagetext']);
		    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['LoginPage']['modified_by'] = $userid;
                    $this->request->data['LoginPage']['pagetext'] = trim($this->request->data['LoginPage']['pagetext']);
                    if ($this->LoginPage->save($this->request->data)) {
				$this->Session->setFlash('The login page has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The login page could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LoginPage.' . $this->LoginPage->primaryKey => $id));
			$this->request->data = $this->LoginPage->find('first', $options);
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
		$this->LoginPage->id = $id;
		if (!$this->LoginPage->exists()) {
			throw new NotFoundException(__('Invalid login page'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LoginPage->delete()) {
			$this->Session->setFlash('Login page deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Login page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
