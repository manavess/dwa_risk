<?php

App::uses('AppController', 'Controller');

/**
 * Employees Controller
 *
 * @property Employee $Employee
 */
class EmployeesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Employee->recursive = 0;
        $this->set('employees', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Employee->exists($id)) {
            throw new NotFoundException(__('Invalid employee'));
        }
        $options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
        $employeeData = $this->Employee->find('first', $options);
        $this->loadModel('User');
        $createUserId = $employeeData['Employee']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $employeeData['Employee']['modified_by'];
        $employeeData['Employee']['created'] = date("d-m-Y", strtotime($employeeData['Employee']['created']));
        $employeeData['Employee']['modified'] = date("d-m-Y", strtotime($employeeData['Employee']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('employee', $employeeData);
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
         $this->Employee->set($this->request->data);

            if ($this->Employee->validates()) {

       
            if (!empty($this->request->data) && $this->request->data['Employee']['document']['error']=='0' && is_uploaded_file($this->request->data['Employee']['document']['tmp_name'])) {
                $fileData = fread(fopen($this->request->data['Employee']['document']['tmp_name'], "r"), $this->request->data['Employee']['document']['size']);
                $this->request->data['Employee']['document'] = $fileData;
                
            $this->request->data['Employee']['date_of_joining'] = date("Y-m-d", strtotime($this->request->data['Employee']['date_of_joining']));
            $this->request->data['Employee']['date_of_confirm_joining'] = date("Y-m-d", strtotime($this->request->data['Employee']['date_of_confirm_joining']));
            $this->request->data['Employee']['date_of_resignation'] = date("Y-m-d", strtotime($this->request->data['Employee']['date_of_resignation']));
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['Employee']['created_by'] = $userid;
            $this->Employee->create();
            if ($this->Employee->save($this->request->data)) {
                $this->Session->setFlash('The employee has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
            }
            }  else {

                $this->Session->setFlash(__('The employee could not be saved. Please check either you have missed uploading document or the document type and size which you are uploading.'));
            }
        }else {
                // didn't validate logic
                $errors = $this->Employee->validationErrors;
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
        if (!$this->Employee->exists($id)) {
            throw new NotFoundException(__('Invalid employee'));
        }
        
        $employeedata = $this->Employee->read(null,$id);
        
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $msg = '';
            $empdoc = $this->Employee->find('first',array('fields'=>array('document'),'conditions'=>array('Employee.id'=>$id)));

            $fileData = '';

            if (!empty($this->request->data) && $this->request->data['Employee']['document']['error']=='0' && is_uploaded_file($this->request->data['Employee']['document']['tmp_name'])) { 
             $fileData = fread(fopen($this->request->data['Employee']['document']['tmp_name'], "r"), $this->request->data['Employee']['document']['size']);
            }else{
     
           	 $fileData = $empdoc['Employee']['document'];
 
            }
                $this->request->data['Employee']['document'] = $fileData;
      
                 $this->request->data['Employee']['date_of_joining'] = date("Y-m-d", strtotime($this->request->data['Employee']['date_of_joining']));
            $this->request->data['Employee']['date_of_confirm_joining'] = date("Y-m-d", strtotime($this->request->data['Employee']['date_of_confirm_joining']));
            $this->request->data['Employee']['date_of_resignation'] = date("Y-m-d", strtotime($this->request->data['Employee']['date_of_resignation']));
            $userid = $this->Session->read('Auth.User.id');
            $this->set('editid', $this->request->data['Employee']['id']);
            $this->request->data['Employee']['modified_by'] = $userid;
		        if ($this->Employee->save($this->request->data)) {
		            $this->Session->setFlash('The employee has been saved. ','default',array('class'=>'successmessage'));
		            $this->redirect(array('action' => 'index'));
		        } else {
		            $this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
		        }
            
           
        } else {
            $options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
            $this->request->data = $this->Employee->find('first', $options);
            $this->request->data['Employee']['date_of_joining'] = date("d-m-Y", strtotime($this->request->data['Employee']['date_of_joining']));
            $this->request->data['Employee']['date_of_confirm_joining'] = date("d-m-Y", strtotime($this->request->data['Employee']['date_of_confirm_joining']));
            $this->request->data['Employee']['date_of_resignation'] = date("d-m-Y", strtotime($this->request->data['Employee']['date_of_resignation']));
            $this->set('editid', $this->request->data['Employee']['id']);
        }
        $this->set('editid', $id);
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
        $this->Employee->id = $id;
        if (!$this->Employee->exists()) {
            throw new NotFoundException(__('Invalid employee'));
        }
        try{
        $this->request->onlyAllow('post', 'delete');
        if ($this->Employee->delete()) {
            $this->Session->setFlash('Employee deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
         }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('Employee cannot be deleted because it has been used at other section'));
        $this->redirect(array('action' => 'index'));
    }

    public function download() {
        //$this->layout = false;
        $id = $this->params['pass'][0];
        
        Configure::write('debug', 1);
        $options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
        $empData = $this->Employee->find('first', $options);
     
      
        header('Expires: 0');

		header('Pragma: public');

		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);
        header('Content-length: ' . strlen($empData['Employee']['document']));
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/x-download');
        header('Content-Disposition: attachment; filename="' . $empData['Employee']['name']);
        
        echo $empData['Employee']['document'];
        exit();
    }

}
