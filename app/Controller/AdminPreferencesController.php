<?php

App::uses('AppController', 'Controller');

/**
 * AdminPreferences Controller
 *
 * @property AdminPreference $AdminPreference
 */
class AdminPreferencesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Js', 'Form', 'Html');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->AdminPreference->recursive = 0;
        $this->set('adminPreferences', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->AdminPreference->exists($id)) {
            throw new NotFoundException(__('Invalid admin preference'));
        }
        $options = array('conditions' => array('AdminPreference.' . $this->AdminPreference->primaryKey => $id));
        $adminPreferenceData = $this->AdminPreference->find('first', $options);
        $this->loadModel('User');
        $createUserId = $adminPreferenceData['AdminPreference']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $adminPreferenceData['AdminPreference']['modified_by'];
        $adminPreferenceData['AdminPreference']['created'] = date("d-m-Y", strtotime($adminPreferenceData['AdminPreference']['created']));
        $adminPreferenceData['AdminPreference']['modified'] = date("d-m-Y", strtotime($adminPreferenceData['AdminPreference']['modified']));
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('adminPreference', $adminPreferenceData);
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
            $this->request->data['AdminPreference']['created_by'] = $userid;
            $this->request->data['AdminPreference']['cut_off_date'] = date('Y-m-d', strtotime($this->data['AdminPreference']['cut_off_date']));
            
            if(!empty($this->request->data['AdminPreference']['year']) && $this->request->data['AdminPreference']['year'] !=date('Y', strtotime($this->data['AdminPreference']['cut_off_date']))){
           		
           		$this->Session->setFlash('The admin preference cut-off date must be of the year you mentioned in the form');
                $this->redirect(array('action' => 'index'));
            }
            
            $this->AdminPreference->create();
            if ($this->AdminPreference->save($this->request->data)) {
                $this->Session->setFlash('The admin preference has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The admin preference could not be saved. Please, try again.'));
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
        if (!$this->AdminPreference->exists($id)) {
            throw new NotFoundException(__('Invalid admin preference'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
        
        if(!empty($this->request->data['AdminPreference']['year']) && $this->request->data['AdminPreference']['year'] !=date('Y', strtotime($this->data['AdminPreference']['cut_off_date']))){
           		
           		$this->Session->setFlash('The admin preference cut-off date must be of the same Year that you mentioned in the form');
                $this->redirect(array('action' => 'edit',$id));
            }
        
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['AdminPreference']['modified_by'] = $userid;
            $this->request->data['AdminPreference']['cut_off_date'] = date('Y-m-d', strtotime($this->data['AdminPreference']['cut_off_date']));
            if ($this->AdminPreference->save($this->request->data)) {
                $this->Session->setFlash('The admin preference has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The admin preference could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('AdminPreference.' . $this->AdminPreference->primaryKey => $id));
            $this->request->data = $this->AdminPreference->find('first', $options);
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
        $this->AdminPreference->id = $id;
        if (!$this->AdminPreference->exists()) {
            throw new NotFoundException(__('Invalid admin preference'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->AdminPreference->delete()) {
            $this->Session->setFlash(__('Admin preference deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Admin preference was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
