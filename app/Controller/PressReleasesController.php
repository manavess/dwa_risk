<?php
App::uses('AppController', 'Controller');
/**
 * PressReleases Controller
 *
 * @property PressRelease $PressRelease
 */
class PressReleasesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */	var $components = array("Email", 'Session', 'Cookie');
	public $helpers = array('Html', 'Form', 'Js', 'TinyMCE.TinyMCE');
	
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generalpressreleasehtml');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PressRelease->recursive = 0;
		$this->set('pressReleases', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PressRelease->exists($id)) {
			throw new NotFoundException(__('Invalid press release'));
		}
		$options = array('conditions' => array('PressRelease.' . $this->PressRelease->primaryKey => $id));
		$pressReleaseData = $this->PressRelease->find('first', $options);
                $this->loadModel('User');
                $createUserId = $pressReleaseData['PressRelease']['created_by'];
                $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
                $modifyUserId = $pressReleaseData['PressRelease']['modified_by'];
                $pressReleaseData['PressRelease']['created'] = date("d-m-Y", strtotime($pressReleaseData['PressRelease']['created']));
                $pressReleaseData['PressRelease']['modified'] = date("d-m-Y", strtotime($pressReleaseData['PressRelease']['modified']));
                $pressReleaseData['PressRelease']['press_release'] = strip_tags($pressReleaseData['PressRelease']['press_release']);
                $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
                $this->set('pressRelease', $pressReleaseData);
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
                    $this->request->data['PressRelease']['created_by'] = $userid;
                    $this->request->data['PressRelease']['press_release'] = trim($this->request->data['PressRelease']['press_release']);
			$this->PressRelease->create();
			if ($this->PressRelease->save($this->request->data)) {
				$this->Session->setFlash('The press release has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The press release could not be saved. Please, try again.'));
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
		if (!$this->PressRelease->exists($id)) {
			throw new NotFoundException(__('Invalid press release'));
		}
		
		$this->loadModel('Subscribermail');
			$data = $this->Subscribermail->find('all',array('conditions'=>array('Subscribermail.status'=>'Y')));
	
			
		if ($this->request->is('post') || $this->request->is('put')) {
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['PressRelease']['modified_by'] = $userid;
                    $this->request->data['PressRelease']['press_release'] = trim($this->request->data['PressRelease']['press_release']);
			if ($this->PressRelease->save($this->request->data)) {
			
				
			/*Send mail to every subscriber*/
			 			//============Email================//
                            /* SMTP Options */
                            
                            if(!empty($data)){
                           
                            $ms = wordwrap($this->request->data['PressRelease']['press_release'], 1000);
                            foreach($data as $maildata){
                            $this->Email->smtpOptions = array(
                                'port' => '25',
                                'timeout' => '30',
                                'host' => 'mail.essindia.co.in',
                                'username' => 'vijay.kumar@essindia.co.in',
                                'password' => 'vijay.kumar'
                            );
                            $this->Email->template = 'newsletter';
                           $this->Email->from = 'vijay.kumar@essindia.co.in';
                            
                            $this->Email->to = $maildata['Subscribermail']['email'];
                            $this->Email->subject = 'Newsletter';
                            $this->Email->sendAs = 'both';
							$this->set('content', $ms);
                            $this->Email->delivery = 'smtp';
                            //@$this->Email->send($ms);
                            
                            try {
								if ( $this->Email->send($ms) ) {
									// Success
								} else {
									// Failure, without any exceptions
								}
							} catch ( Exception $e ) {
								//pr($e);
							}
                           
                            
                            
							}
						}
                            //============EndEmail=============//
			
			/**/
			
				$this->Session->setFlash('The press release has been saved','default',array('class'=>'successmessage'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The press release could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PressRelease.' . $this->PressRelease->primaryKey => $id));
			$this->request->data = $this->PressRelease->find('first', $options);
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
		$this->PressRelease->id = $id;
		if (!$this->PressRelease->exists()) {
			throw new NotFoundException(__('Invalid press release'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PressRelease->delete()) {
			$this->Session->setFlash('Press release deleted','default',array('class'=>'successmessage'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Press release was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function generalpressreleasehtml() {
        $this->set('pressRelease', $this->PressRelease->find('first'));
    }
}
