<?php
App::uses('AppController', 'Controller');
/**
 * Notices Controller
 *
 * @property Notice $Notice
 */
class NoticesController extends AppController {

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
        $this->Auth->allow('generalnoticehtml');
    }
        
	public function index() {
		$this->Notice->recursive = 0;
		$this->set('notices', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notice->exists($id)) {
			throw new NotFoundException(__('Invalid notice'));
		}
		$options = array('conditions' => array('Notice.' . $this->Notice->primaryKey => $id));
		$noticeData = $this->Notice->find('first', $options);
                $this->loadModel('User');
                $createUserId = $noticeData['Notice']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $noticeData['Notice']['modified_by'];
                $noticeData['Notice']['created'] = date("d-m-Y", strtotime($noticeData['Notice']['created']));
                $noticeData['Notice']['modified'] = date("d-m-Y", strtotime($noticeData['Notice']['modified']));
                $noticeData['Notice']['notice'] = strip_tags($noticeData['Notice']['notice']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                $this->set('notice', $noticeData);
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
                    $this->request->data['Notice']['created_by'] = $userid;
                    $this->request->data['Notice']['notice'] = trim($this->request->data['Notice']['notice']);
			$this->Notice->create();
			if ($this->Notice->save($this->request->data)) {
				$this->Session->setFlash('The notice has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notice could not be saved. Please, try again.'));
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
		if (!$this->Notice->exists($id)) {
			throw new NotFoundException(__('Invalid notice'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['Notice']['modified_by'] = $userid;
                    $this->request->data['Notice']['notice'] = trim($this->request->data['Notice']['notice']);
			if ($this->Notice->save($this->request->data)) {
				$this->Session->setFlash('The notice has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notice could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notice.' . $this->Notice->primaryKey => $id));
			$this->request->data = $this->Notice->find('first', $options);
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
		$this->Notice->id = $id;
		if (!$this->Notice->exists()) {
			throw new NotFoundException(__('Invalid notice'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notice->delete()) {
			$this->Session->setFlash('Notice deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Notice was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function generalnoticehtml() {
        $this->set('notice', $this->Notice->find('first'));
    }
        
}
