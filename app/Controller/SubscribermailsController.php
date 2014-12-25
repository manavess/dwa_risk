<?php
App::uses('AppController', 'Controller');
/**
 * Subscribermails Controller
 *
 * @property Subscribermail $Subscribermail
 */
class SubscribermailsController extends AppController {

/**
 * index method
 *
 * @return void
 */
 
 public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('addsubscriber','unsubscribe');
    }
 
	public function index() {
		$this->Subscribermail->recursive = 0;
		$this->set('subscribermails', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Subscribermail->exists($id)) {
			throw new NotFoundException(__('Invalid subscribermail'));
		}
		$options = array('conditions' => array('Subscribermail.' . $this->Subscribermail->primaryKey => $id));
		$this->set('subscribermail', $this->Subscribermail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subscribermail->create();
			if ($this->Subscribermail->save($this->request->data)) {
				$this->Session->setFlash(__('The subscribermail has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscribermail could not be saved. Please, try again.'));
			}
		}
	}
	
	public function addsubscriber(){
	$this->layout=false;
	
	
		if(!empty($this->request->data['email'])){
			
			$data = array();
			$data = $this->Subscribermail->find('first',array('fields'=>array('id','status'),'conditions'=>array('Subscribermail.email LIKE '=>trim($this->request->data['email']),'Subscribermail.status'=>'Y')));		
			
		
			if(!empty($data['Subscribermail']['id']) && $data['Subscribermail']['status']=='Y'){
			
				echo $message = "This email is already in subscription list";
			}else if(!empty($data['Subscribermail']['id']) && $data['Subscribermail']['status']=='N'){
			
				$changedstatus = array('Subscribermail.status'=>"'Y'");
				$this->Subscribermail->updateAll($changedstatus,array('Subscribermail.id'=>$data['Subscribermail']['id']));
			}else{
			
			$this->request->data['Subscribermail']['email'] = $this->request->data['email'];
			$this->request->data['Subscribermail']['status'] = 'Y';
			
			$this->Subscribermail->create();
			if ($this->Subscribermail->save($this->request->data)) { 
				echo $message = "Your email has been subscribed and you will be in touch with our Press Release.";
			}else{
				echo $message = "Email could not be subscribed. Please try again later";
			}
			
			}
			
		}
	exit;

	}
	
	public function unsubscribe(){
	$this->layout=false;
	
	
		if(!empty($this->request->data['email'])){
			
			$this->request->data['Subscribermail']['email'] = $this->request->data['email'];
			$data = array();
			$data = $this->Subscribermail->find('first',array('fields'=>array('id'),'conditions'=>array('Subscribermail.email LIKE'=>trim($this->request->data['email']))));			
			if(!empty($data['Subscribermail']['id'])){
			$changedstatus = array('status'=> "'N'");
			
			$this->Subscribermail->create();
			if ($this->Subscribermail->updateAll($changedstatus,array('Subscribermail.id'=>$data['Subscribermail']['id']))) { 
			echo $message = "Your email has been unsubscribed successfully.";
			}else{
			echo $message = "Email could not be unsubscribed. Please try again later";
			}
			}else{
			echo $message = "Email does not exist";
			}
			
		}
	exit;

	}


}
