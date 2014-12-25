<?php

App::uses('AppController', 'Controller');


class GalleriesController extends AppController {

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Html', 'Form', 'Js');

    /**
     * index method
     *
     * @return void
     */
    
      public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','add');
    }
    public function index() {
        $this->Gallery->recursive = 0;
        $this->set('galleries', $this->paginate());
    }
    
      public function add() {
    
          if ($this->request->is('post')) {
            $this->Gallery->set($this->request->data);

            if ($this->Gallery->validates()) {


                if (!empty($this->request->data) && $this->request->data['Gallery']['image']['error'] == '0' && is_uploaded_file($this->request->data['Gallery']['image']['tmp_name'])) {

                    //$fileData = fread(fopen($this->request->data['Gallery']['image']['tmp_name'], "r"), $this->request->data['Gallery']['image']['size']);
                    //$this->request->data['Gallery']['name'] = $fileData;
        //           $filename = fread(fopen($this->request->data['Gallery']['image']['tmp_name'], "r"));
                   
                    
                    
                    //$destination = "/home/vijay/public_html/dwa_risk/app/webroot/gallery/";
                    $destination = WWW_ROOT."gallery/".$this->request->data['Gallery']['image']['name'];
                    
                    
                    move_uploaded_file($this->request->data['Gallery']['image']['tmp_name'], $destination);
                    
                    
                    
                    $this->request->data['Gallery']['name'] = $this->request->data['Gallery']['image']['name'];
                    $userid = $this->Session->read('Auth.User.id');
                    $this->request->data['Gallery']['created'] = date('Y-m-d');
                    $this->request->data['Gallery']['createdby'] = $userid;
                    $this->request->data['Gallery']['modified'] = date('Y-m-d');
                    $this->request->data['Gallery']['modifiedby'] = $userid;
                    $this->Gallery->create();
                    if ($this->Gallery->save($this->request->data)) {
                        $this->Session->setFlash('The Gallery has been saved', 'default', array('class' => 'successmessage'));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The Gallery could not be saved. Please, try again.'));
                    }
                } else {

                    $this->Session->setFlash(__('The Gallery could not be saved. Please check either you have missed uploading document or the document type and size which you are uploading.'));
                }
            } else {
                // didn't validate logic
                $errors = $this->Gallery->validationErrors;
            }
        }
    }
    
    public function delete($id = null) {
        $this->Gallery->id = $id;
        if (!$this->Gallery->exists()) {
            throw new NotFoundException(__('Invalid image'));
        }
        try{
        $this->request->onlyAllow('post', 'delete');
        if ($this->Gallery->delete()) {
            $this->Session->setFlash('Gallery image deleted','default',array('class'=>'successmessage'));
            $this->redirect(array('action' => 'index'));
        }
         }catch ( Exception $e ) {   }
        $this->Session->setFlash(__('Gallery image could not be deleted'));
        $this->redirect(array('action' => 'index'));
    }
}

    
