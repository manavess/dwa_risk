<?php

App::uses('AppController', 'Controller');

/**
 * Universities Controller
 *
 * @property University $University
 */
class UniversitiesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('generaluniversityview','getcitylist');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->University->recursive = 0;
        $this->set('universities', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->University->exists($id)) {
            throw new NotFoundException(__('Invalid university'));
        }
        $options = array('conditions' => array('University.' . $this->University->primaryKey => $id));
        $universityData = $this->University->find('first', $options);
        $this->loadModel('User');
        $createUserId = $universityData['University']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $universityData['University']['modified_by'];
        $universityData['University']['created'] = date("d-m-Y", strtotime($universityData['University']['created']));
        $universityData['University']['modified'] = date("d-m-Y", strtotime($universityData['University']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('university', $universityData);
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
            
            if(isset($this->request->data['Reset']))
       		{
       			$this->redirect("/universities/add");
       			}
 
            $fileData = '';
            if (!empty($this->request->data) && $this->request->data['University']['image']['error']=='0' && is_uploaded_file($this->request->data['University']['image']['tmp_name'])) { 
               $fileData = fread(fopen($this->request->data['University']['image']['tmp_name'], "r"), $this->request->data['University']['image']['size']);
            }else{
     
           	 $fileData = $fileData;
 
            }
            
            $this->request->data['University']['image'] = $fileData;
                        
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['University']['created_by'] = $userid;
            $this->University->create();
            if ($this->University->save($this->request->data)) {
                $this->Session->setFlash('The university has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The university could not be saved. Please, try again.'));
            }
        }
        $cities = $this->University->City->find('list');
        $states = $this->University->State->find('list');
        $this->set(compact('cities', 'states'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->University->exists($id)) {
            throw new NotFoundException(__('Invalid university'));
        }
        
        //$univerdata = $this->University->read(null,$id);
        $unimage = $this->University->find('first',array('fields'=>array('image'),'conditions'=>array('University.id'=>$id)));

            $fileData = '';

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->request->data) && $this->request->data['University']['image']['error']=='0' && is_uploaded_file($this->request->data['University']['image']['tmp_name'])) { 
               $fileData = fread(fopen($this->request->data['University']['image']['tmp_name'], "r"), $this->request->data['University']['image']['size']);
            }else{
     
           	 $fileData = $unimage['University']['image'];
 
            }
            
            $this->request->data['University']['image'] = $fileData;
            
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['University']['modified_by'] = $userid;
            if ($this->University->save($this->request->data)) {
                $this->Session->setFlash('The university has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The university could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('University.' . $this->University->primaryKey => $id));
            $this->request->data = $this->University->find('first', $options);
        }
        
        $cities = $this->University->City->find('list');
        $states = $this->University->State->find('list');
        $this->set(compact('cities', 'states'));
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
        $this->University->id = $id;
        if (!$this->University->exists()) {
            throw new NotFoundException(__('Invalid university'));
        }
		try{
        $this->request->onlyAllow('post', 'delete');
        $this->University->College->deleteAll(array('College.university_id' => $id), false);
        if ($this->University->delete()) {
            $this->Session->setFlash('University deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
         }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('University cannot be deleted because it has been used for various colleges'));
        $this->redirect(array('action' => 'index'));
    }

    public function getcitylist() {
        $this->layout = null;
        $state_id = $this->request->data['State'];
        $cities = $this->University->City->find('list', array('conditions' => array('state_id' => $state_id, 'City.status' => 'Y')));
        $this->set('cities', $cities);
    }

    public function generaluniversityview() {
        $this->set('universities', $this->University->find('all'));
    }
}
