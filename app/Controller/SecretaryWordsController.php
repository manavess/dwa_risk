<?php
App::uses('AppController', 'Controller');
/**
 * SecretaryWords Controller
 *
 * @property SecretaryWord $SecretaryWord
 */
class SecretaryWordsController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');


public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalsecretarywordhtml');
        
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SecretaryWord->recursive = 0;
		$this->set('secretaryWords', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SecretaryWord->exists($id)) {
			throw new NotFoundException(__('Invalid secretary word'));
		}
		$options = array('conditions' => array('SecretaryWord.' . $this->SecretaryWord->primaryKey => $id));
		$secretaryWordData = $this->SecretaryWord->find('first', $options);
                $this->loadModel('User');
                $createUserId = $secretaryWordData['SecretaryWord']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $secretaryWordData['SecretaryWord']['modified_by'];
                $secretaryWordData['SecretaryWord']['created'] = date("d-m-Y", strtotime($secretaryWordData['SecretaryWord']['created']));
                $secretaryWordData['SecretaryWord']['modified'] = date("d-m-Y", strtotime($secretaryWordData['SecretaryWord']['modified']));
                $secretaryWordData['SecretaryWord']['secretary_word'] = strip_tags($secretaryWordData['SecretaryWord']['secretary_word']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                $this->set('secretaryWord', $secretaryWordData);
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
                    $this->request->data['SecretaryWord']['created_by'] = $userid;
                    $this->request->data['SecretaryWord']['secretary_word'] = trim($this->request->data['SecretaryWord']['secretary_word']);
			$this->SecretaryWord->create();
			if ($this->SecretaryWord->save($this->request->data)) {
				$this->Session->setFlash('The secretary word has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The secretary word could not be saved. Please, try again.'));
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
		if (!$this->SecretaryWord->exists($id)) {
			throw new NotFoundException(__('Invalid secretary word'));
		}
		if ($this->request->is('post') || $this->request->is('put')) { 
                    $userid = $this->Session->read('Auth.User.id');
            $this->request->data['SecretaryWord']['modified_by'] = $userid;
            $this->request->data['SecretaryWord']['secretary_word'] = trim($this->request->data['SecretaryWord']['secretary_word']);
			if ($this->SecretaryWord->save($this->request->data)) {
				$this->Session->setFlash('The secretary word has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The secretary word could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SecretaryWord.' . $this->SecretaryWord->primaryKey => $id));
			$this->request->data = $this->SecretaryWord->find('first', $options);
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
		$this->SecretaryWord->id = $id;
		if (!$this->SecretaryWord->exists()) {
			throw new NotFoundException(__('Invalid secretary word'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SecretaryWord->delete()) {
			$this->Session->setFlash('Secretary word deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Secretary word was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function generalsecretarywordhtml() {
        $this->set('secretaryWord', $this->SecretaryWord->find('first'));
    }
}
