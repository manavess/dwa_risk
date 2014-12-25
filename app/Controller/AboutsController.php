<?php
App::uses('AppController', 'Controller');
/**
 * Abouts Controller
 *
 * @property About $About
 */
class AboutsController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');
        
        public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalaboutushtml');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->About->recursive = 0;
		$this->set('abouts', $this->paginate());
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->About->exists($id)) {
			throw new NotFoundException(__('Invalid about'));
		}
		$options = array('conditions' => array('About.' . $this->About->primaryKey => $id));
		$aboutData = $this->About->find('first', $options);
                $this->loadModel('User');
                $createUserId = $aboutData['About']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $aboutData['About']['modified_by'];
                $aboutData['About']['created'] = date("d-m-Y", strtotime($aboutData['About']['created']));
                $aboutData['About']['modified'] = date("d-m-Y", strtotime($aboutData['About']['modified']));
                $aboutData['About']['pagetext'] = strip_tags($aboutData['About']['pagetext']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                $this->set('about', $aboutData);
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
            $this->request->data['About']['created_by'] = $userid;
            $this->request->data['About']['pagetext']=trim($this->request->data['About']['pagetext']);
			$this->About->create();
			if ($this->About->save($this->request->data)) {
				$this->Session->setFlash('The about has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The about could not be saved. Please, try again.'));
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
		if (!$this->About->exists($id)) {
			throw new NotFoundException(__('Invalid about'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $userid = $this->Session->read('Auth.User.id');
            $this->request->data['About']['modified_by'] = $userid;
            $this->request->data['About']['pagetext']=trim($this->request->data['About']['pagetext']);
			if ($this->About->save($this->request->data)) {
				$this->Session->setFlash('The about has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The about could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('About.' . $this->About->primaryKey => $id));
			$this->request->data = $this->About->find('first', $options);
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
		$this->About->id = $id;
		if (!$this->About->exists()) {
			throw new NotFoundException(__('Invalid about'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->About->delete()) {
			$this->Session->setFlash('About deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('About was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
         public function generalaboutushtml() {
          $this->set('about', $this->About->find('first'));
    }
        
}
