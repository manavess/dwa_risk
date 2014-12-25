<?php
App::uses('AppController', 'Controller');
/**
 * FeeStructures Controller
 *
 * @property FeeStructure $FeeStructure
 */
class FeeStructuresController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalfeestructurehtml');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FeeStructure->recursive = 0;
		$this->set('feeStructures', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FeeStructure->exists($id)) {
			throw new NotFoundException(__('Invalid fee structure'));
		}
		$options = array('conditions' => array('FeeStructure.' . $this->FeeStructure->primaryKey => $id));
		$feeStructureData = $this->FeeStructure->find('first', $options);
                $this->loadModel('User');
                $createUserId = $feeStructureData['FeeStructure']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $feeStructureData['FeeStructure']['modified_by'];
                $feeStructureData['FeeStructure']['created'] = date("d-m-Y", strtotime($feeStructureData['FeeStructure']['created']));
                $feeStructureData['FeeStructure']['modified'] = date("d-m-Y", strtotime($feeStructureData['FeeStructure']['modified']));
                $feeStructureData['FeeStructure']['pagetext'] = strip_tags($feeStructureData['FeeStructure']['pagetext']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                
                $this->loadModel('AdminPreference');
                $adminSetFees = $this->AdminPreference->find('all');
               
                $this->set('fees',$adminSetFees);
                $this->set('feeStructure', $feeStructureData);
                $this->set('createuser', $createUserData['User']['username']);
                $this->set('modifyuser', $modifyUserData['User']['username']);
                }
                
                public function feesdisplay(){
                
		            $options = array('conditions' => array('FeeStructure.' . $this->FeeStructure->primaryKey => $id));
					$feeStructureData = $this->FeeStructure->find('first', $options);
					$feeStructureData['FeeStructure']['pagetext'] = strip_tags($feeStructureData['FeeStructure']['pagetext']);
					$this->set('feeStructure', $feeStructureData);
                }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['FeeStructure']['created_by'] = $userid;
                    $this->request->data['FeeStructure']['pagetext'] = trim($this->request->data['FeeStructure']['pagetext']);
			$this->FeeStructure->create();
			if ($this->FeeStructure->save($this->request->data)) {
				$this->Session->setFlash('The fee structure has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fee structure could not be saved. Please, try again.'));
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
		if (!$this->FeeStructure->exists($id)) {
			throw new NotFoundException(__('Invalid fee structure'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['FeeStructure']['modified_by'] = $userid;
                    $this->request->data['FeeStructure']['pagetext'] = trim($this->request->data['FeeStructure']['pagetext']);
			if ($this->FeeStructure->save($this->request->data)) {
				$this->Session->setFlash('The fee structure has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fee structure could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FeeStructure.' . $this->FeeStructure->primaryKey => $id));
			$this->request->data = $this->FeeStructure->find('first', $options);
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
		$this->FeeStructure->id = $id;
		if (!$this->FeeStructure->exists()) {
			throw new NotFoundException(__('Invalid fee structure'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FeeStructure->delete()) {
			$this->Session->setFlash('Fee structure deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Fee structure was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function generalfeestructurehtml() {
        $this->set('feeStructure', $this->FeeStructure->find('first'));
    }
}
