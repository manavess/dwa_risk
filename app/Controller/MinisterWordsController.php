<?php
App::uses('AppController', 'Controller');
/**
 * MinisterWords Controller
 *
 * @property MinisterWord $MinisterWord
 */
class MinisterWordsController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');

public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalministerwordhtml');
        
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MinisterWord->recursive = 0;
		$this->set('ministerWords', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MinisterWord->exists($id)) {
			throw new NotFoundException(__('Invalid minister word'));
		}
		$options = array('conditions' => array('MinisterWord.' . $this->MinisterWord->primaryKey => $id));
		$ministerWordData = $this->MinisterWord->find('first', $options);
                $this->loadModel('User');
                $createUserId = $ministerWordData['MinisterWord']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $ministerWordData['MinisterWord']['modified_by'];
                $ministerWordData['MinisterWord']['created'] = date("d-m-Y", strtotime($ministerWordData['MinisterWord']['created']));
                $ministerWordData['MinisterWord']['modified'] = date("d-m-Y", strtotime($ministerWordData['MinisterWord']['modified']));
                $ministerWordData['MinisterWord']['minister_word'] = strip_tags($ministerWordData['MinisterWord']['minister_word']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                $this->set('ministerWord', $ministerWordData);
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
                    $this->request->data['MinisterWord']['created_by'] = $userid;
                    $this->request->data['MinisterWord']['minister_word'] = trim($this->request->data['MinisterWord']['minister_word']);
			$this->MinisterWord->create();
			if ($this->MinisterWord->save($this->request->data)) {
				$this->Session->setFlash('The minister word has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minister word could not be saved. Please, try again.'));
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
		if (!$this->MinisterWord->exists($id)) {
			throw new NotFoundException(__('Invalid minister word'));
		}
		if ($this->request->is('post') || $this->request->is('put')) { 
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['MinisterWord']['modified_by'] = $userid;
                    $this->request->data['MinisterWord']['minister_word'] = trim($this->request->data['MinisterWord']['minister_word']);
                    
			if ($this->MinisterWord->save($this->request->data)) {
				$this->Session->setFlash('The minister word has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minister word could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MinisterWord.' . $this->MinisterWord->primaryKey => $id));
			$this->request->data = $this->MinisterWord->find('first', $options);
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
		$this->MinisterWord->id = $id;
		if (!$this->MinisterWord->exists()) {
			throw new NotFoundException(__('Invalid minister word'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MinisterWord->delete()) {
			$this->Session->setFlash('Minister word deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Minister word was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function generalministerwordhtml() {
        $this->set('ministerWord', $this->MinisterWord->find('first'));
    }
}
