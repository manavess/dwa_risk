<?php

App::uses('AppController', 'Controller');

/**
 * AdmissionGuides Controller
 *
 * @property AdmissionGuide $AdmissionGuide
 */
class AdmissionGuidesController extends AppController {

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
        $this->Auth->allow('generaladmissionhtml','downloadadmissionguide');
    }

    public function index() {
        $this->AdmissionGuide->recursive = 0;
        $this->set('admissionGuides', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->AdmissionGuide->exists($id)) {
            throw new NotFoundException(__('Invalid admission guide'));
        }
        $options = array('conditions' => array('AdmissionGuide.' . $this->AdmissionGuide->primaryKey => $id));
        $admissionGuideData = $this->AdmissionGuide->find('first', $options);
        $this->loadModel('User');
        $createUserId = $admissionGuideData['AdmissionGuide']['created_by'];
        $createUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $createUserId)));
        $modifyUserId = $admissionGuideData['AdmissionGuide']['modified_by'];
        $admissionGuideData['AdmissionGuide']['created'] = date("d-m-Y", strtotime($admissionGuideData['AdmissionGuide']['created']));
        $admissionGuideData['AdmissionGuide']['modified'] = date("d-m-Y", strtotime($admissionGuideData['AdmissionGuide']['modified']));
        $admissionGuideData['AdmissionGuide']['admission_guide'] = strip_tags($admissionGuideData['AdmissionGuide']['admission_guide']);
        $modifyUserData = $this->User->find('first', array('fields' => array('id', 'username'), 'condition' => array('User.id' => $modifyUserId)));
        $this->set('admissionGuide', $admissionGuideData);
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
            if (!empty($this->request->data) && is_uploaded_file($this->request->data['AdmissionGuide']['image']['tmp_name'])) {
                $fileData = fread(fopen($this->request->data['AdmissionGuide']['image']['tmp_name'], "r"), $this->request->data['AdmissionGuide']['image']['size']);
                $this->request->data['AdmissionGuide']['image'] = $fileData;
            }
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['AdmissionGuide']['created_by'] = $userid;
            $this->request->data['AdmissionGuide']['admission_guide']=trim($this->request->data['AdmissionGuide']['admission_guide']);

            //$this->request->data['AdmissionGuide']['admission_guide'] = strip_tags($this->request->data['AdmissionGuide']['admission_guide']);
            $this->AdmissionGuide->create();
            if ($this->AdmissionGuide->save($this->request->data)) {
                $this->Session->setFlash('The admission guide has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The admission guide could not be saved. Please, try again.'));
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
        if (!$this->AdmissionGuide->exists($id)) {
            throw new NotFoundException(__('Invalid admission guide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
       
       /*Preuploaded*/ 
        $admissionguideimage = $this->AdmissionGuide->find("first",array('fields'=>array('image'),'conditions'=>array('AdmissionGuide.id'=>$id)));
        
        
            if (!empty($this->request->data) && is_uploaded_file($this->request->data['AdmissionGuide']['image']['tmp_name'])) {
                $fileData = fread(fopen($this->request->data['AdmissionGuide']['image']['tmp_name'], "r"), $this->request->data['AdmissionGuide']['image']['size']);
                $this->request->data['AdmissionGuide']['image'] = $fileData;
            }else{
          	  $this->request->data['AdmissionGuide']['image'] = $admissionguideimage['AdmissionGuide']['image'];
            }
            $userid = $this->Session->read('Auth.User.id');
            $this->request->data['AdmissionGuide']['modified_by'] = $userid;
            $this->request->data['AdmissionGuide']['admission_guide']=$this->request->data['AdmissionGuide']['admission_guide'];
            $pagetext = strip_tags($this->request->data['AdmissionGuide']['admission_guide'],'');
            if(!empty($pagetext) && $pagetext!=''){
            	 if ($this->AdmissionGuide->save($this->request->data)) {
                $this->Session->setFlash('The admission guide has been saved','default',array('class'=>'successmessage'));
                $this->redirect(array('action' => 'index'));
		        } else {
		            $this->Session->setFlash(__('The admission guide could not be saved. Please, try again.'));
		        }
            }else{
            $this->Session->setFlash(__('The admission guide could not be saved. Please, try again.'));
            }
           
        } else {
            $options = array('conditions' => array('AdmissionGuide.' . $this->AdmissionGuide->primaryKey => $id));
            $this->request->data = $this->AdmissionGuide->find('first', $options);
            $this->set('editid', $this->request->data['AdmissionGuide']['id']);
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
        $this->AdmissionGuide->id = $id;
        if (!$this->AdmissionGuide->exists()) {
            throw new NotFoundException(__('Invalid admission guide'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->AdmissionGuide->delete()) {
            $this->Session->setFlash('Admission guide deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Admission guide was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function generaladmissionhtml() {
        $this->set('admissionGuide', $this->AdmissionGuide->find('first'));
    }

    public function downloadadmissionguide() {
    
		//$name =  'KM_Document_v2.pdf'; 
		$name =  'admission_guidelines.pdf'; 
		
		$filename = 'download/'.$name; 
		 
		header('Expires: 0');

		header('Pragma: public');

		header("Content-Type: application/octet-stream");

		header("Content-Type: application/download");

		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

		header('Content-Disposition: attachment; filename="'.$name.'"');

		header('Content-Transfer-Encoding: binary');

		@readfile($filename);


    }
    
}
